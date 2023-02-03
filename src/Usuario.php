<?php
    namespace Jdiego;

    class Usuario {
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

        public function login($nombre, $clave){
            $sql="SELECT nombre_usuario FROM `usuarios` WHERE nombre_usuario = :nombre AND clave = :clave ";
        
        
            $resultado= $this->cn->prepare($sql);

            $_array=array(
                
                ":nombre"=>$nombre,
                ":clave"=>$clave
            );

            if($resultado->execute($_array)){
                return $resultado->fetch();
            }else{
                return false;
            }
        }
    }