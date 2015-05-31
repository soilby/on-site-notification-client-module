<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 31.5.15
 * Time: 11.53
 */

namespace Soil\OnSiteNotificationClient\View\Helper;

use Zend\View\Helper\AbstractHelper;

class NotificationEngine extends AbstractHelper {


    public function __invoke($authorURI)  {

        $viewModel = new ViewModel([
            'entityURI' => $entityURI,
            'authorURI' => $authorURI,
            'enableSubscription' => $enableSubscription
        ]);

        $viewModel->setTemplate('comment/widget/widget');

        return $this->view->render($viewModel);
    }
} 