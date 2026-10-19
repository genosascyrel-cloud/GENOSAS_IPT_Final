@extends('layouts.app')
@section('title', 'Edit Owner')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold"><i class="bi bi-pencil-square"></i> Edit Owner</div>
    <form method="POST" action="{{ route('owners.update', $owner) }}" class="card-body">
        @csrf @method('PUT')
        @include('owners._form', ['item' => $owner])
    </form>
</div>
@endsection
