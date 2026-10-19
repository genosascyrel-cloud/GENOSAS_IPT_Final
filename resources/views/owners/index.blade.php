@extends('layouts.app')
@section('title', 'Owners')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0"><i class="bi bi-people"></i> Owners</h1>
    <a href="{{ route('owners.create') }}" class="btn btn-success"><i class="bi bi-plus-circle"></i> Add Owner</a>
</div>
<form method="GET" class="card card-body shadow-sm mb-3">
    <div class="row g-2">
        <div class="col-md-8"><input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search owner by name..."></div>
        <div class="col-md-3 d-flex gap-1"><button class="btn btn-outline-success flex-fill"><i class="bi bi-search"></i> Filter</button><a href="{{ route('owners.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a></div>
    </div>
</form>
<div class="card shadow-sm"><div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th>Name</th><th>Phone</th><th>Email</th><th>Pets</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @forelse ($owners as $owner)
            <tr>
                <td><a href="{{ route('owners.show', $owner) }}" class="fw-semibold text-decoration-none">{{ $owner->full_name }}</a></td>
                <td>{{ $owner->phone }}</td>
                <td>{{ $owner->email ?? '—' }}</td>
                <td><span class="badge text-bg-info">{{ $owner->pets_count }}</span></td>
                <td class="text-end text-nowrap">
                    <a href="{{ route('owners.show', $owner) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('owners.edit', $owner) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                    <x-delete-btn :action="route('owners.destroy', $owner)" :name="$owner->full_name" />
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted py-4">No owners found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div></div>
<div class="mt-3">{{ $owners->links() }}</div>
@endsection
