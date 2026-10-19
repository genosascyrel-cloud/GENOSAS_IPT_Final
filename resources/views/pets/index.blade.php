@extends('layouts.app')
@section('title', 'Pets')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0"><i class="bi bi-emoji-smile"></i> Pets</h1>
    <a href="{{ route('pets.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Pet</a>
</div>
<form method="GET" class="card card-body shadow-sm mb-3">
    <div class="row g-2">
        <div class="col-md-5"><input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search pet name..."></div><div class="col-md-3"><select name="species" class="form-select"><option value="">All species</option>@foreach ($speciesList as $sp)<option value="{{ $sp }}" @selected(request('species') == $sp)>{{ $sp }}</option>@endforeach</select></div>
        <div class="col-md-3 d-flex gap-1"><button class="btn btn-outline-success flex-fill"><i class="bi bi-search"></i> Filter</button><a href="{{ route('pets.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a></div>
    </div>
</form>
<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Name</th><th>Species / Breed</th><th>Owner</th><th>Appointments</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($pets as $pet)
            <tr>
                <td><a href="{{ route('pets.show', $pet) }}" class="fw-semibold text-decoration-none">{{ $pet->name }}</a></td>
                <td>{{ $pet->species }}{{ $pet->breed ? ' / '.$pet->breed : '' }}</td>
                <td><a href="{{ route('owners.show', $pet->owner) }}" class="text-decoration-none">{{ $pet->owner->full_name }}</a></td>
                <td><span class="badge text-bg-info">{{ $pet->appointments_count }}</span></td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('pets.show', $pet) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('pets.edit', $pet) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                    <x-delete-btn :action="route('pets.destroy', $pet)" :name="$pet->name" />
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-4">No pets found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $pets->links() }}</div>
@endsection
