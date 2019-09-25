@extends('layouts.master')


@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Password Change </h1>
                <p>Bootstrap default form components</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item"><a href="#"> Password Change </a></li>
            </ul>
        </div>
        <div  class="col-md-6 offset-md-3">
                 <div class="tile">
                         <div class="col-lg-12">
                             <div>
                                 <div>
                                 <img width="60 px" class="app-sidebar__user-avatar"  src="{{ asset('images/user/'.Auth::user()->image) }}" alt="User Image">
                                    <p><span class="badge badge-dark">{{ Auth::user()->fullname }}</span></p>
                                  </div>
                             </div>
                             <form method="POST" action="{{ route('password.update') }}">
                                 @csrf

                                 <input type="hidden" name="token" value="{{ $token }}">

                                 <div class="form-group row">
                                     <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                     <div class="col-md-6">
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                         @error('email')
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                     <div class="col-md-6">
                                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                         @error('password')
                                         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                     <div class="col-md-6">
                                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                     </div>
                                 </div>

                                 <div class="form-group row mb-0">
                                     <div class="col-md-6 offset-md-4">
                                         <button type="submit" class="btn btn-primary">
                                             {{ __('Reset Password') }}
                                         </button>
                                     </div>
                                 </div>
                             </form>
                        </div>
                     <div class="tile-footer">
                    </div>
             </div>
        </div>
     </main>

 @endsection