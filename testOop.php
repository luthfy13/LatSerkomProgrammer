<?php
	class Mahasiswa{
		protected $nim;
		private $name;

		public function setNim($nim){
			$this->nim = $nim;
		}

		public function setNama($nama){
			$this->nim = $nama;
		}

	}

	class MahasiswaTeknik extends Mahasiswa{
		public function getNimTeknik(){
			return $this->nim;
		}
		public function getNamaTeknik(){
			return $this->nama;
		}
	}


	$mhs = new MahasiswaTeknik();
	
	//aman karena variabel $nim access modifier-nya protected
	$mhs->setNim("001");
	echo $mhs->getNimTeknik();

	//error karena variabel $nama access modifier-nya private
	//pesan error: "Notice: Undefined property: MahasiswaTeknik::$nama"
	$mhs->setNama("Hasan");
	echo $mhs->getNamaTeknik();

?>