@props(['name', 'label', 'options', 'selected' => null, 'required' => false])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} @if ($required)<span class="text-danger">*</span>@endif</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option value="">-- Select --</option>
        @foreach ($options as $key => $text)
            <option value="{{ $key }}" @selected((string) old($name, $selected) === (string) $key)>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
