@extends('layouts.templates.home')
@section('homeContent')

<div class="row">

    @if(Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->is_admin)

        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card widget-block p-4 rounded border" style="background-color: #17a2b8;">
                <div class="card-block">
                    <h4 class="text-white my-2">{{ $count_patient }}</h4>
                    <p class="text-white">Total Patient</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card widget-block p-4 rounded border" style="background-color: #fd7e14;">
                <div class="card-block">
                    <h4 class="text-white my-2">{{ $count_doctor }}</h4>
                    <p class="text-white">Total Docteur</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card widget-block p-4 rounded border" style="background-color: #6610f2;">
                <div class="card-block">
                    <h4 class="text-white my-2">{{ $count_secretary }}</h4>
                    <p class="text-white">Total Secretaire</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card widget-block p-4 rounded border" style="background-color: #17a2b8;">
                <div class="card-block">
                    <h4 class="text-white my-2">{{ $count_admin }}</h4>
                    <p class="text-white">Total Admin</p>
                </div>
            </div>
        </div>

    @endif


    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card widget-block p-4 rounded bg-primary border">
            <div class="card-block">
                <h4 class="text-white my-2">{{ $count_my_appointment_today }}</h4>
                <p class="text-white">Mes Rendez-vous Du Jour</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card widget-block p-4 rounded bg-warning border">
            <div class="card-block">
                <h4 class="text-white my-2">{{ $count_my_prescription_today }}</h4>
                <p class="text-white">Mes Prescription Du Jour</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card widget-block p-4 rounded bg-danger border">
            <div class="card-block">
                <h4 class="text-white my-2">{{ $count_my_appointment }}</h4>
                <p class="text-white">Tout Mes Rendez-vous</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card widget-block p-4 rounded bg-success border">
            <div class="card-block">
                <h4 class="text-white my-2">{{ $count_my_prescription }}</h4>
                <p class="text-white">Tout Mes Prescription</p>
            </div>
        </div>
    </div>
</div>



<div class="row">

    <div class="col-xl-12 col-md-12 col-12">
        <div class="card card-default" data-scroll-height="675">
            <div class="card-header">
                @if(Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->is_admin)
                    <h2>Total Rendez-vous et Prescription de cette Annee :</h2>
                @else
                    <h2>Total Rendez-vous et Prescription Pour Vous Pour cette Annee :</h2>
                @endif
            </div>
            <div class="card-body">
                {!! $appointment_prescription_charts->container() !!}
            </div>
            <div class="card-footer d-flex flex-wrap bg-white p-0">
                <div class="col-6 px-0">
                    <div class="text-center p-4">
                        <h4>{{ $count_appointment }}</h4>
                        <p class="mt-2">Nombre Total Rendez-vous de cette Annee</p>
                    </div>
                </div>
                <div class="col-6 px-0">
                    <div class="text-center p-4 border-left">
                        <h4>{{ $count_prescription }}</h4>
                        <p class="mt-2">Nombre Total de Prescription de cette Annee</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->is_admin)
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card card-default" data-scroll-height="675">
                <div class="card-header">
                    <h2>Les Rendez-vous des medecin pour le Mois Precedant :</h2>
                </div>
                <div class="card-body">
                    {!! $appointment_doctor_charts->container() !!}
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@section('scripts')
{!! $appointment_prescription_charts->script() !!}
@if(Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->is_admin)
    {!! $appointment_doctor_charts->script() !!}
@endif
@endsection
