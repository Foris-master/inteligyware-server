<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => env('WKHTML_PATH',base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64')),
        'timeout' => false,
        'options' => array(
            /* 'footer-right' => 'Page [page] de [toPage]',
             'footer-font-size' => 8,
             'footer-left' => 'Facture BVS '*/
        ),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
