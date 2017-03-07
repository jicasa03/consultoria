<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Documentos_c extends Controler{
	public function index(){
		if ($this->input->is_ajax_request()){
			$lista = $this->db->query("SELECT ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque,usuario.usu_id
				FROM produccion INNER JOIN ficha_enfoque ON ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque INNER JOIN usuario ON ficha_enfoque.id_usuario = usuario.usu_id where ficha_enfoque.id_trabajador = ".$_SESSION['id_persona']."; ")->result();
			$this->load->view('Documentos/index',compact('lista'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function new_documento(){
		$id=$_GET['id'];
		$lista = $this->db->query("SELECT log_transacional.fecha_movimiento,ficha_enfoque.id_ficha_enfoque,log_transacional.observacion,
			ficha_enfoque.titulo_enfoque,tipo_mov.descripcion,archivo.nombre_archivo
			FROM archivo
			INNER JOIN log_transacional ON archivo.id_archivo = log_transacional.id_archivo
			INNER JOIN ficha_enfoque ON ficha_enfoque.id_ficha_enfoque = log_transacional.id_log
			INNER JOIN tipo_mov ON tipo_mov.id_tipo_movi = log_transacional.id_tipo_movi
			where ficha_enfoque.id_ficha_enfoque =".$_GET['id']."; ")->result();
		$this->load->view('Documentos/nuevo',compact('id','lista'));
	}

	public function imagen_nueva(){
		$carpetaAdjunta="archivos";
// Contar envían por el plugin
		$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
		$infoImagenesSubidas = array();
		for($i = 0; $i < $Imagenes; $i++) {
	// El nombre y nombre temporal del archivo que vamos para adjuntar
			$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
			$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;

			$rutaArchivo=base_url()."archivos".$_FILES['imagenes']['name'][$i];

			move_uploaded_file($_FILES["file"]["tmp_name"][$i],"archivos".$_FILES['imagenes']['name'][$i]);

			$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar.php","key"=>$nombreArchivo);
			$ImagenesSubidas[$i]="<img  height='120px'  src=".base_url()."archivos".$_FILES['imagenes']['name'][$i]." class='file-preview-image'>";
		}
		$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			"initialPreview"=>$ImagenesSubidas);
		echo json_encode($arr);
	}

	public function traerarchivos(){
		$lista = $this->db->query("SELECT archivo.id_archivo,archivo.nombre_archivo FROM archivo where archivo.id_ficha=1")->result();
		echo json_encode($lista);	
	}


	
}