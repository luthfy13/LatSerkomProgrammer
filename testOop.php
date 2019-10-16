<?php
	class Mahasiswa{
		protected $nim;

		public function setNim($nim){
			$this->nim = $nim;
		}

	}

	class MahasiswaTeknik extends Mahasiswa{
		public function getNimTeknik(){
			return $this->nim;
		}
	}


	$mhs = new MahasiswaTeknik();
	$mhs->setNim("001");
	echo $mhs->getNimTeknik();
?>