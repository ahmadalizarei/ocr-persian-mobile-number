<?php
$txt=$_POST['word'];
$fName=$_POST['name'];
$myfile = file_put_contents($fName.".txt", $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
?>