@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="p-4 mb-4 rounded-3 text-white" style="background: linear-gradient(120deg,#0f766e,#14b8a6);">
    <h1 class="h3 mb-1"><i class="bi bi-heart-pulse"></i> Pet Clinic Management System</h1>
    <p class="mb-3">Manage owners, pets, veterinarians, appointments and treatments in one place.</p>
    <a href="{{ route('appointments.create') }}" class="btn btn-light btn-sm"><i class="bi bi-calendar-plus"></i> Book Appointment</a>
    <a href="{{ route('pets.create') }}" class="btn btn-outline-light btn-sm"><i class="bi bi-plus-circle"></i> Register Pet</a>
</div>

<div class="row g-3 mb-4">
    @foreach ($counts as $label => [$total, $route, $icon])
        <div class="col-6 col-md-4 col-lg">
            <a href="{{ route($route) }}" class="text-decoration-none">
                <div class="card stat-card shadow-sm text-center h-100"><div class="card-body">
                    <i class="bi {{ $icon }} fs-2 text-success"></i>
                    <div class="fs-3 fw-bold text-dark">{{ $total }}</div>
                    <div class="text-muted">{{ $label }}</div>
                </div></div>
            </a>
        </div>
    @endforeach
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold"><i class="bi bi-calendar-event"></i> Upcoming Appointments</div>
            <ul class="list-group list-group-flush">
                @forelse ($upcoming as $a)
                    <li class="list-group-item d-flex justify-content-between flex-wrap">
                        <div>
                            <a href="{{ route('appointments.show', $a) }}" class="fw-semibold text-decoration-none">{{ $a->pet->name }}</a>
                            <small class="text-muted">({{ $a->pet->owner->full_name }})</small>
                            <div class="small text-muted">{{ $a->reason }} &middot; {{ $a->veterinarian->name }}</div>
                        </div>
                        <span class="text-nowrap small">{{ $a->appointment_date->format('M d, h:i A') }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No upcoming appointments.</li>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <div class="text-muted">Total Treatment Revenue</div>
                <div class="display-6 fw-bold text-success">₱{{ number_format($revenue, 2) }}</div>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold"><i class="bi bi-person-badge"></i> Veterinarian Workload</div>
            <ul class="list-group list-group-flush">
                @foreach ($vets as $v)
                    <li class="list-group-item d-flex justify-content-between">
                        <a href="{{ route('veterinarians.show', $v) }}" class="text-decoration-none">{{ $v->name }}</a>
                        <span class="badge text-bg-success">{{ $v->appointments_count }} appts</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold"><i class="bi bi-bandaid"></i> Recent Treatments</div>
            <ul class="list-group list-group-flush">
                @forelse ($recentTreatments as $t)
                    <li class="list-group-item d-flex justify-content-between">
                        <span><a href="{{ route('treatments.show', $t) }}" class="text-decoration-none">{{ $t->name }}</a> for <strong>{{ $t->appointment->pet->name }}</strong></span>
                        <span>₱{{ number_format($t->cost, 2) }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No treatments recorded yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
