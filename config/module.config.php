<?php

namespace Uploadify;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'view_helpers' => [
        'aliases' => [
            'formUploadify' => Form\View\Helper\FormUploadify::class,
        ],
        'factories' => [
            Form\View\Helper\FormUploadify::class => InvokableFactory::class
        ]
    ],
];
