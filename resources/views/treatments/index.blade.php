@extends('layouts.app')
@section('title', 'Treatments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0"><i class="bi bi-bandaid"></i> Treatments</h1>
    <a href="{{ route('treatments.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Treatment</a>
</div>
<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Treatment</th><th>Pet</th><th>Appointment Date</th><th>Cost</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($treatments as $treatment)
            <tr>
                <td><a href="{{ route('treatments.show', $treatment) }}" class="fw-semibold text-decoration-none">{{ $treatment->name }}</a></td>
                <td>{{ $treatment->appointment->pet->name }}</td>
                <td>{{ $treatment->appointment->appointment_date->format('M d, Y') }}</td>
                <td>₱{{ number_format($treatment->cost, 2) }}</td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('treatments.show', $treatment) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('treatments.edit', $treatment) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                    <x-delete-btn :action="route('treatments.destroy', $treatment)" :name="$treatment->name" />
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-4">No treatments found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $treatments->links() }}</div>
@endsection
