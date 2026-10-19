@extends('layouts.app')
@section('title', 'Add Owner')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-plus-circle"></i> Add Owner</div>
    <form method="POST" action="{{ route('owners.store') }}" class="card-body">
        @csrf
        @include('owners._form')
    </form>
</div>
@endsection
