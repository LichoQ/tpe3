<?php
    class TaskModel{
        private $db;

        function __construct(){
            $this->db = new PDO('mysql:host=localhost;dbname=comercio_ropa;charset=utf8', 'root', '');
        }

        function listarProductos() {
            $sentencia = $this->db->prepare("SELECT * FROM producto");
            $sentencia->execute();
            $productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
            return $productos;
        }

        function detalleItem($id = []) {
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id=?");
            $sentencia->execute([$id]);
            $producto = $sentencia->fetch(PDO::FETCH_OBJ);
            return $producto;
        }

        function borrarItem($id = []){
            $sentencia = $this->db->prepare("DELETE FROM producto WHERE id=?");
            $sentencia ->execute([$id]);
        }

        function agregarProducto($nombre, $descripcion, $precio){
            $sentencia = $this->db->prepare("INSERT INTO producto (nombre, descripcion, precio)VALUES(?,?,?)");
            $sentencia->execute([$nombre, $descripcion, $precio]);

            return $this->db->lastInsertId();
        }

    

    }