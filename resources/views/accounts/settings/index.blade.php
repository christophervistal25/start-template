@extends('templates.dashboard')
@section('title','Account Settings')
@section('content')
@include('alerts.success')
<div class="row">
    <div class="col-md-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-capitalize">change account username</h6>
            </div>
            <div class="card-body">
                <form method="POST" autocomplete="off" action="{{route('update.account.settings')}}">
                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <label class="text-capitalize font-weight-bold">current username : </label>
                        <input type="text" name="current_username" readonly class="form-control form-control-user form-control{{ $errors->has('current_username') ? ' is-invalid' : '' }}" value="{{ Auth::user()->username }}" >
                        
                        @if ($errors->has('current_username'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('current_username') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">new username : </label>
                        <input type="text" name="new_username" class="form-control form-control-user form-control{{ $errors->has('new_username') ? ' is-invalid' : '' }}" value="{{ old('new_username') }}" >
                        
                        @if ($errors->has('new_username'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('new_username') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">password : </label>
                        <input type="text" name="current_password" class="form-control form-control-user form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" value="{{ old('current_password') }}" >
                        
                        @if ($errors->has('current_password'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <input type="hidden" value="{{\Crypt::encrypt('changeUsername')}}" name="action_type">
                    <div class="form-group">
                        <input type="submit" value="change username" class="text-capitalize btn btn-primary btn-sm shadow font-weight-bold float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-capitalize">change account profile</h6>
            </div>
            <div class="card-body text-center">
                <div class="form-group">
                    <img width="198px" height="198px" src="{{ url("storage/profile_images/" . Auth::user()->profile_image) }}" class="img-fluid rounded-circle">
                </div>
                <form method="POST" action="{{route('update.account.settings')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="file" name="profile_image">
                    </div>
                        
                    <input type="hidden" value="{{\Crypt::encrypt('changeProfile')}}" name="action_type">
                    <div class="form-group">
                        <input type="submit" value="change profile" class="text-capitalize btn btn-primary btn-sm shadow font-weight-bold float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-capitalize">change account password</h6>
            </div>
            <div class="card-body">
                <form method="POST" autocomplete="off" action="{{route('update.account.settings')}}">
                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <label class="text-capitalize font-weight-bold">current password : </label>
                        <input type="password" name="user_current_password" class="form-control form-control-user form-control{{ $errors->has('user_current_password') ? ' is-invalid' : '' }}" value="{{ old('user_current_password') }}" >
                        
                        @if ($errors->has('user_current_password'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('user_current_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        @csrf
                        <label class="text-capitalize font-weight-bold">new password : </label>
                        <input type="password" name="new_password" class="form-control form-control-user form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" value="{{ old('new_password') }}" >
                        
                        @if ($errors->has('new_password'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('new_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        @csrf
                        <label class="text-capitalize font-weight-bold">confirm password : </label>
                        <input type="password" name="confirm_new_password" class="form-control form-control-user form-control{{ $errors->has('confirm_new_password') ? ' is-invalid' : '' }}" value="{{ old('confirm_new_password') }}" >
                        
                        @if ($errors->has('confirm_new_password'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('confirm_new_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <input type="hidden" value="{{\Crypt::encrypt('changePassword')}}" name="action_type">
                    <div class="form-group">
                        <input type="submit" value="change password" class="text-capitalize btn btn-primary btn-sm shadow font-weight-bold float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-capitalize">add new administrator</h6>
            </div>
            <div class="card-body">
                <form method="POST" autocomplete="off" enctype="multipart/form-data" action="{{route('store.account.settings')}}">
                    <div class="form-group">
                        @csrf
                        <label class="text-capitalize font-weight-bold">full name : </label>
                        <input type="text" name="name" class="form-control form-control-user form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" >
                        
                        @if ($errors->has('name'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">username : </label>
                        <input type="text" name="username" class="form-control form-control-user form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" >
                        
                        @if ($errors->has('username'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">email : </label>
                        <input type="email" name="email" class="form-control form-control-user form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" >
                        
                        @if ($errors->has('email'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">password : </label>
                        <input type="password" name="password" class="form-control form-control-user form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" >
                        
                        @if ($errors->has('password'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">confirm password : </label>
                        <input type="password" name="confirm_password" class="form-control form-control-user form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" value="{{ old('confirm_password') }}" >
                        
                        @if ($errors->has('confirm_password'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('confirm_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-capitalize font-weight-bold">Profile : </label>
                        <input type="file" name="profile_image">
                        
                        @if ($errors->has('profile_image'))
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $errors->first('profile_image') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create administrator" class="text-capitalize btn btn-primary btn-sm shadow font-weight-bold float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection