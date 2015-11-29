<?php
use Cake\Core\Configure;

$config['HybridAuth'] = [
    'providers' => [
        'GitHub' => [
            'enabled' => true
        ] ],
    'debug_mode' => Configure::read('debug'),
    'debug_file' => LOGS . 'hybridauth.log',
];
