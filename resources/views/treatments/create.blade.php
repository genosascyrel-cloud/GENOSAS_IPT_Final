@extends('layouts.app')
@section('title', 'Add Treatment')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-plus-circle"></i> Add Treatment</div>
    <form method="POST" action="{{ route('treatments.store') }}" class="card-body">
        @csrf
        @include('treatments._form')
    </form>
</div>
@endsection
