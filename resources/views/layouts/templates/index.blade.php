@extends('layouts.master')
{{--
    $list_name
    $name_create_route
    $entities

    @yield('IndexSessionChangesDisplay')
    @yield('TableColumnsName_th')
    @yield('TableBodyList_tr')
--}}
@section('mainContent')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <!-- List Entities -->
                <div class="card card-table-border-none">
                    <div class="card-header justify-content-between">
                        <h2>{{ $list_name }}</h2>
                        <a role="button" class="btn btn-lg btn-info" href="{{ route($name_create_route) }}">
                            <i class="mdi mdi-account-plus mr-1">
                            </i>
                            Ajouter
                        </a>
                        {{-- <div class="date-range-report ">
                            <span></span>
                        </div> --}}
                    </div>
                    <div class="card-body pt-0 pb-5">

                        @yield('IndexSessionChangesDisplay')

                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    @yield('TableColumnsName_th')
                                </tr>
                            </thead>
                            <tbody>
                                @yield('TableBodyList_tr')
                            </tbody>
                        </table>
                        {{ $entities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(".a-delete-entity").on("click", function(){
    event.preventDefault();
    swal({
        title: "Êtes-vous sûr de vouloir faire ça?",
        icon: "warning",
        buttons: ["Annuler", true],
        dangerMode: true,
    }
    ).then((value) => {
        if(value){
            document.getElementById('destroy-form-'+ $(this).data('entityid')).submit();
            return ;
        }
    });
});
</script>
@endsection
