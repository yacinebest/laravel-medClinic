@extends('layouts.master')
{{--

    //for entity details
    $name_entity
    $icon_entity has already default value is
    @yield('entity_data')

    //for master details entities
    @yield('entities_master_details')
--}}

@section('styles')
    <link href="{{ asset('assets/css/boxcontent.css')}}" rel="stylesheet"  />
@endsection

@section('mainContent')
<div class="content-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-12">
                <div class="box-content card">
                    <h4 class="box-title"><i class="{{ isset($icon_entity) ? $icon_entity : 'fa fa-user ico'  }}"></i>{{ $name_entity }}</h4>
                    <div class="card-content">
                        <div class="row">
                            @yield('entity_data')
                        </div>
                    </div>
                </div>
            </div>

            @yield('entities_master_details')

        </div>
    </div>
</div>
@endsection
