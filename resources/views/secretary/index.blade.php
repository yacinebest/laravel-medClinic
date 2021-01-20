@extends('layouts.templates.index',[
    'list_name'=>'La secretaire :','name_create_route'=>'secretary.create',
    'table_id'=>'DataTable_Secretaries',
    'table_columns_name'=>['ID','Nom','Prénom','Username','Email'],
    'action'=>true,'add_btn_text'=>'Ajouter Secretaire']
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_secretary'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_secretary')])
    @endif
    @if(Session::has('destroy_secretary'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_secretary')])
    @endif
    @if(Session::has('update_secretary'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_secretary')])
    @endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table_Secretaries = $('#DataTable_Secretaries').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('secretary.ajax.getAllSecretary') }}",
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
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
