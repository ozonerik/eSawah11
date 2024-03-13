@extends('layouts.verify')
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('Verify Your Email Address') }}</h3>
    </div>
    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
        <div class="text-center">
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
        </div>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="row">
            <!-- /.col -->
            <div class="col-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection
