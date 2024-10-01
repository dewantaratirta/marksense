@extends('layouts/layoutMaster')

@section('title', 'Create Admin')

@section('content')

    <div class="card mb-6">
        <h5 class="card-header">Create Admin</h5>

        <form class="card-body" action="{{ route('user_management.admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row">

                <div class="col-md-6">
                    <h6>Account Details</h6>

                    <x-form.text label="name" for="name" name="name" :value="old('name')" :error="$errors->first('name')" />
                    <x-form.text label="email" for="email" name="email" :value="old('email')" :error="$errors->first('email')" />
                    <x-form.text label="username" for="username" name="username" :value="old('username')" :error="$errors->first('username')" />
                </div>

                <div class="col-md-6">
                    <h6>Update Password</h6>

                    <x-form.password label="password" for="password" name="password" :error="$errors->first('password')" required/>
                    <x-form.password label="confirm password" for="password_confirmation" name="password_confirmation"
                        :error="$errors->first('password_confirmation')" required/>
                    <x-form.upload-image label="avatar" for="avatar" name="avatar" value=""
                        :error="$errors->first('avatar')" />
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary me-4 waves-effect">Create</button>
                    <a href="{{ route('user_management.admin.index') }}" class="btn btn-outline-secondary waves-effect">
                        Back
                    </a>
                </div>
            </div>

        </form>
    </div>

@endsection


@section('page-script')

@endsection
