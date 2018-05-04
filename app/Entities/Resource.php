<?php namespace App\Entities;

use Enstart\Entity\Entity;

class Resource extends Entity
{
    protected $_params = [
        'id'      => null,
        'name'    => null,
        'path'    => null,
        'content' => null,
        'created' => 0,
        'updated' => 0,
    ];

    public function forDB()
    {
        return $this->toArray(['id', 'content']);
    }
}
