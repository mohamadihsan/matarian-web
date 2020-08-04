<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<fieldset>
<legend>Form Upload Excel</legend>
<form method="post" enctype="multipart/form-data" action="<?= site_url('test/import') ?>">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile">
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>
</fieldset>
</body>
</html>