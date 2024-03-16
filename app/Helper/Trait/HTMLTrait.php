<?php

namespace App\Helper\Trait;

trait HTMLTrait
{
    public function generateDeleteButton($row, $route = null,$permission=null) {
        $html = "";
        if(in_array($permission,$this->admin_permissions)){
            $html = '<form class="d-inline" action="'.$route.'" method="post">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="fa fa-trash"></i></button>
            </form>';
        }
        return $html;
    }
}
