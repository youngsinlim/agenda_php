<?php

  include('conector.php');

  $data['email'] = "'young2@naver.com'";
  $data['psw'] = "'".password_hash('12345', PASSWORD_DEFAULT)."'";
  $data['nombre'] = "'ancestro'";
  $data['fecha_nacimiento'] = "'1900-01-01'";


  $exion = new ConectorBD('localhost','younglim','contrasena');
  $response['conexion'] = $exion->initConexion('agenda_db');

  if ($response['conexion']=='OK') {
    if($exion->insertData('usuarios', $data)){
      $response['msg']="exito en la inserción";
    }else {
      $response['msg']= "Hubo un error y los datos no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);

 ?>
