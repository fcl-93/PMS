<?php
require_once('common/database.php');
require_once('common/common.php');
session_start();
if(isset($_SESSION['cliente_id']))
{
    $queryClient = 'SELECT * FROM cliente WHERE idcliente = '.$_SESSION['cliente_id'];
    $getCli = mysqli_query($link, $queryClient);
    if(!$getCli)
    {
      echo 'Erro Query #1' .mysqli_error($link);
    }
    else
    { 
      $data = mysqli_fetch_array($getCli);
      $nome = $data['nome'];
      $sobrenome = $data['sobrenome'];
      $telefone = $data['telefone'];
      $mail = $data['email'];
    }
    mysqli_close($link);
}
else
{
  $nome = '';
  $sobrenome = '';
  $telefone = '';
  $mail = '';
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
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/carousel.css" rel="stylesheet">
    <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link rel='shortcut icon' type='image/x-icon' href='/images/favicon.png' />

  </head>
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
                <img alt="Brand" src="images\drawing2.png">
              </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li  class="active"><a href="#home" class="page-scroll" 	>Home    </a></li>
                <li><a href="#reserva" class="page-scroll" 	>Reservas</a></li>
                <li><a href="login.php"					>Login   </a></li>
                <li><a href="#sobre" class="page-scroll"	>Sobre   
                </a></li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
	<section id="home" class="home-section hidden-xs">
	    <div id="myCarousel" class="carousel slide" data-ride="carousel">
	      <!-- Indicators -->
	      <ol class="carousel-indicators">
	        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	        <li data-target="#myCarousel" data-slide-to="1"></li>
	      <!-- <li data-target="#myCarousel" data-slide-to="2"></li>-->
	      </ol>
	      <div class="carousel-inner" role="listbox">
	        <div class="item active">
	          <img class="first-slide" src="/images/slider/slider3.jpg" alt="First slide">
	          <div class="container">
	            <div class="carousel-caption">
	              <h1>Uma refeição de Sonho!</h1>
               <p>Marque já o seu almoço ou jantar no nosso brilhante restaurante e delicie-se com as nossas espcialidades!</p>
               <p><a class="btn btn-lg btn-primary page-scroll" href="#reserva" role="button">Reserve Já!</a></p>
	            </div>
	          </div>
	        </div>
	        <div class="item">
	          <img class="second-slide" src="/images/slider/slider1.jpg" alt="Second slide">
	          <div class="container">
	            <div class="carousel-caption">
	             <h1>Venha conhecer-nos!</h1>
               <p>Localizado na Universidade da Madeira, o Dom Petisco terá um enorme prazer em recebê-lo!</p>
               <p><a class="btn btn-lg btn-primary page-scroll" href="#sobre" role="button">Visite-nos!</a></p>
	            </div>
	          </div>
	        </div>
	      <!--  <div class="item">
	          <img class="third-slide" src="/images/slider/slider1.jpg" alt="Third slide">
	          <div class="container">
	            <div class="carousel-caption">
	              <h1>One more for good measure.</h1>
	              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
	              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
	            </div>
	          </div>
	        </div>
	      </div>-->
	      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
	      </a>
	      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
	      </a>
	    </div><!-- /.carousel -->
  	</section>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-6 ">
           <span class="circle glyphicon glyphicon-cutlery" aria-hidden="true"></span>
          <h2>A melhor comida!</h2>
          <p>Dirija-se ao Dom Petisco e aproveite para deliciar-se<br>com as nossas fantásticas iguarias!
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-6">
          <span class="circle glyphicon glyphicon-glass" aria-hidden="true"></span>
          <h2>A melhor bebida!</h2>
          <p>Para acompanhar a sua maravilhosa refeição<br>nada como as bebidas que temos para si!
        </div>
      </div><!-- /.row -->



      <!-- START THE FEATURETTES -->
  
  <section  id="reserva"class="reserva-section">  
  <hr  class="featurette-divider">
      <form id="form_reserva" onsubmit="return false">
       <!--<div class="row">
          <div class="col-md-4 form-group"> 
            <label for="contribuinte">Número de Contribuinte:</label> 
            <input type="number" class="form-control" name="contribuinte" id="contribuinte" placeholder="Número de Contribuinte">
          </div>
        </div>-->
        <div class="row">
          <div class="col-md-6 form-group"> 
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome?>" placeholder="Nome" >
          </div>
          <div class="col-md-6 form-group"> 
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" name="sobrenome" id="sobrenome" value="<?php echo $sobrenome ?>" placeholder="Sobrenome">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 form-group">           
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $mail ?>" placeholder="Email">
          </div>
          <div class="col-md-6 form-group telErroIcon">
            <label for="numerotel">Telefone:</label></label><br>
            <input type="text" class="form-control teste"  name="numerotel" id="numerotel" value="<?php echo $telefone ?>" placeholder="Número de telefone">
          </div>
        </div>
        <div class="row">
          <div class='col-sm-6'>
            <div class="form-group errorIcon">
				<label for="datetimepicker1">Data e Hora: </label>
	                <div class='input-group date' id='datetimepicker1' name="datetimepicker1">
	                    <input type='text' class="form-control" id="datahora" name="datahora" placeholder="Data e Hora" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
            </div>
        </div>
        <div class="col-md-3 form-group">
			<div class="form-group">
			 <label for="selMesa">Número de Mesa:</label>
			  <select class="form-control" id="selMesa"  name="selMesa">
			    <option></option>
          <option>1</option>
			    <option>2</option>
			    <option>3</option>
			    <option>4</option>
			  </select>
			</div>
          </div>
          <div class="col-md-3 form-group">
           	<div class="form-group selectNumPess">
           	 <label for="selNumPes">Número de Pessoas:</label>
  			  <select class="form-control" id="selNumPes" name="selNumPes">
    			  <option></option>
            <option>1</option>
 				   	<option>2</option>
 				   	<option>3</option>
    				<option>4</option>
    				<option>5</option>
    				<option>6</option>
    				<option>7</option>
    				<option>8</option>
    				<option>9</option>
  				</select>
			</div>
          </div>
          <p style="text-align:center;font-weight:bold;">Em caso de reservas superiores a 9 pessoas por favor, contacte-nos através de  291 525 372.</p>
        </div>
        <div class="row">
          <div id="status_text" />
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" id="btn_submit" name="submit" class="btn btn-default">Reservar</button> 
          </div>
        </div>
    </form>
   </section>
   <hr class="featurette-divider">
  <section id="sobre" class="sobre-section">
   <!--
        <div class="row featurette">-->
        <div class="col-lg-6 ">
            <h2>Encontre-nos aqui</h2>
           <div id="map-container" class="col-md-6"></div>
        </div>
        <div class="col-lg-6 text-center">
        <br>
        <br>
        <br>
        <h3>Horário de funcionamento</h3>
        <p>Aberto todos os dias.</p>
        <p>Desde as 12 horas até as 23 horas</p>
        <h3>Telefone</h3>
        <p> 291 525 372</p>
        <h3>Morada</h3>
        <p>Caminho da Penteada 9020-105 Funchal</p>

        </div>
      </div>
   </section>

      <!-- /END THE FEATURETTES -->
      <!-- FOOTER -->
      <footer class="container text-center footer">
         <p>&copy; 2015/2016 PMS GRUPO 2. &middot; </p>
      </footer>

    </div><!-- /.container -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="/js/holder.min.js"></script>
 
    <!-- Scrolling Nav JavaScript -->
    <script src="/js/jquery.easing.min.js"></script>
    <script src="/js/scrolling-nav.js"></script>
    <!--Traduz datapicker pra pt e data atual-->
    <script src="/js/moment.js"></script>
    <script type="text/javascript" src="/js/locale/pt.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
    
   
  <script type="text/javascript">
            var date = new Date();
            date.setMinutes(date.getMinutes() + 50);

            $(function () {
                $('#datetimepicker1').datetimepicker({
                  locale: 'pt',
                  format: 'YYYY-MM-DD HH:mm',
                  minDate:  date,
                  enabledHours: [12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
                  sideBySide:true}).on('changeDate', function(e) {
                  // Revalidate the date field
                 $('#dateRangeForm').formValidation('revalidateField', 'datahora');
        });
            });
        </script>

       
 <!-- jQuery Bootstrap Form Validator -->
 <link rel="stylesheet" href="/formvalidation/css/formValidation.css"/>
 <script type="text/javascript" src="/formvalidation/js/formValidation.js"></script>
 <script type="text/javascript" src="/formvalidation/js/framework/bootstrap.js"></script>
<!--Validação de input números de telefone plugin pro form validation-->
<link rel="stylesheet" href="/formvalidation/css/intlTelInput.css" />
<script src="/formvalidation/js/intlTelInput.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#form_reserva')
        .find('[name="numerotel"]')
            .intlTelInput({
                utilsScript: '/formvalidation/js/utils.js',
                autoPlaceholder: true,
                defaultCountry:"pt",
            });

     $('#form_reserva')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
              contribuinte: {
                row: '.row',
                validators: {
                    notEmpty: {
                        message: 'Deve introduzir o seu contribuinte.'
                    },
                    stringLength: {
                        min: 9,
                        max: 9,
                        message: 'O número de contribuinte deve conter exatamente 9 digitos'
                    },
                 } 
              },
               nome: {
                message: 'O nome não é válido',
                validators: {
                    notEmpty: {
                        message: 'Deve introduzir o seu nome.'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'O nome deve conter pelo menos 3 carateres e um máximo de 30 carateres.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'O nome só pode ter letras, numeros, pontos.'
                    }
                }
            },
            sobrenome: {
                row: '.col-md-6',
                    message: 'O sobrenome não é válido.',
                validators: {
                    notEmpty: {
                        message: 'Deve introduzir o seu sobrenome.'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'O sobrenome deve conter pelo menos 3 carateres e um máximo de 30 carateres.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9\.]+$/,
                        message: 'O sobrenome só pode ter letras, numeros, pontos.'
                    }
                }
            },
             email: {
                validators: {
                    notEmpty: {
                        message: 'Deve introduzir o seu endereço de email.'
                    },
                    emailAddress: {
                        message: 'O endereço de email introduzido não é válido.'
                    }
                }
            },
            selNumPes: {
                validators: {
                    notEmpty: {
                        message: 'Selecione o número de pessoas.'
                    }
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
        /*.on('click', '.country-list', function() {$('#form_reserva').formValidation('revalidateField', 'numerotel');});*/
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: "form_reserva.php",
                type: 'POST',
                data: $form.serialize(),
                 success: function(data,status, xhr)
    {
       
        $('#nome').val('');
        $('#sobrenome').val('');
        $('#email').val('');
        $('#numerotel').val('');
        //$('#datahora').val('');
        $('#selMesa').val('');
        $('#selNumPes').val('');
        //Reset ao form
        $('#form_reserva').data('formValidation').resetForm(); 
 		//if success then just output the text to the status div then clear the form inputs to prepare for new data
        $("#status_text").html(data);
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
    }
            }); 
            });
});

</script>
<!--Fim dos plugin de validação-->
  
  <!--Google Maps Plugin load-->
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script>  
          function init_map() {
          var var_location = new google.maps.LatLng(32.659110, -16.924339);
          var var_mapoptions = {
              center: var_location,
              zoom: 17
            };
          var var_marker = new google.maps.Marker({
          position: var_location,
                map: var_map,
          title:"Venice"});
     
          var var_map = new google.maps.Map(document.getElementById("map-container"),
                var_mapoptions);
     
          var_marker.setMap(var_map); 
          }
          google.maps.event.addDomListener(window, 'load', init_map);
    </script>


  </body>
</html>