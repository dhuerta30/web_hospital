<?php 

namespace App\Controllers;

use App\core\SessionManager;
use App\core\Token;
use App\core\Redirect;
use App\core\ArtifyStencil;
use App\core\DB;
use App\Models\UserModel;
use App\Controllers\HomeController;

class LoginController {

    public function __construct()
	{
		SessionManager::startSession();

		if (isset($_SESSION["data"]["usuario"]["usuario"])) {
			$artify = DB::ArtifyCrud();
			$queryfy = $artify->getQueryfyObj();
			$queryfy->where("usuario", $_SESSION["data"]["usuario"]["usuario"]);
			$sesion_users = $queryfy->select("usuario");
			$_SESSION["usuario"] = $sesion_users;
		}

		$Sesusuario = SessionManager::get('usuario');
		if (isset($Sesusuario)) {
			Redirect::to("modulos");
		}
	}

    public function index(){
        $artify = DB::ArtifyCrud();
		$configuracion = HomeController::configuracion();
		$html_template = '
		<div class="container mt-5">
			<div class="row d-flex justify-content-center">
				<div class="col-xl-6">
					<div class="card px-5 py-5 bg-light shadow-lg" id="form1">
						<p class="mb-3 mt-3 text-center font-weight-bold">Acceso</p>
						<center><img class="w-25" src="'.$_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $configuracion[0]["logo_login"].'"></center>
						<p class="mb-3 mt-3 text-center font-weight-bold"></p>
						<div class="form-data">
							<div class="form-group usuario_col">
								<label>Usuario</label>
								{usuario}
								<p class="ertify_help_block help-block form-text with-errors"></p>
							</div>
							<div class="form-group">
								<label>Contraseña</label>
								{password}
								<p class="ertify_help_block help-block form-text with-errors"></p>
							</div>
							<div class="mb-2"> <button v-on:click.stop.prevent="submit" class="btn btn-primary w-100">Acceder</button> </div>
							<a class="btn btn-info btn-block" href="'.$_ENV["BASE_URL"].'recuperar">Recuperar Clave</a>
						</div>
					</div>
				</div>
			</div>
		</div>';
		$artify->set_template($html_template);
		$artify->buttonHide("submitBtn");
		$artify->buttonHide("cancel");
		$artify->fieldDisplayOrder(array("usuario", "password"));
		$artify->fieldRenameLable("email", "Correo");
		$artify->fieldRenameLable("password", "Contraseña");
        $artify->fieldAddOnInfo("usuario", "before", '<div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span></div>');
        $artify->fieldAddOnInfo("password", "before", '<div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span></div>');
		$artify->addCallback("before_select", [$this, "login"]);
		$artify->formFields(array("usuario", "password"));
		$artify->setLangData("login", "Ingresar");
		$login = $artify->dbTable("usuario")->render("selectform");

		$stencil = new ArtifyStencil();
		echo $stencil->render('login', [
			'login' => $login
		]);
    }

	public function login($data, $obj) {
		$pass = $data['usuario']['password'];
		$user = $data['usuario']['usuario'];
		
		$queryfy = $obj->getQueryfyObj();
		$queryfy->where("usuario", $user);
		$hash = $queryfy->select("usuario");

		if ($hash) {
			if (password_verify($pass, $hash[0]['password'])) {
				@session_start();
				$_SESSION["data"] = $data;
			
				$obj->setLangData("no_data", "Bienvenido");
				$obj->formRedirection($_ENV['BASE_URL']."modulos");
			} else {
				echo "El usuario o la contraseña ingresada no coinciden.";
				die();
			}
		} else {
			echo "Datos erroneos.";
			die();
		}

		return $data;
	}

	public function users()
	{
		$users = new UserModel();
		$result = $users->select_users();

		echo json_encode($result);
	}

    public function salir()
	{
		SessionManager::startSession();
		SessionManager::destroy();

		Redirect::to("login");
	}

    public function reset()
	{
		$artify = DB::ArtifyCrud();
		$configuracion = HomeController::configuracion();
		$html_template = '
		<div class="container mt-5">
			<div class="row d-flex justify-content-center">
				<div class="col-xl-6">
					<div class="card px-5 py-5 bg-light shadow-lg" id="form1">
						<p class="mb-3 mt-3 text-center font-weight-bold">Recuperar Clave</p>
						<center><img class="w-25" src="'.$_ENV["BASE_URL"]. "app/libs/artify/uploads/" . $configuracion[0]["logo_login"].'"></center>
						<p class="mb-3 mt-3 text-center font-weight-bold"></p>
						<div class="form-data">
							<div class="form-group">
								<label>Correo</label>
								{email}
								<p class="mt-2 font-weight-bold text-center">Ingresa tu correo para recuperar tu clave</p>
								<p class="ertify_help_block help-block form-text with-errors"></p>
							</div>
							<div class="mb-2"> <button v-on:click.stop.prevent="submit" class="btn btn-primary w-100">Recuperar</button> </div>
							<a class="btn btn-info btn-block" href="'.$_ENV["BASE_URL"].'login">Acceder</a>
						</div>
					</div>
				</div>
			</div>
		</div>';
		$artify->set_template($html_template);
		$artify->buttonHide("submitBtn");
		$artify->buttonHide("cancel");
		$artify->fieldRenameLable("email", "Correo");
		$artify->fieldAddOnInfo("email", "before", '<div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o"></i></span></div>');
		$artify->addCallback("before_select", [$this, "recuperar"]);
		$artify->formFields(array("email"));
		$artify->setLangData("login", "Recuperar");
		$reset = $artify->dbTable("usuario")->render("selectform");

		$stencil = new ArtifyStencil();
		echo $stencil->render('reset', [
			'reset' => $reset
		]);
	}

	public function recuperar($data, $obj)
	{   
		$email = htmlspecialchars($data['usuario']['email']);

		if(empty($email)){
			echo "Ingrese un correo para Recuperar su contraseña";
			die(); 
		} 

		$queryfy = $obj->getQueryfyObj();
		$queryfy->where("email", $email);
		$hash = $queryfy->select("usuario");

		if ($hash) {
			$pass = $queryfy->getRandomPassword(15, true);
			$encrypt = password_hash($pass, PASSWORD_DEFAULT);

			$queryfy->where("id", $hash[0]["id"]);
			$queryfy->update("usuario", array("password" => $encrypt));

			$emailBody = "Correo enviado  tu nueva contraseña es: $pass";
			$subject = "Nueva Contraseña de acceso al sistema de Procedimentos";
			$to = $email;

			//$queryfy->send_email_public($to, 'daniel.telematico@gmail.com', null, $subject, $emailBody);
			DB::PHPMail($to, "daniel.telematico@gmail.com", $subject, $emailBody);
			$obj->setLangData("success", "Correo enviado con éxito");
		}

		return $data;
	}
}