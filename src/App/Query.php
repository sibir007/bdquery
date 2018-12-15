<?php


namespace App;


class Query
{
private $pdo;
private $where = [];


public function __construct($pdo, $table, $where = [])
{
$this->pdo = $pdo;
$this->table = $table;
$this->where = $where;
}


public function where($key, $value)
{
$where = [$key => $value];
return $this->getClone($where);
}


public function all()
{
return $this->pdo->query($this->toSql())->fetchAll();
}


public function toSql()
{
	// BEGIN (write your solution here)
	$where = $this->where;
	if (count($where) != 0){
		$pdo = $this->pdo;
		$whereParamArr = array_reduce(array_keys($this->where), function ($acc, $item) use ($where, $pdo) { 
		// $qoteColl = $pdo->quote($item);
		$qoteParam = $pdo->quote($where[$item]);
		$qoteColl = ($item);
		// $qoteParam = ($where[$item]);
		$acc[] = "$qoteColl = $qoteParam";
		return $acc;
		}, []);
	$whereParamStr = implode(" And ", $whereParamArr);
	$sql = "SELECT * FROM $this->table WHERE $whereParamStr;";
	echo $sql;
	} else {
	$sql = "SELECT * FROM $this->table;";
	}
	return $sql; 
// END
}


private function getClone($where)
{
$mergedData = array_merge($this->where, $where);
return new self($this->pdo, $this->table, $mergedData);
}
}



