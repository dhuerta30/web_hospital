<?php

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;

class WebController
{
    public function index()
    {
        $artify = DB::ArtifyCrud();
        $render = $artify->dbTable("dhsjdghs")->render();

        $stencil = new ArtifyStencil();
        echo $stencil->render('web/home');
    }
}