<?php
/**
* requestSorter.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/


require_once __DIR__  . DIRECTORY_SEPARATOR . '../envSettings-backend.php';
require_once __DIR__  . DIRECTORY_SEPARATOR . 'utilities/constants/httpConstants.php';
require_once __DIR__  . DIRECTORY_SEPARATOR . 'utilities/helpers/helpers.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
    try {
        if ($_SERVER['HTTP_SECRET'] == BACKEND_REQUEST_SECRET) {
            $path = substr($_SERVER['PATH_INFO'], 1);
            if (!file_exists($path)) {
                http_response_code(BAD_REQUEST);
                throw new Exception('File does not exist.');
            }
            $service = require_once __DIR__  . DIRECTORY_SEPARATOR . $path;
            $request = [
                'GET' => function () use ($service) {
                    if (isset($_GET)) {
                        return $service($_GET);
                    }
                },
                'POST' => function () use ($service) {
                    if (isset($_POST['params'])) {
                        return $service(json_decode($_POST['params'], true));
                    }
                }
            ][$_SERVER['REQUEST_METHOD']];
            if (isset($request)) {
                echo json_encode($request());
            } else {
                http_response_code(METHOD_NOT_ALLOWED);
                throw new Exception('Method Not Allowed');
            }
            exit;
        } else {
            http_response_code(FORBIDDEN);
            throw new Exception('Forbidden');
        }
    } catch (\Throwable $e) {
        error_log($e);
        echo json_encode(uniformReturnObject(false, null, $e->__toString(), $e->getMessage()));
        exit;
    }
}
