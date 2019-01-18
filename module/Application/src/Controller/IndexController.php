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
            $response    = json_encode(['winningPrize' => $randomPrize]);

            $view = new JsonModel([$response]);
            $view->setTerminal(true);

            return $view;
        }
    }
}
