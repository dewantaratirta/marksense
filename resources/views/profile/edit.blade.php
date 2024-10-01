@extends('layouts/layoutMaster')

@section('title', 'Edit Profile')

@section('content')

    @php
        //current route
        $currentRoute = Route::currentRouteName();
    @endphp

    <div class="row">
        {{-- import profile_hero --}}
        @include('profile.profile_hero', ['link_edit' => false, 'link_back' => true])

        @include('profile.profile_edit_tab', ['currentRoute' => 'profile.edit'])

        @switch($currentRoute)
            @case('profile.edit')
                @include('profile/edit/profile_form')
            @break

            @case('profile.edit_password')
                @include('profile/edit/password_form')
            @break

            @default
                {{-- Default case --}}
        @endswitch
    </div>

@endsection


@section('page-script')

@endsection
