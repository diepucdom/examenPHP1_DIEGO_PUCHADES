<?php
    $datosDeEntrada = [ ["id" => 1, "nombre" => "Portátil Gaming", "precio" => 1199.99, "stock" => 10, "categoria" => "Electrónica"], ["id" => 2, "nombre" => "Ratón Inalámbrico", "precio" => 45.50, "stock" => 3, "categoria" => "Electrónica"], ["id" => 3, "nombre" => "Teclado Mecánico", "precio" => 89.90, "stock" => 0, "categoria" => "Electrónica"], ["id" => 4, "nombre" => "Silla de Oficina", "precio" => 150.00, "stock" => 7, "categoria" => "Muebles"], ["id" => 5, "nombre" => "Cafetera Express", "precio" => 79.95, "stock" => 12, "categoria" => "Electrodomésticos"] ];
    
    //FUNCIONES DE ARRAY
    function obtenerProductosDisponibles(array $arr) : array{
        $disponibles = [];
        foreach($arr as $elemento){
            if(!elemento["stock"]==0){
                $Disponibles[]=$elemento;
            }
        }
        return $disponibles;
    }
    
    function calculaValorTotalStock(array $arr) : float{
        $total=0;
        foreach($arr as $elemento){
            $total+=$elemento["precio"];
        }
        return $total;
    }

    function buscarPorID(int $id, array $arr) : array{
        foreach($arr as $elemento){
            if(elemento["id"]==$id){
                return $id;
            }
        }
    }

    function obtenerNombreDeProducto(int $id, array $arr) : string {
        foreach($arr as $elemento){
            if($elemento["id"]==$id){
                return $elemento["nombre"];
            }
        }
    }

    function obtenerCategorias(array $arr) : array {
        $categorias = array_column($arr, "categoria");
        $sinDuplicados=array_unique($categorias);
        $str ="";
        foreach($sinDuplicados as $elemento){
            $str .= $elemento . ", ";
        }
        return $str;
    }
    
    function clasificarEstado(array $arr) : string{
        if($arr["stock"]<=3 && $arr["stock"]>0){
            return "Stock bajo";
        }else{
            if($arr["stock"]==0){
                return "Agotado";
            }else{
                return "Disponible;"
            }
        }
    }
    foreach($datosDeEntrada as $elemento){
        $elemento[]="estado"=>clasificarEstado($elemento);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>PANEL INVENTARIO</h1>
    <?php
        echo "<h2>TOTAL STOCK:". calculaValorTotalStock($datosDeEntrada). "</h2>". "<h2>CATEGORIAS:". obtenerCategorias($datosDeEntrada);
    ?>
    <table>
        <tr>
            <th>ID</th><th>NOMBRE</th><th>PRECIO</th><th>STOCK</th><th>CATEGORIA</th><th>ESTADO</th>
        </tr>
        <?php
            foreach($datosDeEntrada as $producto){
                if($producto["estado"]=="Agotado"){
                    echo "<tr><td>". $producto["id"]. "</td><td>". $producto["nombre"] . "</td><td>". $producto["precio"]. "€" . "</td><td>" . $producto["stock"] . "</td><td>". $producto["categoria"] . "</td><td class="noDisponible">". $producto["estado"]. "</td></tr>";
                }else{
                    echo "<tr><td>". $producto["id"]. "</td><td>". $producto["nombre"] . "</td><td>". $producto["precio"]. "€" . "</td><td>" . $producto["stock"] . "</td><td>". $producto["categoria"] . "</td><td>". $producto["estado"]. "</td></tr>";
                }
            }
        ?>
    </table> 
</body>
</html>