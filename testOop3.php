<?php 
	abstract class BangunRuang{
		abstract public function luas();
	}

	class Persegi extends BangunRuang{
		public $s;
		public function __construct($s){
			$this->s = $s;
		}

		public function luas(){
			return $this->s * $this->s;
		}
	}

	class Segitiga extends BangunRuang{
		private $alas;
		private $tinggi;
		
		public function __construct($alas, $tinggi){
			$this->alas = $alas;
			$this->tinggi = $tinggi;
		}		

		public function luas(){
			return 0.5 * $this->alas * $this->tinggi;
		}
	}

	$p = new Persegi(10);
	echo $p->luas();

	echo "<br><br>";

	$p = new Segitiga(5, 10);
	echo $p->luas();

?>