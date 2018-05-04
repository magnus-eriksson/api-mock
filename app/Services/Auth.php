<?php namespace App\Services;

use Enstart\Http\SessionInterface;
use Maer\Auth\SecurityInterface;

class Auth extends \Maer\Auth\Auth
{
    protected $session;

    /**
     * @param SecurityInterface $security
     * @param SessionInterface  $session
     */
    public function __construct(SecurityInterface $security, SessionInterface $session)
    {
        $this->security = $security;
        $this->session  = $session;
        $this->setCurrentUser($session->get('adminUser'));
    }

    public function setCurrentUser($user)
    {
        parent::setCurrentUser($user);
        $this->session->set('adminUser', $user);
    }
}
