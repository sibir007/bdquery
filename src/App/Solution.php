<?php


namespace App\Solution;


function like($pdo, array $params)
{
				if (count($params) == 0) {
								$sql = "SELECT id FROM users4;";
				} else {
								$paramsKeys = array_keys($params);
								$sqlPartArr = array_reduce($paramsKeys, function ($acc, $item) use ($params) {
												$acc[] = "$item LIKE ?";
												return $acc;
								},[]);

								$sqlPartStr = implode(" OR ", $sqlPartArr);
								$sql = "SELECT  email FROM users4 WHERE " . $sqlPartStr . ";";
				}
				$sth = $pdo->prepare($sql);
				$values = array_values($params);
				$sth->execute($values);
				$res = $sth->fetchAll();
				return $res;
}
