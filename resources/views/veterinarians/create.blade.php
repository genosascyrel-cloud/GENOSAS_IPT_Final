@extends('layouts.app')
@section('title', 'Add Veterinarian')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-plus-circle"></i> Add Veterinarian</div>
    <form method="POST" action="{{ route('veterinarians.store') }}" class="card-body">
        @csrf
        @include('veterinarians._form')
    </form>
</div>
@endsection
