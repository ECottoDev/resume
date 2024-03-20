<?php

/**
* getskill.js
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
// Get the skill data with mysqli into an array

$skill = $db->select('SELECT * FROM skills');

// echo json_encode($skill);
$encodedskill = json_encode($skill["result"]);

$skillData = [];

foreach ($skill["result"] as $key => $value) {
    $skillData[$key] = $value;
}

echo json_encode($skillData);


// // return the data

// echo json_encode($skillData);




