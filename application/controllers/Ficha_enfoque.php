<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');

class Ficha_enfoque extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request()){
       $lista=$this->Mantenimiento_m->consulta("SELECT ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,per_cliente.nombres as cliente_nombre,per_cliente.apellidos as cliente_apellidos,
per_trabajador.nombres as trabajador_nombre,per_trabajador.apellidos as trabajador_apellido,ficha_enfoque.titulo_enfoque as titulo, ficha_enfoque.estado_ficha as estado
 from ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario
where ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario AND
per_cliente.dni=cliente.dni and per_trabajador.dni=trabajador.dni and per_usuario.dni=usuario.persona");
       
			$this->load->view("Ficha_enfoque/index",compact('lista'));

		}
		else{
			$this->load->view("Error/404");
		}
	}

	public function provincia(){
		if (isset($_POST['id'])) {
              $lista=$this->Mantenimiento_m->provincia($_POST['id']);
	           $html="";
	          foreach ($lista as $value) {
	            $html.= "<option value='".$value->id_provincia."'>".$value->descripcion."</option>";
	          }
	          echo $html;
		}
	}

		public function distrito(){
		if (isset($_POST['id'])) {

              $lista=$this->Mantenimiento_m->distrito($_POST['id']);
             
	           $html="";
	          foreach ($lista as $value) {
	            $html.= "<option value='".$value->id_distrito."'>".$value->descripcion."</option>";
	          }
	          echo $html;
		}
	}
    
    public function registrarcliente()
    {
    $dni="";
    $pub=$this->Mantenimiento_m->consulta2("select * from persona,cliente where persona.dni=cliente.dni");
    if($pub->dni!=""){
     $dni=$pub->dni;
    } 
     


      if($dni==""){
     
          	$data=array(
              "dni"=>$_POST['dni'],
              "nombres"=>strtoupper($_POST['nombres']),
              "apellidos"=>strtoupper($_POST['apellidos']),
              "telefono"=>$_POST["telefono"],
              "correo"=>$_POST['correo'],
               "direccion"=>$_POST['direccion']
    		);
          $iduniversidad=$this->Mantenimiento_m->universidad_id($_POST['universidad']);
    		$data1=array(
    			"dni"=>$_POST['dni'],
    			"id_universidad"=>$iduniversidad,
    			"id_distrito"=>$_POST['distrito'],
    			"carrera"=>strtoupper($_POST['carrera']),
    			"id_tipocliente"=>$_POST['id_tipocliente']

    		);
          $this->Mantenimiento_m->insertar_cliente($data,$data1);
          echo "1";
      }
      else{
          $data=array(
              "dni"=>$_POST['dni'],
              "nombres"=>strtoupper($_POST['nombres']),
              "apellidos"=>strtoupper($_POST['apellidos']),
              "telefono"=>$_POST["telefono"],
              "correo"=>$_POST['correo'],
               "direccion"=>$_POST['direccion']
        );
          $iduniversidad=$this->Mantenimiento_m->universidad_id($_POST['universidad']);
        $data1=array(
          "dni"=>$_POST['dni'],
          "id_universidad"=>$iduniversidad,
          "id_distrito"=>$_POST['distrito'],
          "carrera"=>strtoupper($_POST['carrera']),
          "id_tipocliente"=>$_POST['id_tipocliente']

        );

         $this->Mantenimiento_m->actualizar_cliente($data,$data1);
           echo "2";
      }
         
    	
    
        
    }

    


	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
            $tipo=$this->Mantenimiento_m->tipo_enfoque();
			$departamento=$this->Mantenimiento_m->lista("departamento");
             $universidad=$this->Mantenimiento_m->universidad("universidad");
			 $categoria=$this->Mantenimiento_m->lista("categoria");
			$tipocliente=$this->Mantenimiento_m->tipocliente();
			$grado=$this->Mantenimiento_m->lista("grado");
			$tipo_norma=$this->Mantenimiento_m->lista("tipo_norma");
			$especialidad=$this->Mantenimiento_m->lista("especialidad");
      $resultado=$this->Mantenimiento_m->lista("resultado");
            
	
			$this->load->view('Ficha_enfoque/nuevo',compact("resultado","departamento","tipocliente","universidad","categoria","grado","tipo_norma","especialidad","tipo"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
   
    public function asesores()
    {   $html="";
    	$sede=$this->Mantenimiento_m->lista("sede");
    	$html.="<option value='-1'>Seleciones por favor</>";
    	foreach ($sede as $datasede) {
    	      $asesorsede=$this->Mantenimiento_m->asesores($datasede->id_sede);

    	      $html.= '
              
    	      <optgroup label="'.$datasede->descripcion.'">';
    	      foreach ($asesorsede as $datasesor) {
    	              $html.='<option data-toggle="modal" value="'.$datasesor->dni.'" data-target="#modal_large">'.$datasesor->nombres." ".$datasesor->apellidos.'</option>';
						
										
    	      }
    	      $html.='</optgroup>';

    	}
    	echo $html;
      }

    public function guardar_ficha_admin()
    {
    	$data=array(
            "id_trabajador"=>$_POST['id_trabajador'],
            "id_categoria"=>$_POST['id_categoria'],
            "id_grado"=>$_POST['id_grado'],
            "id_usuario"=>$_SESSION['usuario_id'],
             "id_cliente"=>$_POST['dni1'],
             "fecha_registro"=>date('Y-m-d'),
             "id_especialidad"=>$_POST["id_especialidad"],
             "id_tipo_enfoque"=>$_POST['id_tipo_enfoque'],
             "estado_ficha"=>1
    		);
    	$this->Mantenimiento_m->insertar("ficha_enfoque",$data);
        $r=$this->Mantenimiento_m->maximo_ficha();
        echo $r;
    }
    
    public function traer_un_cliente()
    {
    	$dni=$_POST['dni'];
    	$res=$this->Mantenimiento_m->traer_cliente($dni);
    	print_r(json_encode($res));
    }
    public function distrito_lista()
    {
    	$res=$this->Mantenimiento_m->lista_distritos($_POST['id_distrito']);
    	 $html="";
              foreach ($res as $value) {
                $html.= "<option value='".$value->id_distrito."'>".$value->descripcion."</option>";
              }
              echo $html;
    }


   public function cronograma_prestamo(){
    if ($this->input->is_ajax_request()){
      $monto_prest = $_POST["monto"];
      $semanas = $_POST["semanas"];
      $intervalo = $_POST["intervalo"];
      $fecha = $_POST["fechaprestamo"];
      $this->load->view('Ficha_enfoque/cronograma',compact('monto_prest','semanas','intervalo','fecha'));
    }else{
      $this->load->view('Error/404');
    }
  }

  public function ingresar()
  {  
      $id_enfoque="";
       if(isset($_POST['id_enfoque'])){
       $id_enfoque=$_POST['id_enfoque'];
      }

    $data=array(
        "titulo_enfoque"=>$_POST['titulo_enfoque'],
        "porque"=>$_POST['porque'],
        "paraque"=>$_POST['paraque'],
        "como"=>$_POST['como'],
        "donde"=>$_POST['donde'],
        "variables"=>$_POST['variables'],
        "muestra"=>$_POST['muestra'],
        "dis_inv"=>$_POST['dis_inv'],
        "anios_antiguedad"=>$_POST['anios_antiguedad'],
        "cant_inter"=>$_POST['cant_inter'],
        "cant_nacio"=>$_POST['cant_nacio'],
        "cant_local"=>$_POST['cant_local'],
        "can_realidad"=>$_POST['can_realidad'],
        "cant_marco"=>$_POST['cant_marco'],
        "anio_teoria"=>$_POST['anio_teoria'],
        "can_autor"=>$_POST['can_autor'],
         "marco_conceptual"=>$_POST['marco_conceptual'],
         "res_cant_hojas"=>$_POST['res_cant_hojas'],
         "id_tipo_norma"=>$_POST['id_tipo_norma'],
         "bio_cantidad"=>$_POST['bio_cantidad'],
         "forma_orden"=>$_POST['forma_orden'],
         "bio_ordenado"=>$_POST['bio_ordenado'],
          "plan_mejora"=>$_POST['plan_mejora'],
          "estado_ficha"=>"2"

      );
    print_r($data);
    

    if($id_enfoque==""){
       $this->Mantenimiento_m->insertar("ficha_enfoque",$data);
           echo "1";
    }
    else {
  
      $this->Mantenimiento_m->actualizar("ficha_enfoque",$data,$id_enfoque,"id_ficha_enfoque");
             echo "2";
    }
  }

  public function actualizar()
  {

    $query="SELECT * from ficha_enfoque where id_ficha_enfoque=".$_POST['id'];

       $resultado=$this->Mantenimiento_m->lista("resultado");
      $data=$this->Mantenimiento_m->consulta($query);
      $tipo=$this->Mantenimiento_m->tipo_enfoque();
      $departamento=$this->Mantenimiento_m->lista("departamento");
             $universidad=$this->Mantenimiento_m->universidad("universidad");
       $categoria=$this->Mantenimiento_m->lista("categoria");
      $tipocliente=$this->Mantenimiento_m->tipocliente();
      $grado=$this->Mantenimiento_m->lista("grado");
      $tipo_norma=$this->Mantenimiento_m->lista("tipo_norma");
      $especialidad=$this->Mantenimiento_m->lista("especialidad");
            
  
      $this->load->view('Ficha_enfoque/nuevo',compact("resultado","departamento","tipocliente","universidad","categoria","grado","tipo_norma","especialidad","tipo","data"));

  }

  public function data()
  {
    $query="SELECT per_cliente.dni as dni,
ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,
per_cliente.nombres as cliente_nombre,
per_cliente.apellidos as cliente_apellidos,
per_cliente.dni as dni_cliente,
per_cliente.telefono as telefono_cliente,
per_cliente.direccion as direccion_cliente,
per_cliente.correo as cliente_correo,
cliente.id_tipocliente as tipocliente,
universidad.descripcion as universidad,
per_trabajador.nombres as trabajador_nombre,
per_trabajador.apellidos as trabajador_apelido,
ficha_enfoque.titulo_enfoque as titulo,
ficha_enfoque.id_tipo_enfoque as id_tipo_enfoque,
ficha_enfoque.id_categoria as id_categoria,
ficha_enfoque.id_trabajador as id_trabajador,
cliente.carrera as carrera
from ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario,universidad
where ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario 
AND universidad.id_universidad=cliente.id_universidad and
per_cliente.dni=cliente.dni and per_trabajador.dni=trabajador.dni and per_usuario.dni=usuario.persona and 
ficha_enfoque.id_ficha_enfoque=".$_POST['id'];
   $data=$this->Mantenimiento_m->consulta2($query);

$data1=array("cliente_nombre"=>$data->cliente_nombre,"cliente_apellidos"=>$data->cliente_apellidos,"dni"=>$data->dni,"telefono_cliente"=>$data->telefono_cliente,"direccion_cliente"=>$data->direccion_cliente,"cliente_correo"=>$data->cliente_correo,"universidad"=>$data->universidad,
  "carrera"=>$data->carrera,"tipocliente"=>$data->tipocliente,"id_tipo_enfoque"=>$data->id_tipo_enfoque,"id_categoria"=>$data->id_categoria,
  "id_trabajador"=>$data->id_trabajador);
 

   echo json_encode($data1);

  }

  public function notificacion()
  {
       //echo $_SESSION['dni_usuario'];
       $sql="SELECT 
persona.nombres as cliente_nombre,
persona.apellidos as cliente_apellidos
from ficha_enfoque,cliente,persona
where ficha_enfoque.id_cliente=cliente.dni and 
persona.dni=cliente.dni and
ficha_enfoque.estado_ficha=1
and 
ficha_enfoque.id_trabajador=".$_SESSION['dni_usuario'];

     $data=$this->Mantenimiento_m->consulta($sql);
      $tal= count($data); 

       $html="";
      $html.='<ul class="media-list dropdown-content-body width-350">';
       foreach ($data as $key => $value) {
          $html.='<li class="media">
                  <div class="media-left">
                    <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs legitRipple"><i class="icon-spinner11"></i></a>
                  </div>
                  
                  <div class="media-body">
                    <strong>'.$value->cliente_nombre." ".$value->cliente_apellidos.'</strong> - 1320 new users, 3284 orders, $49,390 revenue
                    <div class="media-annotation">Feb 1, 05:46</div>
                  </div>
                </li>
                 ';
       }

      

      $html.="</ul>";

 $sql="SELECT max(id_ficha_enfoque) as maximo from ficha_enfoque where ficha_enfoque.id_trabajador=".$_SESSION['dni_usuario'];
$maximo=0;
$max=$this->Mantenimiento_m->consulta($sql);
foreach ($max as $key => $value) {
  $maximo=$value->maximo;
}

$sql="SELECT 
persona.nombres as cliente_nombre,
persona.apellidos as cliente_apellidos
from ficha_enfoque,cliente,persona
where ficha_enfoque.id_cliente=cliente.dni and 
persona.dni=cliente.dni and
ficha_enfoque.estado_ficha=1
and 
ficha_enfoque.id_ficha_enfoque=".$maximo;
$max=$this->Mantenimiento_m->consulta($sql);
foreach ($max as $key => $value) {
  $nombres=$value->cliente_nombre;
  $apellidos=$value->cliente_apellidos;
}

    if($tal!=0){
     $data1=array("datos"=>$html,"cantidad"=>$tal,"maximo"=>$maximo,"nombre"=>$nombres." ".$apellidos);
   }
   else
   {
     $data1=array("datos"=>"","cantidad"=>$tal,"maximo"=>"","nombre"=>"");
   }
      echo json_encode($data1);
   }
  

  public function categoria_subfases()
  {  //echo $_POST['id_categoria'];
      $sql="select DISTINCT(subfase.id_fase) as id_fase,fases.titulo as fases,fases.descripcion as descripcion from categoria_subfase,subfase,fases WHERE categoria_subfase.id_categoria=".$_POST['id_categoria']." and categoria_subfase.id_subfase=subfase.id_subfase
and subfase.id_fase=fases.id_fase and fases.id_tipo_enfoque=".$_POST['id_tipo_enfoque']." order by subfase.id_subfase asc";
       $data=$this->Mantenimiento_m->consulta($sql);
       $html="";
       foreach ($data as $key => $value)
        {
           $radio1="";
           $radio2="";
           $radio3="";
           $radio4="";
           $radio5="";
           $radio6="";
         $html.="<tr>";
           $html.="<td><h3><b title='".$value->descripcion ."'>".$value->fases."</b></h3>";
           $sql="select * from subfase where estado=1 and id_fase=".$value->id_fase;
            $data1=$this->Mantenimiento_m->consulta($sql);
           $html.="<td >";
         
          //print_r($data1);exit();

          foreach ($data1 as $key => $data2) 
           {    

                //echo $data2->id_subfase;exit();
                $html.="<h6 title='".$data2->descripcion."'>".$data2->titulo."</h6>";
                $sql="select * from subfase,subfase_tiempo WHERE subfase.id_subfase=subfase_tiempo.id_subfase and subfase.id_subfase= ".$data2->id_subfase." ORDER BY id_tarea asc ,id_dificultad asc" ;
              
                $tiempo=$this->Mantenimiento_m->consulta($sql);
                 // print_r($tiempo);exit();
                $difi=0;
                $tar=0;
               foreach ($tiempo as $key => $value1 ) 
               {
                
                
                  $difi=$value1->id_dificultad;
                  $tar=$value1->id_tarea;
                  if($tar==1 && $difi==1){
                   $radio1.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>
                      
                  ';
                  }
                 if($tar==1 && $difi==2){
                  $radio2.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==1 && $difi==3){
                    $radio3.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==2 && $difi==1){
                   $radio4.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==2 && $difi==2){
                   $radio5.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==2 && $difi==3){
                   $radio6.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                
                
             }
           }
               $html.="</td>";
               $html.="<td>".$radio1."</td>";
               $html.="<td>".$radio2."</td>";
               $html.="<td>".$radio3."</td>";
               $html.="<td>".$radio4."</td>";
               $html.="<td>".$radio5."</td>";
              $html.="<td>".$radio6."</td>";
             

         $html.="</tr>";

      

       }

          $html.='

          <script>
$( function() {
$(".styled, .multiselect-container input").uniform({
        radioClass: "choice"
    });});



  

    </script>';

     
       echo $html;
  }

  public function estado3(){
    $id_enfoque=$_POST['id_enfoque'];
    $data=array("estado_ficha"=>3);
    $this->Mantenimiento_m->actualizar("ficha_enfoque",$data,$id_enfoque,"id_ficha_enfoque");
  }
  public function asesores_subfase()
  {
     //print_r($_POST['id_tiempo']);exit(); 
     $id_produccion="";
     if (isset($_POST['id_produccion'])) {
      $id_produccion=$_POST["id_produccion"];
     }
   
     
  
    if($id_produccion=="")
    { 
        $data=array("descripcion"=>"",
         "estado_fase"=>1,
         "id_ficha_enfoque"=>$_POST["id_enfoque"]
        );
       $this->Mantenimiento_m->insertar("produccion",$data);
       $data=$this->Mantenimiento_m->consulta("select max(id_producion ) as maximo from produccion");
       foreach ($data as $key => $value) {
        $id_produccion=$value->maximo;
       }
      
    }
 // print_r($_POST['id_tiempo']);exit(); 

  foreach ($_POST['id_tiempo'] as $key => $value) {
   
         $data1=array(
             "id_tiempo"=>$_POST['id_tiempo'][$key],
             "id_produccion"=>$id_produccion
             );
   
 $this->Mantenimiento_m->insertar("subfase_tiempo_produccion",$data1);
    // print_r($data);
    }
  
              
     $html="";

      $sede=$this->Mantenimiento_m->lista("sede");
     
      foreach ($sede as $datasede) {
            $asesorsede=$this->Mantenimiento_m->asesores($datasede->id_sede);
              $html.="<div class='form-group'>";
            $html.= ' <label class="text-semibold">'.$datasede->descripcion.'</label>';
            foreach ($asesorsede as $datasesor) {
              $html.='<div class="checkbox">
                      <label>';
            $html.='<input type="checkbox" name="id_empleado[]" id="id_empleado" value="'.$datasesor->dni.'">'.$datasesor->nombres." ".$datasesor->apellidos.'</input>';
            $html.='</label>
                    </div>';
                    
            }
           
            $html.='</div>';
      }
      $a="'Ficha_enfoque','Tesis'";
      $boton=' <center> 
                        <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('.$a.')">Cancelar</button>
                        <button id="btn_form4"  type="button" class="btn btn-primary legitRipple">Guardar </button>
                              </center>               
               <script>
                $("#btn_form4").click(function(event) {
                  alert($("#formulario2").serialize());
                  $.post(base_url+"ficha_enfoque/arrastrar_asesor",$("#formulario2").serialize(),function(data){
                    alert(data.boton);
                    $("#cabeza-tab3").empty();
                    $("#cabeza-tab3").append(data.html);
                    $("#boton2").empty();
                    $("#boton2").append(data.boton);
                  },"json");
               });
               </script>';

    $data2=array("id_produccion"=>$id_produccion,"asesores"=>$html,"boton"=>$boton);
    echo json_encode($data2);
  }

  public function horario()
  {
       
  }


  public function arrastrar_asesor()
  {
    $html1="";
    $html2="";
    $html="";
    $html3="";
    $post="";
    /*print_r($_POST['id_empleado']);
    echo $_POST["id_produccion"];*/
     $cantidad= count($_POST['id_empleado']);

       if($cantidad==1)
       {
          
        foreach ($_POST['id_empleado'] as $key => $value) 
                   {
                  
                      $this->Mantenimiento_m->consulta1("UPDATE subfase_tiempo_produccion set id_trabajador=".$_POST['id_empleado'][$key]."
                              where id_produccion=".$_POST['id_produccion']);

                   }
             
         }
       else
       {
           
            foreach ($_POST['id_empleado'] as $key => $value) 
                   {  
                 $id_empleado=$_POST['id_empleado'][$key];
                     if(($key+2)%2==0)
                      { //echo "hola1";
                          //print_r($id_empleado);

                          $nombre="";
                          $dni="";
                          $sql="select * from persona where dni=".$id_empleado;
                         // echo $sql;
                            $data=$this->Mantenimiento_m->consulta($sql);
                          // print_r($data);
                         foreach ($data as $key => $value) {
                            $nombre=$value->nombres." ".$value->apellidos;
                            $dni=$value->dni;
                          }
                        $post.=' 
                             alert($("#'.$dni.'").serialize());
                         $.ajax({
    url:base_url+"Ficha_enfoque/asignacion",
    data:"id_produccion="+$("#id_produccion").val()+"&"+$("#'.$dni.'").serialize(),
    type:"post",
     dataType: "json",
   
    success: function(data) {
  
    }
  });';


                          $html1.='
                           <form id="'.$dni.'">
                          <div class="panel panel-body border-top-info">
                          
                <div class="text-center">
                  <input id="id_asesor" type="hidden" value="'.$dni.'">
                  <h6 class="text-semibold no-margin">Asesor</h6>
                  <p class="content-group-sm text-muted">'.$nombre.'</p>
                </div>

                <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
                  
                            
                  
                  </ul>
                  
              </div></form>';
                     }
                      else
                      {
                        //echo "hola2";
                          $nombre="";
                          $sql="select * from persona where dni=".$id_empleado;
                            $data=$this->Mantenimiento_m->consulta($sql);
                            //   print_r($sql);
                              //  print_r($data);
                          foreach ($data as $key => $value) {
                            $nombre=$value->nombres." ".$value->apellidos;
                            $dni=$value->dni;
                          }
                           $post.=' 
                            alert($("#'.$dni.'").serialize());
                            $.ajax({
    url:base_url+"Ficha_enfoque/asignacion",
    data:"id_produccion="+$("#id_produccion").val()+"&"+$("#'.$dni.'").serialize(),
    type:"post",
     dataType: "json",
   
    success: function(data) {
    
    }
  });';

                         $html2.='
                           <form id="'.$dni.'">
                         <div class="panel panel-body border-top-info">
                          
                <div class="text-center">
                  <input id="id_asesor" type="hidden"  value="'.$dni.'"/>
                  <h6 class="text-semibold no-margin">Asesor</h6>
                  <p class="content-group-sm text-muted">'.$nombre.'</p>
                </div>

                <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
                  
                            
                  
                  </ul>
                  
              </div></form>';
                      }

                   
                  } 
               // echo   $html1;

                //echo  $html2;
           
                   $sql="SELECT DISTINCT(fases.id_fase) as id_fase,fases.titulo as titulo,fases.descripcion as descripcion from subfase_tiempo_produccion,subfase_tiempo,subfase,fases
                     where subfase_tiempo.id_tiempo=subfase_tiempo_produccion.id_tiempo and 
                     subfase_tiempo.id_subfase=subfase.id_subfase and subfase.id_fase=fases.id_fase and 
                     subfase_tiempo_produccion.id_produccion=".$_POST['id_produccion']." order by subfase.id_subfase asc";

                         $data=$this->Mantenimiento_m->consulta($sql);
                     //print_r($data);
                         
                    foreach ($data as $key => $value)
                      {     

                           $sql="SELECT subfase_tiempo_produccion.id_tiempo as id_tiempo,subfase.titulo as titulo, subfase.descripcion as descripcion from subfase_tiempo_produccion,subfase_tiempo,subfase
                            where subfase_tiempo.id_tiempo=subfase_tiempo_produccion.id_tiempo and 
                          subfase_tiempo.id_subfase=subfase.id_subfase and subfase.id_fase=".$value->id_fase." and
                            subfase_tiempo_produccion.id_produccion=".$_POST['id_produccion']." order by subfase.id_subfase asc";
                               
                               $data1=$this->Mantenimiento_m->consulta($sql);
                             // echo $value->titulo;
                           
                             $html3.='<div class="form-group">
                           <label title="'.$value->descripcion.'" ><b>'.$value->titulo.'</b></label>
                            <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">';
                              
                             // print_r($data1);
                                foreach ($data1 as $key => $data2) 
                                        {   
                                          $html3.='<li class=""><input type="hidden" id="idsubfases[]" value="'.$data2->id_tiempo.'" ><a href="#" title="'.$value->titulo.":".$data2->descripcion.'">'.$data2->titulo.'</a></li>';
                                          }

                          $html3.='</ul> </div>';
                    }

              //echo $html3;
                  $html.='<div class="row">
                  <div class="col-md-4"> ';
                  $html.=$html1;
                  $html.="</div>";
                  $html.='<div class="col-md-4"> ';
                  $html.=$html3;
                  $html.='</div><div class="col-md-4">';
                  $html.=$html2;
                  $html.="</div></div>";
              $html.="<script>
                   $( function() {
                        var containers = $('.dropdown-menu-sortable').toArray();
                            dragula(containers, {
                              mirrorContainer: document.querySelector('.dropdown-menu-sortable')
                            });
                     });
                   function boton()
                    {
                      alert($('#87654321').serialize());
                      } 
              </script>";
              $a="";
               $a="'Ficha_enfoque','Tesis'";
                $boton=' <center> 
                  <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('.$a.')">Cancelar</button>
                  <button id="btn_form5" onclick="boton()" type="button" class="btn btn-primary legitRipple">Guardar </button>
                  </center>  
                 <script>

                 </script>';
         $datos=array("html"=>$html,"boton"=>$boton);
         echo json_encode($datos);
	    }
    }

}

?>