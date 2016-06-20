<?php

return array(
    'assetic_configuration' => array(
        'modules' => array(
            'Soil\OnSiteNotificationClient' => array(
                'root_path' => __DIR__ . '/../assets',
                'collections' => array(
                    'onsite_notification_js' => [
                        'assets' => [
                            'on-site-notification/controller/on-site-notification-engine.js',
                        ],
                        'options' => [
                            'output' => 'on-site-notification.js'
                        ],
                        'filters' => array('?EnliteNgminFilter', '?EnliteUglifyFilter')
                    ]
                ),
            ),
        ),
        'routes' => array(

        )
    )
);