@extends('layouts.app')
@section('title', $pet->name)
@section('content')
<div class="card shadow-sm mb-4"><div class="card-body">
    <div class="d-flex justify-content-between flex-wrap gap-2">
        <div>
            <h1 class="h3">{{ $pet->name }} <span class="badge text-bg-secondary fs-6">{{ $pet->species }}</span></h1>
            <div class="text-muted">Owner: <a href="{{ route('owners.show', $pet->owner) }}">{{ $pet->owner->full_name }}</a></div>
        </div>
        <div class="text-nowrap">
            <a href="{{ route('pets.edit', $pet) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
            <x-delete-btn :action="route('pets.destroy', $pet)" :name="$pet->name" />
        </div>
    </div>
    <hr>
    <dl class="row mb-0">
        <dt class="col-sm-3">Breed</dt><dd class="col-sm-9">{{ $pet->breed ?? '—' }}</dd>
        <dt class="col-sm-3">Sex</dt><dd class="col-sm-9">{{ $pet->sex }}</dd>
        <dt class="col-sm-3">Birth Date</dt><dd class="col-sm-9">{{ $pet->birth_date ? $pet->birth_date->format('M d, Y').' ('.$pet->birth_date->age.' yrs)' : '—' }}</dd>
        <dt class="col-sm-3">Weight</dt><dd class="col-sm-9">{{ $pet->weight_kg ? $pet->weight_kg.' kg' : '—' }}</dd>
    </dl>
</div></div>
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Appointment History ({{ $pet->appointments->count() }})</span>
        <a href="{{ route('appointments.create', ['pet_id' => $pet->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-calendar-plus"></i> Book</a>
    </div>
    <ul class="list-group list-group-flush">
        @forelse ($pet->appointments as $a)
            <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span><a href="{{ route('appointments.show', $a) }}" class="text-decoration-none">{{ $a->appointment_date->format('M d, Y h:i A') }}</a> &middot; {{ $a->reason }}
                    <small class="text-muted">({{ $a->veterinarian->name }}, {{ $a->treatments_count }} treatments)</small></span>
                <span class="badge text-bg-{{ \App\Models\Appointment::STATUS_COLORS[$a->status] ?? 'light' }}">{{ $a->status }}</span>
            </li>
        @empty<li class="list-group-item text-muted">No appointments yet.</li>@endforelse
    </ul>
</div>
<a href="{{ route('pets.index') }}" class="btn btn-link mt-2"><i class="bi bi-arrow-left"></i> Back</a>
@endsection
