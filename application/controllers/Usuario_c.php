<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Usuario_c extends Controler {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_m');
	}
	public function index(){
		if ($this->input->is_ajax_request()){
			$listar = $this->Usuario_m->traerusuarios();
			$this->load->view('Usuario/index',compact('listar'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function new_asesor(){
		if ($this->input->is_ajax_request()){
			$sede = $this->db->query("SELECT sede.id_sede,sede.descripcion FROM sede where estado=1")->result();
			$especialidad =  $this->db->query("SELECT especialidad.descripcion, especialidad.id_especialidad FROM especialidad where estado=1")->result();
			$perfiles =  $this->db->query("SELECT perfil.per_id,perfil.per_descripcion FROM perfil where per_estado =1")->result();
			$this->load->view('Usuario/nuevo',compact('sede','especialidad','perfiles'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function savetrabajador(){
		if ($this->input->is_ajax_request()){
			$fecha_nac =date("Y/m/d", strtotime($_POST['fechanacimiento']));  
			$persona = array(
				'dni' => $_POST["dni"],
				'nombres' => $_POST["nombre"],
				'apellidos' => $_POST["apellido"],
				'telefono' => $_POST["celular"],
				'correo' => $_POST["correo"],
				'direccion' => $_POST["direccion"]
				);
			$trabajador = array(
				'dni' => $_POST["dni"],
				'n_cuenta_bcp' => $_POST["ncuenta"],
				'fecha_ingre' => '',
				'fecha_nac' => $fecha_nac
				);
			
			$usuario = array(
				'usu_usuario' => $_POST["usuario"],
				'usu_clave' => $_POST["clave"],
				'usu_perfil' =>$_POST["perfil"],
				'usu_fechareg' => '',
				'usu_sede' => $_POST["sede"],
				'persona' => $_POST["dni"]
				);
			if($_POST["id"]==""){
				$this->db->insert('persona', $persona);
				$this->db->insert('trabajador', $trabajador);
				foreach ($_POST['especialidad'] as $key => $value) {
					$detalle = array(
						'id_especialidad' => $value,
						'id_trabajador' => $_POST["dni"]
						);
					$this->db->insert('especilidad_trabajador', $detalle);
				}
				$estado=$this->db->insert('usuario', $usuario);
			}else{
				$this->db->where('dni',$_POST["id"]);
				$this->db->update('persona', $persona);
				$this->db->where('dni',$_POST["id"]);
				$this->db->update('trabajador', $trabajador);
				$this->db->query("DELETE FROM especilidad_trabajador where id_trabajador=".$_POST["dni"].";");
				foreach ($_POST['especialidad'] as $key => $value) {
					$detalle = array(
						'id_especialidad' => $value,
						'id_trabajador' => $_POST["dni"]
						);
					$this->db->insert('especilidad_trabajador', $detalle);
				}
				$this->db->where('persona',$_POST["id"]);
				$estado=$this->db->update('usuario', $usuario);

			}
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}
	public function savecliente(){
		if ($this->input->is_ajax_request()){
			$persona = array(
				'dni' => $_POST["dni"],
				'nombres' => $_POST["nombre"],
				'apellidos' => $_POST["apellido"],
				'telefono' => $_POST["celular"],
				'correo' => $_POST["correo"],
				'direccion' => $_POST["direccion"]
				);
			$cliente = array(
				'dni' => $_POST["dni"],
				'id_tipocliente' => $_POST['tipocliente'],
				'id_universidad' => $_POST['universidad'],
				'fecha_nacimiento'	=> '',
				'estado'	=> '1'																			
				);
			
			$usuario = array(
				'usu_usuario' => $_POST["usuario"],
				'usu_clave' => $_POST["clave"],
				'usu_perfil' =>'3',
				'usu_fechareg' => '',
				'persona' => $_POST["dni"]
				);

				$this->db->where('dni',$_POST["dni"]);
				$this->db->update('persona', $persona);
				$this->db->where('dni',$_POST["dni"]);
				$this->db->update('cliente', $cliente);
				if($_POST["nuevo"]=='0'){
					$estado=$this->db->insert('usuario', $usuario);
				}else{
					$this->db->where('persona',$_POST["dni"]);
				$estado=$this->db->update('usuario', $usuario);
				}

			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}
	public function savefoto(){
		if (isset($_FILES['files'])) {
			$archivo = $_FILES['files'];
			$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
			$time = time();
			$url = base_url();
			$nombre ="{$_POST['nombre_archivo']}_$time.$extension";
			$direccion = $url .$nombre; 
			echo $direccion;
			if (move_uploaded_file($_FILES["files"]["tmp_name"],"public/perfil/"."/". $_FILES["files"]["name"])) {
				$usuario = array(
					'usu_foto' =>$_FILES["files"]["name"]
					);
				$this->db->where('persona',$_POST["dni"]);
				$this->db->update('usuario', $usuario);
			} else {
				echo 0;
			}
		}
	}

	public function update_asesor(){
		$query = $this->db->query("SELECT persona.nombres,persona.apellidos,persona.telefono,persona.correo,persona.direccion,trabajador.n_cuenta_bcp,
			trabajador.fecha_nac,trabajador.estado,usuario.usu_usuario,usuario.usu_clave,usuario.usu_foto,persona.dni,
			especialidad.descripcion,especialidad.id_especialidad,usuario.usu_sede,usuario.usu_perfil
			FROM trabajador
			INNER JOIN detalle_trabajador_especialidad ON detalle_trabajador_especialidad.id_trabajador = trabajador.dni
			INNER JOIN especialidad ON detalle_trabajador_especialidad.id_especialidad = especialidad.id_especialidad
			INNER JOIN persona ON persona.dni = trabajador.dni
			INNER JOIN usuario ON persona.dni = usuario.persona
			where persona.dni=".$_POST["dni"].";")->result();
		echo json_encode($query);
	}
	public function update_cliente(){
		$listar = $this->db->query("SELECT persona.nombres,persona.apellidos,persona.telefono,persona.correo,persona.direccion,
			persona.dni,tipocliente.descripcion AS tipocliente,universidad.descripcion AS universidad,
			distrito.descripcion AS distrito,tipocliente.id_tipocliente,universidad.id_universidad,distrito.id_distrito
			FROM
			persona
			LEFT JOIN cliente ON cliente.dni = persona.dni
			LEFT JOIN tipocliente ON cliente.id_tipocliente = tipocliente.id_tipocliente
			LEFT JOIN universidad ON cliente.id_universidad = universidad.id_universidad
			LEFT JOIN distrito ON cliente.id_distrito = distrito.id_distrito
			where cliente.estado=1 	and persona.dni=".$_POST["dni"].";")->result();
		$universidad = $this->db->query("SELECT universidad.id_universidad,universidad.descripcion FROM universidad where estado =1")->result();
		$tipocliente = $this->db->query("SELECT tipocliente.id_tipocliente,tipocliente.descripcion FROM tipocliente where estado =1")->result();
		$usuario = $this->db->query("SELECT usuario.usu_id,usuario.usu_usuario,usuario.usu_clave,usuario.usu_foto FROM usuario where usuario.persona=".$_POST["dni"].";")->result(); 
		$this->load->view('Usuario/cliente',compact('listar','universidad','tipocliente','usuario'));
	}

	function delete_usuario(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'usu_estado' => 0
				);
			$this->db->where('persona', $_POST["id"]);
			$estado=$this->db->update('usuario', $data);
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

	function validardni(){
		$query = $this->db->query("SELECT count(persona.dni) as cant  FROM persona where dni=".$_POST["dni"].";")->result();
		echo json_encode($query);
	}
	public function prueba(){
		$carpetaAdjunta=base_url() . 'public/archivos/'.$_POST["id_ficha"].'/';
// Contar envían por el plugin
		$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
		$infoImagenesSubidas = array();
		for($i = 0; $i < $Imagenes; $i++) {
	// El nombre y nombre temporal del archivo que vamos para adjuntar
			$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
			$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
			$rutaArchivo=$carpetaAdjunta.$nombreArchivo;
			$canti = $this->db->query("SELECT count(archivo.nombre_archivo) as cantidad FROM archivo INNER JOIN log_transacional ON archivo.id_archivo = log_transacional.id_archivo
				where log_transacional.id_log =".$_POST["id_ficha"]." and archivo.nombre_archivo  LIKE '%".$nombreArchivo."%';")->row_array();
			$canti = $canti['cantidad']; 
			if($canti == 1){
				$borrar = '../public/archivos/'.$_POST["id_ficha"]."/".$nombreArchivo;
				unlink($borrar);
				move_uploaded_file($_FILES["imagenes"]["tmp_name"][$i],"public/archivos/".$_POST["id_ficha"]."/". $_FILES["imagenes"]["name"][$i]);
				$id=$this->db->query("SELECT archivo.id_archivo FROM archivo ORDER BY id_archivo DESC LIMIT 1")->row_array();
				$id = $id['id_archivo'];
				$transaccion = array(
					'id_log' => $_POST["id_ficha"],
					'id_archivo' => $id,
					'fecha_movimiento' => date("y-m-d"),
					'id_usuario'  => $_SESSION['usuario_id'],
					'observacion' => $_POST['descrip'],
					'id_tipo_movi' => '2'
					);
				$this->db->insert('log_transacional', $transaccion);
			}else{
				$directorio = "public/archivos/".$_POST["id_ficha"];
				if(!is_dir($directorio)){
					mkdir($directorio,0755,TRUE);
				}
				move_uploaded_file($_FILES["imagenes"]["tmp_name"][$i], "public/archivos/".$_POST["id_ficha"]."/". $_FILES["imagenes"]["name"][$i]);
				$archivo = array(
					'nombre_archivo' => $nombreArchivo
					);
				$this->db->insert('archivo', $archivo);
				$id=$this->db->query("SELECT archivo.id_archivo FROM archivo ORDER BY id_archivo DESC LIMIT 1")->row_array();
				$id = $id['id_archivo'];
				$transaccion = array(
					'id_log' => $_POST["id_ficha"],
					'id_archivo' => $id,
					'fecha_movimiento' => date("y-m-d"),
					'id_usuario'  => $_SESSION['usuario_id'],
					'observacion' => $_POST['descrip'],
					'id_tipo_movi' => '1'
					);
				$this->db->insert('log_transacional', $transaccion);
			}
			$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>base_url()."Usuario_c/borrar","key"=>$nombreArchivo);
			$ImagenesSubidas[$i]="<img  height='120px'  src=".$rutaArchivo." class='kv-preview-data file-preview-image file-zoom-detail'>";
		}
		$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			"initialPreview"=>$ImagenesSubidas);
		echo json_encode($arr);
	}

	public function borrar(){
		$carpetaAdjunta="public/archivos/1/";
		parse_str(file_get_contents("php://input"),$datosDELETE);
		$key= $datosDELETE['key'];
		$archivo = array(
			'estado' => '0'
			);
		$this->db->where('nombre_archivo',$key);
		$this->db->update('archivo', $archivo);
		unlink($carpetaAdjunta.$key);

		echo json_encode(0);

	}

	public function datos(){
		$query = $this->db->query("SELECT archivo.id_archivo,archivo.nombre_archivo FROM archivo INNER JOIN log_transacional ON archivo.id_archivo = log_transacional.id_archivo
			where log_transacional.id_log  =".$_POST["id_ficha"].";")->result();
		echo json_encode($query);
	}
}