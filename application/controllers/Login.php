<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index(){
		$this->load->view('Login/index');
	}
	
	public function crear_login(){

		$login = $this->db->query(
			"select *from usuario,persona,sede,perfil where usuario.usu_perfil=perfil.per_id and sede.id_sede=usuario.usu_sede and persona.dni=usuario.persona and usu_usuario='".$_POST['username']."' and usu_clave='".$_POST['password']."' and usu_estado=1"
		)->result_array();

		if (count($login)>0) {
			$_SESSION['usuario_id'] = $login[0]['usu_id'];
			$_SESSION['usuario'] = $login[0]['usu_usuario'];
			$_SESSION['usuario_nombre'] = $login[0]['nombres'].' '.$login[0]['apellidos'];
			$_SESSION['usuario_perfil'] = $login[0]['usu_perfil'];
			$_SESSION['sede']=$login[0]['descripcion'];
			$_SESSION['imagen']=$login[0]['usu_foto'];
			$_SESSION['perfil']=$login[0]['per_descripcion'];
			$_SESSION['dni_usuario']=$login[0]['dni'];
			$_SESSION['id_persona'] = $login[0]['persona'];
		}else{

			echo '2-Usuario o contraseña incorrento!';
			
		}
	}

	public function destroy_login(){
		session_destroy();
		header('Location: '.base_url());
	}
}
