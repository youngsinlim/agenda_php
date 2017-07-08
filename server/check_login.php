<?php

  require('conector.php');

  $exion = new ConectorBD('localhost','younglim','contrasena');

  $response['conexion']= $exion->initConexion('agenda_db');

  if($response['conexion']=='OK'){

    $r_consulta = $exion->consultar(['usuarios'],
    ['email', 'psw'], 'WHERE email="'.$_POST['username'].'"');

    if ($r_consulta->num_rows != 0) {
      $fila = $r_consulta->fetch_assoc();
      if (password_verify($_POST['passw'], $fila['psw'])) {
        $response['acceso'] = 'concedido';
        session_start();
        $_SESSION['username']=$fila['email'];
      }else {
        $response['motivo'] = 'Contraseña incorrecta';
        $response['acceso'] = 'rechazado';
      }
    }else{
      $response['motivo'] = 'Email incorrecto';
      $response['acceso'] = 'rechazado';
    }
  }

  echo json_encode($response);

  $exion->cerrarConexion();

 ?>
