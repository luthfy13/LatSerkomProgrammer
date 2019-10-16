<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php

class Mahasiswa{
	private $nim;
	private $nama;
	private $telp;

	function __construct($nim, $nama, $telp){
		$this->nim = $nim;
		$this->nama = $nama;
		$this->telp = $telp;
	}

	public function getNim(){
		return $this->nim;
	}

	public function getNama(){
		return $this->nama;
	}

	public function getTelp(){
		return $this->telp;
	}

}

class File{
	private $namaFile;
	public function simpanFile($namaFile, $arrayData){
		file_put_contents($namaFile, serialize($arrayData));
	}
	public function bacaFile($namaFile){
		$hasil = unserialize(file_get_contents($namaFile));
		return $hasil;
	}
}

class Operasional{
	private $arrayMhs;
	public function prosesSimpan($nim, $nama, $telp){
		for($j=0; $j<sizeOf($nim); $j++)
			$this->arrayMhs[$j] = new Mahasiswa($nim[$j], $nama[$j], $telp[$j]);
		return $this->arrayMhs;
	}

	public function tampilData($arrayMhs){
		for($j=0; $j<sizeOf($arrayMhs); $j++){
			echo "Nomor Induk: ".$arrayMhs[$j]->getNim();
			echo "  Nama: ".$arrayMhs[$j]->getNama();
			echo "  Telp: ".$arrayMhs[$j]->getTelp();
			echo "<br>";
		}
	}
}

	$mhs = array();
	$i=0;
	if (isset($_POST["txtJmlBaris"]))
		$jmlBaris = $_POST["txtJmlBaris"];
	else
		$jmlBaris = 1;

	if (isset($_POST["btnSimpan"])){
		$arrayNim = $_POST['txtNim'];
		$arrayNama = $_POST['txtNama'];
		$arrayTelp = $_POST['txtTelp'];
		
		//buat objek operasional
		$op = new Operasional();
		
		//simpan ke arrayMahasiswa
		$arrayMhs = $op->prosesSimpan($arrayNim, $arrayNama, $arrayTelp);

		//tampil data
		$op->tampilData($arrayMhs);
		$jmlBaris = 1;
	}

	if (isset($_POST["btnSimpanFile"])){
		$arrayNim = $_POST['txtNim'];
		$arrayNama = $_POST['txtNama'];
		$arrayTelp = $_POST['txtTelp'];

		//buat objek operasional
		$op = new Operasional();

		//buat objek file
		$file = new File();
		//simpan ke file
		$arrayMhs = $op->prosesSimpan($arrayNim, $arrayNama, $arrayTelp);
		$file->simpanFile("dataMhs.arr", $arrayMhs);

		$jmlBaris = 1;
		
	}

	if (isset($_POST["btnBacaFile"])){
		$file = new File();
		$arrayMhs = $file->bacaFile('dataMhs.arr');
		
		//buat objek operasional
		$op = new Operasional();
		
		//tampil data
		$op->tampilData($arrayMhs);
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
			echo "<td><input type='text' name='txtNim[]'></td>";
			echo "<td><input type='text' name='txtNama[]'></td>";
			echo "<td><input type='text' name='txtTelp[]'></td>";
			echo "</tr>";
		}
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