<?php

class UsersController extends RenderController
{
    public function read()
    {
        $usuario = new UserModel();
        $usuarios = $usuario->getUsers();
        if (!$usuarios) {
            $usuarios = 'Error al listar usuarios';
        }
        RenderController::render('home', [
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        $data = [];
        if (isset($_POST['nombre'])) {
            $usuario = new UserModel();
            $respuesta = $usuario->createUser($_POST);
            if ($respuesta) {
                $data['respuesta'] = 'ok';
            }else{
                $data['respuesta'] = 'error';
            }

            echo json_encode($data);
        } else {
            header('location: ./');
        }
    }

    public function update()
    {
        $data = [];
        if (isset($_POST)) {
            $usuario = new UserModel();
            $respuesta = $usuario->updateUser($_POST);
            if ($respuesta) {
                $data['respuesta'] = 'ok';
            }else{
                $data['respuesta'] = 'error';
            }
            echo json_encode($data);
        } else {
            header('location: ./');
        }
    }

    public function delete($id)
    {
        $data = [];
        if (isset($id) && isset($_POST)) {
            $usuario = new UserModel();
            $respuesta = $usuario->deleteUser($id);
            if ($respuesta) {
                $data['respuesta'] = 'ok';
            }else{
                $data['respuesta'] = 'error';
            }
            echo json_encode($data);
        } else {
            header('location: ./');
        }
    }

    public function User($id)
    {
        $data = [];
        $usuario = new UserModel();
        $respuesta = $usuario->getUser($id);
        if ($respuesta) {
            $data = [
                'respuesta' => 'ok',
                'datos' => $respuesta,
            ];
        }else{
            $data['respuesta'] = 'error';
        }
        echo json_encode($data);
    }
}
