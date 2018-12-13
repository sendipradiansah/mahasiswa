
<label for="errors"><?php echo validation_errors(); ?> </label>
<form method="post">
	<div>
		<label>NIM : </label> 
		<input type="text" name="nim" placeholder="NIM">
	</div><br />
	<div>
		<label>Nama : </label> 
		<input type="text" name="nama" placeholder="Nama">
	</div><br />
	<div>
		<label>Jurusan :</label> 
		<input type="text" name="jurusan" placeholder="Jurusan">
	</div><br />
	<button type="submit">Simpan</button>
</form>