<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

class Orang{
	private $nama;
	public function setNama($nama){
		$this->nama = $nama;
	}
	public function getNama(){
		return $this->nama;
	}
}

class Mahasiswa extends Orang{
	private $nim;
	private $telp;

	function __construct($nim, $nama, $telp){
		$this->nim = $nim;
		parent::setNama($nama);
		$this->telp = $telp;
	}

	public function getNim(){
		return $this->nim;
	}

	public function getTelp(){
		return $this->telp;
	}

}

class OperasiFile{
	private $namaFile;
	private $dariFile;
	public function simpanFile($namaFile, $arrayData){
		file_put_contents($namaFile, serialize($arrayData));
	}
	public function bacaFile($namaFile){
		$this->dariFile = unserialize(file_get_contents($namaFile));
		return $this->dariFile;
	}
}

if (session_status() == PHP_SESSION_NONE)
	session_start();

	$mhs = array();
	$i=0;
	if (isset($_POST["txtJmlBaris"]))
		$jmlBaris = $_POST["txtJmlBaris"];
	else
		$jmlBaris = 1;

	if (isset($_POST["btnSimpan"]) && $_POST["txtNim0"] != ""){
		for($j=0; $j<$_SESSION["jml"]; $j++){
			$mhs[$j] = new Mahasiswa($_POST["txtNim".$j], $_POST["txtNama".$j], $_POST["txtTelp".$j]);
			echo "Nomor Induk: ".$mhs[$j]->getNim();
			echo "  Nama: ".$mhs[$j]->getNama();
			echo "  Telp: ".$mhs[$j]->getTelp();
			echo "<br>";
		}
		$jmlBaris = 1;
	}

	if (isset($_POST["btnSimpanFile"])){
		for($j=0; $j<$_SESSION["jml"]; $j++){
			$mhs[$j] = new Mahasiswa($_POST["txtNim".$j], $_POST["txtNama".$j], $_POST["txtTelp".$j]);
		}
		$jmlBaris = 1;
		$opFile = new OperasiFile();
		$opFile->simpanFile("dataMhs.arr", $mhs);
	}

	if (isset($_POST["btnBacaFile"])){
		$opFile = new OperasiFile();
		$arrayMhs = $opFile->bacaFile('dataMhs.arr');
		for($j=0; $j<count($arrayMhs); $j++){
			echo "Nomor Induk: ".$arrayMhs[$j]->getNim();
			echo "  Nama: ".$arrayMhs[$j]->getNama();
			echo "  Telp: ".$arrayMhs[$j]->getTelp();
			echo "<br>";
		}
		$jmlBaris = 1;
	}

?>
	<form action="" method="post">

		Masukkan Jumlah Baris <input type="text" name="txtJmlBaris"> <input type="submit" value="OK">
		<table>
			<tr>
				<th>No</th>
				<th>NIM</th>
				<th>Nama</th>
				<th>Telp</th>
			</tr>
<?php
		for($i=0; $i<$jmlBaris; $i++){
			echo "<tr>";
			echo "<td>".($i+1)."</td>";
			echo "<td><input type='text' name='txtNim".$i."'></td>";
			echo "<td><input type='text' name='txtNama".$i."'></td>";
			echo "<td><input type='text' name='txtTelp".$i."'></td>";
			echo "</tr>";
		}
		$_SESSION["jml"] = $i;
?>
		<tr><td colspan="4" align="right">
			<input type="submit" value="Simpan" name="btnSimpan">
			<input type="submit" value="Simpan -> File" name="btnSimpanFile">
			<input type="submit" value="Baca -> File" name="btnBacaFile">
		</td></tr>
		</table>
	</form>
</body>
</html>