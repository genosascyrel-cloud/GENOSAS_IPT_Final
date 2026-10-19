@extends('layouts.app')
@section('title', 'Edit Appointment')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-pencil-square"></i> Edit Appointment</div>
    <form method="POST" action="{{ route('appointments.update', $appointment) }}" class="card-body">
        @csrf @method('PUT')
        @include('appointments._form', ['item' => $appointment])
    </form>
</div>
@endsection
