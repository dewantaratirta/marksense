@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'required' => false,
    'options' => [],
    'selected' => null,
    'mb' => 'mb-6',
    'form' => 'form-floating form-floating-outline',

    // select2
    'url' => null, //ajax call
    'clearAfterSelect' => false //selector #id or .classname
])
@php
    $isArray = false;

    if (count($options) > 0) {
        if (
            ($options instanceof \Illuminate\Support\Collection && gettype($options->first()) == 'string') or
            gettype(reset($options)) == 'string'
        ) {
            $isArray = true;
        }
    }

@endphp

<div class="form-floating form-floating-outline {{ $mb }}">

    <select class="form-select {{ $error ? 'is-invalid' : '' }}" id="{{ $for }}" {{ $attributes }}
        @if ($url) data-url="{{ $url }}" @endif
        @if ($clearAfterSelect) data-clear-after-select="{{ $clearAfterSelect }}" @endif
        @if ($required) required @endif
    >

        @if (count($options) == 0)
            ''
        @elseif (!$isArray)
            @foreach ($options as $key => $value)
                <option value="{{ $value->id }}" {{ $value->id == $selected ? 'selected' : '' }}>
                    {{ $value->text }}
                </option>
            @endforeach
        @else
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        @endif
    </select>
    <label class="text-capitalize" for="{{ $for }}">{{ $label }}</label>


    @if ($error)
        <div class="invalid-feedback text-capitalize" role="alert">{{ $error }}</div>
    @endif
</div>
