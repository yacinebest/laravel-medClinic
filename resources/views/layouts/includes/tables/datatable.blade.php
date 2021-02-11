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
                @if(isset($add_parameter))
                    <a role="button" class="btn btn-lg bt-info" href="{{ route($add_route,$add_parameter) }}">
                        <i class="fa fa-plus mr-1" aria-hidden="true">
                        </i>
                        {{ $add_btn_text }}
                    </a>
                @else
                    <a role="button" class="btn btn-lg bt-info" href="{{ route($add_route) }}">
                        <i class="fa fa-plus mr-1" aria-hidden="true">
                        </i>
                        {{ $add_btn_text }}
                    </a>
                @endif
            @endif
        </div>
        <div class="card-body">

            @yield(isset($yield_session_name) ? $yield_session_name : 'IndexSessionChangesDisplay' )

            <table id="{{ $table_id }}" class="table table-bordered data-table" style="width:100%">
                <thead>
                    <tr>
                        @if(isset($details_btn) && $details_btn)
                            <th></th>
                        @endif
                        @foreach($table_columns_name as $name)
                            @if($name=='Fichier')
                                <th class="w-50">{{ $name }}</th>
                            @else
                                <th>{{ $name }}</th>
                            @endif
                        @endforeach
                        @if(isset($action) && $action)
                            <th width="30px"></th>
                            {{-- <th width="100px">Action</th> --}}
                        @endif
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>
