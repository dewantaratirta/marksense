@props([
    'label' => false,
    'for' => false,
    'error' => false,
    'required' => false,
    'withToggle' => true,
    'mb' => 'mb-3'
])

<div class="mb-3">
    <div class="form-password-toggle">
        <div class="input-group input-group-merge">
            <div class="form-floating form-floating-outline">
                <input type="password" id="{{ $for }}" class="form-control {{ $error ? 'is-invalid' : '' }}"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="{{ $for }}" 
                    {{ $attributes }}
                    @if ($required) required @endif
                    autocomplete="off"
                    />
                <label id="{{ $for }}">{{ $label }}</label>
            </div>
            @if ($withToggle)
            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
            @endif
        </div>
        <div id="{{ $for }}Help" class="form-text">{{ $slot }}</div>
        @if ($error)
            <div class="form-text text-danger text-capitalize" role="alert">{{ $error }}</div>
        @endif
    </div>
</div>
