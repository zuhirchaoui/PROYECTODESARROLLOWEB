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
 //select de la bd
		  $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		?>

		<?php
    //Conexión de la bd
 include("config.php");
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'"); //Sumatorio y recogida de datos
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		?>

		<?php
    //Conexión con la bd
	require_once 'config.php';
    //Condición If
	if(isset($_GET['delete_id']))
	{



        //Borra datos de la tabla orderdetails
		$stmt_delete = $DB_con->prepare('DELETE FROM orderdetails WHERE order_id =:order_id');
		$stmt_delete->bindParam(':order_id',$_GET['delete_id']);
		$stmt_delete->execute();

		header("Location: cart_items.php");
	}

?>
<?php
  //Conexión con la bd
	require_once 'config.php';
 //Condición If
	if(isset($_GET['update_id']))
	{



      //Actualiza los datos de la tabla orderdetails
		$stmt_delete = $DB_con->prepare('update orderdetails set order_status="Ordered" WHERE order_status="Pending" and user_id =:user_id');
		$stmt_delete->bindParam(':user_id',$_GET['update_id']);
		$stmt_delete->execute();
		echo "<script>alert('Item/s successfully ordered!')</script>";

		header("Location: orders.php");
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
                    <li ><a href="index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Inicio</a></li>
                    <li><a href="shop.php?id=1"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span>Productos</a></li>
                    <li class="active"><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Carrito</a></li>
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
                        //Sumatorio y recogida de datos
          $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Pending'");
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
    <li class="breadcrumb-item active" aria-current="page">Carrito</li>
  </ol>
</nav>

        <div id="page-wrapper">


			<div class="alert alert-default" style="color:white;background-color:#008CBA">
         <center><h3> <span class="fa fa-cart-plus"></span> Listado Carrito</h3></center>
        </div>

			<br />

						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Precio</th>
				  <th>Cantidad</th>
				  <th>Total</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              <tbody>
			  <?php
        //Conexión con la bd
include("config.php");
//Select de la bd 
	$stmt = $DB_con->prepare("SELECT * FROM orderdetails where order_status='Pending' and user_id='$user_id'");
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);


			?>
                <tr>

                 <td><?php echo $order_name; ?></td>
				 <td>&#8364; <?php echo $order_price; ?> </td>
				 <td><?php echo $order_quantity; ?></td>
				 <td>&#8364; <?php echo $order_total; ?> </td>

				 <td>





                  <a class="btn btn-block btn-danger" href="?delete_id=<?php echo $row['order_id']; ?>" title="click for delete" ><span class='glyphicon glyphicon-trash'></span> Borrar Producto</a>

                  </td>
                </tr>


              <?php
		} //Conexión con la bd
		 include("config.php");
     //Sumatorio y recogida de datos
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Pending'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		echo "<tr>";
		echo "<td colspan='3' align='right'>Precio Total:";
		echo "</td>";

		echo "<td>&#8364; ".$totalx;
		echo "</td>";

		echo "<td>";
		echo "<a class='btn btn-block btn-success' href='?update_id=".$user_id."' ><span class='glyphicon glyphicon-shopping-cart'></span> Pedir Ahora</a>";
		echo "</td>";

		echo "</tr>";
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#033c73;"><a style="color: #fff" target="_blank">
                       ZapStreet - 2020 PROYECTO DESARROLLO WEB | Zuhir Chaoui Mohamed</a>
                       <br>
          <a href="../rss.xml" target="_blank"><img style="width:2%;"src="https://icons.getbootstrap.com/icons/rss.svg"></a>
          <a href="../sitemap.xml" target="_blank"><img style="width:2%;">SITEMAP</a>

                    </div>
	</div>';

		echo "</div>";
	}
	else
	{
		?>


        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No se encontró ningún artículo ...
            </div>
        </div>
        <?php
	}

?>








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
	  	  <script charset="utf-8" type="text/javascript" src="js/todojs.js"></script>
</body>
</html>
