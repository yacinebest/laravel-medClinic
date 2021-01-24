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
                @include('layouts.includes.crud.delete_btn',['id'=>$id,'name_id'=>$name_id,'route_delete'=>$route_delete])
            </li>
        @endisset
    </ul>
</div>
