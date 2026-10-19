<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | Pet Clinic Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f8f6; }
        .navbar { background: linear-gradient(90deg, #0f766e, #0e9aa7); }
        .stat-card { transition: transform .15s; } .stat-card:hover { transform: translateY(-3px); }
        
    </style>
</head>
<body>
@php
    $nav = [
        'dashboard' => ['Dashboard', 'bi-speedometer2'],
        'owners.index' => ['Owners', 'bi-people'],
        'pets.index' => ['Pets', 'bi-emoji-smile'],
        'veterinarians.index' => ['Veterinarians', 'bi-person-badge'],
        'appointments.index' => ['Appointments', 'bi-calendar-check'],
        'treatments.index' => ['Treatments', 'bi-bandaid'],
    ];
@endphp
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}"><i class="bi bi-heart-pulse"></i> Pet Clinic Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                @foreach ($nav as $route => [$label, $icon])
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($route === 'dashboard' ? 'dashboard' : explode('.', $route)[0].'.*') ? 'active fw-semibold' : '' }}" href="{{ route($route) }}">
                            <i class="bi {{ $icon }}"></i> {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Please fix the following:</strong>
            <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="text-center text-muted small py-4">Pet Clinic Management System &middot; Laravel Final Project</footer>

{{-- One reusable delete-confirmation modal for every module --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="deleteForm" class="modal-content">
            @csrf @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title text-danger"><i class="bi bi-trash"></i> Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete <strong id="deleteName"></strong>? This cannot be undone.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, delete</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('deleteModal').addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        document.getElementById('deleteForm').action = btn.dataset.action;
        document.getElementById('deleteName').textContent = btn.dataset.name;
    });
</script>
</body>
</html>
