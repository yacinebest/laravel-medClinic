@extends('layouts.templates.show',['name_entity'=>'Docteur'])

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
<div class="col-lg-12">
    <div class="card card-default text-dark">
        <div class="card-header">
            <h2>Liste des Rendez-vous :</h2>
        </div>
        <div class="py-4">
            <table id="DataTable_Appointments" class="table table-bordered data-table" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // $.fn.dataTable.ext.errMode = 'throw'; if we want to disable error alert for datatable
        var table = $('#DataTable_Appointments').DataTable({
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
