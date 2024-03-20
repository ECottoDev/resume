<?php

/**
* getwork.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/

// Require the necessary files
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../utilities/helpers/helpers.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../utilities/constants/constants.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../databaseConnection/DatabaseDriver.php';

//return function

$db = new DatabaseDriver(RESUME_DATABASE);
// Get the work data with mysqli into an array

$work = $db->select('SELECT * FROM workExperience');

// echo json_encode($work);
$encodedwork = json_encode($work["result"]);

$workData = [];

foreach ($work["result"] as $key => $value) {
    $workData[$key] = $value;
}

echo json_encode($workData);


// // return the data

// echo json_encode($workData);




