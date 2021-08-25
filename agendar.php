<?php 
session_start();
include('verifica_login.php');
include('./meta/connect.php');
include('./meta/meta.php');
include ('./meta/navbar.php');
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="img/icon.jpeg" href="icon.ico" >
    <title>Decom | Cadastro Evento Interno</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" /> 
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="https://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>


    <!-- estilo dos formularios -->
    <link rel="stylesheet" href="./css/responsivo.css">
</head>

<body style="background-image: none;background-color: rgb(242, 247, 250);">


  <br>
  <br>
  <div class="m-auto" style="width:90% !important; max-width: 800px;margin-top: 30px">
  <h3 class="title has-text-grey text-center">Agendar Medico</h3>
  <?php 
    if(isset($_SESSION['status_cadastro'])):
  ?>
    <div class="alert alert-success">
        Cadastro efetuado!
    </div>
        <?php
            endif;
            unset($_SESSION['status_cadastro']);
        ?>
        </div>
        <br>
        <div class="box m-auto border rounded" style="width:90% !important; max-width: 800px;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;background-color: white;" >
          <form action="agenda_cadastrar.php" method="POST">

              <div class="form-row border-bottom" style="padding:50px" >
                <div  class="form-group col-md-6">
                  <label style="font-size:20px;font-weight: bold;" for="paciente">Paciente</label>
                  <input style="height:40px !important;font-size:20px;" type="text" class="form-control date" id="paciente" name="paciente" required>
                </div>
                <div class="form-group col-md-3">
                  <label style="font-size:20px;font-weight: bold;" for="celular">Celular</label>
                  <input style="height:40px !important;font-size:20px;"type="text" class="form-control celular"  id="celular" name="celular" required>
                </div>

                <div class="form-group col-md-3">
                  <label style="font-size:20px;font-weight: bold;" for="departamento">Departamento</label>
                  <select style="height:40px !important;font-size:20px;" class="form-control" name="departamento" class="input is-large" required>
                    <option disabled selected value>---Selecione o Departamento---</option>
                    <option value="SOCIAL">Social</option>
                    <option value="COMPETICAO">Competição</option>
                    <option value="ADMINISTRATIVO">Administrativo</option>
                    <option value="LAZER/MARKET">Lazer/Market</option>
                  </select>
                </div>
              </div>

              <div class="form-row" style="padding:50px" >
                <div  class="form-group col-md-6">
                  <label style="font-size:20px;font-weight: bold;" for="calendario">Data</label>
                  <input style="height:40px !important;font-size:20px;" class="form-control" type="text" id="calendario"  name="calendario"  readonly="true" required/>
                </div>
                <div class="form-group col-md-6">
                  <label style="font-size:20px;font-weight: bold;" for="horario">Horario</label>
                  <select style="height:40px !important;font-size:20px;" class="form-control" id="horario" name="horario" required>
                  <option value="null" disabled selected > ---- Escolha uma data ---- </option>
                  </select>
                </div>
              </div>

               <div class="form-row m-auto" style="padding:50px;width:50%" >
                <div  class="form-group col-md-6">
                  <a href="home.php"><button style="width:100px" type="button" class="btn btn-secondary">Voltar</button></a>
                </div>
                <div class="form-group col-md-6">
                  <button style="width:100px" type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
              </div>
          </form>
      </div>
          <br>
          <br>
          <br>

  <?php
    $select_retorno = "SELECT data,disponibilidade FROM hora_disponivel";
    $query = mysqli_query($conn, $select_retorno);
    $dias =  array();
     while($row = mysqli_fetch_assoc($query)){
      if ($row['disponibilidade'] == 0) {
            array_push($dias,$row['data']);
      }  
    }
    $dias = implode('-', $dias);

  ?>
  <script>
  $(function() {

    now = new Date();

    // aqui vai um array com as datas que não tem mais vagas
    let arr = '<?php echo $dias ?>';
    let dias =  arr.split('-');

      $( "#calendario" ).datepicker({
        inline: true,
        dateFormat: "dd/mm/yy",
        minDate: now,
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        beforeShowDay: function(dateText, inst) {

        var datepickerDay = ('0' + dateText.getDate()).slice(-2) + '/'
        + ('0' + (dateText.getMonth()+1)).slice(-2) + '/'
        + dateText.getFullYear();

        // se for final de semana ou tiver no array data desabilitar
      if(dias.indexOf(datepickerDay.trim()) > -1 || dateText.getDay() == 0 || dateText.getDay() == 6) {
          return [false,dias];
        }
        return [true, "disponivel"];
      },

      });


      // na hora de conferir se foi marcado ja mandar direto para pagina de impressão
      // fazer uma pagina só pro medico ver todos os agendamentos que ele possa filtrar por data e depois por hora

  });
      $("#calendario").on("change", function(){
        var calendario = $("#calendario").val();
        var data = {dia:calendario};
        var url = './ajax/ajax.hora_agenda.php';
        $.ajax({
          url,
          type: 'POST',
          data,
          success: function(data) {
                data = $.parseJSON(data);
            $("#horario").html(data.confirmar);
          }
        })
      });
   

  </script>
</body>

</html>