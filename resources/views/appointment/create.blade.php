@extends('layouts.templates.create',[
'part_name'=>'Ajouter Rendez-vous','action_name'=>'Créer Rendez-vous','store_route_name'=>'appointment.store']
)

@section('CreateFormElements')
    <div class="col-md-12">
        <div class="form-group">
            <label>Raison Du Rendez-vous :</label>
            <input name="reason" type="text" class="form-control @error('reason') is-invalid @enderror" value="{{ old('reason') }}" placeholder="Raison Du Rendez-vous">
        </div>
        @error('reason')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Date Du Rendez-vous :</label>
            <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ !empty(old('date')) ? old('date') : now()->format('Y-m-d') }}" placeholder="Date">
        </div>
        @error('date')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Commence à :</label>
            <input name="start_at" type="time" class="form-control @error('start_at') is-invalid @enderror" value="{{ !empty(old('start_at')) ? old('start_at') : now()->format('H:i') }}" placeholder="Commence à">
        </div>
        @error('start_at')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
        @error('appointment_time_taken')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Fini à :</label>
            <input name="end_at" type="time" class="form-control @error('end_at') is-invalid @enderror" value="{{ !empty(old('end_at')) ? old('end_at') : now()->format('H:i') }}" placeholder="Fini à">
        </div>
        @error('end_at')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label>Docteur :</label>
            @if(Auth::guard('doctor')->check() && !Auth::guard('doctor')->user()->is_admin )
                <input type="text" class="form-control" value="{{ Auth::guard('doctor')->user()->last_name . ' ' . Auth::guard('doctor')->user()->first_name }}" readonly>
                <input type="hidden" name="doctor_id" value="{{ Auth::guard('doctor')->user()->id }}">
            @else
                <select id="sel_doctor" class="form-control select-class" name="doctor_id" data-live-search="true" title="Selectionner Un Docteur...">
                </select>
            @endif
        </div>
        @error('doctor_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Patient :</label>
            <input type="text" class="form-control" value="{{ $patient->last_name . ' ' . $patient->first_name . ' ' . $patient->birth_date}}" readonly>
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        </div>
        @error('patient_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

@endsection


@section('scripts')
<script type='text/javascript'>
    $(document).ready(function(){
        var load_doctors = "{{ Auth::guard('doctor')->check() && !Auth::guard('doctor')->user()->is_admin }}";
        var is_login_secretary = "{{ Auth::guard('secretary')->check() }}";
        if(!load_doctors || is_login_secretary){
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
                        var id = "{{ Auth::guard('doctor')->check() ? Auth::guard('doctor')->user()->id : '' }}";
                        $("#sel_doctor").val(id).trigger('change');
                    }

                }
            });
        }
    });
</script>

@endsection
