<?php

namespace ApplicationTest\Service;

use Application\Service\ConvertManager;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Class ConvertManagerTest
 * @package ApplicationTest\Service
 */
class ConvertManagerTest extends AbstractHttpControllerTestCase
{
    public function testConvertMoneyToBonusCanBeAccessed()
    {
        $this->assertDirectoryExists(__DIR__ . '/../../src/Service' );
        $mock = $this->getMockForTrait(ConvertManager::class );
        $mock->convertMoneyToBonus(1);
    }
}
