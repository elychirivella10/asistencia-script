<?php 

	class DB {
		private $dbHost = '172.16.0.8:3306';
		
		private $dbUser = 'root';
		private $dbPass = 'dEC0DpfDlBbc';
		
		public function connection ($dbName) {
			$conec = new mysqli ($this->dbHost , $this->dbUser , $this->dbPass , $dbName);
			return $conec;
		}
		
	}

 ?>