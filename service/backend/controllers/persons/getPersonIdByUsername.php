<?php

/**
 * getPersonIdByUsername.php
 * @author John A Cruz Merced <john.cruz@seedburysquare.com>
 * @copyright Seedbury Square, LLC. All Rights Reserved.
 *
 * @version 2024-January-04 Initial Version
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../envSettings-backend.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../databaseConnection/DatabaseDriver.php';

/**
 * Retrieve a person's ID based on their username from the database.
 *
 * @param string $username The username to search for.
 * @param DatabaseDriver|null $dbDriver The database driver to use. If not provided, a new DatabaseDriver instance will be created using CFI_DATABASE constant.
 *
 * @return mixed The PersonId if found, otherwise the result of the select operation.
 */
function getPersonIdByUsername($username, $dbDriver = null)
{
    $dbDriver ??= new DatabaseDriver(CFI_DATABASE);
    return ($dbDriver)->select(
        'SELECT UD.PersonId
         FROM SUMACUserDetail UD WITH (NOLOCK) 
         WHERE UD.Username = ?;',
        [$username]
    );
}
