@extends('layouts.templates.edit',[
'part_name'=>'Modifier Médecins','update_route_name'=>'doctor.update','entity_name'=>'doctor','entity'=>$doctor]
)

@section('UpdateFormElements')
    <div class="col-sm-6">
        <div class="form-group">
            <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ $doctor->last_name }}" placeholder="Nom">
        </div>
        @error('last_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ $doctor->first_name }}" placeholder="Prénom">
        </div>
        @error('first_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $doctor->username }}" placeholder="Username">
        </div>
        @error('username')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $doctor->email }}" placeholder="Email">
        </div>
        @error('email')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="specialty" type="text" class="form-control @error('specialty') is-invalid @enderror" value="{{ $doctor->specialty }}" placeholder="Specialité">
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
                    @if(!$doctor->is_admin)
                        <input type="radio" name="is_admin" value="0" checked="checked">
                    @else
                        <input type="radio" name="is_admin" value="0">
                    @endif
                    <div class="control-indicator"></div>
                </label>
                <label class="control control-radio">Administrateur
                    @if($doctor->is_admin)
                        <input type="radio" name="is_admin" value="1" checked="checked">
                    @else
                        <input type="radio" name="is_admin" value="1">
                    @endif
                    <div class="control-indicator"></div>
                </label>
            </div>
        </div>
    </div>
@endsection
