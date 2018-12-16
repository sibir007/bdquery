<?php


namespace App;


class User
{
				private $photos;
				private $id;
				private $name;



				public function __construct($name)
				{
								$this->name = $name;
				}


				public function getId()
				{
								return $this->id;
				}


				public function getName()
				{
								return $this->name;
				}


				public function setId($id)
				{
								$this->id = $id;
				}


				public function addPhoto($name, $filepath)
				{
								$photo = new Photo($this, $name, $filepath);
								$this->photos[] = $photo;
				}


				public function getPhotos()
				{
								return $this->photos;
				}
}
