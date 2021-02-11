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
                <input type="text" class="form-control" value="{{ $patient->last_name . ' ' . $patient->first_name . ' ' . $patient->birth_date }}" readonly>
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            </div>
            <div class="form-group">
                <form method="POST" action="{{ route('imagery.store') }}"class="dropzone" files="true" enctype="multipart/form-data" id="my-awesome-dropzone">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <h3>Ajouter Plusieur Image :</h3>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                </form>
            </div>

            <div class="form-group">
                <a role="button" class="btn btn-block bt-primary mb-4" href="{{ route('patient.show',['patient'=> $patient->id]) }}">
                    Retour
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js" ></script>
<script type='text/javascript'>
    $(document).ready(function(){
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
