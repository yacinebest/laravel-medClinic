@extends('layouts.templates.create',[
'part_name'=>'Ajouter Prescription','action_name'=>'Créer Prescription','store_route_name'=>'prescription.store']
)

@section('CreateFormElements')
    <div class="col-md-12">
        <div class="form-group">
            <label>Date Prescription :</label>
            <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ !empty(old('date')) ? old('date') : now()->format('Y-m-d') }}" placeholder="Date">
        </div>
        @error('date')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label>Docteur :</label>
            <input type="text" class="form-control" value="{{ Auth::guard('doctor')->user()->last_name . ' ' . Auth::guard('doctor')->user()->first_name }}" readonly>
            <input type="hidden" name="doctor_id" value="{{ Auth::guard('doctor')->user()->id }}">
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
                        $("#sel_patient").val('').trigger('change');
                    }

                }
            });

    });
</script>

@endsection
