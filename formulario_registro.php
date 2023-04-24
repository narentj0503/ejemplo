<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario de registro</title>
</head>
<body>
    <h1>Formulario de registro</h1>
    <form action="formulario_registro.php" method="POST">

    <!--en la accion siempre va el archivo de php que contiene las consultas de SQL para manipular los datos

        el method es obligatorio,ya que  este es el que me permite obtener la informacion escrita en el formulario-->

        <label for="">id_cliente</label><br>
        <input type="number"placeholder="Escribe aqui tu identificacion" name="id_cliente"><br>
        <!-- el name siempre sera el nombre de la columna de la tabla-->
 
        <label for="">nombre cliente</label><br>
        <input type="text" name="nombre_cliente"placeholder="Esciba aqui su nombre"><br>

        <label for="">Apellido cliente</label><br>
        <input type="text" name="apellido_cliente"placeholder="Esciba aqui su nombre"><br>

        <label for="">Telefono </label><br>
        <input type="number" name="telefono_cliente"placeholder="Esciba aqui su telefono"><br>

        <label for="">Direccion</label><br>
        <input type="text" name="direccion_cliente"placeholder="Esciba aqui su direccion"><br>

        <label for="">Fecha de nacimiento</label><br>
        <input type="text" name="fecha_nac_cliente"placeholder="Esciba aqui su fecha de nacimiento"><br><br>

        <input type="submit" value="Enviar datos" name="Guardar"class="btn btn-outline-warning"><br><br>
  
        <input type="submit"value="consultar registros" name="consultar"class="btn btn-outline-warning"><br><br>

        <input type="submit"value="actualizar un registro" name="actualizar"class="btn btn-outline-warning"><br><br>

        <input type="submit"value="eliminar un registro" name="eliminar"class="btn btn-outline-warning"><br><br>
        <!--el boton siempre debe ser tipo submit, sino no dara la accion-->
         <?php
         //comprobar a cual de los botones le estan dando click
         if(isset($_POST['Guardar']))
         //isset me permite identificar si un elemento esta siendo seleccionado
         {
            //cuando necesitemos traer un elementod un formulario se hace por medo de una variable que deende del metodo establecido,esa variable puede ser $_GET o $_POST seuido del name del elemento que necesito traer, ejemplo:$_POST['name']
           
            //v<mos a comenzar a realizar el tratamiento o administracion de la informacion diligenciada en el formulario

            //lo primero es que necesitamos el archivo de conexion,vamos a incluir ese archivo 
            include ('conexion.php');//traemos el archivo de conexion para poder acceder a las tablas que estan en la base de datos

            //lo segundo es que vamos a declarar las variables que se necesitan para realizar una consulta sql. en este caso vamos a insertar informacion

            $id=$_POST['id_cliente'];//esta variable va a almacenar lo que digitanen el input del formulario que  tiene como metodo POST y un atributo name id_cliente

            $nombre=$_POST['nombre_cliente'];
            $apellido=$_POST['apellido_cliente'];
            $telefono=$_POST['telefono_cliente'];
            $direccion=$_POST['direccion_cliente'];
            $fecha_nacimiento=$_POST['fecha_nac_cliente'];
            //todos los campos mas los datos

            //el tercer paso es que cuando ya tenemos declarada la informacion necesaria para hacer la consulta, se procede a realizarla

            mysqli_query($conexion,"INSERT INTO cliente(id_cliente,nombre_cliente,apellido_cliente,telefono_cliente,direccion_cliente,fecha_nac_cliente)VALUE ('$id','$nombre','$apellido','$telefono','$direccion','$fecha_nacimiento')");
            //mysqli_query() es una funcion que realiza consultas a la base de datos mysql,esta funcion requiere de 2 parametros
            //el primer parametro es la conexion
            //el segundo parametro es la consulta que se necesita realizar a esta base de datos
            echo"Se ingresaron correctamente los datos";
         }
         if(isset($_POST['consultar'])){

            //paso 1:traer el archivo de conexion
            include('conexion.php');
            //paso 2:declarar las variables necesarias para realizar
            $id=$_POST['id_cliente'];
            //comprobar que en el formulario el campo Identificacion cliente no este vacio y que si esta vacio envie un mensaje que diga
            //'Digite un numero de identificacion'
            if($id =="")
            {
                echo "<script> alert('Digite un numero de identificacion');</script>";
            }
            else 
            {
                $resultado=mysqli_query($conexion,"SELECT*FROM cliente WHERE id_cliente=$id");//esta variable almacena la consulta que trae un registro

                while($consultar=mysqli_fetch_array($resultado))//devuelve un registro de acuerdo a una consulta
                {
                    //vamos a imprimir el resultado de esa consulta por medio de una tabla
                    echo "
                    <table border=1 width='100%'>
                    <tr> 
                    <th>Identificacion</th>
                    <th> Nombre cliente </th>
                    <th> Apellido cliente </th>
                    <th> Telefono cliente </th>
                    <th> Direccion cliente </th>
                    <th> Fecha de nacimiento</th>
                    </tr>
                    <tr>
                    <td>".$consultar['id_cliente']."</td>
                    <td>".$consultar['nombre_cliente']."</td>
                    <td>".$consultar['apellido_cliente']."</td>
                    <td>".$consultar['telefono_cliente']."</td>
                    <td>".$consultar['direccion_cliente']."</td>
                    <td>".$consultar['fecha_nac_cliente']."</td>
                    </tr>
                    </table>
                    ";
                }
            }
         }
         ?>
    </form>
</body>
</html>