<?php
header( 'Cache-Control: no-cache' );
include('../meta/connect.php');

    $data = $_POST['dia'];
    $tabela = array();

    $select_retorno = "SELECT hora8,hora9,hora10,hora11 FROM hora_disponivel where data = '$data'";
    $query = mysqli_query($conn, $select_retorno);
    $sql = mysqli_num_rows($query);
    $row = mysqli_fetch_all($query);

    if($sql == 1){
        for ($i=0; $i < count($row[0]); $i++) {
          //verificando se tem ':' na string se tiver o horario ta disponivel'
          if (mb_strpos($row[0][$i],':')) {
          // $i+8 é pra pegar colocar no value o nome da tabela
            array_push($tabela,"<option value=".'hora'.($i+8).">".$row[0][$i]."</option>");
          }
        };
    }else{
      $sql = "INSERT INTO hora_disponivel (id_hora,data,disponibilidade,hora8,hora9,hora10,hora11) values 
      (DEFAULT,'$data','1','08:00','09:00','10:00','11:00')";
      $query = mysqli_query($conn, $sql);

      $teste = '<option value="hora8">08:00</option>
                <option value="hora9">09:00</option>
                <option value="hora10">10:00</option>
                <option value="hora11">11:00</option>';
                
        array_push($tabela,$teste);
    }
      echo json_encode(array('confirmar'=> $tabela));


?>



