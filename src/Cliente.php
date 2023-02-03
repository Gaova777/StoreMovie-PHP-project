<?php
    namespace Jdiego;

    class Cliente {
        private $config;
        private $cn=null;

        public function __construct(){
            $this->config=parse_ini_file(__DIR__.'/../config.ini');

            // print '<pre>';//una forma de imprimir por pantalla en php en clases, acá vemos como conectamos con la base de datos
            // print_r($this->config);

            $this->cn=new \PDO($this->config['dns'],$this->config['usuario'],$this->config['clave'], array(
                \PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
            ));
            //acá vemos como PDO funciona solo con una contra barra debido al composer en el pr_4
        }

        public function registrar($_params){

            $sql="INSERT INTO `clientes`(`nombre`, `apellidos`, `email`, `telefono`, `comentario`) VALUES (:nombre, :apellidos, :email, :telefono, :comentario)";

            $resultado= $this->cn->prepare($sql);

            $_array=array(
                ":nombre"=>$_params['nombre'], 
                ":apellidos"=>$_params['apellidos'], 
                ":email"=>$_params['email'], 
                ":telefono"=>$_params['telefono'], 
                ":comentario"=>$_params['comentario'], 
                
            );

            if($resultado->execute($_array)){
                return $this->cn->lastInsertId();
            }else{
                return false;
            }

        }
    }
?>