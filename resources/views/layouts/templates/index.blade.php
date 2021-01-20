@extends('layouts.master')
{{--
    $list_name
    $name_create_route

    $table_id
    $table_columns_name
    $action

    @yield('IndexSessionChangesDisplay')
--}}

@section('styles')
@include('layouts.includes.tables.styles_datatable')
@endsection

@section('mainContent')
<div class="content-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="card card-default text-dark">
                    <div class="card-header justify-content-between">
                        <h2>{{ $list_name }}</h2>
                            <a role="button" class="btn btn-lg btn-info" href="{{ route($name_create_route) }}">
                                <i class="fa fa-plus mr-1" aria-hidden="true">
                                </i>
                                Ajouter
                            </a>
                    </div>
                    <div class="card-body">
                        @yield('IndexSessionChangesDisplay')
                        @include('layouts.includes.tables.only_datatable',[
                            'table_id'=>$table_id,
                            'table_columns_name'=>$table_columns_name,
                            'action'=>$action,
                            ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('body').on('click', '.a-delete-entity', function () {
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
@yield('scripts_continue')
@endsection
