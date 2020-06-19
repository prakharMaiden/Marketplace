<?php
include '../../../config/config.php';
$category_id=$_POST["category_id"];
$result = mysqli_query($con,"SELECT * FROM category where parent_id=$category_id");
?>

<option>--Please select-- </option>
<?php
while($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"];?>"><?php echo $row["name"];?></option>
    <?php
}
?>
