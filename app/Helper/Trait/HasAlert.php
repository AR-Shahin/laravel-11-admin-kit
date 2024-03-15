<?php

namespace App\Helper\Trait;

trait HasAlert
{
    public function successAlert($message){
        session()->flash("success",$message);
    }
    public function errorAlert($message){
        session()->flash("error",$message);
    }
    public function warningAlert($message){
        session()->flash("warning",$message);
    }
}
