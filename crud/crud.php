<?php

    //Creem la data per al log del text
    $text = date("Y-m-d H:i:s")."\t\t";

    switch($_SERVER['REQUEST_METHOD']){
      case 'GET':
        if(file_exists($_GET['id'].".txt")){
          //Imprimim per pentalla el fitxer que ens demanen
          $text .= "GET\t\tid : ".$_GET['id']."\n";
          echo file_get_contents($_GET['id'].".txt");
        }else{
          $text .= "GET\t\tid : ".$_GET['id']."404 File Not found\n";
          echo '404 File Not found';
        }

        break;

      case 'POST':
        //Si existeix el fitxer l'actualitzem, si no fiquem un misatge d'error al log
        if(file_exists($_GET['id'].".txt")){
          $text .= "POST\t\tid : ".$_GET['id']."\n";
          file_put_contents($_GET['id'].".txt", file_get_contents("php://input")); //fiquem el cos del input al fitxer que creem
        }else{
          $text .= "POST\t\tid : ".$_GET['id']."404 File Not found\n";
          echo '404 File Not found';
        }
        break;

      case 'PUT':
        //Si existeix el fitxer el borrem, si no fiquem un misatge d'error al log
        if(file_exists($_GET['id'].".txt")){
          $text .= "PUT\t\tid : ".$_GET['id']."404 File Already Exists\n";
          echo 'File Already Exists';
        }else{
          $text .= "PUT\t\tid : ".$_GET['id']."\n";
          file_put_contents($_GET['id'].".txt", file_get_contents("php://input")); //fiquem el cos del input al fitxer que creem
        }

        break;

      case 'DELETE':
        //Si existeix el fitxer el borrem, si no fiquem un misatge d'error al log
        if(file_exists($_GET['id'].".txt")){
          unlink($_GET['id'].".txt"); // Borrem el fitxer amb aquest id
          $text .= "DELETE\t\tid : ".$_GET['id']."\n";
        }else{
          $text .= "DELETE\t\tid : ".$_GET['id']."404 File Not found\n";
          echo '404 File Not found';
        }

        break;
      //No es cap de les altres peticions
      default:
        $text = "ERROR\n";
        $retval = array( 'estat' => 'ERROR' );
        break;
    }

    // echo $text;
    file_put_contents("logs.txt", $text ,FILE_APPEND);

?>
