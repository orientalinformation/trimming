<form method="post" enctype="multipart/form-data" action="upload.php">
    <p>max file can upload:<?=ini_get('upload_max_filesize')?>)</p>
    <input name="file" id="file" type="file" multiple="multiple" />
    From time<input name="fromTime" type="input" />
    End time<input name="endTime" type="input" />
    <input type="submit" value="uploadfile" name="submit">
</form>