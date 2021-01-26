@extends('layouts.templates.index',[
    'list_name'=>'Liste Des Patients :','name_create_route'=>'patient.create',
    'table_id'=>'DataTable_Patients',
    'table_columns_name'=>['ID','Nom','Prénom','Date de naissance','N° (+213)','Addresse','Email'],
    'action'=>true,'add_btn_text'=>'Ajouter Patient']
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_patient'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_patient')])
    @endif
    @if(Session::has('destroy_patient'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_patient')])
    @endif
    @if(Session::has('update_patient'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_patient')])
    @endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table_Patients = $('#DataTable_Patients').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('patient.ajax.getAllPatient') }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'last_name', name: 'last_name'},
                {data: 'first_name', name: 'first_name'},
                //{data: 'social_security_number', name: 'social_security_number'},
                {data: 'birth_date', name: 'birth_date'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'address_limit', name: 'address_limit'},
                {data: 'email_limit', name: 'email_limit'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
