<?php namespace App\Views;

use Enstart\View\AbstractExtension;

class ViewExtension extends AbstractExtension
{
    /**
     * @var array
     */
    protected $functions = [
        'helloWorld'
    ];

    /**
     * Say Hello World
     *
     * @return string
     */
    public function helloWorld()
    {
        return 'Hello World';
    }
}
