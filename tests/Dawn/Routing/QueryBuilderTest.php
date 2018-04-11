<?php

declare (strict_types = 1);

use PHPUnit\Framework\TestCase;
use Dawn\Database\QueryBuilder;

final class QueryBuilderTest extends TestCase
{
    public function testSelectEverythingWhenNoParameters()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->select();

        $this->assertSame(
            "SELECT *",
            $queryBuilder->getQuery()
        );
    }

    public function testSelectOneColumn()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->select("column");

        $this->assertSame(
            "SELECT column",
            $queryBuilder->getQuery()
        );
    }

    public function testSelectColumns()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->select(["column1", "column2"]);

        $this->assertSame(
            "SELECT column1, column2",
            $queryBuilder->getQuery()
        );
    }

    public function testFromEverythingWhenNoParameters()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->from();

        $this->assertSame(
            " FROM *",
            $queryBuilder->getQuery()
        );
    }

    public function testFromOneColumn()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->from("column");

        $this->assertSame(
            " FROM column",
            $queryBuilder->getQuery()
        );
    }

    public function testFromColumns()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->from(["column1", "column2"]);

        $this->assertSame(
            " FROM column1, column2",
            $queryBuilder->getQuery()
        );
    }

    public function testWhere()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->where("column", "=", "value");

        $this->assertSame(
            " WHERE column='value'",
            $queryBuilder->getQuery()
        );
    }

    public function testAnd()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->and("column", "=", "value");

        $this->assertSame(
            " AND column='value'",
            $queryBuilder->getQuery()
        );
    }

    public function testOr()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->or("column", "=", "value");

        $this->assertSame(
            " OR column='value'",
            $queryBuilder->getQuery()
        );
    }

    public function testCompareString()
    {
        $queryBuilder = new QueryBuilder();

        $this->assertSame(
            " WORD column='value'",
            $queryBuilder->compare("WORD", "column", "=", "value")
        );
    }

    public function testCompareNumber()
    {
        $queryBuilder = new QueryBuilder();

        $this->assertSame(
            " WORD column=1",
            $queryBuilder->compare("WORD", "column", "=", 1)
        );
    }

    public function testCompareLike()
    {
        $queryBuilder = new QueryBuilder();

        $this->assertSame(
            " WORD column LIKE 'value'",
            $queryBuilder->compare("WORD", "column", "like", "value")
        );
    }

    public function testInsert()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->insert('table', ['column1' => 'value1', 'column2' => 1]);

        $this->assertSame(
            "INSERT INTO table (column1, column2) VALUES ('value1', 1)",
            $queryBuilder->getQuery()
        );
    }

    public function testFullQuery()
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->select(['column1, column2'])->from(['column1, column2'])->where('column1', 'like', 'value')->and('column2', '=', 1);

        $this->assertSame(
            "SELECT column1, column2 FROM column1, column2 WHERE column1 LIKE 'value' AND column2=1",
            $queryBuilder->getQuery()
        );
    }
}

