@extends('layouts.templates.show',['name_entity'=>'Docteur'])

@section('entity_data')

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Nom:</label></div>
            <div class="col-7">{{ $doctor->last_name }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Prénom:</label></div>
            <div class="col-7">{{ $doctor->first_name }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Username:</label></div>
            <div class="col-7">{{ $doctor->username }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Email:</label></div>
            <div class="col-7">{{ $doctor->email }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Role:</label></div>
            @if($doctor->is_admin)
                <div class="col-7">Administrateur</div>
            @else
                <div class="col-7">Docteur</div>
            @endif
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Spécialité:</label></div>
            <div class="col-7">{{ $doctor->specialty }}</div>
        </div>
    </div>


@endsection


@section('entities_master_details')
<div class="col-lg-12">
</div>
{{-- later if we want to have multiple list each one of them will be inside one like this --}}
{{-- <div class="col-lg-12">
</div> --}}
@endsection
