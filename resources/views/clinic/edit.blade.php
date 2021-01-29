@extends('layouts.templates.edit',[
'part_name'=>'Modifier La clinic','update_route_name'=>'clinic.update','entity_name'=>'clinic','entity'=>$clinic]
)

@section('UpdateFormElements')
    <div class="col-sm-6">
        <div class="form-group">
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $clinic->name }}" placeholder="Nom">
        </div>
        @error('name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $clinic->address }}" placeholder="Adresse">
        </div>
        @error('address')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $clinic->phone_number }}" placeholder="X XX XX XX XX">
        </div>
        @error('phone_number')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
@endsection
