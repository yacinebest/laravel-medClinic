@extends('layouts.master')
@section('mainContent')
<div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8 col-lg-8 col-md-10">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="app-brand">
                        <a href="#" onclick="event.preventDefault();">

                            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                                <g fill="none" fill-rule="evenodd">
                                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                </g>
                            </svg>
                            <span class="brand-name">Ajouter un médecin</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">
                    {{-- <h4 class="text-dark mb-5"></h4> --}}
                    <form method="POST" action="{{ route('doctor.store') }}">
                    @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Nom">
                                </div>
                                @error('last_name')
                                    <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="Prénom">
                                </div>
                                @error('first_name')
                                    <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(Session::has('first_name_last_name_unique'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-highlighted">{{ Session::get('first_name_last_name_unique') }}</div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Username">
                                </div>
                                @error('username')
                                    <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="specialty" type="text" class="form-control @error('specialty') is-invalid @enderror" value="{{ old('specialty') }}" placeholder="Specialité">
                                </div>
                                @error('specialty')
                                    <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="align-items-sm-center d-flex form-group">
                                    <div class="col-md-2">
                                        <label for="Radios" class="text-dark font-weight-medium mb-3">Role :</label>
                                    </div>
                                    <div class="col-md-10">
                                        <label class="control control-radio">Docteur
                                            <input type="radio" name="is_admin" value="0" checked="checked">
                                            <div class="control-indicator"></div>
                                        </label>
                                        <label class="control control-radio">Administrateur
                                            <input type="radio" name="is_admin" value="1" >
                                            <div class="control-indicator"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Mot de passe">
                                </div>
                                @error('password')
                                    <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmez le mot de passe">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Créer Médecin</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
