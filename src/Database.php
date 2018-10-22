<?php

/**
 * Class Database
 * Wrapper for MySQL DB to be used with this project
 */
class Database
{
    public function __construct()
    {
        $this->connect();
    }
    
    private function connect()
    {
        $params = $this->getConnectionParameters();
    }
    
    private function getConnectionParameters()
    {
        
    }
}