@props([
    'prepend' => false,
    'province' => true,
    'city' => true,
    'district' => true,
    'village' => true,
    'address' => true,
    'rt' => false,
    'rw' => false,
    'postal_code' => false,
    'value' => null,
    'no_telp' => true,

    'province_label' => 'Province',
    'city_label' => 'City',
    'district_label' => 'District',
    'village_label' => 'Village',
    'address_label' => 'Address',

    'rt_label' => 'RT',
    'rw_label' => 'RW',
    'postal_code_label' => 'Postal Code',
    'no_telp_label' => 'No. Telp',

    'default_placeholder' => 'Pilih',
])

@php
    $prepend = $prepend ? $prepend . '_' : '';

    $province_value = old($prepend . 'province_id');
    $province_options = [$default_placeholder];

    $city_value = old($prepend . 'city_id');
    $city_options = [$default_placeholder];

    $district_value = old($prepend . 'district_id');
    $district_options = [$default_placeholder];

    $village_value = old($prepend . 'village_id');
    $village_options = [$default_placeholder];

    $address_value = old($prepend . 'address');

    $rt_value = old($prepend . 'rt');
    $rw_value = old($prepend . 'rw');
    $postal_code_value = old($prepend . 'postal_code');
    $no_telp_value = old($prepend . 'no_telp');

    if ($value) {
        if ($value->{$prepend . 'province_id'}) {
            $province_value = $value->{$prepend . 'province_id'};
        }
        if ($value->{$prepend . 'city_id'}) {
            $city_value = $value->{$prepend . 'city_id'};
        }
        if ($value->{$prepend . 'district_id'}) {
            $district_value = $value->{$prepend . 'district_id'};
        }
        if ($value->{$prepend . 'village_id'}) {
            $village_value = $value->{$prepend . 'village_id'};
        }
        if ($value->{$prepend . 'address'}) {
            $address_value = $value->{$prepend . 'address'};
        }

        if ($value->{$prepend . 'rt'}) {
            $rt_value = $value->{$prepend . 'rt'};
        }
        if ($value->{$prepend . 'rw'}) {
            $rw_value = $value->{$prepend . 'rw'};
        }
        if ($value->{$prepend . 'postal_code'}) {
            $postal_code_value = $value->{$prepend . 'postal_code'};
        }
        if ($value->{$prepend . 'no_telp'}) {
            $no_telp_value = $value->{$prepend . 'no_telp'};
        }

    }

    if ($province_value) {
        $province_options = \Laravolt\Indonesia\Models\Province::where('code', $province_value)
            ->pluck('name', 'code')
            ->toArray();
    }
    if ($city_value) {
        $city_options = \Laravolt\Indonesia\Models\City::where('code', $city_value)
            ->pluck('name', 'code')
            ->toArray();
    }
    if ($district_value) {
        $district_options = \Laravolt\Indonesia\Models\District::where('code', $district_value)
            ->pluck('name', 'code')
            ->toArray();
    }
    if ($village_value) {
        $village_options = \Laravolt\Indonesia\Models\Village::where('code', $village_value)
            ->pluck('name', 'code')
            ->toArray();
    }

@endphp


@if ($province)
    <x-form.select2 :label="$province_label" :for="$prepend . 'province_id'" :name="$prepend . 'province_id'" :options="$province_options" :selected="$province_value"
        url="{{ route('api.public.provinces') }}" :error="$errors->first($prepend . 'province_id')" :data-clear-after-select="json_encode([$prepend . 'city_id', $prepend . 'district_id', $prepend . 'village_id'])" :data-change-url-after-select="json_encode([$prepend . 'city_id'])"
        />
@endif


@if ($city)
    <x-form.select2 :label="$city_label" :for="$prepend . 'city_id'" :name="$prepend . 'city_id'" :options="$city_options" :selected="$city_value"
        url="{{ route('api.public.cities') }}" :error="$errors->first($prepend . 'city_id')" :data-clear-after-select="json_encode([$prepend . 'district_id', $prepend . 'village_id'])" :data-change-url-after-select="json_encode([$prepend . 'district_id'])"
        />
@endif


@if ($district)
    <x-form.select2 :label="$district_label" :for="$prepend . 'district_id'" :name="$prepend . 'district_id'" :options="$district_options" :selected="$district_value"
        url="{{ route('api.public.districts') }}" :error="$errors->first($prepend . 'district_id')" :data-clear-after-select="json_encode([$prepend . 'village_id'])" :data-change-url-after-select="json_encode([$prepend . 'village_id'])"
        />
@endif

@if ($village)
    <x-form.select2 :label="$village_label" :for="$prepend . 'village_id'" :name="$prepend . 'village_id'" :options="$village_options" :selected="$village_value"
        url="{{ route('api.public.villages') }}" :error="$errors->first($prepend . 'village_id')"
        />
@endif


@if ($address)
    <x-form.textarea :label="$address_label" :for="$prepend . 'address'" :name="$prepend . 'address'" :error="$errors->first($prepend . 'address')" :value="$address_value" />
@endif


@if ($rt)
    <x-form.text :label="$rt_label" :for="$prepend . 'rt'" :name="$prepend . 'rt'" :error="$errors->first($prepend . 'rt')" :value="$rt_value" placeholder="01" />
@endif


@if ($rw)
    <x-form.text :label="$rw_label" :for="$prepend . 'rw'" :name="$prepend . 'rw'" :error="$errors->first($prepend . 'rw')" :value="$rw_value" placeholder="02" />
@endif


@if ($postal_code)
    <x-form.number :label="$postal_code_label" :for="$prepend . 'postal_code'" :name="$prepend . 'postal_code'" :error="$errors->first($prepend . 'postal_code')" :value="$postal_code_value" 
        placeholder="51866"
        />
@endif

@if ($no_telp)
    <x-form.text :label="$no_telp_label" :for="$prepend . 'no_telp'" :name="$prepend . 'no_telp'" :value="$no_telp_value" :error="$errors->first('no_telp')" />
@endif