@props(['action', 'name'])
<button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
        data-action="{{ $action }}" data-name="{{ $name }}" title="Delete"><i class="bi bi-trash"></i></button>
