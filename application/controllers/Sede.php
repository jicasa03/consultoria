<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Sede extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("Sede");
			$this->load->view("Sede/index",compact('lista'));

		}
		else{
			$this->load->view("Error/404");
		}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Sede/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_sede="";
			if(isset($_POST['id_sede'])){
               $id_sede=$_POST['id_sede'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);

			//print_r($data);
			if($id_sede==""){
			     $this->Mantenimiento_m->insertar("sede",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("sede",$data,$id_sede,"id_sede");
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
			
			$data=$this->Mantenimiento_m->lista_uno("sede",$_POST['id'],"id_sede");

			$this->load->view('Sede/nuevo',compact("data"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_Sede=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("sede",$id_Sede,"id_sede");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>