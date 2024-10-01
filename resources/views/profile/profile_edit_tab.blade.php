@php
//current route
$currentRoute = Route::currentRouteName();
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-sm-row mb-6 row-gap-2">
                <li class="nav-item"><a
                        class="nav-link waves-effect waves-light
                    @if ($currentRoute == 'profile.edit') active @endif
                    "
                        href="{{route('profile.edit')}}"><i class="ri-user-3-line me-2"></i>Profile</a>
                </li>

                <li class="nav-item"><a
                        class="nav-link waves-effect waves-light
                    @if ($currentRoute == 'profile.edit_password') active @endif"
                        href="{{route('profile.edit_password')}}"><i class="fa-solid fa-key me-2"></i>Password</a>
                </li>
            </ul>
        </div>
    </div>
</div>
