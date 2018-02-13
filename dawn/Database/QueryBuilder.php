<?php

class QueryBuilder
{
    public static function query($sql)
    {
        $statement = $instance->db->prepare($sql);
        $statement->execuite();
    }
}
