@extends('auth.master')
@section('form-login')
<div class="d-flex justify-content-center align-items-center">
    <form action="{{route('login')}}" method="post" class="mx-auto row modal-fullscreen-lg-down col-md-4">
        @csrf
        @if (session('msg'))
            <div class="alert alert-danger" role="alert">
              {{session('msg')}}
            </div>
        @endif
        <h1 class="col-12 mb-3 d-flex justify-content-center">Login</h1>
        <div class="col-12 mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="col-12 mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="col-12 mb-3">
            <label for="confirm_password" class="form-label">Confirm password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
          </div>
        <div class="col-12 d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </form>
</div>
@endsection