<?php
session_start();
include('./meta/connect.php');

$paciente =  mysqli_real_escape_string($conn, trim($_POST['paciente']));
$celular =  mysqli_real_escape_string($conn, trim($_POST['celular']));
$departamento =  mysqli_real_escape_string($conn, trim($_POST['departamento']));
$calendario =  mysqli_real_escape_string($conn, trim($_POST['calendario']));
$horario =  mysqli_real_escape_string($conn, trim($_POST['horario']));


$sql = "INSERT INTO agendar_medico (id_agenda,nome,celular,departamento,data,id_Hora) values 
(DEFAULT,'$paciente','$celular','$departamento','$calendario','$horario')";

// print_r($sql)
if(mysqli_query($conn, $sql)){
  //ultimo id da tabela ( id do insert acima)
  $id = mysqli_insert_id($conn);

  $sql2 = "UPDATE hora_disponivel set $horario ='$id' where data = '$calendario' limit 1";
  if (mysqli_query($conn, $sql2)) {

    $select_retorno = "SELECT hora8,hora9,hora10,hora11 FROM hora_disponivel where data = '$calendario'";
    $query = mysqli_query($conn, $select_retorno);
    $row = mysqli_fetch_all($query);
    $v = 1;
      for ($i=0; $i < count($row[0]); $i++) {
        //verificando se tem ':' na string se tiver o horario ta disponivel'
        $teste = mb_strpos($row[0][$i],':');
        if ($teste == 0) {
          if ($v == count($row[0])) {
            mysqli_query($conn, "UPDATE hora_disponivel set disponibilidade = 0 where data = '$calendario' limit 1");
          }
          $v++;
        }
      };


    $_SESSION['status_cadastro'] = true;
  }
  }else{
    $_SESSION['status_cadastro'] = false;
  } 
  $conn->close();

echo "<script>document.location='agendar.php'</script>";

exit;
?>