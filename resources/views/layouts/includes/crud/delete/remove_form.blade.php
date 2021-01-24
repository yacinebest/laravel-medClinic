{{--
    $id
    $name_id
    $route_delete
--}}

<form id="{{'destroy-form-'.$name_id.'-'. $id  }}"
    action="{{ route($route_delete,[$name_id=>$id] )  }}" method="POST" class="d-none">
    @method('DELETE')
    @csrf
</form>
