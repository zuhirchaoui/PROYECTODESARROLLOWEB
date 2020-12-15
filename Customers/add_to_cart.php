<?php
session_start();
//Condición If
if(!$_SESSION['user_email'])
{
  
    header("Location: ../index.php");
}

?>

<?php
//Conexión con la bd
 include("config.php");
 extract($_SESSION); 
 //Select de la bd
		  $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>
		<?php
		//CDonexión con la bd
 include("config.php");
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'"); //SUMATORIO Y RECOGIDA DE DATOS
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>
		
		
		<?php

	error_reporting( ~E_NOTICE );
	//Conexión con la bd
	require_once 'config.php';
	//Condición if
	if(isset($_GET['cart']) && !empty($_GET['cart']))
	{
		$id = $_GET['cart'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM items WHERE item_id =:item_id'); //Select de la bd
		$stmt_edit->execute(array(':item_id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: shop.php");
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
                    <li><a href="index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Inicio</a></li>
					<li class="active"><a href="shop.php?id=1"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span>Productos</a></li>
					<li><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Carrito</a></li>
					<li><a href="orders.php"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span> Mis Pedidos</a></li>
					<li><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Pedidos Anteriores</a></li>
					<li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Ajustes de Cuenta</a></li>
					<li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span> Cerrar Sesión</a></li>


                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            setlocale(LC_TIME, "Spanish");
                            echo strftime("%d de %B de %Y"); ?></a>

                    </li>
					<li class="dropdown user-dropdown">
                        <a href="cart_items.php" class="dropdown-toggle"><span class='glyphicon glyphicon-shopping-cart'></span> Total Carrito: &#8364; <?php

                       //Conexión con la bd
                        include("config.php");
					        $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Pending'"); //Sumatorio y recogida de datos
					        $stmt_edit->execute(array(':user_id'=>$user_id));
					        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
					        extract($edit_row); echo $totalx; ?> </b></a>

                    </li>


                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#setAccount"><i class="fa fa-gear"></i>Ajustes</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item"><a href="shop.php?id=1">Productos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Añadir al Carrito</li>
  </ol>
</nav>

        <div id="page-wrapper">
            
	
			
					
					
					
					
 <form role="form" method="post" action="save_order.php">
	
    
    <?php
	if(isset($errMSG)){
		?>
       
        <?php
	}
	?>
   
    <div class="alert alert-default" style="color:white;background-color:#008CBA">
         <center><h3> <span class="glyphicon glyphicon-info-sign"></span> Añadir al Carrito</h3></center>
        </div>
		
		 <td><input class="form-control" type="hidden" name="order_name" value="<?php echo $item_name; ?>" /></td>
		<td><input class="form-control" type="hidden" name="order_price" value="<?php echo $item_price; ?>" /></td>
		<td><input class="form-control" type="hidden" name="user_id" value="<?php echo $user_id; ?>" /></td>
		
	<table class="table table-bordered table-responsive">
	 
	
	 
    <tr>
    	<td><label class="control-label">Nombre del Producto</label></td>
        <td><input class="form-control" type="text" name="v1" value="<?php echo $item_name; ?>" disabled/></td>
		
		
		
		
    </tr>
    

	 <tr>
    	<td><label class="control-label">Precio</label></td>
        <td><input class="form-control" type="text" name="v2" value="<?php echo $item_price; ?>" disabled/></td>
    </tr>
	
	
	
    <tr>
    	<td><label class="control-label">Imagen</label></td>
        <td>
        	<p><img class="img img-thumbnail" src="../Admin/item_images/<?php echo $item_image; ?>" style="height:250px;width:350px;" /></p>
        	
        </td>
		
		 <tr>
    	<td><label class="control-label">Cantidad</label></td>
        <td><input class="form-control" type="text" placeholder="Cantidad" name="order_quantity" value="1" onkeypress="return isNumber(event)" onpaste="return false" maxlength="2" required />
		
			
		
		</td>
    </tr>
	
	
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="order_save" class="btn btn-primary">
        <span class="glyphicon glyphicon-shopping-cart"></span> OK
        </button>
        
        <a class="btn btn-danger" href="shop.php?id=1"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr>
    
    </table>
    
</form>
					
					
					
					
					
					<br />
			
			<div class="alert alert-default" style="background-color:#033c73;"><a style="color: #fff" target="_blank">
                       ZapStreet - 2020 PROYECTO DESARROLLO WEB | Zuhir Chaoui Mohamed</a>
                       <br>
          <a href="../rss.xml" target="_blank"><img style="width:2%;"src="https://icons.getbootstrap.com/icons/rss.svg"></a>
          <a href="../sitemap.xml" target="_blank"><img style="width:2%;">SITEMAP</a>

                    </div>
            </div>

           

           
        </div>
		
		
		
    </div>
    <!-- /#wrapper -->

	
	<!-- Mediul Modal -->
        <div class="modal fade" id="setAccount" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 style="color:white" class="modal-title" id="myModalLabel">Ajustes de Cuenta</h2>
              </div>
              <div class="modal-body">
         
				
			
				
				 <form enctype="multipart/form-data" method="post" action="settings.php">
                   <fieldset>
					
						
                            <p>Nombre:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Nombre" name="user_firstname" type="text" value="<?php  echo $user_firstname; ?>" required>
                           
							 
							</div>
							
							
							<p>Apellidos:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Apellidos" name="user_lastname" type="text" value="<?php  echo $user_lastname; ?>" required>
                           
							 
							</div>
							
							<p>Dirección:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Dirección" name="user_address" type="text" value="<?php  echo $user_address; ?>" required>
                           
							 
							</div>
							
							<p>Contraseña:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Contraseña" name="user_password" type="password" value="<?php  echo $user_password; ?>" required>
                           
							 
							</div>
							
							<div class="form-group">
							
                                <input class="form-control hide" name="user_id" type="text" value="<?php  echo $user_id; ?>" required>
                           
							 
							</div>
							
							
							
							
				
							
				   
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-block btn-success btn-md" name="user_save">Guardar Cambios</button>
				
				 <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">Cancelar</button>
				
				
				   </form>
              </div>
            </div>
          </div>
        </div>
	
	
</body>
<script charset="utf-8" type="text/javascript" src="js/todojs.js"></script>
</html>
