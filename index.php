<?php require_once ('conexion.php'); $conexion=ConexionDB();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <div>
            <form action="" method="post">
                <table width="400" border="1" align="center">
                    <tr>
                        <th colspan="2" scope="row"><h2> Formulario de Votación!</h2></th>
                   </tr>
                   
                   <tr>
                       <th width="100" scope="row">Nombre y Apellido: </th>
                       <td width="130">
                           <label for="nom_ape"></label>
                           <input type="text" name="nom_ape" id="nom_ape" required>
                       </td>

                   </tr>  

                    <tr>
                       <th width="100" scope="row">Alias: </th>
                       <td width="130">
                           <label for="alias"></label>
                           <input type="text" name="alias" id="alias" minlength=5 pattern="^(?=.*[a-zA-Z])(?=\w*[0-9])\w{5,}$" 
                           title="Ingresa un alias de al menos 5 caracteres con letras y números"required>
                       </td>

                   </tr>
                    <tr>
                       <th width="100" scope="row">Rut: </th>
                       <td width="130">
                           <label for="rut"></label>
                           <input type="text" name="rut" id="rut" minlength=10 maxlength="10" 
                           pattern="\d{3,8}-[\d|kK]{1}"
                           title="Ingresa un rut válido (11111111-1)"
                            required>
                       </td>

                   </tr>
                    <tr>
                       <th width="100" scope="row">Email: </th>
                       <td width="130">
                           <label for="email"></label>
                           <input type="text" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                           title="Ingresa un mail valido (aaaa@aaa.aaa)"
                            required>
                       </td>

                   </tr>


                <?php
                $queryreg = "select * from region";
                $resultado=pg_query($conexion,$queryreg) or die ("Error en la matrix");
                $nr=pg_num_rows($resultado);
                if($nr>0)
                {
                    ?>
                        <tr>
                           <th width="100" scope="row">Región: </th>
                           <td width="130">
                               <select class="form-control" name="region_id" id="region_id" 
                               onchange="actualiza('cmb_comuna','comunas.php', 'comuna='+this.value);" 
                               required>

                          

                       
                    <?php
                        while ($filas=pg_fetch_array($resultado))
                         {
                            echo "<option value=".$filas['region_id'].">".$filas['desc_region']."</option>";
                         }
                    ?>
                             
                    </select>
                          </td>
                        </tr>
                <?php
                }
                else
                    {
                        echo "No hay registros";
                    }
                ?>

                
                    <tr>
                       <th width="100" scope="row">Comunas: </th>
                       <td width="130"><div id="cmb_comuna"></div>

                       </td>
                    </tr>


                

                <?php
                $querycan = "select * from candidato";
                $resultado=pg_query($conexion,$querycan) or die ("Error en la matrix");
                $nr=pg_num_rows($resultado);
                if($nr>0)
                {
                    ?>
                        <tr>
                           <th width="100" scope="row">Candidato: </th>
                           <td width="130">
                               <select class="form-control" name="candidato_id" id="candidato_id" required>

                          

                       
                    <?php
                        while ($filas=pg_fetch_array($resultado))
                         {
                            echo "<option value=".$filas['candidato_id'].">".$filas['nombre_can']."</option>";

                         }
                    ?>
                             
                    </select>
                          </td>
                        </tr>
                <?php
                }
                else
                    {
                        echo "No hay registros";
                    }
                ?>    


                     <tr>
                       <th width="100" scope="row">¿Cómo se enteró de nosotros?: </th>
                       <td width="130">
                           <label for="check"></label>
                            <input type="checkbox" name="publicidad[1]" value="web">Web<br>
                            <input type="checkbox" name="publicidad[2]"  value="tv">TV<br>
                            <input type="checkbox" name="publicidad[3]"  value="rrss">Redes Sociales<br>
                            <input type="checkbox" name="publicidad[4]"  value="amigo">Amigo<br>
                       </td>

                   </tr>
                   <th colspan="2" scope="row">
                        <input type="submit" name="insert" id="insert" value="Insert">
                    </th>
                </table>
            </form>
        </div>

        <?php

                $publicidad = array();

                if (isset($_POST['publicidad']))
                    {
                        $publicidad=$_POST['publicidad'];
                    }
                else
                    {
                        $publicidad=[];
                    }
                if($publicidad =="" || count($publicidad) < 2)

                    {
                        echo "Selecciona al menos 2 opciones de cómo nos conociste";
                    }
                else
                {
                    if(isset($_POST["insert"]))
                    {

                        $rut=$_POST["rut"];
                        $nom_ape=$_POST["nom_ape"];
                        $alias=$_POST["alias"];
                        $email=$_POST["email"];
                        $region_id=$_POST["region_id"];
                        $comuna_id=$_POST["comuna_id"];
                        $candidato_id=$_POST["candidato_id"];
                        $publicidad=$_POST["publicidad"];
                        $cadena= implode ("-", $publicidad);

                        


                        $q="insert into votante (rut,nom_ape,alias,email,region_id,comuna_id,candidato_id,publicidad)
                            values ('".$rut."','".$nom_ape."','".$alias."','".$email."','".$region_id."','".$comuna_id."',
                            '".$candidato_id."','".$cadena."')";  
                        $sql=pg_query($q);
                            if ($sql) 
                            {
                               echo"Voto realizado correcrtamente";          
                            }          

                    }
                }

            /*}*/
            ?>
    <?php 
        /*$query="select * from region";
        $resultado=pg_query($conexion,$query) or die ("Error en la matrix");
        $nr=pg_num_rows($resultado);
        if($nr>0)
            {
                echo "<table border=1 >
                    <tr><td>Id Region</td><td>Descripcion</td></tr>";
                
                while ($filas=pg_fetch_array($resultado))
                    {
                        "<option value".$filas['desc_region'].">"."</option>";

                        
                    
                    }echo "</table>";
            }
            else
                {
                    echo "no hay datos";
                }
        */
    ?>


<script type="text/javascript" src="ajax.js"></script>
    </body>
</html>