<?php
    function agregarPelicula($resultado, $id, $cantidad=1){

        $_SESSION['carrito'][$id]=array(
            'id'=>$resultado['id'],
            'titulo'=>$resultado['titulo'],
            'foto'=>$resultado['foto'],
            'precio'=>$resultado['precio'],
            'cantidad'=> $cantidad,
          );
    }

    function actualizarPelicula($id,$cantidad=false){
        if($cantidad){//si cantidad existe entonces me asigna la cantidad en la propiedad que señalamos 
        $_SESSION['carrito'][$id]['cantidad']=$cantidad;
        }else{// y sino existe la cantidad una vez que se actualize se colocara una mas
        $_SESSION['carrito'][$id]['cantidad']+=1;

        }
    }

    function calcularTotal(){
        $total=0;
        if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $indice => $value){
                $total+=$value['cantidad'] * $value['precio'];
            }
        }
        return $total;
    }
    function cantidadPeliculas(){
        $cantidad=0;
        if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $indice => $value){
            $cantidad++;
            }
        }
        return $cantidad;
    }
?>