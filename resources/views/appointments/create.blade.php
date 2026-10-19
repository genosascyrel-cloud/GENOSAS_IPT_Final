@extends('layouts.app')
@section('title', 'Add Appointment')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-plus-circle"></i> Add Appointment</div>
    <form method="POST" action="{{ route('appointments.store') }}" class="card-body">
        @csrf
        @include('appointments._form')
    </form>
</div>
@endsection
