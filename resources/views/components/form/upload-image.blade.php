@props([
    'id' => 'file',
    'name' => 'file',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'label' => '',
    'editable' => true,
])


<div class="mb-6">
    <h6 for="{{ $id ?? $name }}">
        {{ ucfirst($label ?? $name) }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </h6>
    
    <input type="file" name="{{ $name }}" class="filepond" class="hidden" data-source="{{ $value }}"
        {{ $attributes }}>
    
    @error($name)
        <span class="invalid-feedback text-capitalize d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
