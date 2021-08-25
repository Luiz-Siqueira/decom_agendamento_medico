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
	<title>Decom | Vizualizar Eventos</title>
  <link rel="shortcut icon" href="img/icon.jpeg" href="icon.ico" >
	<!-- <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script> -->
    <script src="https://kit.fontawesome.com/18cca282cb.js" crossorigin="anonymous"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" /> 
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="https://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

	<script>
        function CriaRequest() {
            try{
                request = new XMLHttpRequest();        
            }
            catch (IEAtual) {
                try{
                    request = new ActiveXObject("Msxml2.XMLHTTP");       
                }
                catch(IEAntigo){
                    try{
                        request = new ActiveXObject("Microsoft.XMLHTTP");          
                    }
                    catch(falha){
                    request = false;
                    }
                }
            }
			if (!request) 
                alert("Seu Navegador não suporta Ajax!");
            else
                return request;
        }
    </script>
</head>
<body style="background-image: none; background-color: rgb(242, 247, 250);">           
<div class="container-fluid" style="text-align: center;" >
    <div class="row">
        <div  class="form-row m-auto">
            <div  class="form-group col-md-12">
                <label style="font-size:20px;font-weight: bold;" for="calendario">Data</label>
                <input style="height:40px !important;font-size:20px;" class="form-control" type="text" id="calendario"  name="calendario"  readonly="true" required placeholder="dia/mês/ano" />
            </div>
        </div> 
    </div> 

    <br>
    <div class="row">
        <div  class="form-row m-auto">
            <div  class="form-group col-md-12">
                <label style="font-size:20px;font-weight: bold;" for="horario">Horario</label>
                <select style="height:40px !important;font-size:20px;" class="form-control" id="horario" name="horario" required readonly="true">
                    <option value="null" disabled selected > ---- Escolha uma data ---- </option>
                    <option value="hora8">08:00</option>
                    <option value="hora9">09:00</option>
                    <option value="hora10">10:00</option>
                    <option value="hora11">11:00</option>
                </select>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div  class="form-row m-auto">
            <div class="form-group col-md-12">
                <button type="button" id="confirmar1" class="btn btn-dark">Buscar</button>
                <button type="button" id="confirmar2" class="btn btn-dark">Buscar todos</button>
            </div>
        </div>
    </div> 

    <hr style="border-width: 0.2em; border-color: #808080">

<div class="table-responsive">
    <table class="table-site">
        <tr>
            <th>Data</th>
            <th>Paciente</th>
            <th>celular</th>
            <th>Departamento</th>
            <th>Horario</th>
        </tr>
        <tbody id="respostaTabela" style="overflow: auto !important;" >
        </tbody>
    </table>
</div>
<script type="text/javascript">

    //quando clicar no botao confirmar1 chama ajax com as informações do filtro
    $(document).on('click', "#confirmar1", function () {
      let dia = $("#calendario").val();
      let horario = $("#horario").val();
      let data = {dia:dia, horario:horario};
      let url = './ajax/ajax.tabela_medico.php';
      $.ajax({
          url,
          type: 'POST',
          data,
          success: function(data) {
                // data = $.parseJSON(data);
            $("#respostaTabela").html(data);
          }
      });
    });

    //Quando clicar no botao confirmar2 chama todos os itens do BD
    $(document).on('click', "#confirmar2", function () {
        let url = './ajax/ajax.tabela_medico_all.php';
        $.ajax({
          url,
          type: 'POST',
          success: function(data) {
                // data = $.parseJSON(data);
            $("#respostaTabela").html(data);
          }
      });
    });

  $(function() {

    now = new Date();

      $( "#calendario" ).datepicker({
        inline: true,
        dateFormat: "dd/mm/yy",
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
  
        return [true, "disponivel"];
        },

      });



  });

</script>

</body>
</html>