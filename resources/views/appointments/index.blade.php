@extends('layouts.app')
@section('title', 'Appointments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0"><i class="bi bi-calendar-check"></i> Appointments</h1>
    <a href="{{ route('appointments.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Appointment</a>
</div>
<form method="GET" class="card card-body shadow-sm mb-3">
    <div class="row g-2">
        <div class="col-md-4"><select name="status" class="form-select"><option value="">All statuses</option>@foreach ($statuses as $st)<option value="{{ $st }}" @selected(request('status') == $st)>{{ $st }}</option>@endforeach</select></div>
        <div class="col-md-3 d-flex gap-1"><button class="btn btn-outline-success flex-fill"><i class="bi bi-search"></i> Filter</button><a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a></div>
    </div>
</form>
<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Date & Time</th><th>Pet / Owner</th><th>Veterinarian</th><th>Status</th><th>Treatments</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($appointments as $appointment)
            <tr>
                <td><a href="{{ route('appointments.show', $appointment) }}" class="fw-semibold text-decoration-none">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</a></td>
                <td>{{ $appointment->pet->name }} <small class="text-muted">({{ $appointment->pet->owner->full_name }})</small></td>
                <td>{{ $appointment->veterinarian->name }}</td>
                <td><span class="badge text-bg-{{ \App\Models\Appointment::STATUS_COLORS[$appointment->status] ?? 'light' }}">{{ $appointment->status }}</span></td>
                <td><span class="badge text-bg-info">{{ $appointment->treatments_count }}</span></td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                    <x-delete-btn :action="route('appointments.destroy', $appointment)" :name="'appointment #'.$appointment->id" />
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">No appointments found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $appointments->links() }}</div>
@endsection
