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
            <input type="text" class="form-control" value="{{ $patient->last_name . ' ' . $patient->first_name . ' ' . $patient->birth_date }}" readonly>
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        </div>
        @error('patient_id')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dynamic_field">
                <thead>
                 <tr>
                     <th width="25%">Médicament</th>
                     <th width="20%">Dose</th>
                     <th width="25%">Moment Prise</th>
                     <th width="20%">Durée</th>
                     <th width="10%">Action</th>
                 </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <div>
                        @error('medicine')
                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                        @enderror
                        @error('dose')
                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                        @enderror
                        @error('time_taken')
                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                        @enderror
                        @error('duration')
                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                        @enderror
                        @error('prescriptionLines')
                            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                        @enderror

                    </div>
                </tfoot>
            </table>
        </div>
    </div>
@endsection


@section('scripts')
<script type='text/javascript'>
    $(document).ready(function(){
        //Dynamic Table
        var count = 1;

        dynamic_field(count);

        function dynamic_field(number)
        {
            html = '<tr>';
            html += '<td><input type="text" name="medicine[]" class="form-control" /></td>';
            html += '<td><input type="text" name="dose[]" class="form-control" /></td>';
            html += "<td>"+
                    '<select name="time_taken[]" class="form-control">'+
                    '@foreach($time_taken_const as $key => $value)'+
                        '<option value="{{ $key }}">{{ $value }}</option>'+
                    '@endforeach'+
                    '</select>'+
                    "</td>";
            html += '<td><input type="text" name="duration[]" class="form-control" /></td>';
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn bt-danger remove"><i class="fas fa-minus"></i></button></td></tr>';
                $('tbody').append(html);
            }
            else
            {
                html += '<td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></td></tr>';
                $('tbody').html(html);
            }
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });



    });
</script>

@endsection
