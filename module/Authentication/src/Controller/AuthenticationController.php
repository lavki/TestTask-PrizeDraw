<?php

namespace Authentication\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class AuthenticationController
 * @package Authentication\Controller
 */
class AuthenticationController extends AbstractActionController
{
    public function loginAction()
    {
        return new ViewModel([

        ]);
    }

    public function logoutAction()
    {
        return new ViewModel([

        ]);
    }
}