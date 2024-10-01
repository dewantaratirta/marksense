@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'required' => false,
])

<div class="form-floating form-floating-outline mb-3">
    <input type="date" class="form-control {{ $error ? 'is-invalid' : '' }}" id="{{ $for }}"
        {{ $attributes }} @if ($required) required @endif>
    <label class="text-capitalize" for="{{ $for }}">{{ $label }}</label>
    <div id="{{ $for }}Help" class="form-text">{{ $slot }}</div>
    @if ($error)
        <div class="form-text text-danger text-capitalize" role="alert">{{ $error }}</div>
    @endif
</div>
