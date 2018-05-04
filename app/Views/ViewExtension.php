<?php namespace App\Views;

use Enstart\View\AbstractExtension;

class ViewExtension extends AbstractExtension
{
    /**
     * @var array
     */
    protected $functions = [
        'config',
        'getFullUrl',
    ];

    /**
     * Get a config value
     *
     * @param  string $key
     * @param  mixed  $fallback
     *
     * @return string
     */
    public function config($key, $fallback = null)
    {
        return $this->app->config->get($key, $fallback);
    }

    public function getFullUrl($append = null)
    {
        $scheme = $this->app->request->server('REQUEST_SCHEME');
        $host   = $this->app->request->server('HTTP_HOST');

        return $scheme . '://' . $host . $append;
    }
}
