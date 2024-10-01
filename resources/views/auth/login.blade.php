@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
            <div class="authentication-inner py-6">

                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets/img/favicon/apple-touch-icon.png') }}" width="25px">
                            </span>
                            <span
                                class="app-brand-text demo text-heading fw-semibold">{{ config('variables.templateName') }}</span>
                        </a>
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h4 class="mb-1">Welcome to {{ config('variables.templateName') }}! 👋</h4>
                        <p class="mb-5">Please sign-in to your account and start the adventure</p>

                        <form method="POST" action="{{ route('login') }}">
                          @csrf
                          <x-form.text label="username or email" for="username" name="username" :value="old('username')" :error="$errors->first('username')"
                              required></x-form.text>
                          <x-form.password label="password" for="password" name="password" :error="$errors->first('password')"
                              required></x-form.password>

                          <div class="mb-3 d-flex justify-content-between">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                  {{ old('remember') ? 'checked' : '' }} />
                                  <label class="form-check-label" for="remember"> Remember Me </label>
                              </div>
                          </div>
                          <div class="mb-3">
                              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                          </div>
                      </form>

                      @if (Route::has('register'))
                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
                            </a>
                        </p>
                      @endif

                      @if (Route::has('password.request'))
                        <p class="text-center">
                            <span>Forgot Password ? </span>
                            <a href="{{ route('password.request') }}">
                                <span>Click here</span>
                            </a>
                        </p>
                      @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
