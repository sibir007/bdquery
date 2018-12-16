<?php
include __DIR__ .  '/../vendor/autoload.php';

$userr = new \App\User('Dima');
$userr->addPhoto('family', '/path/to/photo/family');
$userr->addPhoto('party', '/path/to/photo/party');
$userr->addPhoto('friends', '/path/to/photo/friends');

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

$pdo->exec("drop table if exists users3");
$pdo->exec("drop table if exists user_photos");

$pdo->exec("drop sequence if exists serial1");
$pdo->exec("create sequence serial1");

$pdo->exec("drop sequence if exists serial2");
$pdo->exec("create sequence serial2");

$pdo->exec("create table users3 (id integer primary key default nextval('serial1'), name text)");

$pdo->exec("create table user_photos (id integer primary key default nextval('serial2'), user_id integer, name text, filepath text)");

$mapper = new \App\UserMapper($pdo);
$mapper->save($userr);

$selUser = $pdo->query("select * from users3");
var_dump($selUser->fetchAll());
$selPhoto = $pdo->query("select * from user_photos");
var_dump($selPhoto->fetchAll());

