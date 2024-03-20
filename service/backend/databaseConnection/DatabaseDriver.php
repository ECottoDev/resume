<?php

/**
* DatabaseDriver.js
*
* @author Edwin Cotto <cottosoftwaredevelopment@gmail.com>>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-March-15 initial version
*/


require_once __DIR__ . DIRECTORY_SEPARATOR . '../../envSettings-backend.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../utilities/helpers/helpers.php';

class DatabaseDriver
{
    private $connection = false;
    /**
     * @param array $database Database for operations. See envSettings-backend.php
     * @param bool $autoCommit Defaults to true. If set to false, calling the commit/rollBack methods manually is required after process
     * @return resource Database handler
     */
    public function __construct(private array $database, private bool $autoCommit = true)
    {
        $this->setConnection();
    }
    // Setters
    /**
     * Establishes the connection to the selected database
     * @return resource $connection
     */
    private function setConnection()
    {
        //set connection to mysql database
        $this->connection = mysqli_connect($this->database['Hostname'],$this->database['Username'], $this->database['Password'], $this->database['Database'], $this->database['Port']);
        return $this->connection;

        // try {
        //     $this->connection = mysqli_connect($this->database['serverAddress'], $this->database['connectionString']);
        //     !$this->autoCommit && $this->beginTransaction();
        // } catch (\Throwable $e) {
        //     error_log($e);
        // }
        // return $this->connection;
    }
    // Getters
    /**
     * Returns the connection to the selected database
     * @return resource $connection
     */
    private function getConnection()
    {
        return $this->connection ? $this->connection : $this->setConnection();
    }
    // General Methods
    /**
     * Close the database connection
     * @return bool
     */
    private function closeConnection()
    {
        return  $this->connection && mysqli_close($this->connection);
    }
    private function beginTransaction()
    {
        return mysqli_begin_transaction($this->connection);
    }
    /**
     * Commit database transaction
     */
    public function commit()
    {
        return mysqli_commit($this->connection) && $this->closeConnection();
    }
    public function rollBack()
    {
        return mysqli_rollback($this->connection) && $this->closeConnection();
    }
    /**
     * Insert to database
     * @param string $sql
     * @param array $params
     * @return array $output
     */
    public function insert($sql, $params = [])
    {
        //insert into mysql database
        $output = null;
        try {
            if ($this->getConnection()) {
                $stmt = mysqli_prepare($this->connection, $sql);
                if (!$stmt) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                $success = mysqli_stmt_execute($stmt);
                if ($success !== false) {
                    $output = mysqli_insert_id($this->connection);
                }
                if ($success == false) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                mysqli_stmt_close($stmt);
            }
            return mysqli_error_list($this->connection) ? [
                'success' => false,
                'result' => [],
                'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), mysqli_error_list($this->connection))
            ] :  [
                'success' => true,
                'result' => $output,
                'errorMsg' => []
            ];
        } catch (\Throwable $e) {
            error_log($e);
            $this->rollBack();
            return [
                'success' => false,
                'result' => [],
                'errorMsg' => $e
            ];
        }


        // $output = null;
        // try {
        //     if ($this->getConnection()) {
        //         $resource = sqlsrv_query($this->connection, $sql, $this->database['UTF8Encode'] ? encodeForWriting($params) : $params);
        //         if ($resource !== false) {
        //             $nextResult = sqlsrv_next_result($resource);
        //             if ($nextResult) {
        //                 $output = $this->database['UTF8Encode'] ? objToAssociativeArray(sqlsrv_fetch_object($resource)) : sqlsrv_fetch_array($resource, SQLSRV_FETCH_ASSOC);
        //             }
        //         }
        //     }
        //     return sqlsrv_errors() ? [
        //         'success' => false,
        //         'result' => [],
        //         'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), sqlsrv_errors())
        //     ] : [
        //         'success' =>  true,
        //         'result' =>  $output,
        //         'errorMsg' => []
        //     ];
        // } catch (\Throwable $e) {
        //     error_log($e);
        //     $this->rollBack();
        //     return [
        //         'success' => false,
        //         'result' => [],
        //         'errorMsg' => $e
        //     ];
        // }
    }
    /**
     * Read from database
     * @param string $sql
     * @param array $params
     * @return array $results
     */
    public function select($sql)
    {
        //select from mysql database
        $results = [];

        try {
            if ($this->getConnection()) {
                $stmt = mysqli_prepare($this->connection, $sql);
                if (!$stmt) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                $success = mysqli_stmt_execute($stmt);
                if ($success !== false) {
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $results[] = $row;
                    }
                }
                if ($success == false) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                mysqli_stmt_close($stmt);
            }
            return mysqli_error_list($this->connection) ? [
                'success' => false,
                'result' => [],
                'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), mysqli_error_list($this->connection))
            ] :  [
                'success' => true,
                'result' => $results,
                'errorMsg' => []
            ];
        } catch (\Throwable $e) {
            error_log($e);
            $this->rollBack();
            return [
                'success' => false,
                'result' => [],
                'errorMsg' => $e
            ];
        }



