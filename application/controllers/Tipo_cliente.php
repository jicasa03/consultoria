<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Tipo_cliente extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("tipocliente");
			$this->load->view("Tipo_cliente/index",compact('lista'));

		}
		else{
			$this->load->view("Error/404");
		}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Tipo_cliente/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_tipocliente="";
			if(isset($_POST['id_tipocliente'])){
               $id_tipocliente=$_POST['id_tipocliente'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);

			//print_r($data);
			if($id_tipocliente==""){
			     $this->Mantenimiento_m->insertar("tipocliente",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("tipocliente",$data,$id_tipocliente,"id_tipocliente");
	        	 echo "2";
	        	}
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function actualizar()
	{   
		if ($this->input->is_ajax_request()){
			$data="";
			
			$data=$this->Mantenimiento_m->lista_uno("tipocliente",$_POST['id'],"id_tipocliente");

			$this->load->view('Tipo_cliente/nuevo',compact("data"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_categoria=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("tipocliente",$id_categoria,"id_tipocliente");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>