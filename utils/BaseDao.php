<?php

	interface BaseDao {

		public function fetchAll();// returns all the records in the database

		public function fetch($id);// returns a record from the database

		public function insert($entity);// inserts a record into the database

		public function update($entity);// updates a record in the database

		public function delete($id);// deletes a record from the database

	}
?>
