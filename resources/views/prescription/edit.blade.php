@extends('layouts.templates.edit',[
'part_name'=>'Modifier Prescription','update_route_name'=>'prescription.update','entity_name'=>'prescription','entity'=>$prescription]
)

@section('UpdateFormElements')

<div class="col-md-12">
    <div class="form-group">
        <label>Date Prescription :</label>
        <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $prescription->date }}" placeholder="Date">
    </div>
    @error('date')
        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Docteur :</label>
        <input type="text" class="form-control" value="{{ $prescription->doctor->last_name . ' ' . $prescription->doctor->first_name }}" readonly>
        <input type="hidden" name="doctor_id" value="{{ $prescription->doctor->id }}">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Patient :</label>
        <input type="text" class="form-control" value="{{ $prescription->patient->last_name . ' ' . $prescription->patient->first_name }}" readonly>
        <input type="hidden" name="patient_id" value="{{ $prescription->patient->id }}">
    </div>
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
                @foreach($prescription->prescriptionLines as $p_line)
                    <tr>
                        <td><input type="text" name="pmedicine[]" class="form-control" value="{{ $p_line->medicine }}" /></td>
                        <td><input type="text" name="pdose[]" class="form-control" value="{{ $p_line->dose }}" /></td>
                        <td>
                            <select name="ptime_taken[]" class="form-control">
                                @foreach($time_taken_const as $key => $value)
                                    @if($p_line->time_taken==$key)
                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="pduration[]" class="form-control" value="{{ $p_line->duration }}" /></td>
                        <td>
                            @include('layouts.includes.crud.delete.remove_btn',['id'=>$p_line->id,'name_id'=>'prescriptionline','simple_btn_remove'=>true])
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4"><h3 class="text-center">Ajouter De Nouvelle Ligne</h3></td>
                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                </tr>
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
                    @error('prescriptionLines_atleast')
                        <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
                    @enderror

                </div>
            </tfoot>
        </table>
    </div>
</div>

@endsection

@section('form_extends')
    @foreach($prescription->prescriptionLines as $p_line)
        @include('layouts.includes.crud.delete.remove_form',['id'=>$p_line->id,'name_id'=>'prescriptionline','route_delete'=>'prescriptionline.destroy'])
    @endforeach
@endsection

@section('scripts')
<script type='text/javascript'>
    $(document).ready(function(){
        //Dynamic Table
        function dynamic_field()
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

            html += '<td><button type="button" name="remove" id="" class="btn bt-danger remove-dynamic"><i class="fas fa-minus"></i></button></td></tr>';
            $('tbody').append(html);

        }

        $(document).on('click', '#add', function(){
            dynamic_field();
        });

        $(document).on('click', '.remove-dynamic', function(){
            $(this).closest("tr").remove();
        });

    });
</script>

@endsection
