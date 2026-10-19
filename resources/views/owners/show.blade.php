@extends('layouts.app')
@section('title', $owner->full_name)
@section('content')
<div class="card shadow-sm mb-4"><div class="card-body d-flex justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="h3">{{ $owner->full_name }}</h1>
        <div><i class="bi bi-telephone"></i> {{ $owner->phone }} &middot; <i class="bi bi-envelope"></i> {{ $owner->email ?? '—' }}</div>
        <div class="text-muted"><i class="bi bi-geo-alt"></i> {{ $owner->address ?? 'No address' }}</div>
    </div>
    <div class="text-nowrap">
        <a href="{{ route('owners.edit', $owner) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
        <x-delete-btn :action="route('owners.destroy', $owner)" :name="$owner->full_name" />
    </div>
</div></div>
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Pets ({{ $owner->pets->count() }})</span>
        <a href="{{ route('pets.create', ['owner_id' => $owner->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i> Add pet</a>
    </div>
    <ul class="list-group list-group-flush">
        @forelse ($owner->pets as $p)
            <li class="list-group-item"><a href="{{ route('pets.show', $p) }}" class="text-decoration-none fw-semibold">{{ $p->name }}</a>
                <small class="text-muted">{{ $p->species }}{{ $p->breed ? ' / '.$p->breed : '' }}</small></li>
        @empty<li class="list-group-item text-muted">No pets registered.</li>@endforelse
    </ul>
</div>
<a href="{{ route('owners.index') }}" class="btn btn-link mt-2"><i class="bi bi-arrow-left"></i> Back</a>
@endsection
