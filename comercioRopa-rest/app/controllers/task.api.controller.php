<?php
    require_once 'app/controllers/api.controller.php';
    require_once 'app/models/task.model.php';

    class TaskApiController extends ApiController{
        private $model;

        function __construct(){
            parent::__construct();
            $this->model = new TaskModel();
        }

        function getAll(){
            $tareas = $this->model->listarProductos();
            $this->view->response($tareas, 200);
        }

        function get($params=[]){
            if(empty($params)){
                $tareas = $this->model->detalleItem();
                $this->view->response($tareas, 200);
            } else{
                $tarea = $this->model->detalleItem($params[':ID']);
                if(!empty($tarea)){
                    $this->view->response($tarea, 200);
                } else{
                    $this->view->response(
                        ['msg'=> 'La tarea con el id='.$params[':ID']. ' no existe.']
                    , 404);
                }
            }
        }

        function delete($params=[]){
            $id = $params[':ID'];
            $tarea = $this->model->detalleItem($id);
            if($tarea){
                $this->model->borrarItem($id);
                $this->view->response('La tarea con id= '.$id.' ha sido borrada.', 200);
            } else{
                $this->view->response('La tarea con id='.$id.' no existe', 404);
            }
        }

        function create($params=[]){
            $body = $this->getData();

            $nombre = $body->nombre;
            $descripcion = $body->descripcion;
            $precio = $body->precio;

            $id = $this->model->agregarProducto($nombre, $descripcion, $precio);
            
            $this->view->response('La tarea fue insertada con el id= '.$id.'.', 201);
        }
    }