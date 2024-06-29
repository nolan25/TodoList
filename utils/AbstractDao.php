<?php

	require (ROOT . '/utils/BaseDao.php');

	abstract class AbstractDao implements BaseDao {

		public abstract function fetchAll();

		abstract public function fetch($id);

                abstract public function insert($entity);

                abstract public function update($entity, $id);

                abstract public function delete($id);


	}

?>
