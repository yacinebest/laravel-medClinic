{{--
    $list_name
    $table_id
    $table_columns_name
    $action (not required)
--}}
<div class="col-lg-12">
    <div class="card card-default text-dark">
        <div class="card-header">
            <h2>{{ $list_name }}</h2>
        </div>
        <div class="py-4">
            <table id="{{ $table_id }}" class="table table-bordered data-table" style="width:100%">
                <thead>
                    <tr>
                        @foreach($table_columns_name as $name)
                            <th>{{ $name }}</th>
                        @endforeach
                        @if(isset($action) && $action)
                            <th width="100px">Action</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
