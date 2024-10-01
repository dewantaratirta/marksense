@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'required' => false,
    'mb' => 'mb-3',
])

@php
    $classList = '';
    $ariaInvalid = '';
    if ($error) {
        $classList = 'is-invalid invalid';
        $ariaInvalid = 'aria-invalid="true" invalid="true"';
    }
@endphp

<div class="input-group input-group-merge {{ $mb }}">
    <span class="input-group-text">Rp.</span>
    <div class="form-floating form-floating-outline">
        <input type="text" id="{{ $for }}" class="form-control mask-rupiah d-none {{ $classList }}"
            {{ $error ? 'is-invalid' : '' }} {{ $attributes }} @if ($required) required @endif
            inputmode="numeric">
        <label for="{{ $for }}Help">{{ $label }}</label>
    </div>
</div>

<div class="{{$mb}}">
    @if ($error)
        <div class="form-text text-danger text-capitalize" role="alert">{{ $error }}</div>
    @endif
</div>