<?php

namespace Forteroche\Blog;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;
					dbname=fqrafr_p4;
					charset=utf8',
					'fqrafr_p4',
					'forteroche@2020');
        return $db;
    }
}