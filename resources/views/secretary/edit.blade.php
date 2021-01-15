@extends('layouts.templates.edit',[
'part_name'=>'Modifier Secretaire','update_route_name'=>'secretary.update','entity_name'=>'secretary','entity'=>$secretary]
)

@section('UpdateFormElements')
    <div class="col-sm-6">
        <div class="form-group">
            <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ $secretary->last_name }}" placeholder="Nom">
        </div>
        @error('last_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ $secretary->first_name }}" placeholder="Prénom">
        </div>
        @error('first_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $secretary->username }}" placeholder="Username">
        </div>
        @error('username')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $secretary->email }}" placeholder="Email">
        </div>
        @error('email')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
@endsection
