@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::guard('doctor')->check())
                        {{ __('Hello Dr.' . Auth::guard('doctor')->user()->first_name . " " . Auth::guard('doctor')->user()->last_name ) }}
                    @elseif(Auth::guard('secretary')->check())
                        {{ __('Hello Sc.' . Auth::guard('secretary')->user()->first_name . " " . Auth::guard('secretary')->user()->last_name ) }}
                    @else
                        {{ __('You are not logged in!') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
