<?php

namespace App\Http\Controllers;

use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VeterinarianController extends Controller
{
    private function rules(?Veterinarian $vet = null): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'specialization' => ['required', 'string', 'max:100'],
            'license_number' => ['required', 'string', 'max:30', Rule::unique('veterinarians', 'license_number')->ignore($vet)],
            'phone' => ['nullable', 'string', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('veterinarians', 'email')->ignore($vet)],
        ];
    }

    public function index()
    {
        $veterinarians = Veterinarian::withCount('appointments')->orderBy('name')->paginate(10);

        return view('veterinarians.index', compact('veterinarians'));
    }

    public function create()
    {
        return view('veterinarians.create');
    }

    public function store(Request $request)
    {
        $vet = Veterinarian::create($request->validate($this->rules()));

        return redirect()->route('veterinarians.show', $vet)->with('success', 'Veterinarian added successfully.');
    }

    public function show(Veterinarian $veterinarian)
    {
        $appointments = $veterinarian->appointments()->with('pet.owner')->orderByDesc('appointment_date')->take(15)->get();

        return view('veterinarians.show', compact('veterinarian', 'appointments'));
    }

    public function edit(Veterinarian $veterinarian)
    {
        return view('veterinarians.edit', compact('veterinarian'));
    }

    public function update(Request $request, Veterinarian $veterinarian)
    {
        $veterinarian->update($request->validate($this->rules($veterinarian)));

        return redirect()->route('veterinarians.show', $veterinarian)->with('success', 'Veterinarian updated successfully.');
    }

    public function destroy(Veterinarian $veterinarian)
    {
        if ($veterinarian->appointments()->exists()) {
            return back()->with('error', "Cannot delete {$veterinarian->name}: this veterinarian still has appointments on record.");
        }

        $veterinarian->delete();

        return redirect()->route('veterinarians.index')->with('success', 'Veterinarian deleted successfully.');
    }
}
