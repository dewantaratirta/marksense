@php
use Illuminate\Support\Carbon;

if (!isset($link_edit)) $link_edit = true;
if(!isset($link_back)) $link_back = false;
@endphp

<div class="row">
    <div class="col-12 mt-6">
        <div class="card mb-6">
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{ $user->avatarUrl('thumb') }}" alt="user image"
                        class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img shadow">
                </div>
                <div class="flex-grow-1 mt-4 mt-sm-12">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                        <div class="user-profile-info">
                            <h4 class="mb-2">{{ $user->name }}</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                <li class="list-inline-item">
                                    <i class="ri-user-2-line ri-24px me-2"></i><span
                                        class="fw-medium">{{ ucfirst($user->roles->first()->name) }}</span>
                                </li>

                                <li class="list-inline-item">
                                    <i class="ri-calendar-line me-2 ri-24px"></i><span
                                        class="fw-medium">{{ Carbon::parse($user->created_at)->format('j F Y') }}</span>
                                </li>
                            </ul>
                        </div>
                        @if ($link_edit)
                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-outline-primary waves-effect waves-light">
                            <i class="ri-user-settings-line ri-16px me-2"></i>Edit Profile
                        </a>
                        @endif

                        @if ($link_back)
                        <a href="{{ route('profile.index') }}"
                            class="btn btn-outline-secondary waves-effect">
                            <i class="ri-arrow-left-line ri-16px me-2"></i> Back
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>