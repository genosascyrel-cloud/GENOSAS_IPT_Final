@extends('layouts.app')
@section('title', $veterinarian->name)
@section('content')
<div class="card shadow-sm mb-4"><div class="card-body d-flex justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="h3">{{ $veterinarian->name }}</h1>
        <div class="text-muted">{{ $veterinarian->specialization }} &middot; License {{ $veterinarian->license_number }}</div>
        <div><i class="bi bi-telephone"></i> {{ $veterinarian->phone ?? '—' }} &middot; <i class="bi bi-envelope"></i> {{ $veterinarian->email ?? '—' }}</div>
    </div>
    <div class="text-nowrap">
        <a href="{{ route('veterinarians.edit', $veterinarian) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
        <x-delete-btn :action="route('veterinarians.destroy', $veterinarian)" :name="$veterinarian->name" />
    </div>
</div></div>
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">Recent Appointments</div>
    <ul class="list-group list-group-flush">
        @forelse ($appointments as $a)
            <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span><a href="{{ route('appointments.show', $a) }}" class="text-decoration-none">{{ $a->appointment_date->format('M d, Y h:i A') }}</a>
                    &middot; {{ $a->pet->name }} <small class="text-muted">({{ $a->pet->owner->full_name }})</small></span>
                <span class="badge text-bg-{{ \App\Models\Appointment::STATUS_COLORS[$a->status] ?? 'light' }}">{{ $a->status }}</span>
            </li>
        @empty<li class="list-group-item text-muted">No appointments yet.</li>@endforelse
    </ul>
</div>
<a href="{{ route('veterinarians.index') }}" class="btn btn-link mt-2"><i class="bi bi-arrow-left"></i> Back</a>
@endsection
