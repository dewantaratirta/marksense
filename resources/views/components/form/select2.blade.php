@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'required' => false,
    'options' => [],
    'addons_options' => [], // example [0 => Pilih Data]
    'selected' => null,
    'value' => null,
    'mb' => 'mb-6',

    // select2
    'url' => null, //ajax call
    'clearAfterSelect' => false, //selector #id or .classname
])
@php
    # convert to object
    if (isChildrenIsArray($options)) {
        if (empty($options) || $options == null || $options == false) {
            $options = [];
        }
        if (count($options) > 0) {
            $temp_options = [];
            foreach ($options as $key => $v) {
                $temp_options[] = (object) ['id' => $key, 'text' => $v];
            }
            $options = $temp_options;
        }
    }
    $options = collect($options);

    if (isChildrenIsArray($addons_options)) {
        if (empty($addons_options) || $addons_options == null || $addons_options == false) {
            $addons_options = [];
        }
        if (count($addons_options) > 0) {
            $temp_addons_options = [];
            foreach ($addons_options as $key => $v) {
                $temp_addons_options[] = (object) ['id' => $key, 'text' => $v];
            }
            $addons_options = $temp_addons_options;
        }
    }
    $addons_options = collect($addons_options);

    $selected = $selected ?? $value;

    if(!$url) {
        $options = [...$options, ...$addons_options];
    }
@endphp

<div class="form-floating form-floating-outline {{ $mb }}">
    <select class="form-select select2 {{ $error ? 'is-invalid' : '' }}" id="{{ $for }}" {{ $attributes }}
        @if ($url) data-url="{{ $url }}" @endif
        @if ($clearAfterSelect) data-clear-after-select="{{ $clearAfterSelect }}" @endif
        @if (count((array) $addons_options) > 0) data-addons-options="{{ json_encode($addons_options->toArray()) }}" @endif
        @if ($required) required @endif>

        @if (!empty($options) || count((array) $options) > 0)
            @foreach ($options as $key => $value)
                <option value="{{ $value->id }}" {{ $value->id == $selected ? 'selected="selected"' : '' }}>{{ $value->text }}
                </option>
            @endforeach
        @endif
    </select>
    <label class="text-capitalize" for="{{ $for }}">{{ $label }}</label>
    @if ($error)
        <div class="invalid-feedback text-capitalize" role="alert">{{ $error }}</div>
    @endif
</div>
