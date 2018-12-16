<?php


namespace App;


class Photo
{
		private $user;
		private $name;
		private $filepath;


		public function __construct($user, $name, $filepath)
		{
				$this->user = $user;
				$this->name = $name;
				$this->filepath = $filepath;
		}


		public function getName()
		{
				return $this->name;
		}


		public function getFilepath()
		{
				return $this->filepath;
		}
}
