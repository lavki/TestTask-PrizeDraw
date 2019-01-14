<?php

namespace Authentication\Controller;

use Zend\Uri\Uri;
use Zend\View\Model\ViewModel;
use Authentication\Form\AuthenticationForm;
use Zend\Mvc\Controller\AbstractActionController;
use Authentication\Service\AuthenticationManager;

/**
 * Class AuthenticationController
 * @package Authentication\Controller
 */
class AuthenticationController extends AbstractActionController
{
    /**
     * @var AuthenticationManager
     */
    private $authenticationManager;

    /**
     * AuthenticationController constructor.
     * @param AuthenticationManager $authenticationManager
     */
    public function __construct( AuthenticationManager $authenticationManager )
    {
        $this->authenticationManager = $authenticationManager;
    }

    public function loginAction()
    {
        $redirectUrl = $this->params()->fromQuery( 'redirect-url' );

        if( strlen($redirectUrl) > 2000 )
        {
            throw new \Exception("Too long redirect-url argument passed");
        }

        $form = new AuthenticationForm();
        $form->get('redirect-url')->setValue($redirectUrl);

        if( $this->getRequest()->isPost() )
        {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if( $form->isValid() )
            {
                $email    = (string) $data['email'];
                $password = (string) $data['password'];
                $remember = (bool)   $data['remember-me'];
                $result   = $this->authenticationManager->login( $email, $password, $remember );

                if( $result->isValid() )
                {
                    $redirectUrl = $this->params()->fromPost('redirect-url', '' );

                    if( !empty($redirectUrl) )
                    {
                        $uri = new Uri($redirectUrl);

                        if( !$uri->isValid() || $uri->getHost() != null )
                        {
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl );
                        }

                        $this->redirect()->toUrl($redirectUrl);
                    }

                    else
                    {
                        return $this->redirect()->toRoute('home' );
                    }
                }

                $error = true;
            }
        }

        $this->layout()->setTemplate( '/layout/login.phtml' );

        return new ViewModel([
            'form'         => $form,
            'error'        => $error ?? false,
            'redirect-url' => $redirectUrl
        ]);
    }

    public function logoutAction()
    {
        $this->authenticationManager->logout();

        return $this->redirect()->toRoute('login' );
    }
}