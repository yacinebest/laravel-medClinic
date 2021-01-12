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
                            <span class="brand-name">Modifier le médecin</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">
                    {{-- <h4 class="text-dark mb-5"></h4> --}}
                    <form method="POST" action="{{ route('doctor.update',['doctor'=>$doctor->id]) }}">
                    @method('PUT')
                    @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input name="last_name" type="text" class="form-control" placeholder="Nom" value="{{ $doctor->last_name }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input name="first_name" type="text" class="form-control" placeholder="Prénom" value="{{ $doctor->first_name }}">
                                </div>
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input name="username" type="text" class="form-control input-lg" placeholder="Username" value="{{ $doctor->username }}">
                            </div>
                            <div class="form-group col-md-12 mb-4">
                                <input name="email" type="email" class="form-control input-lg" placeholder="Email" value="{{ $doctor->email }}">
                            </div>
                            <div class="form-group col-md-12 ">
                                <input name="specialty" type="text" class="form-control input-lg" placeholder="Specialité" value="{{ $doctor->specialty }}">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Soumettre</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
