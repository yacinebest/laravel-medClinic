@extends('layouts.templates.edit',[
'part_name'=>'Modifier Lettre','update_route_name'=>'orientationletter.update','entity_name'=>'orientationletter','entity'=>$orientationLetter]
)

@section('UpdateFormElements')

    <div class="col-md-12">
        <div class="form-group">
            <label>Date :</label>
            <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $orientationLetter->date }}" placeholder="Date">
        </div>
        @error('date')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Docteur :</label>
            <input type="text" class="form-control" value="{{ $orientationLetter->doctor->last_name . ' ' . $orientationLetter->doctor->first_name }}" readonly>
            <input type="hidden" name="doctor_id" value="{{ $orientationLetter->doctor->id }}">
        </div>
        @error('doctor_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Patient :</label>
            <input type="text" class="form-control" value="{{ $orientationLetter->patient->last_name . ' ' . $orientationLetter->patient->first_name }}" readonly>
            <input type="hidden" name="patient_id" value="{{ $orientationLetter->patient->id }}">
        </div>
        @error('patient_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Contenu :</label>
            <textarea name="content" rows="3" class="form-control @error('content') is-invalid @enderror" placeholder="Contenu">{{ $orientationLetter->content }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

@endsection



@section('scripts')
<script type='text/javascript'>
    $(document).ready(function(){

    });
</script>

@endsection
