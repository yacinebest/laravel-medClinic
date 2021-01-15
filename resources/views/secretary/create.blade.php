@extends('layouts.templates.create',[
    'part_name'=>'Ajouter Secretaire','action_name'=>'Créer Secretaire','store_route_name'=>'secretary.store']
)

@section('CreateFormElements')
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
@endsection
