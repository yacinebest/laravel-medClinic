@extends('layouts.templates.show',['name_entity'=>'Docteur'])

@php
    $table_id = 'DataTable_Appointments';
@endphp

@section('entity_data')

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Nom:</label></div>
            <div class="col-7">{{ $doctor->last_name }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Prénom:</label></div>
            <div class="col-7">{{ $doctor->first_name }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Username:</label></div>
            <div class="col-7">{{ $doctor->username }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Email:</label></div>
            <div class="col-7">{{ $doctor->email }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Role:</label></div>
            @if($doctor->is_admin)
                <div class="col-7">Administrateur</div>
            @else
                <div class="col-7">Docteur</div>
            @endif
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Spécialité:</label></div>
            <div class="col-7">{{ $doctor->specialty }}</div>
        </div>
    </div>


@endsection


@section('entities_master_details')

@include('layouts.includes.tables.datatable',[
            'list_name'=>'Liste des Rendez-vous :',
            'action'=>true,
            'table_id'=>$table_id,
            'table_columns_name'=>['ID','Date','StartAt','EndAt','Patient','Doctor']
        ])

@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // $.fn.dataTable.ext.errMode = 'throw'; if we want to disable error alert for datatable
        var table = $('#{{ $table_id }}').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('doctor.ajax.getAllAppointments') }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'date', name: 'date'},
                {data: 'start_at', name: 'start_at'},
                {data: 'end_at', name: 'end_at'},
                {data: 'patient_full_name', name: 'patient_full_name'},
                {data: 'doctor_full_name', name: 'doctor_full_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
