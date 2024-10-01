<form action="{{ route('profile.password_post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="d-flex justify-content-center">

        <div class="col-md-6">
            <div class="card mb-6">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Password</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <x-form.password label="Current Password" for="old_password" name="old_password"
                            :error="$errors->first('old_password')" required></x-form.password>
                        <hr />
                        <h5 class="mb-0">New Password</h5>
                        <x-form.password label="Password" for="password" name="password" :error="$errors->first('password')" required />
                        <x-form.password label="Confirm Password" for="password_confirmation"
                            name="password_confirmation" :error="$errors->first('password_confirmation')" required />
                    </div>


                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary me-4 waves-effect">Update</button>
                    </div>

                </div>
            </div>
        </div>

    </div>

</form>
