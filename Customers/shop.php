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
 //Extracción de datos de la sesion
 extract($_SESSION); 
 //Select de la tabla users
		  $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
		?>
		<?php
		//Conexión con la bd
 include("config.php");
 //Sumatorio y recogida de datos
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
		
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
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.css?v=2.1.5" media="screen" />
	
	<link rel="stylesheet" type="text/css" href="jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="jquery.fancybox-buttons.js?v=1.0.5"></script>


	<link rel="stylesheet" type="text/css" href="jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="jquery.fancybox-thumbs.js?v=1.0.7"></script>


	<script type="text/javascript" src="jquery.fancybox-media.js?v=1.0.6"></script>
	
	<script charset="utf-8" type="text/javascript" src="js/todojs.js"></script>
	

   
    
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
                        //Sumatorio y recogida dados
          $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Pending'");
        $stmt_edit->execute(array(':user_id'=>$user_id));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row); echo $totalx; ?> </b></a>
                       
                    </li>
					
					
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#setAccount"><i class="fa fa-gear"></i> Ajustes</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
  </ol>
</nav>

      
				<div id="page-wrapper">

			 
			<div class="alert alert-default" style="color:white;background-color:#008CBA">
         <center><h3> <span class="glyphicon glyphicon-shopping-cart"></span> Estas son nuestras existencias de zapatillas, ¡Compra ahora!</h3></center>
        </div>
			
					<br />
					

<?php

//Conexión con la bd

 $con=new mysqli("localhost","root","","tienda");
   $start=0;
   $limit=8;
   //Condición If
   if(isset($_GET['id']))
   {
    $id=$_GET['id'];

     $start=($id-1)*$limit;

    }
     $query=mysqli_query($con,"select * from items LIMIT $start, $limit");
     //Bucle while
       while($query2=mysqli_fetch_array($query)) 

    {
	
	echo "<div class='col-sm-4'><div class='panel panel-default' style='border-color:#008CBA;'>
            <div class='panel-heading' style='color:white;background-color : #033c73;'>
            <center> 
<textarea style='text-align:center;background-color: white;' class='form-control' rows='1' disabled>".$query2['item_name']."</textarea>
			</center>
            </div>
            <div class='panel-body'>
           
					
					<img src='../Admin/item_images/".$query2['item_image']."' class='img img-thumbnail'  style='width:250px;height:100px;' />
					</a>
					
					
					<center><h4> Precio: &#8364; ".$query2['item_price']." </h4></center>
		
					
										<a class='btn btn-block btn-danger' href='add_to_cart.php?cart=".$query2['item_id']."'><span class='glyphicon glyphicon-shopping-cart'></span> Añadir al Carrito</a>
										<a class='btn btn-block btn-info' href='more_item.php?opi=".$query2['item_id']."' > Ver más</a>
            </div>
          </div>
        </div>";
			
	
}

echo "<div class='container'>";
echo "</div>";




$rows=mysqli_num_rows(mysqli_query($con, "select * from items"));
$total=ceil($rows/$limit);
echo "<br /><ul class='pager'>";
//Condición If
if($id>1)
{
	echo "<li><a style='color:white;background-color : #033c73;' href='?id=".($id-1)."'>Página Anterior</a><li>";
}
//Condición If
if($id!=$total)
{
	echo "<li><a style='color:white;background-color : #033c73;' href='?id=".($id+1)."' class='pager'>Siguiente Pagina</a></li>";
}
echo "</ul>";


echo "<center><ul class='pagination pagination-lg'>";
		for($i=1;$i<=$total;$i++)
		{ //Condición If
			if($i==$id) { echo "<li class='pagination active'><a style='color:white;background-color : #033c73;'>".$i."</a></li>"; }
			
	
			
			else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
echo "</ul></center>";
?>
					
					
					
					
					
					
					
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
               
                <button class="btn btn-block btn-success btn-md" name="user_save">Guardar</button>
				
				 <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">Cancelar</button>
				
				
				   </form>
              </div>
            </div>
          </div>
        </div>
	  	  <script charset="utf-8" type="text/javascript" src="js/todojs.js"></script>
</body>
</html>