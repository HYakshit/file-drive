<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET['nama'];
    $action = $_GET['action'];
    if ($action == 'download') {
        download($name);
    } else {
        show($name);
    }

}
function show($name)
{
    $file = $name;
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if($extension != 'txt'){
        die("Only text files can be opened");
    }
    $target_dir = "../admin/files/$extension";
    $path = $target_dir . '/' . $file;
    $myfile = fopen($path, "r") or  die("Unable to open file!");
    echo fread($myfile, filesize($path));
    fclose($myfile);
}
function download($name)
{
    $file = $name;
    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $target_dir = "../admin/files/$extension";
    $path = $target_dir . '/' . $file;
    if (file_exists($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}
?>