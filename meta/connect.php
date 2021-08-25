<?php
    $servername = "";
    $username = "";
    $password = "";
    $database = "";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn) {
        echo "Erro na conexão: ". mysqli_error($conn);
    }
?>

