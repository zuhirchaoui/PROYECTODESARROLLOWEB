<?php
session_start();
//Captcha
$first_num = rand(1, 10);
$second_num = rand(1, 10);

$operators = array("+", "-", "*");
$operator = rand(0, count($operators) -1);
$operator = $operators[$operator];

$answer = 0;
switch ($operator) {
  case '+':
    $answer = $first_num + $second_num;
    break;
  
  case "-":
    $answer = $first_num - $second_num;
    break;

  case '*':
    $answer = $first_num * $second_num;
    break;
}

$_SESSION["answer"] = $answer;
//Captcha
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ZapStreet</title>
	  <link rel="shortcut icon" href="assets/img/newlogo.png" type="image/x-icon" />

    <script src="load_captcha.js"></script>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />    
 
</head>
<body>
   
 <div class="navbar navbar-inverse navbar-fixed-top" id="menu">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img class="logo-custom"   src="assets/img/newlogo.png" alt=""  /></a>
            </div>
            <div class="navbar-collapse collapse move-me">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a href="index.php">Inicio</a></li>
                    <li><a href="productos.php?id=1">Productos</a></li>
					          <li><a href="#course-sec">Contact</a></li>
                    <li><a class="btn dropdown-toggle" data-toggle="dropdown">Entrar</a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal"data-target="#ln">Iniciar Sesión</a><p></p>
                          <a class="dropdown-item" href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">Registrarse</a><p></p>
                          <a class="dropdown-item" href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">Panel Admin</a></div></li>
                     
                </ul>
            </div>
           
        </div>
    </div>
    <br>
    <br>
    <br>

    <div id="my-carousel" class="carousel slide hero-slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#my-carousel" data-slide-to="1"></li>
        <li data-target="#my-carousel" data-slide-to="2"></li>
    <li data-target="#my-carousel" data-slide-to="3"></li>
        <li data-target="#my-carousel" data-slide-to="4"></li>
    <li data-target="#my-carousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">

            <img src="assets/img/1-slide.jpg" alt="Hero Slide">

            <div class="carousel-caption">
                <h1 style="font-family:Century Gothic"><b></b></h1>

                <h2></h2>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/2-slide.jpg" alt="...">

            <div class="carousel-caption">

            </div>
        </div>
        <div class="item">
            <img src="assets/img/3-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

    <div class="item">
            <img src="assets/img/4-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

    <div class="item">
            <img src="assets/img/5-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

    <div class="item">
            <img src="assets/img/6-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#my-carousel" role="button" data-slide="prev">

      <span class="icon-prev"></span>

    </a>
    <a class="right carousel-control" href="#my-carousel" role="button" data-slide="next">

       <span class="icon-next"></span>
    </a>

<!-- #my-carousel-->

      </div>
     
       
       <!--HOME SECTION END-->   
    
    <!--HOME SECTION TAG LINE END-->   
         
   
		
			 <br />
    <!-- FACULTY SECTION END-->
      <div id="course-sec" class="container set-pad">
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">Contacto</h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s">Si tiene alguna pregunta, no dude en contactarnos, nuestro centro de servicio al cliente está trabajando para usted 24/7.

					  <br />Para más detalles. Consulte la información de contacto a continuación.
                         </p>
                 </div>

             </div>
             <!--/.HEADER LINE END-->

<br />
           
             <div class="container">
             <div class="row set-row-pad">
                 <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1" data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Contáctanos </strong></h2>
        <hr />
                    <div >
                        <h4><strong>TLF:</strong>  +34 666 666 666 </h4>
                        <h4><strong>E-mail: </strong>zapstreet@contact.es</h4>
                    </div>
                    </div>


                </div>
                 </div>
                 
                 
               </div>
             </div>
      <!-- COURSES SECTION END-->
     <div class="modal fade" id="su" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Formulario de Registro</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="register.php">
                   <fieldset>
					
							<div class="form-group">
                                <input class="form-control" placeholder="Nombre" name="ruser_firstname" id="ruser_firstname" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Apellidos" name="ruser_lastname" id="ruser_lastname" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Dirección" name="ruser_address" id="ruser_address" type="text" required>
							</div>
							
                            <div class="form-group">
                                <input class="form-control" id="ruser_email" placeholder="Email" name="ruser_email" type="email" required>
							</div>
              <div id="erroremail"></div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="ruser_password" id="ruser_password" type="password" required>
							</div>
              <div class="form-group">
                <?php echo $first_num . " " . $operator . " " .$second_num . " = "; ?>
                <input class="form-control" type="number" name="answer" id="answer" placeholder="CAPTCHA" required>

               
            </div>
					       </fieldset>
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-md btn-warning btn-block" name="register">Registrarse</button>
				
				 <button  type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Cancelar</button>
				   </form>
           
              </div>
            </div>
          </div>
        </div>
<!-- Script -->


     <div class="modal fade" id="ln" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:white" class="modal-title" id="myModalLabel">Area Cliente</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="userlogin.php">
                   <fieldset>
					
						
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="user_email" type="email" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="user_password" type="password" required>
							</div>
              <div> <p>Si no estás registrado, puede  <a class="btn btn-md btn-warning" data-toggle="modal" data-dismiss="modal"  data-target="#su">Registrarse</a></p></div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-md btn-warning btn-block" name="user_login">Entrar</button>
				
				 <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Cancelar</button>
				   </form>
				   
              </div>
            </div>
          </div>
        </div>
		
		<div class="modal fade" id="an" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
           <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:white" class="modal-title" id="myModalLabel">Panel Administrador</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="adminlogin.php">
                   <fieldset>
					
						
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario Admin" name="admin_username" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="admin_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-md btn-warning btn-block" name="admin_login">Entrar</button>
				
				 <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Cancelar</button>
				   </form>
              </div>
            </div>
          </div>
        </div>
		 <br />
			 <br />
			 <br />
<!-- Script -->
     <!-- CONTACT SECTION END-->
    <div id="footer">
         ZapStreet - 2020 PROYECTO DESARROLLO WEB|  <a style="color: #fff" target="_blank">Zuhir Chaoui Mohamed</a> <br>
          <a href="rss.xml" target="_blank"><img style="width:2%;"src="https://icons.getbootstrap.com/icons/rss.svg"></a>
          <a href="sitemap.xml" target="_blank"><img style="width:2%;">SITEMAP</a>

    </div>
     <!-- FOOTER SECTION END-->
   
    <!--  Jquery Core Script -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="assets/js/bootstrap.js"></script>
    <!--  Flexslider Scripts --> 
         <script src="assets/js/jquery.flexslider.js"></script>
     <!--  Scrolling Reveal Script -->
    <script src="assets/js/scrollReveal.js"></script>
    <!--  Scroll Scripts --> 
    <script src="assets/js/jquery.easing.min.js"></script>
    <!--  Custom Scripts --> 
         <script src="assets/js/custom.js"></script>

</body>
</html>
