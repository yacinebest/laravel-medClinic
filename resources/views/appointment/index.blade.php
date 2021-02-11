@extends('layouts.templates.index',[
    'list_name'=>'Liste des Rendez-Vous :',
    'table_id'=>'DataTable_Appointments',
    'table_columns_name'=>['ID','Raison','Date','Commence A','Fini A','Patient','Docteur'],
    'action'=>true]
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_appointment'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_appointment')])
    @endif
    @if(Session::has('destroy_appointment'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_appointment')])
    @endif
    @if(Session::has('update_appointment'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_appointment')])
    @endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table_Appointments = $('#DataTable_Appointments').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('appointment.ajax.getAllAppointment') }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'reason', name: 'reason'},
                {data: 'date', name: 'date'},
                {data: 'start_at', name: 'start_at'},
                {data: 'end_at', name: 'end_at'},
                {data: 'patient_full_name', name: 'patient_full_name'},
                {data: 'doctor_full_name', name: 'doctor_full_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            orderMulti: true,
            order: [[2, 'desc'],[3, 'asc'],[4, 'asc']]
        });
    });
</script>
@endsection
