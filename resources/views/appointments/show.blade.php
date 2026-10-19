@extends('layouts.app')
@section('title', 'Appointment #'.$appointment->id)
@section('content')
<div class="card shadow-sm mb-4"><div class="card-body">
    <div class="d-flex justify-content-between flex-wrap gap-2">
        <div>
            <h1 class="h4">Appointment #{{ $appointment->id }}
                <span class="badge text-bg-{{ \App\Models\Appointment::STATUS_COLORS[$appointment->status] ?? 'light' }}">{{ $appointment->status }}</span></h1>
            <div class="text-muted">{{ $appointment->appointment_date->format('l, F d, Y \a\t h:i A') }}</div>
        </div>
        <div class="text-nowrap">
            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
            <x-delete-btn :action="route('appointments.destroy', $appointment)" :name="'appointment #'.$appointment->id" />
        </div>
    </div>
    <hr>
    <dl class="row mb-0">
        <dt class="col-sm-3">Pet</dt><dd class="col-sm-9"><a href="{{ route('pets.show', $appointment->pet) }}">{{ $appointment->pet->name }}</a> ({{ $appointment->pet->species }})</dd>
        <dt class="col-sm-3">Owner</dt><dd class="col-sm-9"><a href="{{ route('owners.show', $appointment->pet->owner) }}">{{ $appointment->pet->owner->full_name }}</a></dd>
        <dt class="col-sm-3">Veterinarian</dt><dd class="col-sm-9"><a href="{{ route('veterinarians.show', $appointment->veterinarian) }}">{{ $appointment->veterinarian->name }}</a></dd>
        <dt class="col-sm-3">Reason</dt><dd class="col-sm-9">{{ $appointment->reason }}</dd>
        <dt class="col-sm-3">Notes</dt><dd class="col-sm-9">{{ $appointment->notes ?? '—' }}</dd>
    </dl>
</div></div>
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Treatments &middot; Total ₱{{ number_format($appointment->treatments->sum('cost'), 2) }}</span>
        <a href="{{ route('treatments.create', ['appointment_id' => $appointment->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i> Add treatment</a>
    </div>
    <ul class="list-group list-group-flush">
        @forelse ($appointment->treatments as $t)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><a href="{{ route('treatments.show', $t) }}" class="text-decoration-none fw-semibold">{{ $t->name }}</a>
                    <small class="text-muted">{{ $t->notes }}</small></span>
                <span class="text-nowrap">₱{{ number_format($t->cost, 2) }}
                    <a href="{{ route('treatments.edit', $t) }}" class="btn btn-sm btn-outline-warning ms-2"><i class="bi bi-pencil"></i></a>
                    <x-delete-btn :action="route('treatments.destroy', $t)" :name="$t->name" /></span>
            </li>
        @empty<li class="list-group-item text-muted">No treatments recorded.</li>@endforelse
    </ul>
</div>
<a href="{{ route('appointments.index') }}" class="btn btn-link mt-2"><i class="bi bi-arrow-left"></i> Back</a>
@endsection
