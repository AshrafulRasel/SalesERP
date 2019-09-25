@extends('layouts.master')

@section('title', 'Profile | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Profile Update </h1>
                <p>Bootstrap default form components</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item"><a href="#"> Profile Update </a></li>
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
                            <form action="{{route('update_profile', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                 <div class="form-group">
                                    <label for="Inputfname">First Name</label>
                                    <input value="{{ Auth::user()->f_name }}" name="f_name" class="form-control" id="Inputfname" type="text" aria-describedby="emailHelp" placeholder="Enter email"><small class="form-text text-muted" id="emailHelp"></small>
                                </div>
                                <div class="form-group">
                                    <label for="Inputlname">Last Name </label>
                                    <input value="{{ Auth::user()->l_name }}" name="l_name" class="form-control" id="Inputlname" type="text" aria-describedby="emailHelp" placeholder="Enter email"><small class="form-text text-muted" id="emailHelp"></small>
                                </div>
                                <div class="form-group">
                                    <label for="InputEmail1">Email address</label>
                                    <input value="{{Auth::user()->email}}" name="email" class="form-control" id="InputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email"><small class="form-text text-muted" id="emailHelp"></small>
                                </div>

                                <div class="form-group">
                                    <label  >Profile Picture</label>
                                    <input class="form-control" name="image"   type="file" >
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>
                        </div>
                     <div class="tile-footer">
                    </div>
             </div>
        </div>
     </main>

 @endsection