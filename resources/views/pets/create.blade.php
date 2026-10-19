@extends('layouts.app')
@section('title', 'Add Pet')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-plus-circle"></i> Add Pet</div>
    <form method="POST" action="{{ route('pets.store') }}" class="card-body">
        @csrf
        @include('pets._form')
    </form>
</div>
@endsection
