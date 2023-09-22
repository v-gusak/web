<?php

interface QueryBuilder
{
    public function select(string $columns): QueryBuilder;
    public function where(string $condition): QueryBuilder;
    public function limit(int $limit): QueryBuilder;
    public function getSQL(): string;
}

class PostgreSQLQueryBuilder implements QueryBuilder
{
    private $query;

    public function select($columns): QueryBuilder
    {
        $this->query = "SELECT " . implode(", ", $columns);
        return $this;
    }

    public function where($condition): QueryBuilder
    {
        $this->query .= " WHERE " . $condition;
        return $this;
    }

    public function limit($limit): QueryBuilder
    {
        $this->query .= " LIMIT " . $limit;
        return $this;
    }

    public function getSQL(): string
    {
        return $this->query;
    }
}

class MySQLQueryBuilder implements QueryBuilder
{
    private $query;

    public function select($columns): QueryBuilder
    {
        $this->query = "SELECT " . implode(", ", $columns);
        return $this;
    }

    public function where($condition): QueryBuilder
    {
        $this->query .= " WHERE " . $condition;
        return $this;
    }

    public function limit($limit): QueryBuilder
    {
        $this->query .= " LIMIT " . $limit;
        return $this;
    }

    public function getSQL(): string
    {
        return $this->query;
    }
}

$postgreSQLQueryBuilder = new PostgreSQLQueryBuilder();
$query = $postgreSQLQueryBuilder->select(['name', 'email'])
    ->where('age > 30')
    ->limit(10)
    ->getSQL();

echo "PostgreSQL Query: $query\n";

$mySQLQueryBuilder = new MySQLQueryBuilder();
$query = $mySQLQueryBuilder->select(['name', 'email'])
    ->where('age > 30')
    ->limit(10)
    ->getSQL();

echo "MySQL Query: $query\n";

?>