@extends('layouts/layoutMaster')

@section('title', 'Edit Superadmin')

@section('content')

    <div class="card mb-6">
        <h5 class="card-header">Edit User</h5>

        <form class="card-body" action="{{ route('user_management.superadmin.update', $user->ulid) }}" method="POST" enctype="multipart/form-data"
            autocomplete="off"
            >
            @csrf
            @method('PATCH')

            <div class="row">

                <div class="col-md-6">
                    <h6>Account Details</h6>

                    <x-form.text label="name" for="name" name="name" :value="$user->name" :error="$errors->first('name')" />
                    <x-form.text label="email" for="email" name="email" :value="$user->email" :error="$errors->first('email')" />
                    <x-form.text label="username" for="username" name="username" :value="$user->username" :error="$errors->first('username')" />
                    <hr />
                    <x-form.select2 label="User Role" for="role" name="role" :options="$roles" :selected="$user->roles[0]->id"
                        :error="$errors->first('role')" />

                </div>


                <div class="col-md-6">
                    <h6>Update Password</h6>

                    <x-form.password label="password" for="password" name="password" :error="$errors->first('password')" />
                    <x-form.password label="confirm password" for="password_confirmation" name="password_confirmation"
                        :error="$errors->first('password_confirmation')" />
                    <x-form.upload-image label="avatar" for="avatar" name="avatar" value="{{ $user->avatarUrl() }}"
                        :error="$errors->first('avatar')" />
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary me-4 waves-effect">Update</button>
                    <a href="{{ route('user_management.superadmin.index') }}" class="btn btn-outline-secondary waves-effect">
                        Back
                    </a>
                </div>
            </div>

        </form>
    </div>

@endsection


@section('page-script')

@endsection
