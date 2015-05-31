<?php

return array(
    'assetic_configuration' => array(
        'modules' => array(
            'Talaka\CommentsClient' => array(
                'root_path' => __DIR__ . '/../assets',
                'collections' => array(
                    'comment_js' => [
                        'assets' => [
                            'comments/controller/comments-controller.js',
                            'comments/model/comment.js'
                        ],
                        'options' => [
                            'output' => 'comment.js'
                        ],
                    ]
                ),
            ),
        ),
        'routes' => array(

        )
    )
);