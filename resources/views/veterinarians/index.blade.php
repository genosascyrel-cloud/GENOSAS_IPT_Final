@extends('layouts.app')
@section('title', 'Veterinarians')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0"><i class="bi bi-person-badge"></i> Veterinarians</h1>
    <a href="{{ route('veterinarians.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Veterinarian</a>
</div>
<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Name</th><th>Specialization</th><th>License</th><th>Phone</th><th>Appointments</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($veterinarians as $veterinarian)
            <tr>
                <td><a href="{{ route('veterinarians.show', $veterinarian) }}" class="fw-semibold text-decoration-none">{{ $veterinarian->name }}</a></td>
                <td>{{ $veterinarian->specialization }}</td>
                <td>{{ $veterinarian->license_number }}</td>
                <td>{{ $veterinarian->phone ?? '—' }}</td>
                <td><span class="badge text-bg-info">{{ $veterinarian->appointments_count }}</span></td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('veterinarians.show', $veterinarian) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('veterinarians.edit', $veterinarian) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                    <x-delete-btn :action="route('veterinarians.destroy', $veterinarian)" :name="$veterinarian->name" />
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">No veterinarians found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $veterinarians->links() }}</div>
@endsection
