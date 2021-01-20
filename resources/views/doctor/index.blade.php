@extends('layouts.templates.index',[
    'list_name'=>'Liste Des Médecins :','name_create_route'=>'doctor.create',
    'table_id'=>'DataTable_Doctors',
    'table_columns_name'=>['ID','Nom','Prénom','Username','Email','Specialité','Role'],
    'action'=>true,'add_btn_text'=>'Ajouter Médecin']
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_doctor'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_doctor')])
    @endif
    @if(Session::has('destroy_doctor'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_doctor')])
    @endif
    @if(Session::has('update_doctor'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_doctor')])
    @endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table_Doctors = $('#DataTable_Doctors').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('doctor.ajax.getAllDoctor') }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'last_name', name: 'last_name'},
                {data: 'first_name', name: 'first_name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'specialty', name: 'specialty'},
                {data: 'role_name', name: 'role_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
