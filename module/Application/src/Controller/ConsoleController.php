<?php

namespace Application\Controller;

use RuntimeException;
use Zend\Console\Prompt;
use Zend\Console\Request as ConsoleRequest;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class ConsoleController
 * @package Application\Controller
 */
class ConsoleController extends AbstractActionController
{
    public function sendMoneyToUserBankAccountAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked
        // our application into running this action from a public web server.
        if( !$request instanceof ConsoleRequest )
        {
            throw new RuntimeException( 'You can only use this action from a console!' );
        }

        $verbose = $request->getParam('verbose') || $request->getParam('v'); // Check verbose flag
        $mode    = $request->getParam( 'mode', false ); // Check mode, defaults to is false

        $confirm = new Prompt\Confirm("Are you sure you want to continue?\n\r
        Press letter 'y' if you are agree or 'n' if you are not agree...");
        $result = $confirm->show();
        if ($result) {
            return "Money was sended to the bank account of user John Doe!"; // the user chose to continue
        }

        return "Hello World!";
    }
}