@extends('layouts.app')
@section('title', 'Edit Veterinarian')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-pencil-square"></i> Edit Veterinarian</div>
    <form method="POST" action="{{ route('veterinarians.update', $veterinarian) }}" class="card-body">
        @csrf @method('PUT')
        @include('veterinarians._form', ['item' => $veterinarian])
    </form>
</div>
@endsection
