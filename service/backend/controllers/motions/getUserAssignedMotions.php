<?php

/**
 * getUserAssignedMotions.php
 * @author Edwin X. Borrero Santiago <edwin.borrero@seedburysquare.com>
 * @copyright Seedbury Square, LLC. All Rights Reserved.
 *
 * @version 2024-January-11 Initial Version
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . '../../utilities/helpers/helpers.php';

return function () {
    $dummyMotions = [
        [
            "CaseId" => "61241",
            "RecordId" => "2840973",
            "CaseNumber" => "SJ2023CV00013",
            "ShortEpigraph" => "DEMANDANTE  A  V. DEMANDADO   B ",
            "DateCreated" => "2024/01/08 13:08:40",
            "MotionDescription" => "DEMANDA presentada por  (FRANCISCO J. MEDINA MEDINA).",
            "FilingTypeCode" => 454
        ],
        [
            "CaseId" => "61242",
            "RecordId" => "2840974",
            "CaseNumber" => "SJ2023CV00015",
            "ShortEpigraph" => "DEMANDANTE  C  V. DEMANDADO   D ",
            "DateCreated" => "2023/03/08 13:08:40",
            "MotionDescription" => "DEMANDA presentada por Juan del Pueblo.",
            "FilingTypeCode" => 450
        ],
        [
            "CaseId" => "61243",
            "RecordId" => "2840975",
            "CaseNumber" => "SJ2023CV00018",
            "ShortEpigraph" => "DEMANDANTE  E  V. DEMANDADO  F ",
            "DateCreated" => "2023/04/12 13:08:40",
            "MotionDescription" => "DEMANDA presentada por María Milagros.",
            "FilingTypeCode" => 452
        ],
        [
            "CaseId" => "61244",
            "RecordId" => "2840976",
            "CaseNumber" => "SJ2023CV00025",
            "ShortEpigraph" => "DEMANDANTE  G  V. DEMANDADO  H ",
            "DateCreated" => "2023/05/15 13:08:40",
            "MotionDescription" => "DEMANDA presentada por Fulano.",
            "FilingTypeCode" => 460
        ]
    ];
    return uniformReturnObject(true, $dummyMotions, null, null);
};
// function getUserAssignedMotions(){

// }