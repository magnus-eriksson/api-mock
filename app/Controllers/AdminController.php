<?php namespace App\Controllers;

use App\Entities\Resource;
use App\Services\Resources;
use Enstart\Controller\Controller;
use Maer\Auth\AuthInterface;
use Maer\Auth\SecurityInterface;

class AdminController extends Controller
{
    protected $auth;
    protected $security;
    protected $resources;

    public function __construct(
        AuthInterface $auth,
        SecurityInterface $security,
        Resources $resources
    )
    {
        $this->auth      = $auth;
        $this->security  = $security;
        $this->resources = $resources;
    }

    public function login()
    {
        $loginError = $this->session->getFlash('loginError');
        $loginError = $loginError && count($loginError) == 1;

        return $this->views->render('login', [
            'loginError' => $loginError,
        ]);
    }

    public function loginDo()
    {
        $user = $this->request->post('username');
        $pass = $this->request->post('password');

        $confUser = $this->config->get('auth.username');
        $confPass = $this->config->get('auth.password');

        if ($user && $pass && $user == $confUser && $this->security->verifyPassword($pass, $confPass)) {
            $this->auth->setCurrentUser(['user' => 'Delorean']);
            return $this->routeRedirect('admin.home');
        }

        $this->session->setFlash('loginError', true);

        return $this->routeRedirect('admin.login');
    }

    public function resources()
    {
        return $this->views->render('resources', [
            'resources' => $this->resources->all(),
        ]);
    }

    public function edit($id)
    {
        $resource = $this->resources->getById($id);
        if (!$resource) {
            return $this->routeRedirect('admin.home');
        }

        return $this->views->render('resource', [
            'resource' => $resource,
        ]);
    }

    public function create()
    {
        return $this->views->render('resource', [
            'resource' => new Resource,
        ]);
    }

    public function delete()
    {
        $json = $this->makeJsonEntity();
        $id   = $this->request->post('id');
        if (!$id) {
            return $json->setError('Invalid ID');
        }

        $this->resources->delete($id);
        return $json->setData($this->router->getRoute('admin.home'));
    }

    public function save()
    {
        $json = $this->makeJsonEntity();

        $data = new Resource([
            'id'      => $this->request->post('id'),
            'name'    => $this->request->post('name'),
            'path'    => $this->request->post('path'),
            'content' => $this->request->post('content'),
        ]);

        if (strpos($data->path, '/') !== 0) {
            $data->path = '/' . $data->path;
        }

        $errors = $this->resources->validate($data->toArray());
        if ($errors) {
            return $json->setErrors($errors);
        }

        if ($data->id) {
            $response = $this->resources->update($data);
        } else {
            $response = $this->resources->add($data);
        }

        if (!$response) {
            $json->setError('An error occurred when saving the resource');
        } else {
            $json->setData($response);
        }

        return $json;
    }
}
