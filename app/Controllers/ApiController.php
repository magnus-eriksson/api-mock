<?php namespace App\Controllers;

use App\Services\Resources;
use Enstart\Controller\Controller;

class ApiController extends Controller
{
    protected $resources;

    public function __construct(Resources $resources)
    {
        $this->resources = $resources;
    }

    public function getResource($path = null)
    {
        $json     = $this->makeJsonEntity();
        $path     = '/' . trim($path, '/');
        $resource = $this->resources->getByPath($path);

        if (!$resource) {
            return $json->setCode('404')
                ->setMessage('Resource not found');
        }

        $content = @json_decode($resource->content);

        return $json->setData($content ?: new \StdClass);
    }
}