        // $rowArray = array();
        // try {
        //     if ($this->getConnection()) {
        //         $stmt = sqlsrv_prepare($this->connection, $sql, $params);
        //         if (!$stmt) {
        //             error_log(json_encode(sqlsrv_errors()), true);
        //         }
        //         if (!sqlsrv_execute($stmt)) {
        //             error_log(json_encode(sqlsrv_errors()), true);
        //         }
        //         while ($row = $this->database['UTF8Encode'] ? sqlsrv_fetch_object($stmt) : sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        //             $rowArray[] = $this->database['UTF8Encode'] ?  objToAssociativeArray($row) : $row;
        //         }
        //         sqlsrv_free_stmt($stmt);
        //     } else {
        //         error_log(json_encode(sqlsrv_errors()), true);
        //     }
        //     return sqlsrv_errors() ? [
        //         'success' => false,
        //         'result' => [],
        //         'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), sqlsrv_errors())
        //     ] : [
        //         'success' =>  true,
        //         'result' =>  $rowArray,
        //         'errorMsg' => []
        //     ];
        // } catch (\Throwable $e) {
        //     error_log($e);
        //     $this->rollBack();
        //     return [
        //         'success' => false,
        //         'result' => [],
        //         'errorMsg' => $e
        //     ];
        // }
    }
    /**
     * Update rows
     * @param string $sql
     * @param array $params
     * @return bool $success
     */
    public function update($sql, $params)
    {
        //update mysql database
        $success = false;
        try {
            if ($this->getConnection()) {
                $stmt = mysqli_prepare($this->connection, $sql);
                if (!$stmt) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                $success = mysqli_stmt_execute($stmt);
                if ($success == false) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                mysqli_stmt_close($stmt);
            }
            return mysqli_error_list($this->connection) ? [
                'success' => false,
                'result' => [],
                'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), mysqli_error_list($this->connection))
            ] :  [
                'success' => true,
                'result' => $success,
                'errorMsg' => []
            ];
        } catch (\Throwable $e) {
            error_log($e);
            $this->rollBack();
            return [
                'success' => false,
                'result' => [],
                'errorMsg' => $e
            ];
        }



        // $success = false;
        // $output = null;
        // try {
        //     if ($this->getConnection()) {
        //         $stmt = sqlsrv_prepare($this->connection, $sql, $params);
        //         if (!$stmt) {
        //             error_log(json_encode(sqlsrv_errors()), true);
        //         }
        //         $success = sqlsrv_execute($stmt);
        //         if ($success !== false) {
        //             $nextResult = sqlsrv_next_result($stmt);
        //             if ($nextResult && $stmt) {
        //                 $output = $this->database['UTF8Encode'] ? objToAssociativeArray(sqlsrv_fetch_object($stmt)) : sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        //             }
        //         }
        //         if ($success == false) {
        //             error_log(json_encode(sqlsrv_errors()), true);
        //         }
        //         sqlsrv_free_stmt($stmt);
        //     }
        //     return sqlsrv_errors() ? [
        //         'success' => false,
        //         'result' => [],
        //         'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), sqlsrv_errors())
        //     ] :  [
        //         'success' => true,
        //         'result' => $output,
        //         'errorMsg' => []
        //     ];
        // } catch (\Throwable $e) {
        //     error_log($e);
        //     $this->rollBack();
        //     return [
        //         'success' => false,
        //         'result' => [],
        //         'errorMsg' => $e
        //     ];
        // }
    }
    public function executeStoredProcedure($sql, $params)
    {
        //execute stored procedure in mysql database
        $output = null;
        try {
            if ($this->getConnection()) {
                $stmt = mysqli_prepare($this->connection, $sql);
                if (!$stmt) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                $success = mysqli_stmt_execute($stmt);
                if ($success !== false) {
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $output[] = $row;
                    }
                }
                if ($success == false) {
                    error_log(json_encode(mysqli_error_list($this->connection)), true);
                }
                mysqli_stmt_close($stmt);
            }
            return mysqli_error_list($this->connection) ? [
                'success' => false,
                'result' => [],
                'errorMsg' => array_map(fn ($error) => removeNumericIndices($error), mysqli_error_list($this->connection))
            ] :  [
                'success' => true,
                'result' => $output,
                'errorMsg' => []
            ];
        } catch (\Throwable $e) {
            error_log($e);
            $this->rollBack();
            return [
                'success' => false,
                'result' => [],
                'errorMsg' => $e
            ];
        }}



    //     $valueArray = [];
    //     try {
    //         if ($this->getConnection()) {
    //             $stmt = sqlsrv_prepare($this->connection, $sql, $params);
    //             if (!$stmt) {
    //                 $this->rollback();
    //                 error_log(json_encode(sqlsrv_errors()), true);
    //             }
    //             $success = sqlsrv_execute($stmt);
    //             if ($success === false) {
    //                 $this->rollback();
    //                 error_log(json_encode(sqlsrv_errors()), true);
    //             }
    //             while ($row = $this->database['UTF8Encode'] ? sqlsrv_fetch_object($stmt) : sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    //                 $valueArray[] = $this->database['UTF8Encode'] ? objToAssociativeArray($row) : $row;
    //             }
    //             sqlsrv_free_stmt($stmt);
    //             return [
    //                 'success' => $success,
    //                 'result' => $valueArray
    //             ];
    //         }
    //     } catch (Exception $e) {
    //         $this->rollBack();
    //         error_log($e);
    //         return [
    //             'success' => false,
    //             'result' => null,
    //             'errorMsg' => $e
    //         ];
    //     }
    // }
}
