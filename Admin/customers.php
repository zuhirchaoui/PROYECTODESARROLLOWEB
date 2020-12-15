<?php
session_start();

//Condición if recoge la información de la sesion
if (!$_SESSION['admin_username']) {

    header("Location: ../index.php");
}

?>
<?php
//Conexión con la bd
require_once 'config.php';
//Condición if
if (isset($_GET['delete_id'])) {

    //Prepara y ejecuta sql para borrar un usuario
    $stmt_delete = $DB_con->
        prepare('DELETE FROM users WHERE user_id =:user_id');
    $stmt_delete->bindParam(':user_id', $_GET['delete_id']);
    $stmt_delete->execute();

    header("Location: customers.php");
}

?>
<?php
//Conexión con la bd
require_once 'config.php';
//Condición if obtiene informacion del producto
if (isset($_GET['order_id'])) {

    //Prepara y ejecuta sql para Actualizar la tabla de pedidos
    $stmt_delete = $DB_con->
        prepare('update orderdetails set order_status="Ordered_Finished"  WHERE user_id =:user_id and order_status="Ordered"');
    $stmt_delete->bindParam(':user_id', $_GET['order_id']);
    $stmt_delete->execute();

    header("Location: customers.php");
}

?>
<!DOCTYPE html>
<html lang="es" xml:lang="es">
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
                <title>
                    ZapStreet
                </title>
                <link href="../assets/img/newlogo.png" rel="shortcut icon" type="image/x-icon"/>
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
                <link href="css/local.css" rel="stylesheet" type="text/css"/>
                <script src="js/jquery-1.10.2.min.js" type="text/javascript">
                </script>
                <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
                </script>
            </meta>
        </meta>
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
                    <li class="active"><a href="customers.php"> &nbsp; &nbsp; &nbsp; Gestión de Clientes</a></li>
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
                    <li class="breadcrumb-item">
                        <a href="index.php">
                            Inicio
                        </a>
                    </li>
                    <li aria-current="page" class="breadcrumb-item active">
                        Gestión de Clientes
                    </li>
                </ol>
            </nav>
            <div id="page-wrapper">
                <div class="alert alert-danger">
                    <center>
                        <h3>
                            <strong>
                                Gestión de clientes
                            </strong>
                        </h3>
                    </center>
                </div>
                <br/>
                <div class="table-responsive">
                    <table cellspacing="0" class="display table table-bordered" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Email Cliente
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Dirección
                                </th>
                                <th>
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
//Conexión con la bd
include "config.php";
//Prepara y ejecuta sql que recoge las columnas de la tabla users
$stmt = $DB_con->
    prepare('SELECT * FROM users');
$stmt->execute();
//Condición if
if ($stmt->rowCount() > 0) {
    //Bucle While que recorre las filas
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        ?>
                            <tr>
                                <td>
                                    <?php echo $user_email; ?>
                                </td>
                                <td>
                                    <?php echo $user_firstname; ?>
                                    <?php echo $user_lastname; ?>
                                </td>
                                <td>
                                    <?php echo $user_address; ?>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="view_orders.php?view_id=<?php echo $row['user_id']; ?>">
                                        <span class="glyphicon glyphicon-shopping-cart">
                                        </span>
                                        Ver Pedidos
                                    </a>
                                    <a class="btn btn-warning" href="?order_id=<?php echo $row['user_id']; ?>" title="click for delete">
                                        <span class="glyphicon glyphicon-ban-circle">
                                        </span>
                                        Reiniciar Pedido
                                    </a>
                                    <a class="btn btn-primary" href="previous_orders.php?previous_id=<?php echo $row['user_id']; ?>">
                                        <span class="glyphicon glyphicon-eye-open">
                                        </span>
                                        Pedidos Anteriores
                                    </a>
                                    <a class="btn btn-danger" href="?delete_id=<?php echo $row['user_id']; ?>" title="click for delete">
                                        <span class="glyphicon glyphicon-trash">
                                        </span>
                                        Borrar Cliente
                                    </a>
                                </td>
                            </tr>
                            <?php
}
    echo "</tbody>
                            ";
    echo "
                        </tbody>
                    </table>
                    ";
    echo "
                </div>
                ";
    echo "
                <br/>
                ";
    //Muestra el footer
    echo '
                <div class="alert alert-default" style="background-color:#033c73;">
                    <a style="color: #fff" target="_blank">
                        ZapStreet - 2020 PROYECTO DESARROLLO WEB | Zuhir Chaoui Mohamed
                    </a>
                </div>
            </div>
            ';

    echo "
        </div>
        ";
} else {
    ?>
        <div class="col-xs-12">
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-info-sign">
                </span>
                Datos no encontrados ...
            </div>
        </div>
        <?php }?>
    </body>
</html>
<br/>
<br/>
<!-- /#wrapper -->
<!-- Mediul Modal -->
<div aria-labelledby="myMediulModalLabel" class="modal fade" id="uploadModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="color:white;background-color:#008CBA">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h2 class="modal-title" id="myModalLabel" style="color:white">
                    Subir Productos
                </h2>
            </div>
            <div class="modal-body">
                <form action="additems.php" enctype="multipart/form-data" method="post">
                    <fieldset>
                        <p>
                            Nombre del Producto:
                        </p>
                        <div class="form-group">
                            <input class="form-control" name="item_name" placeholder="Nombre del Producto" required="" type="text">
                            </input>
                        </div>
                        <p>
                            Descripción del Producto:
                        </p>
                        <div class="form-group">
                            <input class="form-control" name="item_description" placeholder="Describe el producto" required="" type="text">
                            </input>
                        </div>
                        <p>
                            Precio:
                        </p>
                        <div class="form-group">
                            <input class="form-control" id="priceinput" name="item_price" placeholder="Precio" required="" type="text">
                            </input>
                        </div>
                        <p>
                            Elegir Imagen:
                        </p>
                        <div class="form-group">
                            <input accept="image/*" class="form-control" name="item_image" required="" type="file"/>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-md" name="item_save">
                    Guardar
                </button>
                <button class="btn btn-danger btn-md" data-dismiss="modal" type="button">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
<script charset="utf-8" type="text/javascript" src="js/todojs.js"></script>