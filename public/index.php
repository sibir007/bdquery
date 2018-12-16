<?php
include __DIR__ .  '/../vendor/autoload.php';

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

$pdo->exec("drop table if exists users4");
$pdo->exec("create table users4 (id integer, first_name text, email text)");

$pdo->exec("insert into users4 values (1, 'john', 'john@gmail.com')");
$pdo->exec("insert into users4 values (3, 'adel', 'adel@yahoo.org')");


$params = ['email' => '%gmail%', 'first_name' => 'ad%'];
$res = \App\Solution\like($pdo, $params);
echo "<pre>";
print_r($res);
echo "<pre>";

