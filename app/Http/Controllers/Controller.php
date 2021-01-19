<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function actions($id,$name_id,$route_edit =null,$route_delete=null,$route_show=null){

        $delete ='';
        if($route_delete!=null){
            $delete =
            "<li class=\"dropdown-item\">
                <a href=\"#\"
                    data-entityid=\"". $id ."\" class=\"a-delete-entity\">
                    <i class=\"mdi mdi-delete mr-1\"></i>
                    Supprimer
                </a>
                <form id=\"destroy-form-".$id ."\"
                    action=\"".route($route_delete,[$name_id=>$id]) ."\"
                    method=\"POST\" class=\"d-none\">
                    @method('DELETE')
                    @csrf
                </form>
            </li>";
        }

        $edit='';
        if ($route_edit!=null) {
            $edit =
                "<li class=\"dropdown-item\">
                    <a
                        href=\"".route($route_edit, [$name_id =>$id])."\">
                        <i class=\"mdi mdi-square-edit-outline mr-1\"></i>
                        Modifier
                    </a>
                </li>";
        }

        $show='';
        if ($route_show!=null) {
            $show=
            "<li class=\"dropdown-item\">
                <a
                    href=\"".route($route_show, [$name_id =>$id])."\">
                    <i class=\"mdi mdi-account-details mr-1\"></i>
                    Voir
                </a>
            </li>"
            ;
        }

        return
            "<div class=\"dropdown show d-inline-block widget-dropdown\">
                <a class=\"dropdown-toggle icon-burger-mini\" href=\"\" role=\"button\" id=\"dropdown-btn\"
                data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" data-display=\"static\"></a>

                <ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"dropdown-btn\">"
                . $show . $edit . $delete .
                "</ul>
            </div>";
    }
}
