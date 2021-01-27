@extends('layouts.templates.show',['name_entity'=>'Patient'])

@section('entity_data')

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Nom:</label></div>
            <div class="col-7">{{ $patient->last_name }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Prénom:</label></div>
            <div class="col-7">{{ $patient->first_name }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>SSN:</label></div>
            <div class="col-7">{{ $patient->social_security_number }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>Date de naissance:</label></div>
            <div class="col-7">{{ $patient->birth_date }}</div>
        </div>
    </div>


    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>N° de téléphone:</label></div>
            <div class="col-7">{{ $patient->phone_number }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>adresse:</label></div>
            <div class="col-7">{{ $patient->address }}</div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-5"><label>email:</label></div>
            <div class="col-7">{{ $patient->email }}</div>
        </div>
    </div>

    <div class="card-body">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-chronic-diseases-tab" data-toggle="pill" href="#pills-chronic-diseases" role="tab" aria-controls="pills-chronic-diseases"
                 aria-selected="true">Maladies Chroniques</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-allergies-tab" data-toggle="pill" href="#pills-allergies" role="tab" aria-controls="pills-allergies"
                 aria-selected="false">Allergies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-antecedents-tab" data-toggle="pill" href="#pills-antecedents" role="tab" aria-controls="pills-antecedents"
                 aria-selected="false">Antécédents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-comments-tab" data-toggle="pill" href="#pills-comments" role="tab" aria-controls="pills-comments"
                 aria-selected="false">Commentaires</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-chronic-diseases" role="tabpanel" aria-labelledby="pills-chronic-diseases-tab">
               {{ $patient->chronic_diseases }}
            </div>
            <div class="tab-pane fade" id="pills-allergies" role="tabpanel" aria-labelledby="pills-allergies-tab">
               {{ $patient->allergies }}
            </div>
            <div class="tab-pane fade" id="pills-antecedents" role="tabpanel" aria-labelledby="pills-antecedents-tab">
                {{ $patient->antecedents }}
            </div>
            <div class="tab-pane fade" id="pills-comments" role="tabpanel" aria-labelledby="pills-comments-tab">
                {{ $patient->comments }}
            </div>
        </div>
    </div>
@endsection


@section('entities_master_details')

@if((Auth::guard('doctor')->check()) || Auth::guard('secretary')->check())
    @section('IndexSessionChangesDisplay_Appointment')
        @if(Session::has('destroy_appointment'))
        @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_appointment')])
        @endif
        @if(Session::has('update_appointment'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_appointment')])
        @endif
        @if(Session::has('store_appointment'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('store_appointment')])
        @endif
    @endsection
@endif
@include('layouts.includes.tables.datatable',[
            'list_name'=>'Liste des Rendez-vous :',
            'action'=>((Auth::guard('doctor')->check()) || Auth::guard('secretary')->check() ? true : false),
            'table_id'=>'DataTable_Appointments',
            'table_columns_name'=>['ID','Date','Docteur','Debute A','Fini A'],
            'yield_session_name'=>'IndexSessionChangesDisplay_Appointment',
            'add_route'=>'appointment.create',
            'add_btn_text'=>'Ajouter rendez-vous',
            'add_parameter'=>['patient'=>$patient->id]
        ])


@if(Auth::guard('doctor')->check())
    @section('IndexSessionChangesDisplay_Prescription')
        @if(Session::has('destroy_prescription'))
        @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_prescription')])
        @endif
        @if(Session::has('update_prescription'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_prescription')])
        @endif
        @if(Session::has('store_prescription'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('store_prescription')])
        @endif
    @endsection
@endif
@include('layouts.includes.tables.datatable',[
    'list_name'=>'Liste des Prescriptions :',
    'action'=>( (Auth::guard('doctor')->check()) ? true : false),
    'table_id'=>'DataTable_Prescriptions',
    'table_columns_name'=>['ID','Date','Docteur','Crée A','Modifie A'],
    'yield_session_name'=>'IndexSessionChangesDisplay_Prescription',
    'details_btn'=>true,
    'add_route'=>'prescription.create',
    'add_btn_text'=>'Ajouter prescriptions',
    'add_parameter'=>['patient'=>$patient->id]
])


@if(Auth::guard('doctor')->check())
    @section('IndexSessionChangesDisplay_OrientationLetter')
        @if(Session::has('destroy_orientationLetter'))
            @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_orientationLetter')])
        @endif
        @if(Session::has('update_orientationLetter'))
            @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_orientationLetter')])
        @endif
         @if(Session::has('store_orientationLetter'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('store_orientationLetter')])
        @endif
    @endsection
@endif
@include('layouts.includes.tables.datatable',[
            'list_name'=>'Liste des Lettres d\'Orientation :',
            'action'=>true,
            'table_id'=>'DataTable_OrientationLetters',
            'table_columns_name'=>['ID','Date','Contenu','Docteur','Crée A','Modifie A'],
            'yield_session_name'=>'IndexSessionChangesDisplay_OrientationLetter',
            'add_route'=>'orientationletter.create',
            'add_btn_text'=>'Ajouter lettre d\'Orientation',
            'add_parameter'=>['patient'=>$patient->id]
        ])

@if(Auth::guard('doctor')->check())
    @section('IndexSessionChangesDisplay_Imagery')
        @if(Session::has('destroy_imagery'))
            @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_imagery')])
        @endif
        @if(Session::has('update_imagery'))
            @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_imagery')])
        @endif
         @if(Session::has('store_imagery'))
        @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('store_imagery')])
        @endif
    @endsection
@endif
@include('layouts.includes.tables.datatable',[
            'list_name'=>'Liste des imageries :',
            'action'=>true,
            'table_id'=>'DataTable_Imageries',
            'table_columns_name'=>['ID','Fichier','Crée A'],
            'yield_session_name'=>'IndexSessionChangesDisplay_Imagery',
            'add_route'=>'imagery.create',
            'add_btn_text'=>'Ajouter le fichier imagerie',
            'add_parameter'=>['patient'=>$patient->id]
        ])
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
        var prop_doctor = "{{ (Auth::guard('doctor')->check())}}";
        var connect_secretary = "{{ Auth::guard('secretary')->check() }}";

        var table_Appointments = $('#DataTable_Appointments').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('patient.ajax.getAppointmentsForPatient',['patient_id'=>$patient->id]) }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns:getColumnsForAppointments(prop_doctor,connect_secretary)
        });

        var table_Prescriptions = $('#DataTable_Prescriptions').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('patient.ajax.getPrescriptionsForPatient',['patient_id'=>$patient->id]) }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns:getColumnsForPrescriptions(prop_doctor),
            "order": [[2, 'asc']]
        });

        var table_OrientationLetters = $('#DataTable_OrientationLetters').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('patient.ajax.getOrientationLettersForPatient',['patient_id'=>$patient->id]) }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns:getColumnsForOrientationLetters(prop_doctor)
        });

        var table_Imageries = $('#DataTable_Imageries').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('patient.ajax.getImageriesForPatient',['patient_id'=>$patient->id]) }}",
                type: 'GET',
                data: function ( d ) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns:getColumnsForImageries(prop_doctor)
        });

        function getColumnsForAppointments(prop_doctor,connect_secretary) {
            if (prop_doctor || connect_secretary) {
                columns_Appointments= [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'doctor_full_name', name: 'doctor_full_name'},
                    {data: 'start_at', name: 'start_at'},
                    {data: 'end_at', name: 'end_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ];
            }
            else {
                columns_Appointments= [
                    {data: 'id', name: 'id'},
                    {data: 'date', name: 'date'},
                    {data: 'doctor_full_name', name: 'doctor_full_name'},
                    {data: 'start_at', name: 'start_at'},
                    {data: 'end_at', name: 'end_at'},
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
                    {data: 'doctor_full_name', name: 'doctor_full_name'},
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
                    {data: 'doctor_full_name', name: 'doctor_full_name'},
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
                    {data: 'doctor_full_name', name: 'doctor_full_name'},
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
                    {data: 'doctor_full_name', name: 'doctor_full_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                ];
            }
            return columns_OrientationLetters;
        }

        function getColumnsForImageries(prop_doctor){
            if (prop_doctor ) {
                columns_Imageries=  [
                    {data: 'id', name: 'id'},
                    {data: 'file_path', name: 'file_path'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ];
            }
            else {
               columns_Imageries=  [
                    {data: 'id', name: 'id'},
                    {data: 'file_path', name: 'file_path'},
                    {data: 'created_at', name: 'created_at'},
                ];
            }
            return columns_Imageries;
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

    });
</script>
@endsection
