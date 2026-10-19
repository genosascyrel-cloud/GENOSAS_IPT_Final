<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OwnerController extends Controller
{
    private function rules(?Owner $owner = null): array
    {
        return [
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('owners', 'email')->ignore($owner)],
            'phone' => ['required', 'string', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function index(Request $request)
    {
        $owners = Owner::withCount('pets')
            ->when($request->filled('search'), fn ($q) => $q->where(fn ($w) => $w
                ->where('first_name', 'like', '%'.$request->search.'%')
                ->orWhere('last_name', 'like', '%'.$request->search.'%')))
            ->orderBy('last_name')->paginate(10)->withQueryString();

        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $owner = Owner::create($request->validate($this->rules()));

        return redirect()->route('owners.show', $owner)->with('success', 'Owner added successfully.');
    }

    public function show(Owner $owner)
    {
        $owner->load('pets');

        return view('owners.show', compact('owner'));
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $owner->update($request->validate($this->rules($owner)));

        return redirect()->route('owners.show', $owner)->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        if ($owner->pets()->exists()) {
            return back()->with('error', "Cannot delete {$owner->full_name}: this owner still has registered pets. Remove or reassign the pets first.");
        }

        $owner->delete();

        return redirect()->route('owners.index')->with('success', 'Owner deleted successfully.');
    }
}
