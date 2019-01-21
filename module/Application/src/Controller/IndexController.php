<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Application\Service\RafflePrize;
use Application\Service\ConvertManager;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * Selecting random Prize functionality
     */
    use RafflePrize, ConvertManager;

    public function indexAction()
    {
        return new ViewModel([
            'prize' => $this->prizeRepository->getRandomPrize(),
        ]);
    }

    public function rafflePrizesAction()
    {
        if( $this->getRequest()->isXmlHttpRequest() ) // if ajax
        {
            $randomPrize = $this->getRandomPrize();

            if( array_key_exists('Item', $randomPrize) ) {
                $option = [
                    'confirm' => 'Pick up',
                    'reject'  => 'Reject'];

            } elseif( array_key_exists('Money', $randomPrize) ) {
                $option = [
                    'convert' => 'Convert to Loyalty account',
                    'send'    => 'Send to bank account'];

            } elseif( array_key_exists('Bonus', $randomPrize) ) {
                $option = [
                    'take' => 'Take the points won'];
            }

            $response = json_encode(['winningPrize' => $randomPrize, 'options' => $option]);

            $view = new JsonModel([$response]);
            $view->setTerminal(true);

            return $view;
        }
    }
}
