@extends('layouts.app')
@section('title', $treatment->name)
@section('content')
<div class="card shadow-sm"><div class="card-body">
    <div class="d-flex justify-content-between flex-wrap gap-2">
        <h1 class="h4">{{ $treatment->name }}</h1>
        <div class="text-nowrap">
            <a href="{{ route('treatments.edit', $treatment) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
            <x-delete-btn :action="route('treatments.destroy', $treatment)" :name="$treatment->name" />
        </div>
    </div>
    <hr>
    <dl class="row mb-0">
        <dt class="col-sm-3">Cost</dt><dd class="col-sm-9">₱{{ number_format($treatment->cost, 2) }}</dd>
        <dt class="col-sm-3">Pet</dt><dd class="col-sm-9"><a href="{{ route('pets.show', $treatment->appointment->pet) }}">{{ $treatment->appointment->pet->name }}</a> (owner: {{ $treatment->appointment->pet->owner->full_name }})</dd>
        <dt class="col-sm-3">Appointment</dt><dd class="col-sm-9"><a href="{{ route('appointments.show', $treatment->appointment) }}">#{{ $treatment->appointment_id }} - {{ $treatment->appointment->appointment_date->format('M d, Y') }}</a></dd>
        <dt class="col-sm-3">Notes</dt><dd class="col-sm-9">{{ $treatment->notes ?? '—' }}</dd>
    </dl>
</div></div>
<a href="{{ route('treatments.index') }}" class="btn btn-link mt-2"><i class="bi bi-arrow-left"></i> Back</a>
@endsection
