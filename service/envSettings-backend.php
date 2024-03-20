<?php
/**
* envSettings-backend.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/


require_once __DIR__ . DIRECTORY_SEPARATOR . 'env.php';
[
    'dev' => function () {

        !defined('BACKEND_REQUEST_SECRET') and define('BACKEND_REQUEST_SECRET', 'a3997410-9187-4470-b0f2-e26f2785d0f0');
        !defined('RESUME_DATABASE') and define('RESUME_DATABASE', 
        [
            'Hostname' => '198.12.246.215',
            'Username' => 'Luxian',
            'Password' => 'Luxian1037@',
            'Database' => 'resumeData',
            'Port' => 3306
        ]);
        !defined('RESUME_APPLICATION_ID') and define('RESUME_APPLICATION_ID', 'b8b6a889-de37-4e27-9d2d-5b1d9a2550da');
    }
][APP_ENV]();