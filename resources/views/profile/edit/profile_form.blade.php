<form action="{{ route('profile.profile_post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="col-md-12">
        <div class="card mb-6">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Profile</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.text label="name" for="name" name="name" :value="old('name') ?? $user->name" :error="$errors->first('name')" />
                        <x-form.text label="email" for="email" name="email" :value="old('email') ?? $user->email" :error="$errors->first('email')" />
                        <x-form.text label="username" for="username" name="username" :value="$user->username"
                            :error="$errors->first('username')" />
                        <x-form.select2 label="Jenis Kelamin" for="gender" name="gender" :options="$gender_options"
                            :selected="$user->gender" :error="$errors->first('gender')" />
                    </div>

                    <div class="col-md-6">
                        <x-form.upload-image label="avatar" for="avatar" name="avatar"
                            value="{{ $user->avatarUrl() }}" :error="$errors->first('avatar')" />
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 mb-6">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-4 waves-effect">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
