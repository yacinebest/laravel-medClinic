@extends('layouts.templates.create',[
'part_name'=>'Ajouter Des Images','action_name'=>'Ajouter Des Images','store_route_name'=>'imagery.store','extend_form'=>true]
)

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css" />
@endsection


@section('extend_form')
<div class="col-md-12">
    <div class="form-group">

        <div class="col-md-12">
            <div class="form-group">
                <label>Patient :</label>
                <input type="text" class="form-control" value="Patinet 1234" readonly>
            </div>
        </div>
        <form method="POST" action="{{ route('imagery.store') }}"class="dropzone" files="true" enctype="multipart/form-data" id="my-awesome-dropzone">
            @csrf
            <div class="col-md-12">
                <div class="form-group">
                    <h3>Ajouter Plusieur Image :</h3>
                </div>
            </div>
            <input type="hidden" name="patient_id" value="">

        </form>
    </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" ></script>
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
                            var birth_date = response['patients'][i].birth_date;

                            var option = "<option value='"+id+"'>"+last_name + " " + first_name+" " +birth_date +"</option>";

                            $("#sel_patient").append(option);
                        }
                        $('#sel_patient').selectpicker('refresh');
                        $("#sel_patient").val('').trigger('change');
                    }

                }
            });



            function loadPreview(input){
                var data = $(input)[0].files; //this file data
                $.each(data, function(index, file){
                    var fRead = new FileReader();
                    fRead.onload = (function(file){
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image thumb element
                            $('#thumb-output').append(img);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                });
            }

    });
</script>

@endsection
