<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    private function rules(): array
    {
        return [
            'owner_id' => ['required', 'exists:owners,id'],
            'name' => ['required', 'string', 'max:80'],
            'species' => ['required', Rule::in(Pet::SPECIES)],
            'breed' => ['nullable', 'string', 'max:80'],
            'sex' => ['required', Rule::in(['Male', 'Female'])],
            'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
            'weight_kg' => ['nullable', 'numeric', 'min:0.01', 'max:300'],
        ];
    }

    private function formData(): array
    {
        return [
            'owners' => Owner::orderBy('last_name')->get()->pluck('full_name', 'id'),
            'species' => array_combine(Pet::SPECIES, Pet::SPECIES),
        ];
    }

    public function index(Request $request)
    {
        $pets = Pet::with('owner')->withCount('appointments')
            ->when($request->filled('search'), fn ($q) => $q->where('name', 'like', '%'.$request->search.'%'))
            ->when($request->filled('species'), fn ($q) => $q->where('species', $request->species))
            ->orderBy('name')->paginate(10)->withQueryString();

        return view('pets.index', compact('pets') + ['speciesList' => Pet::SPECIES]);
    }

    public function create(Request $request)
    {
        return view('pets.create', $this->formData() + ['preselected' => $request->query('owner_id')]);
    }

    public function store(Request $request)
    {
        $pet = Pet::create($request->validate($this->rules()));

        return redirect()->route('pets.show', $pet)->with('success', 'Pet registered successfully.');
    }

    public function show(Pet $pet)
    {
        $pet->load(['owner', 'appointments' => fn ($q) => $q->with('veterinarian')->withCount('treatments')->orderByDesc('appointment_date')]);

        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit', ['pet' => $pet, 'preselected' => null] + $this->formData());
    }

    public function update(Request $request, Pet $pet)
    {
        $pet->update($request->validate($this->rules()));

        return redirect()->route('pets.show', $pet)->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete(); // appointments (and their treatments) are removed by cascading foreign keys

        return redirect()->route('pets.index')->with('success', 'Pet and its appointment history deleted successfully.');
    }
}
