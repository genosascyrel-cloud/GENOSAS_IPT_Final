@props(['name', 'label', 'type' => 'text', 'value' => null, 'step' => null, 'max' => null, 'required' => false])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} @if ($required)<span class="text-danger">*</span>@endif</label>
    @if ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="4" class="form-control @error($name) is-invalid @enderror">{{ old($name, $value) }}</textarea>
    @else
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
               @if ($step) step="{{ $step }}" @endif @if ($max) max="{{ $max }}" @endif
               class="form-control @error($name) is-invalid @enderror">
    @endif
    @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
