<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 31.5.15
 * Time: 11.53
 */

namespace Soil\OnSiteNotificationClient\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NotificationEngineFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)  {
        $helper = new NotificationEngine();


        return $helper;
    }

} 