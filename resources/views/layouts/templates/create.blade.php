@extends('layouts.master')
{{--
    $part_name
    $action_name
    $store_route_name

    @yield('CreateFormElements')
--}}
@section('mainContent')
<div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-8 col-lg-8 col-md-10">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="app-brand">
                        <a href="#" onclick="event.preventDefault();">

                            <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                                <g fill="none" fill-rule="evenodd">
                                    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                                    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                                </g>
                            </svg>
                            <span class="brand-name">{{ $part_name }}</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-5">
                    {{-- <h4 class="text-dark mb-5"></h4> --}}
                    @if(isset($extend_form) && $extend_form)
                        @yield('extend_form')
                    @else
                        <form method="POST" action="{{ route($store_route_name) }}" id="store-form">
                        @csrf
                            <div class="row">
                                @yield('CreateFormElements')

                                <div class="col-md-12">
                                    <button id="store-button" type="submit" class="btn btn-lg bt-primary btn-block mb-4">{{ $action_name }}</button>
                                </div>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- script to display alert when store button is clicked --}}
{{-- <script type="text/javascript">
$("#store-button").on("click", function(){
    event.preventDefault();
    swal({
        title: "Êtes-vous sûr de vouloir faire ça?",
        icon: "warning",
        buttons: ["Annuler", true],
        dangerMode: true,
    }
    ).then((value) => {
        if(value){
            document.getElementById('store-form').submit();
            return ;
        }
    });
});
</script> --}}
@endsection
