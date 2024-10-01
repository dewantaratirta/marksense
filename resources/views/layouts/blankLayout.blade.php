@isset($pageConfigs)
{!! App\Helpers\Helpers::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = App\Helpers\Helpers::appClasses();
/* Display elements */
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/commonMaster' )

@section('layoutContent')

<!-- Content -->
@yield('content')
<!--/ Content -->

@endsection
