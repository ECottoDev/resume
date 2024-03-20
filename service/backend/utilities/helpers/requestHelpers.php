<?php

/**
* requestHelpers.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/


/**
 * Returns a uniform object for requests
 * @param bool $success
 * @param string $response 
 * @param string $errorMsg 
 * @param string $displayDialog 
 * @param string $showMsg 
 * @return object
 */
function uniformReturnObject($success, $response = null, $errorMsg = false, $displayDialog = false, $showMsg = false)
{
    return [
        'success' => $success,
        'response' => $response,
        'errorMsg' => $errorMsg,
        'displayDialog' => $displayDialog,
        'showMsg' => $showMsg
    ];
}
/**
 * Rollback DB transaction and log error to file
 * @param object $logObj
 * @param string $lastFunctionCalled 
 * @param object $dbDriver
 */
function logAndReturnError($logObj, $lastFunctionCalled, $dbDriver = false)
{
    $dbDriver && $dbDriver->rollBack();
    return uniformReturnObject(
        false,
        logErrorToFile($logObj, $lastFunctionCalled),
        $logObj['errorMsg'],
        $logObj['errorMsg']
    );
}
