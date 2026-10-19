<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    private function rules(): array
    {
        return [
            'appointment_id' => ['required', 'exists:appointments,id'],
            'name' => ['required', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'cost' => ['required', 'numeric', 'min:0', 'max:9999999'],
        ];
    }

    private function formData(): array
    {
        return [
            'appointments' => Appointment::with('pet')->orderByDesc('appointment_date')->get()
                ->mapWithKeys(fn ($a) => [$a->id => '#'.$a->id.' - '.$a->pet->name.' ('.$a->appointment_date->format('M d, Y').')']),
        ];
    }

    public function index()
    {
        $treatments = Treatment::with('appointment.pet')->latest()->paginate(10);

        return view('treatments.index', compact('treatments'));
    }

    public function create(Request $request)
    {
        return view('treatments.create', $this->formData() + ['preselected' => $request->query('appointment_id')]);
    }

    public function store(Request $request)
    {
        $treatment = Treatment::create($request->validate($this->rules()));

        return redirect()->route('appointments.show', $treatment->appointment_id)->with('success', 'Treatment recorded successfully.');
    }

    public function show(Treatment $treatment)
    {
        $treatment->load('appointment.pet.owner');

        return view('treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment)
    {
        return view('treatments.edit', ['treatment' => $treatment, 'preselected' => null] + $this->formData());
    }

    public function update(Request $request, Treatment $treatment)
    {
        $treatment->update($request->validate($this->rules()));

        return redirect()->route('appointments.show', $treatment->appointment_id)->with('success', 'Treatment updated successfully.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()->route('treatments.index')->with('success', 'Treatment deleted successfully.');
    }
}
