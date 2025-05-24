<?php
$all_val=0;
require_once('my_connection.php');

if(isset($_POST['category_ids'])) {
    $category_ids = json_decode($_POST['category_ids']);  // Decoding the JSON array

    if (in_array('0', $category_ids)) {
        echo '<input type="checkbox" name="item_id[]" value="'.$all_val.'" class="form-check-input item" id="item_all" onchange="ajaxCall()" checked>';
        echo '<label for="item_all">All</label><br>';
        $sql = mysqli_query($my_connection, "SELECT id, item_name FROM items");
        while ($row = mysqli_fetch_array($sql)) {
            $id = $row['id'];
            $item_name = $row['item_name'];
            echo '<input type="checkbox" name="item_id[]" value="'.$id.'" class="form-check-input item" id="item" onchange="ajaxCall()">';
            echo '<label for="item">' . $item_name . '</label><br>';
        }
    } else {
        // Handle the case when specific categories are selected
        $category_ids_str = implode(',', $category_ids);  // Convert array to comma-separated string
        echo '<input type="checkbox" name="item_id[]" value="'.$all_val.'" class="form-check-input item" id="item_all" onchange="ajaxCall()" checked>';
        echo '<label for="item_all">All</label><br>';
        $sql = mysqli_query($my_connection, "SELECT id, item_name FROM items WHERE category_id IN ($category_ids_str)");
        while ($row = mysqli_fetch_array($sql)) {
            $id = $row['id'];
            $item_name = $row['item_name'];
            echo '<input type="checkbox" name="item_id[]" value="'.$id.'" class="form-check-input item" id="item" onchange="ajaxCall()">';
            echo '<label for="item">' . $item_name . '</label><br>';
        }
    }
    
}
?>
