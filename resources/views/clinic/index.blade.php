@extends('layouts.templates.index',[
    'list_name'=>'La clinique :','name_create_route'=>'clinic.create',
    'table_id'=>'DataTable_Clinics',
    'table_columns_name'=>['ID','Nom','Adresse','N° de téléphone'],
    'action'=>true,'add_btn_text'=>'Ajouter Clinique','has_add_route'=>$hasclinic]
)


@section('IndexSessionChangesDisplay')
    @if(Session::has('store_clinic'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_clinic')])
    @endif
    @if(Session::has('destroy_clinic'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_clinic')])
    @endif
    @if(Session::has('update_clinic'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_clinic')])
    @endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table_Clinics = $('#DataTable_Clinics').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('clinic.ajax.getTheClinic') }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            orderMulti: true,
            order: [[1, 'name']]
        });
    });
</script>
@endsection
