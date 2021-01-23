@extends('layouts.templates.index',[
    'list_name'=>'Liste des Prescriptions :','name_create_route'=>'prescription.create',
    'table_id'=>'DataTable_Prescriptions',
    'table_columns_name'=>['ID','Date','Patient','Docteur','Créé à','Mis à Jour à'],
    'action'=>true,'add_btn_text'=>'Ajouter Prescription']
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_prescription'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_prescription')])
    @endif
    @if(Session::has('destroy_prescription'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_prescription')])
    @endif
    @if(Session::has('update_prescription'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_prescription')])
    @endif
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var table_Prescriptions = $('#DataTable_Prescriptions').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('prescription.ajax.getAllPrescription') }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'date', name: 'date'},
                {data: 'patient_full_name', name: 'patient_full_name'},
                {data: 'doctor_full_name', name: 'doctor_full_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
