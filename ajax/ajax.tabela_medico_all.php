<?php
header( 'Cache-Control: no-cache' );
include('../meta/connect.php');

  $select_retorno = "SELECT * FROM agendar_medico";

  $query = mysqli_query($conn, $select_retorno);
  $row = mysqli_num_rows($query);

  if ($row == 0) {
    echo "<h2 style='margin-top:20px'><b>Nenhuma informação encontrada.</b></h2>";
  }else{
    while($row = mysqli_fetch_assoc($query)){   
      echo 
        '<tr>
          <td>'.$row['data'].'</td>
          <td>'.$row['nome'].'</td>
          <td>'.$row['celular'].'</td>
          <td>'.$row['departamento'].'</td>
          <td>'.$row['id_Hora'].'</td>
        </tr>';
      }      
    }



      // echo json_encode(array('confirmar'=> $tabela));
?>