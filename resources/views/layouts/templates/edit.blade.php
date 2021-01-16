@extends('layouts.master')
{{--

    $part_name
    $update_route_name
    $entity_name
    $entity

    @yield('UpdateFormElements')
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
                    <form method="POST" action="{{ route($update_route_name,[$entity_name=>$entity->id]) }}" id="update-form">
                    {{-- <form method="POST" action="{{ route($update_route_name,['doctor'=>$doctor->id]) }}"> --}}
                    @method('PUT')
                    @csrf
                        <div class="row">

                            @yield('UpdateFormElements')

                            <div class="col-md-12">
                                <button id="update-button" type="submit" class="btn btn-lg btn-primary btn-block mb-4">Soumettre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$("#update-button").on("click", function(){
    event.preventDefault();
    swal({
        title: "Êtes-vous sûr de appliquer ces modification?",
        icon: "warning",
        buttons: ["Annuler", true],
        dangerMode: true,
    }
    ).then((value) => {
        if(value){
            document.getElementById('update-form').submit();
            return ;
        }
    });
});
</script>
@endsection
