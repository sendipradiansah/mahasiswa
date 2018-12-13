
<label for="errors"><?php echo validation_errors(); ?> </label>

<form method="post">
	<table>
		<div>
		<label>NIM :</label>
		<input type="text" name="nim" value="<?php echo $mahasiswa['nim']; ?>">
		</div><br />
		<div>
			<label>Nama :</label>
			<input type="text" name="nama" value="<?php echo $mahasiswa['nama']; ?>">
		</div><br />
		<div>
			<label>Jurusan :</label>
			<input type="text" name="jurusan" value="<?php echo $mahasiswa['jurusan']; ?>">
		</div><br />
	</table>
	<button type="submit">Simpan</button>
</form>
