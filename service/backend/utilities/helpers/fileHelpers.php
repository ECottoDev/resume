<?php

/**
* fileHelpers.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/


/**
 * Logs data to error file
 * @param object $logObj
 * @param string $lastFunctionCalled
 * @return object $logObj
 */
function logErrorToFile($logObj, $lastFunctionCalled = '')
{
    $logObj = array_merge($logObj, ['lastFunctionCalled' => $lastFunctionCalled, 'timeStamp' => time()]);
    $URL = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'errorLog' . DIRECTORY_SEPARATOR;
    if (!file_exists($URL)) {
        mkdir($URL, 0777, true);
    }
    file_put_contents($URL . time() . '-' . md5((json_encode($logObj))) . '.json', json_encode($logObj));
    return $logObj;
}
