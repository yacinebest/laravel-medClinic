@extends('layouts.master')
@section('mainContent')
<div class="content-wrapper">
    <div class="content">
        <div class="bg-white border rounded">
            <div class="row no-gutters">
                {{-- side bar --}}

                <div class="col-lg-4 col-xl-3">
                    <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                        <div class="card text-center widget-profile px-0 border-0">
                            <div class="card-body">
                                <h4 class="py-2 text-dark">{{ Auth::guard('doctor')->user()->last_name . ' ' . Auth::guard('doctor')->user()->first_name }}</h4>
                                <p>{{ Auth::guard('doctor')->user()->email }}</p>
                            </div>
                        </div>
                        <hr class="w-100">
                        <div class="contact-info pt-4">
                            <h5 class="text-dark mb-1">Informations personnelles</h5>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Username</p>
                            <p>{{ Auth::guard('doctor')->user()->username }}</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Email</p>
                            <p>{{ Auth::guard('doctor')->user()->email }}</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">specialitée</p>
                            <p>{{ Auth::guard('doctor')->user()->specialty }}</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-8 col-xl-9">
                    <div class="profile-content-right py-5">
                        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Changer Mot de passe</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-4 px-3 px-xl-5" id="myTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @if(Session::has('update_doctor'))
                                @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_doctor')])
                                @endif
                                <form method="POST" action="{{ route('doctor.updateprofile') }}" id="update-form">
                                    @csrf
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nom:</label>
                                                <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ Auth::guard('doctor')->user()->last_name }}" placeholder="Nom">
                                            </div>
                                            @error('last_name')
                                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Prénom:</label>
                                                <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ Auth::guard('doctor')->user()->first_name }}" placeholder="Prénom">
                                            </div>
                                            @error('first_name')
                                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username:</label>
                                                <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ Auth::guard('doctor')->user()->username }}" placeholder="Username">
                                            </div>
                                            @error('username')
                                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::guard('doctor')->user()->email }}" placeholder="Email">
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>specialitée:</label>
                                                <input name="specialty" type="text" class="form-control @error('specialty') is-invalid @enderror" value="{{ Auth::guard('doctor')->user()->specialty }}" placeholder="Specialité">
                                            </div>
                                            @error('specialty')
                                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="col-md-12">
                                            <button id="update-button" type="submit" class="btn btn-lg bt-primary btn-block mb-4">Soumettre</button>
                                        </div>
                                    </div>
                                </form>






                            </div>

                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <form method="POST" action="{{ route('doctor.updatepassword') }}" id="update-password">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mot de passe:</label>
                                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">
                                            </div>
                                            @error('password')
                                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label>Confirmer mot de passe:</label>
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmez le mot de passe">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button id="update-button" type="submit" class="btn btn-lg bt-primary btn-block mb-4">Soumettre</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection
