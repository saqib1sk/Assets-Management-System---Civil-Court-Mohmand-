db_import.php<?php
require_once('my_connection.php');
if(isset($_GET['db_Name'])) {
    $filename = $_GET['db_Name'];
    $handle = fopen("dbBackup/$filename","r+");
    $contents = fread($handle,filesize("dbBackup/$filename"));
    $sql = explode(';', $contents);
    $success = true;

    foreach($sql as $query){
        if(trim($query) != '') {
            $result = mysqli_query($my_connection, $query);
            if(!$result) {
                $success = false;
                break;
            }
        }
    }
    fclose($handle);
    if($success) {
        echo "<script>alert('Database restored successfully!');</script>";
    } else {
        echo "<script>alert('Database restore failed. Please try again.');</script>";
    }
    
    echo "<script>window.location.href = 'index.php'</script>";
}

?>
