<?php

/**
 * getDeadlinesByCaseId.php
 * @author Edwin X. Borrero Santiago <edwin.borrero@seedburysquare.com>
 * @copyright Seedbury Square, LLC. All Rights Reserved.
 *
 * @version 2024-January-16 Initial Version
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . '../../utilities/helpers/helpers.php';

return function () {
    $dummyDeadlines = [
        [
            "DeadlineId" => 1014,
            "CaseId" => 8,
            "Content" => "test deadline",
            "StatusCode" => 103,
            "StatusDescription" => "No Atendido",
            "StartDate" => "2023-12-04 11:26:20.000",
            "EndDate" => "2023-12-06 14:00:00.000",
            "ComplianceDate" => null,
            "Priority" => 0,
            "DeadlineTypeCode" => 208,
            "DeadlineTypeDescription" => "Termino Regular",
            "CaseNumber" => "SJ2016CV00012",
            "ShortName" => "LUIS ECHEVARRÍA v. AAA BB"
        ],
        [
            "DeadlineId" => 1048,
            "CaseId" => 19,
            "Content" => "bbbbbbbb",
            "StatusCode" => 103,
            "StatusDescription" => "No Atendido",
            "StartDate" => "2023-12-13 13:24:24.000",
            "EndDate" => "2023-12-12 16:00:00.000",
            "ComplianceDate" => null,
            "Priority" => 1,
            "DeadlineTypeCode" => 208,
            "DeadlineTypeDescription" => "Termino Regular",
            "CaseNumber" => "SJ2023CV00029",
            "ShortName" => "CLARO  v. BRENNON ÁLVAREZ SÁNCHEZ"
        ],
        [
            "DeadlineId" => 1035,
            "CaseId" => 21,
            "Content" => "bbbbb",
            "StatusCode" => 103,
            "StatusDescription" => "No Atendido",
            "StartDate" => "2024-01-08 13:03:07.000",
            "EndDate" => "2024-01-30 15:00:00.000",
            "ComplianceDate" => null,
            "Priority" => 0,
            "DeadlineTypeCode" => 208,
            "DeadlineTypeDescription" => "Termino Regular",
            "CaseNumber" => "SJ2023CV00050",
            "ShortName" => "ROSA MARRERO RODRIGUEZ y otros v. TOÑO PEREZ LOPEZ y otros"
        ],
        [
            "DeadlineId" => 2023,
            "CaseId" => 1030,
            "Content" => "asdf",
            "StatusCode" => 103,
            "StatusDescription" => "No Atendido",
            "StartDate" => "2024-01-18 14:28:56.000",
            "EndDate" => "2024-03-18 23:59:00.000",
            "ComplianceDate" => null,
            "Priority" => 1,
            "DeadlineTypeCode" => 208,
            "DeadlineTypeDescription" => "Termino Regular",
            "CaseNumber" => "SJ2023CV00147",
            "ShortName" => "ALBERTO LUIS MATOS BERRIOS v. LOURDES MATOS BERRIOS"
        ]
    ];
    return uniformReturnObject(true, $dummyDeadlines, null, null);
};
// function getDeadlinesByCaseId(){

// };