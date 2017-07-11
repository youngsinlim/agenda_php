<?php

  require('conector.php');

  $id = "'".$_POST['id']."'";

  $exion = new ConectorBD('localhost','younglim','contrasena');

  $response['conexion']= $exion->initConexion('agenda_db');

  if($response['conexion']=='OK'){
    $data['msg']="OK";
    $exion->eliminarRegistro('eventos','id = '.$id);
  }else{
    $data['msg']="Error ingresando a base de datos en crear nuevo evento :(";
  }

  echo json_encode($data);

 ?>
