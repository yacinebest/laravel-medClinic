@extends('layouts.templates.create',[
'part_name'=>'Ajouter Lettre','action_name'=>'Créer Lettre D\'Orientation','store_route_name'=>'orientationletter.store']
)

@section('CreateFormElements')
    <div class="col-md-12">
        <div class="form-group">
            <label>Date :</label>
            <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ !empty(old('date')) ? old('date') : now()->format('Y-m-d') }}" placeholder="Date">
        </div>
        @error('date')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Docteur :</label>
            @if(Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id )
                <input type="text" class="form-control" value="{{ Auth::guard('doctor')->user()->last_name . ' ' . Auth::guard('doctor')->user()->first_name }}" readonly>
                <input type="hidden" name="doctor_id" value="{{ Auth::guard('doctor')->user()->id }}">
            @endif
        </div>
        @error('doctor_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Patient :</label>
            <input type="text" class="form-control" value="{{ $patient->last_name . ' ' . $patient->first_name . ' ' . $patient->birth_date }}" readonly>
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        </div>
        @error('patient_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Contenu :</label>
            <textarea class="ckeditor form-control @error('content') is-invalid @enderror" name="content" placeholder="Contenu">{{  old('content') }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

@endsection

