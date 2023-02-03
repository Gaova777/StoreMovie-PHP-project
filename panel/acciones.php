<?php


require '../vendor/autoload.php';

$pelicula = new Jdiego\Pelicula;

if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['accion']=='Registrar'){

        if(empty($_POST['titulo'])){
            exit('Completar titulo');
        }
        
        if(empty($_POST['descripcion'])){
            exit('Completar titulo');
        }
        
        if(empty($_POST['categoria_id'])){
            exit('Seleccionar una categoría');
        }
        if(!is_numeric($_POST['categoria_id'])){
            exit('Seleccionar una categoría válida');
        }

        $_params= array(
            'titulo'=>$_POST['titulo'],
            'descripcion'=>$_POST['descripcion'],
            'foto'=>subirFoto(),
            'precio'=>$_POST['precio'],
            'categoria_id'=>$_POST['categoria_id'],

            'fecha'=>date('Y-m-d'),
            
        );

        $rpt=$pelicula->registrar($_params);

       if($rpt){
        header('location: peliculas/index.php');
       }else{
        print 'Error al registrar la pelicula';
       }
    }
    if($_POST['accion']=='Actualizar'){
        if(empty($_POST['titulo'])){
            exit('Completar titulo');
        }
        
        if(empty($_POST['descripcion'])){
            exit('Completar titulo');
        }
        
        if(empty($_POST['categoria_id'])){
            exit('Seleccionar una categoría');
        }
        if(!is_numeric($_POST['categoria_id'])){
            exit('Seleccionar una categoría válida');
        }

        $_params= array(
            'titulo'=>$_POST['titulo'],
            'descripcion'=>$_POST['descripcion'],
            // 'foto'=>subirFoto(),
            'precio'=>$_POST['precio'],
            'categoria_id'=>$_POST['categoria_id'],

            'fecha'=>date('Y-m-d'),
            'id'=>$_POST['id']
            
        );

        if(!empty($_POST['foto_temp'])){
            $_params['foto']=$_POST['foto_temp'];
        }
        if(!empty($_FILES['foto']['name'])){
            $_params['foto']=subirFoto();
        }

        $rpt=$pelicula->actualizar($_params);

        if($rpt){
            header('location: peliculas/index.php');
           }else{
            print 'Error al actualizar la pelicula';
           }
    }
    
}
if($_SERVER['REQUEST_METHOD']=='GET'){
        
    $id=$_GET['id'];
    $rpt=$pelicula->eliminar($id);

   if($rpt){
    header('location: peliculas/index.php');
   }else{
    print 'Error al Eliminar la pelicula';
   }
}

function subirFoto(){
    $carpeta=__DIR__.'/../upload/';
    $archivo=$carpeta.$_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'],$archivo);

    return $_FILES['foto']['name'];
}//con esta funcion puedo guardar y subir una foto  
?>