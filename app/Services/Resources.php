<?php namespace App\Services;

use App\Entities\Resource;
use Maer\FileDB\FileDB;

class Resources
{
    protected $db;
    protected $contentPath;

    public function __construct(FileDB $db, $contentPath)
    {
        $this->db          = $db->resources;
        $this->contentPath = $contentPath;
    }

    public function all()
    {
        return $this->db
            ->asObj('App\Entities\Resource')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getById($id)
    {
        $resource = $this->db
            ->asObj('App\Entities\Resource')
            ->find($id);

        if (!$resource) {
            return null;
        }

        $resource->content = $this->getContent($id);

        return $resource;
    }

    public function getByPath($path)
    {
        $resource = $this->db
            ->asObj('App\Entities\Resource')
            ->find($path, 'path');

        if (!$resource) {
            return null;
        }

        $resource->content = $this->getContent($resource->id);

        return $resource;
    }

    public function getByName($name)
    {
        $resource = $this->db
            ->asObj('App\Entities\Resource')
            ->find($name, 'name');

        if (!$resource) {
            return null;
        }

        $resource->content = $this->getContent($resource->id);

        return $resource;
    }

    public function add(Resource $resource, $content = null)
    {
        $resource->created = time();
        $resource->updated = time();

        $id =  $this->db->insert($resource->forDB());

        if (!$id) {
            return false;
        }

        $this->saveContent($id, $resource->content);

        return $this->getById($id);
    }

    public function update(Resource $resource)
    {
        $time = time();
        $resource->updated = $time;

        $updated = $this->db
            ->where('id', $resource->id)
            ->update($resource->forDB());

        if (!$updated) {
            return false;
        }

        $this->saveContent($resource->id, $resource->content);

        $new = $this->getById($resource->id);

        return $new && $new->updated == $time ? $new : false;
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete();

        $file = $this->contentFilePath($id);
        if (is_file($file)) {
            unlink($file);
        }

        return true;
    }

    public function validate(array $data)
    {
        $errors = [];

        $byName = $this->getByName($data['name']);

        $path = '/' . ltrim($data['path'], '/');
        $byPath = $this->getByPath($path);

        if ($data['id']) {
            if (!$this->getById($data['id'])) {
                $errors[] = 'Invalid resource id';
            }
        }

        if (strlen($data['name']) < 2) {
            $errors[] = 'The name must be at least 2 characters';
        }

        if (strlen($data['path']) < 2) {
            $errors[] = 'The path must be at least 1 character';
        }

        if ($byName && $byName->id != $data['id']) {
            $errors[] = 'There already is a resource with this name';
        }

        if ($byPath && $byPath->id != $data['id']) {
            $errors[] = 'There already is a resource with this path';
        }

        return $errors;
    }

    protected function getContent($id)
    {
        $file = $this->contentFilePath($id);
        $content = is_file($file) ? file_get_contents($file) : null;

        if ($content && @json_decode($content)) {
            return $content;
        }

        return json_encode(new \StdClass);
    }

    protected function saveContent($id, $content)
    {
        if ($content) {
            $file = $this->contentFilePath($id);
            file_put_contents($file, $content);
            return true;
        }

        return false;
    }

    protected function contentFilePath($id)
    {
        return $this->contentPath . "/{$id}.json";
    }
}
