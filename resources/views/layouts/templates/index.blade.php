@extends('layouts.master')
{{--
    $list_name
    $name_create_route
    $add_btn_text

    $table_id
    $table_columns_name
    $action

    @yield('IndexSessionChangesDisplay') for default case is inside datatable file
--}}

@section('styles')
@include('layouts.includes.tables.styles_datatable')
@endsection

@section('mainContent')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            @if(isset($name_create_route) && isset($add_btn_text) )
                @if(isset($has_add_route) && $has_add_route)
                    @include('layouts.includes.tables.datatable',[
                        'list_name'=>$list_name,
                        'table_id'=>$table_id,
                        'table_columns_name'=>$table_columns_name,
                        'action'=>$action,
                        ])
                @else
                    @include('layouts.includes.tables.datatable',[
                        'list_name'=>$list_name,
                        'table_id'=>$table_id,
                        'table_columns_name'=>$table_columns_name,
                        'action'=>$action,
                        'add_route'=>$name_create_route,
                        'add_btn_text'=>$add_btn_text,
                    ])
                @endif
            @else
            @include('layouts.includes.tables.datatable',[
                'list_name'=>$list_name,
                'table_id'=>$table_id,
                'table_columns_name'=>$table_columns_name,
                'action'=>$action,
                ])
            @endif
        </div>
    </div>
</div>
@endsection
