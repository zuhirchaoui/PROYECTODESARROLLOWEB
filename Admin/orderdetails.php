<?php
session_start();
//Condición If
if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>

<?php
  //Conexión con la bd
	require_once 'config.php';
	//Condición If
	if(isset($_GET['delete_id']))
	{
		
	//Conecta y elimina parámetros de la bd
		$stmt_delete = $DB_con->prepare('DELETE FROM orderdetails WHERE order_id =:order_id');
		$stmt_delete->bindParam(':order_id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: orderdetails.php");
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

   
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datatables.min.js"></script>

   
    
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
                    <li><a href="index.php"> &nbsp; &nbsp; &nbsp; Inicio</a></li>
                    <li><a data-toggle="modal" data-target="#uploadModal"> &nbsp; &nbsp; &nbsp; Subir Productos</a></li>
                    <li><a href="items.php"> &nbsp; &nbsp; &nbsp; Gestión de Productos</a></li>
                    <li><a href="customers.php"> &nbsp; &nbsp; &nbsp; Gestión de Clientes</a></li>
                    <li class="active"><a href="orderdetails.php"> &nbsp; &nbsp; &nbsp; Detalles de Pedidos</a></li>
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
                            
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detalles de Pedidos</li>
  </ol>
</nav>

        <div id="page-wrapper">
            
			
			
			
			
			
		
			
			
		 <div class="alert alert-danger">
                        
                          <center> <h3><strong>Gestión de detalles de pedidos</strong> </h3></center>
						  
						  </div>
						  
						  <br />
						  
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Pecha del pedido</th>
                  <th>Nombre del Cliente</th>
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
        //Selecciona y muestra datos de la bd ordenados en filas
        	$stmt = $DB_con->prepare('select order_id, order_date,users.user_firstname, users.user_lastname, order_name, order_price, order_quantity, order_total from orderdetails, users where orderdetails.user_id=users.user_id and order_status="Ordered" order by order_date desc');
        	$stmt->execute();
        	//Condición If num Filas
        	if($stmt->rowCount() > 0)
        	{
        		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        		{
        			extract($row);
        			
        			
        			?>
                <tr>
                  
                 <td><?php echo $order_date; ?></td>
				 <td><?php echo $user_firstname; ?> <?php echo $user_lastname; ?></td>
				 <td><?php echo $order_name; ?></td>
				 <td>&#8364; <?php echo $order_price; ?></td>
				 <td><?php echo $order_quantity; ?></td>
				 <td>&#8364; <?php echo $order_total; ?></td>
				 
				 <td>
				
				 
				
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['order_id']; ?>" title="click for delete" onclick="return confirm('¿Estás seguro de eliminar este pedid?')">
				  <span class='glyphicon glyphicon-trash'></span>
				  Eliminar artículo pedido</a>
                  
                  </td>
                </tr>
               
              <?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#033c73;"><a style="color: #fff" target="_blank">
                       ZapStreet - 2020 PROYECTO DESARROLLO WEB | Zuhir Chaoui Mohamed</a>

                    </div>
	</div>';
	
		echo "</div>";
	}
	else
	{
		?>
		
			
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; Datos no encontrados ...
            </div>
        </div>
        <?php
	}
	
?>
		
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
