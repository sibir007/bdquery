<?php
include __DIR__ .  '/../vendor/autoload.php';

print_r(\PDO::getAvailableDrivers());
$opt = [
		\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
		\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ];
$host = '127.0.0.1';
$db = 'test1';
$user = 'postgres';
$pass = '12345678';
$charset = 'UTF8';
$dsn = "pgsql:host=$host;dbname=$db";
$pdo = new \PDO($dsn, $user, $pass, $opt);

$pdo->exec("drop table users2");
$pdo->exec("create table users2 (id integer, name text, age integer)");

$pdo->exec("insert into users2 values (3, 'adel', 22)");
$pdo->exec("insert into users2 values (3, 'ivan', 22)");
$pdo->exec("insert into users2 values (3, 'pavel', 22)");
$pdo->exec("insert into users2 values (3, 'kola', 21)");
$pdo->exec("insert into users2 values (3, 'iula', 22)");
$pdo->exec("insert into users2 values (33333, 'dkj45adel')");
$query = new \App\Query($pdo, 'users2');
//echo "data";
//print_r($query->data);

$query = $query->where('id', '3'); //->where('age', 21);
//echo "data past";
//print_r($query->data);

$query = $query->select('id', 'name');
$query->count() == sizeof($query->all());
$coll = $query->map(function ($row) {
    return $row['id'] . '-' . $row['name'];
});
print_r($coll); 

// SELECT * FROM users WHERE from = 'github' AND id = 3 AND age = 21;
//print_r($query->data);
//$query->toSql();
//$res = $query->all();
//echo "<pre> sql   ";
//print_r($res);
//echo "<pre> sql";
