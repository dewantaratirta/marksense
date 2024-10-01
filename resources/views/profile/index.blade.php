@extends('layouts/layoutMaster')

@section('title', 'Profile')

@section('content')

    <div class="row">
        {{-- import profile_hero --}}
        @include('profile.profile_hero', ['link_edit' => true])

    </div>

@endsection


@section('page-script')

@endsection
