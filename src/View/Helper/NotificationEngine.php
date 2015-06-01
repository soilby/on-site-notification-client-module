<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 31.5.15
 * Time: 11.53
 */

namespace Soil\OnSiteNotificationClient\View\Helper;

use Talaka\FrontEndConfiguration\View\FrontendConfigHelper;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class NotificationEngine extends AbstractHelper {


    /**
     * @var FrontendConfigHelper
     */
    protected $frontEndConfigHelper;

    public function __construct($frontEndConfigHelper)    {
        $this->frontEndConfigHelper = $frontEndConfigHelper;
    }


    public function __invoke($authorURI)  {
        $this->frontEndConfigHelper->setConfigInline();

        $viewModel = new ViewModel([
            'authorURI' => $authorURI
        ]);

        $viewModel->setTemplate('notification-engine');

        return $this->view->render($viewModel);
    }
} 