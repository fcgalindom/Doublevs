<?php

namespace App\Http\Controllers;

use App\Events\EventNotification;

class UserController extends Controller
{
    public function notification(){
        

        event(new EventNotification('guardado'));
        return "entro";

    }
    public function recibir(){

    }
}
