<?php 

try{
	$usuario="root";
	$password="";
	
    $db="consultoria";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}

$query="select * from ficha_enfoque where id_ficha_enfoque=".$_GET['id'];
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
$idcliente=$rows['id_cliente'];
$titulo_enfoque=$rows['titulo_enfoque'];
$id_categoria=$rows['id_categoria'];
}
$resultado =null;

$query= "select * from persona,cliente,universidad where persona.dni=cliente.dni and universidad.id_universidad=cliente.id_universidad and persona.dni=".$idcliente;


$resultado = $conn->query($query); 
$nombre="";
foreach ( $resultado as $rows) { 

$dni=$rows["dni"];
$nombre=$rows["nombres"];
$apellido=$rows["apellidos"];
$email=$rows['correo'];
$telefono=$rows['telefono'];
$carrera=$rows['carrera'];

$universidad=$rows['observacion'];
}



$resultado =null;
$query= "select * from categoria where estado=1";


$resultado = $conn->query($query); 

$query= "select * from grado where estado=1";


$grado = $conn->query($query); 

$html="";

$html.="<html>

<table width='100%'>
<tr>
  <td width='30%'>
  <img src='logo.png' width='120px' height='80px'/>
  </td>
  <td width='40%'>
    <h2><u>Ficha de Enfoque</u></h2>
  </td>
  <td>
    <label style='font-size:3px'>Fecha de Entrega: </label><input style='font-size:7px;width:40px;height:8px; margin: 0px 0px 0px 0px;' type='text' value='".date('Y-m-d')."'/><br>
     <label style='font-size:3px'>Hora de Entrega: </label><input style='font-size:7px;width:40px;height:8px;margin:3px;'  type='text' value='".date('h:i:s A')."'/>
  </td>
 </tr>
 </table>
 <table>
 <tr>
  <td width='100%'>
  <h6 style='font-size:10px'>Titulo:</h6><input value='".$titulo_enfoque."' id='campo' type='text' />
    </td>

 </table>
<table width='100%'>
<tr>
   <td width='10%'>Categoria:</td>
   <td width='30%'>";
foreach ( $resultado as $rows) { 
      if($id_categoria==$rows['id_categoria'])
      {   
        $html.="<font id='texto'><input type='radio' checked='checked'>  ".$rows['descripcion']."</font><br/>";
      }
      else{
      $html.="<font id='texto'><input type='radio' />  ".$rows['descripcion']."</font><br/>";
        }
      }
         $html.="</td>
   <td width='10%'>
     
      ALUMNO:
   </td>
    <td width='50%'>
     <font id='texto'>Nombres y Apellidos:<input type='text' value='".$nombre." ".$apellido."' id='campo1'/></font><br/>
     <font id='texto'>email:<input type='text' id='campo2' value='".$email."' /></font><br/>
     <font id='texto'>telf.:<input type='text' id='campo3' value='".$telefono."'/><font id='texto'>Univ.:<input value='".$universidad."' type='text'  id='campo4'/><br/>
     <font id='texto'>Escuela:<input type='text' id='campo5' value='".$carrera."'/>

   </td>

</tr>
</table>
<table>

</table>
</html>
";

include("mpdf/mpdf.php");

$mpdf=new mPDF("en-GB-x","A4","","",0,0,0,0,6,3);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

$css=file_get_contents("estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("output", 'I');
