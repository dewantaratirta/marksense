@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'required' => false,
    'mb' => 'mb-6'
])

<div class="form-floating form-floating-outline {{$mb}}">
    <input type="text" class="form-control {{ $error ? 'is-invalid' : '' }}" id="{{ $for }}"
        {{ $attributes }} @if ($required) required @endif>
    <label class="text-capitalize" for="{{ $for }}">{{ $label }}</label>
    <div id="{{ $for }}Help" class="form-text">{{ $slot }}</div>
    @if ($error)
        <div class="invalid-feedback text-capitalize" role="alert">{{ $error }}</div>
    @endif
</div>
