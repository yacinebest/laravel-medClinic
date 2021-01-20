<div class="dropdown show d-inline-block widget-dropdown">
    <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-btn"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>

    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-btn">

        @isset($route_show)
            <li class="dropdown-item">
                <a
                    href="{{ route($route_show, [$name_id =>$id]) }}">
                    <i class="mdi mdi-account-details mr-1"></i>
                    Voir
                </a>
            </li>
        @endisset

        @isset($route_edit)
            <li class="dropdown-item">
                <a
                    href="{{ route($route_edit, [$name_id =>$id]) }}">
                    <i class="mdi mdi-square-edit-outline mr-1"></i>
                    Modifier
                </a>
            </li>
        @endisset

        @isset($route_delete)
            <li class="dropdown-item">
            <a
                data-entityid="{{ $id }}" class="{{ isset($btn_delete_class) ? $class_btn_delete : 'a-delete-entity' }}">
                <i class="mdi mdi-delete mr-1"></i>
                Supprimer
            </a>
            <form id="{{isset($form_delete_id) ? $form_delete_id.$id : 'destroy-form-'. $id  }}"
                    action="{{ route($route_delete,[$name_id=>$id] )  }}" method="POST" class="d-none">
                @method('DELETE')
                @csrf
            </form>
        </li>
        @endisset
    </ul>
</div>
