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
		//Select que recoge informacion de las tablas
		$stmt_select = $DB_con->prepare('SELECT item_image FROM items WHERE item_id =:item_id');
		$stmt_select->execute(array(':item_id'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("item_images/".$imgRow['item_image']);
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM items WHERE item_id =:item_id');
		$stmt_delete->bindParam(':item_id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: items.php");
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
                    <li class="active"><a href="items.php"> &nbsp; &nbsp; &nbsp; Gestión de Productos</a></li>
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
                            
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Gestión de Productos</li>
  </ol>
</nav>

        <div id="page-wrapper">
            
			
			
			
			
			
			
			
			
	
			 <div class="alert alert-danger">
                        
                          <center> <h3><strong>Gestión de Productos</strong> </h3></center>
						  
						  </div>
						  
						  <br />
						  
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Imagen</th>
                  <th>Nonmbre del Producto</th>
                  <th>Descripción</th>
				          <th>Precio</th>
				          <th>Fecha Agregada</th>
                  <th>Acciones</th>
                 
                </tr>
              </thead>
              <tbody>
			  <?php
        //Conexión con la bd
        include("config.php");
          	$stmt = $DB_con->prepare('SELECT * FROM items');
          	$stmt->execute();
          	
          	if($stmt->rowCount() > 0)
          	{
          		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
          		{
          			extract($row);
          			
          			
          			?>
                <tr>
                  <td>
				<center> <img src="item_images/<?php echo $item_image; ?>" class="img img-rounded"  width="100" /></center>
				 </td>
                <td><?php echo $item_name; ?></td>
                <td><?php echo $item_description; ?></td>
				        <td>&#8364; <?php echo $item_price; ?></td>
				        <td><?php echo $item_date; ?></td>
				 
				 <td>
				
				 
				
				 <a class="btn btn-info" href="edititem.php?edit_id=<?php echo $row['item_id']; ?>" title="click for edit"><span class='glyphicon glyphicon-pencil'></span> Editar Producto</a> 
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['item_id']; ?>" title="click for delete"><span class='glyphicon glyphicon-trash'></span> Borrar Producto</a>
				
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
	
	<br />
	<br />
						  
						  
						  
			
			
            
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
