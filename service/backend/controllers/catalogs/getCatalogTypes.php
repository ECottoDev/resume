<?php

/**
 * getCatalogTypes.php
 * @author Edwin X. Borrero Santiago <edwin.borrero@seedburysquare.com>
 * @copyright Seedbury Square, LLC. All Rights Reserved.
 *
 * @version 2024-January-10 Initial Version
 */

require_once __DIR__ . DIRECTORY_SEPARATOR . '../../utilities/helpers/helpers.php';

return function () {
    $dummyCatalogs = [
        [
            "catalogValueCode" => 13,
            "catalogValueDescription" => "Apelación",
            "catalogTypeCode" => 4,
            "catalogTypeDescription" => "recourseType",
            "isLocked" => 1,
            "comment" => null
        ],
        [
            "catalogValueCode" => 14,
            "catalogValueDescription" => "Certiorari",
            "catalogTypeCode" => 4,
            "catalogTypeDescription" => "recourseType",
            "isLocked" => 1,
            "comment" => null
        ],
        [
            "catalogValueCode" => 22,
            "catalogValueDescription" => "Revisión",
            "catalogTypeCode" => 4,
            "catalogTypeDescription" => "recourseType",
            "isLocked" => 1,
            "comment" => null
        ],
        [
            "catalogValueCode" => 23,
            "catalogValueDescription" => "Mandamus",
            "catalogTypeCode" => 4,
            "catalogTypeDescription" => "recourseType",
            "isLocked" => 1,
            "comment" => "test"
        ],
        [
            "catalogValueCode" => 24,
            "catalogValueDescription" => "Hábeas Corpus",
            "catalogTypeCode" => 4,
            "catalogTypeDescription" => "recourseType",
            "isLocked" => 1,
            "comment" => null
        ]
    ];
    return uniformReturnObject(true, $dummyCatalogs, null, null);
};
// function getCatalogTypes(){

// }