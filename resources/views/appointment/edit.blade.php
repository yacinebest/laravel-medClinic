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
        <select id="sel_doctor" class="form-control select-class" name="doctor_id" data-live-search="true" title="Selectionner Un Docteur...">
        </select>
    </div>
    @error('doctor_id')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Patient :</label>
        <select id="sel_patient" class="form-control select-class" name="patient_id" data-live-search="true" title="Selectionner Un Patient...">
        </select>
    </div>
    @error('patient_id')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>
@endsection



@section('scripts')
<script type='text/javascript'>
    $(document).ready(function(){

        $.ajax({
            url: "{{ route('doctor.ajax.getAllDoctorForDropdown') }}",
            type: 'GET',
            dataType: 'json',
            success: function(response){

                var len = 0;
                if(response['doctors'] != null){
                    len = response['doctors'].length;
                }
                if(len > 0){
                    // Read doctors and create <option >
                    for(var i=0; i<len; i++){

                        var id = response['doctors'][i].id;
                        var first_name = response['doctors'][i].first_name;
                        var last_name = response['doctors'][i].last_name;


                        var option = "<option value='"+id+"'>"+last_name + " " + first_name+"</option>";

                        $("#sel_doctor").append(option);
                    }
                    $('#sel_doctor').selectpicker('refresh');
                    $("#sel_doctor").val("{{ $appointment->doctor_id }}").trigger('change');
                }

            }
        });



        $.ajax({
                url: "{{ route('patient.ajax.getAllPatientForDropdown') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    if(response['patients'] != null){
                        len = response['patients'].length;
                    }
                    if(len > 0){
                        // Read patients and create <option >
                        for(var i=0; i<len; i++){

                            var id = response['patients'][i].id;
                            var first_name = response['patients'][i].first_name;
                            var last_name = response['patients'][i].last_name;

                            var option = "<option value='"+id+"'>"+last_name + " " + first_name+"</option>";

                            $("#sel_patient").append(option);
                        }
                        $('#sel_patient').selectpicker('refresh');
                        $("#sel_patient").val("{{ $appointment->patient_id }}").trigger('change');
                    }

                }
            });

    });
</script>

@endsection
