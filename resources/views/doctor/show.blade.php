@extends('layouts.templates.show',['name_entity'=>'Docteur','entity'=>$doctor])

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

@if((Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$doctor->id) || Auth::guard('secretary')->check())
    @section('IndexSessionChangesDisplay_Appointment')
        @if(Session::has('destroy_appointment'))
        @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_appointment')])
        @endif
        @if(Session::has('update_appointment'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_appointment')])
        @endif
    @endsection
@endif
@include('layouts.includes.tables.datatable',[
            'list_name'=>'Liste des Rendez-vous :',
            'action'=>( (  (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$doctor->id) || Auth::guard('secretary')->check() ) ? true : false),
            'table_id'=>'DataTable_Appointments',
            'table_columns_name'=>['ID','Date','Debute A','Fini A','Patient'],
            'yield_session_name'=>'IndexSessionChangesDisplay_Appointment'
            // 'add_route'=>'',
            // 'add_btn_text'=>'',
        ])


@if(Auth::guard('doctor')->check())
    @if(Auth::guard('doctor')->user()->id==$doctor->id)
        @section('IndexSessionChangesDisplay_Prescription')
            @if(Session::has('destroy_prescription'))
            @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_prescription')])
            @endif
            @if(Session::has('update_prescription'))
            @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_prescription')])
            @endif
        @endsection
    @endif

    @include('layouts.includes.tables.datatable',[
        'list_name'=>'Liste des Prescriptions :',
        'action'=>( (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$doctor->id) ? true : false),
        'table_id'=>'DataTable_Prescriptions',
        'table_columns_name'=>['ID','Date','Patient','Crée A','Modifie A'],
        'yield_session_name'=>'IndexSessionChangesDisplay_Prescription',
        'details_btn'=>true,
        // 'add_route'=>'',
        // 'add_btn_text'=>'',
    ])


    @if(Auth::guard('doctor')->user()->id==$doctor->id )
        @section('IndexSessionChangesDisplay_OrientationLetter')
            @if(Session::has('destroy_orientationLetter'))
                @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_orientationLetter')])
            @endif
            @if(Session::has('update_orientationLetter'))
                @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_orientationLetter')])
            @endif
        @endsection
    @endif
    @include('layouts.includes.tables.datatable',[
            'list_name'=>'Liste des Lettres d\'Orientation :',
            'action'=>true,
            'table_id'=>'DataTable_OrientationLetters',
            'table_columns_name'=>['ID','Date','Contenu','Patient','Crée A','Modifie A'],
            'yield_session_name'=>'IndexSessionChangesDisplay_OrientationLetter'
            // 'add_route'=>'',
            // 'add_btn_text'=>'',
        ])

@endif

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.min.js"></script>
<script id="details-template" type="text/x-handlebars-template">
    @verbatim
        <table class="table details-table" id="prescription-{{id}}">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Médicament</th>
                    <th>Dose</th>
                    <th>Moment Prise</th>
                    <th>Durée</th>
                </tr>
            </thead>
        </table>
    @endverbatim
</script>

<script type="text/javascript">
    //for row details
    var template = Handlebars.compile($("#details-template").html());

    $(document).ready(function() {
        // $.fn.dataTable.ext.errMode = 'throw'; if we want to disable error alert for datatable
        var prop_doctor = "{{ (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id==$doctor->id)}}";
        var connect_secretary = "{{ Auth::guard('secretary')->check() }}";
        var connect_doctor = "{{ Auth::guard('doctor')->check() }}";

        var table_Appointments = $('#DataTable_Appointments').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('doctor.ajax.getAppointmentsForDoctor',['doctor_id'=>$doctor->id]) }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns:getColumnsForAppointments(prop_doctor,connect_secretary),
            orderMulti: true,
            order: [[1, 'desc'],[2, 'asc'],[3, 'asc']]
        });

        if(connect_doctor){

            var table_Prescriptions = $('#DataTable_Prescriptions').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:"{{ route('doctor.ajax.getPrescriptionsForDoctor',['doctor_id'=>$doctor->id]) }}",
                    type: 'GET',
                    data: function ( d ) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns:getColumnsForPrescriptions(prop_doctor),
                orderMulti: true,
                order: [[1, 'desc'],[3, 'desc'],[4, 'desc']]
            });

            var table_OrientationLetters = $('#DataTable_OrientationLetters').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url:"{{ route('doctor.ajax.getOrientationLettersForDoctor',['doctor_id'=>$doctor->id]) }}",
                    type: 'GET',
                    data: function ( d ) {
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns:getColumnsForOrientationLetters(prop_doctor),
                orderMulti: true,
                order: [[1, 'desc'],[4, 'desc'],[5, 'desc']]
            });

            $('#DataTable_Prescriptions tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table_Prescriptions.row(tr);
                var tableId = 'prescription-' + row.data().id;
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass( 'details' );
                    // tr.removeClass('shown');

                } else {
                    // Open this row
                    row.child(template(row.data())).show();
                    initTable(tableId, row.data());

                    // tr.addClass('shown');
                    tr.addClass('details');
                    tr.next().find('td').addClass('no-padding bg-gray');
                }
            });

        }

        function getColumnsForAppointments(prop_doctor,connect_secretary) {
            if (prop_doctor || connect_secretary) {
                columns_Appointments= [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'start_at', name: 'start_at'},
                    {data: 'end_at', name: 'end_at'},
                    {data: 'patient_full_name', name: 'patient_full_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ];
            }
            else {
                columns_Appointments= [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'start_at', name: 'start_at'},
                    {data: 'end_at', name: 'end_at'},
                    {data: 'patient_full_name', name: 'patient_full_name'},
                ];
            }
            return columns_Appointments;
        }
        function getColumnsForPrescriptions(prop_doctor){
            if (prop_doctor) {
                columns_Prescriptions = [
                    {
                        "class": "details-control",
                        "orderable": false,
                        "searchable": false,
                        "data": null,
                        "defaultContent": ""
                    },
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'patient_full_name', name: 'patient_full_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ];
            }
            else {
                columns_Prescriptions = [
                    {
                        "class": "details-control",
                        "orderable": false,
                        "searchable": false,
                        "data": null,
                        "defaultContent": ""
                    },
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'patient_full_name', name: 'patient_full_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                ];
            }
            return columns_Prescriptions;
        }
        function getColumnsForOrientationLetters(prop_doctor){
            if (prop_doctor ) {
                columns_OrientationLetters=  [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'content_preview', name: 'content_preview'},
                    {data: 'patient_full_name', name: 'patient_full_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ];
            }
            else {
                columns_OrientationLetters=  [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'content_preview', name: 'content_preview'},
                    {data: 'patient_full_name', name: 'patient_full_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                ];
            }
            return columns_OrientationLetters;
        }

        //Load row details
        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                paging: false,
                searching: false,
                ordering: false,
                bInfo: false,

                responsive: true,
                processing: true,
                serverSide: true,
                ajax: data.details_url,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'medicine', name: 'medicine' },
                    { data: 'dose', name: 'dose' },
                    { data: 'time_taken', name: 'time_taken' },
                    { data: 'duration', name: 'duration' },
                ]
            });
        }



    });
</script>
@endsection
