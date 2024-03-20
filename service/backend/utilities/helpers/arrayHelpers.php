<?php

/**
* arrayHelpers.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/

/**
 * @param array $array
 * @return array
 */
function encodeForWriting($array)
{
    foreach ($array as $property => $value) {
        if (is_string($value)) {
            $array[$property] = iconv('UTF-8', 'ISO-8859-1', $value);
        }
    }
    return $array;
}
/**
 * @param object $obj
 * @return array
 */
function objToAssociativeArray($obj)
{
    foreach ($obj as $property => $value) {
        if (is_string($value)) {
            $obj->$property = iconv('ISO-8859-1', 'UTF-8', $value);
        }
    }
    return json_decode(json_encode($obj), true);
}
/**
 * @param array $array
 * @param bool $recursive
 * @return array $array
 */
function removeNumericIndices($array, $recursive = true)
{
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            if ($recursive && is_array($value)) {
                $value = removeNumericIndices($value);
            }
            if (is_numeric($key)) {
                unset($array[$key]);
            }
        }
    }
    return $array;
}
