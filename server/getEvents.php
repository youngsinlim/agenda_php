<?php

require('conector.php');

session_start();

  if(isset($_SESSION['username'])){

    $exion = new ConectorBD('localhost','younglim','contrasena');

    $response['conexion']= $exion->initConexion('agenda_db');
    // consulta para encontrar el id del usuario actual en tabla usuarios

    $resultado1 = $exion->consultar(['usuarios'], ['id'], "WHERE email ='".$_SESSION['username']."'");
    $fila1 = $resultado1->fetch_assoc();

    // ------------------------------------------------------------------------------------

    if($response['conexion']=='OK'){

      // consulta para tabla eventos y enviar eventos
      $resultado2 = $exion->consultar(['eventos'], ['id','titulo','f_inicio','h_inicio','f_final','h_final','dia_entero'],
       "WHERE fk_usuarios ='".$fila1['id']."'");
       $i=0;
       /*
       while($fila2 = $resultado2->fetch_assoc()){
         $data['eventos'][$i]['id']=$fila2['id'];
         $data['eventos'][$i]['titulo']=$fila2['titulo'];
         $data['eventos'][$i]['f_inicio']=$fila2['f_inicio'];
         $data['eventos'][$i]['h_inicio']=$fila2['h_inicio'];
         $data['eventos'][$i]['f_final']=$fila2['f_final'];
         $data['eventos'][$i]['h_final']=$fila2['h_final'];
         $data['eventos'][$i]['dia_entero']=$fila2['dia_entero'];
         $i++;
       }
       */

      $data['msg']='OK';

    }else{
      $data['msg']="Ups!, No se pudo conectar a la base de datos!";
    }

  }


  echo json_encode($data);
 ?>
