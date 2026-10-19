@extends('layouts.app')
@section('title', 'Edit Pet')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-pencil-square"></i> Edit Pet</div>
    <form method="POST" action="{{ route('pets.update', $pet) }}" class="card-body">
        @csrf @method('PUT')
        @include('pets._form', ['item' => $pet])
    </form>
</div>
@endsection
