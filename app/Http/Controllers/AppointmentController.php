<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    private function rules(Request $request, ?Appointment $appointment = null): array
    {
        return [
            'pet_id' => ['required', 'exists:pets,id'],
            'veterinarian_id' => ['required', 'exists:veterinarians,id'],
            'appointment_date' => [
                'required', 'date',
                $appointment ? 'date' : 'after_or_equal:now', // new bookings must be in the future
                Rule::unique('appointments', 'appointment_date')
                    ->where('veterinarian_id', $request->input('veterinarian_id'))
                    ->where('status', '!=', 'Cancelled')
                    ->ignore($appointment),
            ],
            'reason' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(Appointment::STATUSES)],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    private function messages(): array
    {
        return ['appointment_date.unique' => 'This veterinarian already has an appointment at that date and time.'];
    }

    private function formData(): array
    {
        return [
            'pets' => Pet::with('owner')->orderBy('name')->get()->mapWithKeys(fn ($p) => [$p->id => $p->name.' ('.$p->owner->full_name.')']),
            'vets' => Veterinarian::orderBy('name')->pluck('name', 'id'),
            'statuses' => array_combine(Appointment::STATUSES, Appointment::STATUSES),
        ];
    }

    public function index(Request $request)
    {
        $appointments = Appointment::with(['pet.owner', 'veterinarian'])->withCount('treatments')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->orderByDesc('appointment_date')->paginate(10)->withQueryString();

        return view('appointments.index', compact('appointments') + ['statuses' => Appointment::STATUSES]);
    }

    public function create(Request $request)
    {
        return view('appointments.create', $this->formData() + ['preselected' => $request->query('pet_id')]);
    }

    public function store(Request $request)
    {
        $appointment = Appointment::create($request->validate($this->rules($request), $this->messages()));

        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment booked successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['pet.owner', 'veterinarian', 'treatments']);

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', ['appointment' => $appointment, 'preselected' => null] + $this->formData());
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($request->validate($this->rules($request, $appointment), $this->messages()));

        return redirect()->route('appointments.show', $appointment)->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete(); // treatments cascade

        return redirect()->route('appointments.index')->with('success', 'Appointment and its treatments deleted successfully.');
    }
}
