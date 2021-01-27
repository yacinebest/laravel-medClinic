@extends('layouts.templates.edit',[
'part_name'=>'Modifier Rendez-vous','update_route_name'=>'appointment.update','entity_name'=>'appointment','entity'=>$appointment]
)

@section('UpdateFormElements')
<div class="col-md-12">
    <div class="form-group">
        <label>Raison Du Rendez-vous :</label>
        <input name="reason" type="text" class="form-control @error('reason') is-invalid @enderror" value="{{ $appointment->reason }}" placeholder="Raison Du Rendez-vous">
    </div>
    @error('reason')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Date Du Rendez-vous :</label>
        <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $appointment->date }}" placeholder="Date">
    </div>
    @error('date')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Commence à :</label>
        <input name="start_at" type="time" class="form-control @error('start_at') is-invalid @enderror" value="{{ $appointment->start_at }}" placeholder="Commence à">
    </div>
    @error('start_at')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Fini à :</label>
        <input name="end_at" type="time" class="form-control @error('end_at') is-invalid @enderror" value="{{ $appointment->end_at }}" placeholder="Fini à">
    </div>
    @error('end_at')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>


<div class="col-md-12">
    <div class="form-group">
        <label>Docteur :</label>
        <input type="text" class="form-control" value="{{ $appointment->doctor->last_name . ' ' . $appointment->doctor->first_name . ' ' . $appointment->doctor->birth_date}}" readonly>
        <input type="hidden" name="doctor_id" value="{{ $appointment->doctor->id }}">
    </div>
    @error('doctor_id')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Patient :</label>
        <input type="text" class="form-control" value="{{ $appointment->patient->last_name . ' ' . $appointment->patient->first_name . ' ' . $appointment->patient->birth_date}}" readonly>
        <input type="hidden" name="patient_id" value="{{ $appointment->patient->id }}">
    </div>
    @error('patient_id')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>
@endsection
