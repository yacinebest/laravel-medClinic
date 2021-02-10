@extends('layouts.templates.print',['clinic'=>$clinic,'doctor'=>$prescription->doctor,'patient'=>$prescription->patient,'type'=> 'Prescription' ])

@section('printContent')
    <label for="">Date :</label>
    <label for="">{{ $prescription->date }}</label>
    <br>
    <br>

   <table style="width: -webkit-fill-available;margin: 5px;">
        <thead>
            <tr>
                <th width="25%">Médicament</th>
                <th width="25%">Dose</th>
                <th width="25%">Moment Prise</th>
                <th width="25%">Durée</th>
            </tr>
        </thead>
        @foreach($prescription->prescriptionLines as $p_line)
            <tr class="item-row">
                <td>{{ $p_line->medicine }}</td>
                <td>{{ $p_line->dose }}</td>
                <td>{{ $p_line->time_taken }}</td>
                <td>{{ $p_line->duration }}</td>
            </tr>
        @endforeach
    </table>
@endsection


