<?php
require('../common/database.php');
require('../common/common.php');
session_start();
$erro = false;
if(isset($_SESSION['funcionario_id'])) 
{
  header("Location: funcmain.php");
}
if(isset($_POST['numerotel'],$_POST['inputPassword']))
{
  $numerotel = mysqli_real_escape_string($link, $_POST['numerotel']);
  $inputPassword = mysqli_real_escape_string($link, $_POST['inputPassword']);

  $numerotel = stripslashes($numerotel);
  $inputPassword = stripslashes($inputPassword);

  $numerotel = telefone($numerotel);

  $queryValidaLogin = "SELECT * FROM funcionario WHERE telefone LIKE '$numerotel' AND password LIKE '$inputPassword'";
  $result = mysqli_query($link, $queryValidaLogin);
  if($result)
  {
    if(mysqli_num_rows($result) == 1)
    { 
      $row = mysqli_fetch_assoc($result);
      $_SESSION['funcionario_id'] = $row['idfuncionario'];
      $_SESSION['funcionario_nome'] = $row['nome'];
      
    }
    else
    {
     $erro = true;
    }
  }
  else{
    echo "Erro na query".mysqli_error($link);
    die;
  }

  if(isset($_SESSION['funcionario_id'])) {
    header("Location: funcmain.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Restaurante</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>  
	<link rel="stylesheet" href="../formvalidation/css/formValidation.css"/>
	<link rel="stylesheet" href="../formvalidation/css/intlTelInput.css" />
    <!-- Custom styles for this template -->
    <link href="../css/login.css" rel="stylesheet">

</head>
  <body>

<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">
                <img alt="Brand" src="..\images\drawing2.png">
              </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="../index.php#home" class="page-scroll"     >Home    </a></li>
                <li class="active"><a href="index.php"                    >Login   </a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <div class="container ">
    <form id="form_login" action="index.php" method="POST">
   <?php if($erro == true)
    {
     	echo '<p align="center">	Os campos que introduziram estão incorretas. Certifique-se que colocou os campos corretos.</p>';
    }
    ?>

		<div class="row form-group">
          <div class="col-sm-3 col-sm-offset-4">
			<h2 class="form-signin-heading">Administração Funcionário</h2>
			</div>
		</div>

		<div class="row form-group telErroIcon">
          <div class="col-md-3 col-sm-offset-4 form-group ">
            <label for="numerotel"></label></label><br>
            <input type="text" class="form-control"  name="numerotel" id="numerotel" placeholder="Número telefone">
          </div>
        </div>

    	<div class="row form-group passwdError">
          <div class="col-sm-offset-4 col-sm-3 form-group"> 
            <label for="inputPassword"></label> 
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Palavra passe">
          </div>
        </div>


        <div class="row form-group">
          <div class="col-sm-offset-4 col-sm-3">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Iniciar Sessão</button> 
          </div>

        </div>

    </form>
    </div> <!-- /container -->
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>

    <!-- jQuery Bootstrap Form Validator
	<link rel="stylesheet" href="/formvalidation-master/vendor/bootstrap/css/bootstrap.css"/> -->

 	<script type="text/javascript" src="../formvalidation/js/formValidation.js"></script>
 <script type="text/javascript" src="../formvalidation/js/framework/bootstrap.js"></script>

    <!--Validação de input números de telefone plugin pro form validation-->
<script src="../formvalidation/js/intlTelInput.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#form_login')
        .find('[name="numerotel"]')
            .intlTelInput({
                utilsScript: '/formvalidation/js/utils.js',
                autoPlaceholder: true,
                defaultCountry:"pt"
            });

     $('#form_login')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
            	inputPassword: {
                    validators: {
                        notEmpty: {
                            message: 'Deve introduzir a sua password.'
                        },
                        blank: {}
                    }
                },
            numerotel: {
                validators: {
                        notEmpty: {
                          message: 'Deve introduzir o seu número de telefone.'
                        },
                        callback: {
                          message: 'O número de telefone introduzido não é válido.',
                          callback: function(value, validator, $field) {
                              return value === '' || $field.intlTelInput('isValidNumber');
                            }
                        }
                    }
                }
            }
        })
        .on('click', '.country-list', function() {$('#form_login').formValidation('revalidateField', 'numerotel');}); 
});
</script>
  </body>
</html>
