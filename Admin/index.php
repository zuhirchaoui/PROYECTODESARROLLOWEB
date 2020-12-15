<?php
session_start();
//Condición If
if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="es" xml:lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZapStreet</title>
	 <link rel="shortcut icon" href="../assets/img/newlogo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />


    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>



</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="index.php"><img style="max-height: 35px" src="../assets/img/newlogo.png" alt=""  /></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="index.php"> &nbsp; &nbsp; &nbsp; Inicio</a></li>
                    <li><a data-toggle="modal" data-target="#uploadModal"> &nbsp; &nbsp; &nbsp; Subir Productos</a></li>
                    <li><a href="items.php"> &nbsp; &nbsp; &nbsp; Gestión de Productos</a></li>
                    <li><a href="customers.php"> &nbsp; &nbsp; &nbsp; Gestión de Clientes</a></li>
                    <li><a href="orderdetails.php"> &nbsp; &nbsp; &nbsp; Detalles de Pedidos</a></li>
                    <li><a href="logout.php"> &nbsp; &nbsp; &nbsp; Cerrar Sesión</a></li>
                    
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            setlocale(LC_TIME, "Spanish");
                            echo strftime("%d de %B de %Y"); ?></a>
                        
                    </li>
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php   extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
  </ol>
</nav>
        

        <div id="page-wrapper">






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

            <img src="../assets/img/1-slide.jpg" alt="Hero Slide">

            <div class="carousel-caption">
                <h1 style="font-family:Century Gothic"><b></b></h1>

                <h2></h2>
            </div>
        </div>
        <div class="item">
            <img src="../assets/img/2-slide.jpg" alt="...">

            <div class="carousel-caption">

            </div>
        </div>
        <div class="item">
            <img src="../assets/img/3-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

		<div class="item">
            <img src="../assets/img/4-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

		<div class="item">
            <img src="../assets/img/5-slide.jpg" alt="...">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

		<div class="item">
            <img src="../assets/img/6-slide.jpg" alt="...">

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


		<br />
			 <div class="alert alert-success">

                        Bienvenido <span style="background-color:#fff;" ><?php  echo $admin_username; ?></span> al Panel de Administración
                    </div>
					<br />

			<div class="alert alert-default" style="background-color:#033c73;"><a style="color: #fff" target="_blank">
                       ZapStreet - 2020 PROYECTO DESARROLLO WEB | Zuhir Chaoui Mohamed</a>

                    </div>

                    </div>

                </div>
            </div>




        </div>



    </div>
    <!-- /#wrapper -->


	<!-- Mediul Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 style="color:white" class="modal-title" id="myModalLabel">Subir Productos</h2>
              </div>
              <div class="modal-body">
         
                
            
                
                 <form enctype="multipart/form-data" method="post" action="additems.php">
                   <fieldset>
                    
                        
                            <p>Nombre del Producto:</p>
                            <div class="form-group">
                            
                                <input class="form-control" placeholder="Nombre del Producto" name="item_name" type="text" required>
                           
                             
                            </div>

                            <p>Descripción del Producto:</p>
                            <div class="form-group">
                            
                                <input class="form-control" placeholder="Describe el producto" name="item_description" type="text" required>
                           
                             
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            <p>Precio:</p>
                            <div class="form-group">
                            
                                <input id="priceinput" class="form-control" placeholder="Precio" name="item_price" type="text" required>
                           
                             
                            </div>
                            
                            
                            <p>Elegir Imagen:</p>
                            <div class="form-group">
                        
                             
                                <input class="form-control"  type="file" name="item_image" accept="image/*" required/>
                                    
                            </div>
                   
                     </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-success btn-md" name="item_save">Guardar</button>
                
                 <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancelar</button>


				   </form>
              </div>
            </div>
          </div>
        </div>
	  	<script charset="utf-8" type="text/javascript" src="js/todojs.js"></script>
</body>
</html>
