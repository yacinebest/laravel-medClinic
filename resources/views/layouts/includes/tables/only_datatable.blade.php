<table id="{{ $table_id }}" class="table table-bordered data-table" style="width:100%">
    <thead>
        <tr>
            @foreach($table_columns_name as $name)
                <th>{{ $name }}</th>
            @endforeach
            @if(isset($action) && $action)
                <th width="30px"></th>
                {{-- <th width="100px">Action</th> --}}
            @endif
        </tr>
    </thead>
</table>
