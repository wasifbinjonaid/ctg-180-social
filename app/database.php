<?php

    /**
     * Create connection to mysql database
     * 
     * @return mysqli instance
     */
    function connect()
    {
        return new mysqli(SERVER, USER, PASS, DB);
    }

    /**
     * Insert data into database table
     * 
     * @param string $sql sql query to insert data
     */
    function insert($sql)
    {
        connect()->query($sql);
    }

    /**
     * Update data into database table
     * 
     * @param string $sql sql query to Update data
     */
    function update($sql)
    {
        connect()->query($sql);
    }

    /**
     * Get all data from database
     * 
     * @param string $table database table
     * 
     * @return mysqli result
     */
    function all($table)
    {
        return connect()->query("SELECT * FROM {$table}");
    }

    /**
     * show filtered data
     * 
     * @param string $id id to filter data in table
     * 
     * @return mysqli object result
     */
    function show($id)
    {
        $data = connect()->query("SELECT * FROM users WHERE id='$id'");
        return $data->fetch_object();
    }

    /**
     * validate if data exist in table
     * 
     * @param string $table table name
     * @param string $col column name
     * @param string $val filter column with value
     * 
     * @return bool true or false
     */
    function dataCheck($table, $col, $val)
    {
        $data = connect()->query("SELECT {$col} FROM {$table} WHERE {$col}='$val'");

        if ($data->num_rows > 0) 
        {
            return false;
        } 
        else 
        {
            return true;
        }
}