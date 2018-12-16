<?php


namespace App;


class Query
{
private $pdo;
private $where = [];
public $data = ['select' => '*',	'where' => []]; 

public function __construct($pdo, $table, $data = null) 
{
	$this->pdo = $pdo;
	$this->table = $table;
	if ($data) {
		$this->data = $data;
	}
}


public function count()
{
	return count($this->all());
}


public function map($func)
{
	$arr = $this->all();
	return array_map($func, $arr);
}



public function select(...$arguments)
{
	$data['select'] = $this->data['select'] . ', ' . implode(', ', $arguments);
	$data['where'] = $this->data['where'];
	return $this->getClone($data);
}


public function where($key, $value)
{
	$data['where'] = array_merge($this->data['where'], [$key => $value]);
	$data['select'] = $this->data['select'];
	return $this->getClone($data);
}


public function all()
{
return $this->pdo->query($this->toSql())->fetchAll();
}




public function toSql()
{
	$sqlParts = [];
	$sqlParts[] = "SELECT {$this->data['select']}  FROM {$this->table}";
	if ($this->data['where']) {
		$where = $this->buildWhere();
		$sqlParts[] = "WHERE $where";
	}
	return implode(' ', $sqlParts);
}


private function buildWhere()
{
	return implode(' AND ', array_map(function ($key, $value) {
		$quotedValue = $this->pdo->quote($value);
		return "$key = $quotedValue";
	}, array_keys($this->data['where']), $this->data['where']));
}

private function getClone($data)
{
	return new self($this->pdo, $this->table, $data);
}



}
