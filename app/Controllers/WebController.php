<?php

namespace App\Controllers;

use App\core\Token;
use App\core\Request;
use App\core\ArtifyStencil;
use App\core\Redirect;
use App\core\DB;
use App\Models\NoticiasModel;

class WebController
{
    public function index()
    {
        $noticias = new NoticiasModel();
        $render = $noticias->post(1, 5);

        $stencil = new ArtifyStencil();
        echo $stencil->render('web/home', [
            'render' => $render
        ]);
    }
}