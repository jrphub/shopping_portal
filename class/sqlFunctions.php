<?php
    
    class SqlFunctions
    {
        /**
         * To Connect with database
         *
         * @return returns database connection object
         */
        function connectDatabase()
        {
            $dbConnection = mysql_connect(HOST, DB_USER, DB_PASSWORD);
            mysql_select_db(DATABASE);
            return $dbConnection;
        }
        
        /**
         * To execute any query and return the result
         *
         * @param str $query        Query to execute
         * @param int $returnType   Flag to confirm the return (1: result set, 2: fetched associated array (1 row), 3: affected rows, 4: number of rows, 5: last inserted id)
         * @return According to param $returnType varies
         */
        function executeQuery($query, $returnType = 0)
        {
            if (!$dbConnection) {
                $dbConnection = self::connectDatabase();
            }
            $resultSet = mysql_query($query, $dbConnection);
            if ($resultSet) {
                if ($returnType == 5)
                    $inserted_id = mysql_insert_id($dbConnection);
                //mysql_close($dbConnection);
                switch ($returnType) {
                    case 1:
                        return $resultSet;
                        break;
                    case 2:
                        if ($resultSet)
                            return mysql_fetch_array($resultSet);
                        else
                            die('<b>Error in executing query: </b>' . $query);
                        break;
                    case 3:
                        return mysql_affected_rows($dbConnection);
                        break;
                    case 4:
                        return mysql_num_rows($resultSet);
                        break;
                    case 5:
                        return $inserted_id;
                        break;
                    default:
                        return;
                        break;
                }
            } else {
                echo "Error in SQL Operation";
                return;
            }
        }
        
        /**
         * To create inert query
         *
         * @param str $tableName            Name of the table
         * @param array $insertValueArray   Array contains table field names as key and value as value
         * @return str Returns the insert query
         */
        function createInsertQuery($tableName, $insertValueArray)
        {
            $insertQuery = "INSERT INTO " . $tableName . " (";
            foreach (array_keys($insertValueArray) as $insertField)
            {
                $insertQuery .= $insertField . ", ";
            }
            $insertQuery = substr($insertQuery, 0, -2);
            $insertQuery .= ") VALUES(";
            foreach (array_values($insertValueArray) as $insertValue)
            {
                if (substr($insertValue, 0, 1) == "'") {
                    if (!$dbConnection) {
                        $dbConnection = self::connectDatabase();
                    }
                    $insertQuery .=  "'" . mysql_real_escape_string(substr($insertValue, 1, -1), $dbConnection) . "', ";
                } else
                    $insertQuery .= $insertValue . ", ";
            }
            $insertQuery = substr($insertQuery, 0, -2);
            $insertQuery .= ")";
            return $insertQuery;
        }
    
        /**
         * To create update query
         *
         * @param str $tableName            	Name of the table
         * @param array $updateValueArray   	Array contains table field names as key and value as value
         * @param array $updateConditionsArray	Array contains table field names as key and value as value for conditions
         * @return str Returns the insert query
         */
        function createUpdateQuery($tableName, $updateValueArray, $updateConditionsArray)
        {
            $updateQuery = "UPDATE " . $tableName . " SET ";
            foreach ($updateValueArray as $updateField => $updateValue)
            {
                if (substr($updateValue, 0, 1) == "'") {
                    if (!$dbConnection) {
                        $dbConnection = self::connectDatabase();
                    }
                    $updateQuery .= $updateField . " = '" . mysql_real_escape_string(substr($updateValue, 1, -1), $dbConnection) . "', ";
                } else
                    $updateQuery .= $updateField . " = ". $updateValue . ", ";
            }
            $updateQuery = substr($updateQuery, 0, -2);
            $updateQuery .= " WHERE ";
            foreach ($updateConditionsArray as $conditions => $values)
            {
                if (is_array($values)) {
                    $allValues = implode(',', $values);
                    $updateQuery .= $conditions . " IN (" . $allValues . ") AND ";
                } else {
                    if (substr($values, 0, 1) == "'") {
                        if (!$dbConnection) {
                            $dbConnection = self::connectDatabase();
                        }
                        $updateQuery .= $conditions . " = '" . mysql_real_escape_string(substr($values, 1, -1), $dbConnection) . "' AND ";
                    } else
                        $updateQuery .= $conditions . " = " . $values . " AND ";
                }
            }
            $updateQuery = substr($updateQuery, 0, -5);
            return $updateQuery;
        }
    }