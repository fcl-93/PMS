<?php
require('../common/database.php');
require('../common/common.php');
session_start();
if(empty($_SESSION['funcionario_id']))
{
    header("Location: login.php");
}
if(isset($_POST['cancelar'])) {
    $queryCancelar = sprintf("
        DELETE FROM reserva WHERE idreserva='%s'
    ", mysqli_real_escape_string($link, $_POST['cancelar']));
    echo $queryCancelar;
    mysqli_query($link, $queryCancelar);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administração</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel='shortcut icon' type='image/x-icon' href='../images/favicon.png' />

    </head>

    <body>

    <!--<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="..\images\drawing2.png">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <p class="navbar-text" >Bem-Vindo(a),  <?php echo $_SESSION['funcionario_nome']; ?>!</p>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="funcaddreserva.php"><span class="glyphicon glyphicon-plus"></span> Adicionar Reserva</a>
                </li>
            <li>
                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Terminar Sessão</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<div class="corpo">
    <?php	

    if(empty($_POST['data']))
    {
        $querydata="SELECT CURDATE()";
    
        $result_data= mysqli_query($link, $querydata);
        $data=mysqli_fetch_array($result_data)[0];
    }
    else
    {
        $data = $_POST['data'];
    }
   
    $query_reservas = "SELECT * FROM reserva WHERE data = '".$data."'";
    $result_reservas = mysqli_query($link, $query_reservas);
    if(!$result_reservas)
    {
        echo mysqli_error($link);
    }

    if (mysqli_num_rows($result_reservas) == 0)
    {
      echo "Não tem reservas para o dia pretendido";

  }
  else
  {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><i class="fa"></i> Reservas Efetuadas</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-6 col-md-offset-3">
            <form class="form-inline" method="POST">
                    <div class="form-group">
                        <label for="datetimepicker1">Data: </label>
                    </div>
                    <div class='form-group input-group date' id='datetimepicker1' name="datetimepicker1">
                        <input type='text' class="form-control" id="data" name="data" placeholder="Data" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                
                
                    <button type="submit" id="btn_submit" name="ver_reservas" value="ver_reservas" class="btn btn-info btn2">Verificar reservas</button>
                
            </form>
        </div>
            <br>
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-hover table-striped">
                   <thead>
                      <tr class="info">
                          <th>Número da Reserva</th>
                          <th>Cliente</th>
                          <th>Data da Reserva</th>
                          <th>Hora da Reserva</th>
                          <th>Número de Pessoas</th>
                          <th>Mesa</th>
                          <th>Alterar</th>
                          <th>Cancelar</th>
                      </tr>
                  </thead>

                  <tbody>
                    <?php
                    $intervaloTempo = gmdate("H:i:s", time() -60);
                    if(gmdate("Y-m-d",time())==$data)
                    {
                        $query_listareserva = "SELECT * FROM cliente, reserva, reserva_has_mesa, mesa WHERE reserva.cliente_idcliente=cliente.idcliente and reserva_has_mesa.reserva_idreserva=reserva.idreserva  and reserva_has_mesa.mesa_numero=mesa.numero and reserva.ativo='1' and reserva.data=\"".$data."\" and reserva.hora>=\"".$intervaloTempo."\"";

                    }
                    else
                    {
                        $query_listareserva = "SELECT * FROM cliente, reserva, reserva_has_mesa, mesa WHERE reserva.cliente_idcliente=cliente.idcliente and reserva_has_mesa.reserva_idreserva=reserva.idreserva  and reserva_has_mesa.mesa_numero=mesa.numero and reserva.ativo='1' and reserva.data=\"".$data."\"";
                    }
                    
                    $result_listareserva = mysqli_query($link, $query_listareserva);
                    if(!$result_listareserva)
                    {
                        echo mysqli_error($link);
                    }


                    while($array_listareserva = mysqli_fetch_array($result_listareserva))
                    {
                        ?>								<tr>
                        <td> <?php echo $array_listareserva["idreserva"] ?></td>
                        <td> <?php echo $array_listareserva["nome"] ?> </td>
                        <td> <?php echo $array_listareserva["data"] ?></td>
                        <td> <?php echo $array_listareserva["hora"] ?></td>
                        <td> <?php echo $array_listareserva["num_pessoas"] ?></td>
                        <td> <?php echo $array_listareserva["numero"] ?></td>
                        <td>
                            <form id='alterar_reserva' action='funcalterareserva.php' method='POST'>
                                <input type='hidden' name='idReserva' value=<?php echo "'" . $array_listareserva['idreserva'] . "'"; ?> />
                                <input type='hidden' name='idCliente' value=<?php echo "'" . $array_listareserva['cliente_idcliente'] . "'"; ?> />
                                <input type='hidden' name='data' value=<?php echo "'" . $array_listareserva['data'] . "'"; ?> />
                                <input type='hidden' name='numPessoas' value=<?php echo "'" . $array_listareserva['capacidade'] . "'"; ?> />
                                <input type='hidden' name='numMesa' value=<?php echo "'" . $array_listareserva['numero'] . "'"; ?> />
                                <input type='hidden' name='hora' value=<?php echo "'" . $array_listareserva['hora'] . "'"; ?> />
                                <input type="submit" name="alterar"value='alterar' />
                            </form>
                        </td>
                        <td>
                            <form id='cancelar_reserva' method='POST'>
                                <input type='hidden' name='cancelar' value=<?php echo "'" . $array_listareserva['idreserva'] . "'"; ?> />
                                <input type="submit" onclick="return confirm('Tem a certeza que deseja cancelar esta reserva ?');" value='Cancelar' />
                            </form>
                        </td>
                    </tr>
                    <?php							
                }
                ?>
            </tbody>
        </table>
    </div>

</div>



<?php            
}

?>			



</div>
<!-- /.row -->

<!-- /.container-fluid -->

<!-- /#page-wrapper -->

    <!--</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
     <!--Traduz datapicker pra pt e data atual-->
    <script src="/js/moment.js"></script>
    <script type="text/javascript" src="/js/locale/pt.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
      var date = new Date();

      $(function () {
        $('#datetimepicker1').datetimepicker({
          locale: 'pt',
          format: 'YYYY-MM-DD',
          minDate:  date,
        }).on('changeDate', function(e) {
                  // Revalidate the date field
                  $('#dateRangeForm').formValidation('revalidateField', 'data');
                });
        });
    </script>


</body>

</html>

