<?php 
	/**
	 * This is a Model example.
	 * File naming convention: always capital first letter and singular.
	 * Following the MVC pattern, you should make all of your scripting logic and
	 * database operations here and send them through the Controller to the View.
	 */
	class Post {
		private $db;

		public function __construct(){
			$this->db = new Database();
		}

		//This is a method example
		public function postsNumber(){
			return $this->db->rowCount();
		}

	}