<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
class Mahasiswa{
	public $nim;
	public $nama;
	public $telp;
	function __construct($nim, $nama, $telp){
		$this->nim = $nim;
		$this->nama = $nama;
		$this->telp = $telp;
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
			echo "Nomor Induk: ".$mhs[$j]->nim;
			echo "  Nama: ".$mhs[$j]->nama;
			echo "  Telp: ".$mhs[$j]->telp;
			echo "<br>";
		}
		$jmlBaris = 1;
	}

	if (isset($_POST["btnSimpanFile"])){
		for($j=0; $j<$_SESSION["jml"]; $j++){
			$mhs[$j] = new Mahasiswa($_POST["txtNim".$j], $_POST["txtNama".$j], $_POST["txtTelp".$j]);
		}
		$jmlBaris = 1;
		file_put_contents('dataMhs.arr', serialize($mhs));
	}

	if (isset($_POST["btnBacaFile"])){
		$arrayMhs = unserialize(file_get_contents('dataMhs.arr'));
		for($j=0; $j<count($arrayMhs); $j++){
			echo "Nomor Induk: ".$arrayMhs[$j]->nim;
			echo "  Nama: ".$arrayMhs[$j]->nama;
			echo "  Telp: ".$arrayMhs[$j]->telp;
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