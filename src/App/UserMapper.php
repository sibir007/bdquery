<?php


namespace App;


class UserMapper
{
				private $pdo;


				public function __construct(\PDO $pdo)
				{
								$this->pdo = $pdo;
				}
				public function save(User $user)
				{
								$stmtUser = $this->pdo->prepare("INSERT INTO users3 (name) VALUES (?)");
								$stmtUser->execute([$user->getName()]);
								$user->setId($this->pdo->lastInsertId());
								$stmUser_Photos = $this->pdo->prepare("INSERT INTO user_photos (user_id, name, filepath) VALUES (:user_id, :name, :filepath);");
								$userPhotos = $user->getPhotos();
								foreach ($userPhotos as $photo)
								{
												$stmUser_Photos->execute([':user_id' => $user->getId(),
																':name' => $user->getName(),
																':filepath' => $photo->getFilepath()
												]);
								}
				}
}
