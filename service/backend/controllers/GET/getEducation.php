<?php

/**
* getEducation.js
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
// Get the education data with mysqli into an array

$education = $db->select('SELECT * FROM educationHistory');


$encodedEducation = json_encode($education["result"]);

$educationData = [];

foreach ($education["result"] as $key => $value) {
    $educationData[$key] = $value;
}

echo json_encode($educationData);




