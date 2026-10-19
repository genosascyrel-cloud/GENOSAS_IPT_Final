@extends('layouts.app')
@section('title', 'Edit Treatment')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-pencil-square"></i> Edit Treatment</div>
    <form method="POST" action="{{ route('treatments.update', $treatment) }}" class="card-body">
        @csrf @method('PUT')
        @include('treatments._form', ['item' => $treatment])
    </form>
</div>
@endsection
