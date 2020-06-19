<?php
include '../../../config/config.php';
$id=$_POST["parent_id"];
$level=$_POST["level"];
if($level == 1 ){
    $result = mysqli_query($con,"SELECT * FROM subcategory where parent_id IS NULL and category_id=$id");
}
else {
    $result = mysqli_query($con,"SELECT * FROM subcategory where parent_id=$id");
}
?>

<option>--Please select-- </option>
<?php
while($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
    <?php
}
?>
