{{--
    $list_name
    $table_id
    $table_columns_name
    $action (not required)

    //
    we need to pass this two varibale to have access to add button
    $add_route
    $add_btn_text
--}}
<div class="col-lg-12">
    <div class="card card-default text-dark">
        <div class="card-header justify-content-between">
            <h2>{{ $list_name }}</h2>
            @if(isset($add_route) && isset($add_btn_text) )
                <a role="button" class="btn btn-lg btn-info" href="{{ $add_route }}">
                    <i class="fa fa-plus mr-1" aria-hidden="true">
                    </i>
                    {{ $add_btn_text }}
                </a>
            @endif
        </div>
        <div class="card-body">
            @include('layouts.includes.tables.only_datatable',[
                'table_id'=>$table_id,
                'table_columns_name'=>$table_columns_name,
                'action'=>$action,
                ])
        </div>
    </div>
</div>
