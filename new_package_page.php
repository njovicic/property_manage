<?php
$subTitle = "new_package_page";
require_once('head.php');
// print_r($_SESSION);
?>
<?php if($u_name) {?>
<form class="form-ajax-post"
      data-action="./main/control.php?act=create_package"
      data-url="view_package_page.php">
    <h3 class="title">Create New Package for Property x</h3>
    <div class="form-group">
        <label>Interior Notes: </label>
        <input name="packInt" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Exterior Notes: </label>
        <input name="packExt" type="text" class="form-control"/>
    </div>
    <div id="itemDiv" class="form-group">
        <label>Location: </label>
        <select id="itemloc1">
            <?php $locations = listLocations();foreach($locations as $k=>$v){?>
                <option value=<?php echo $v["locId"]?>><?php echo $v["locName"]?></option>
            <?php }?>
        </select>
        <label>Item: </label>
        <select id="item1">
            <?php $items = listItems();foreach($items as $k=>$v){?>
                <option value=<?php echo $v["itemId"]?>><?php echo $v["itemName"]?></option>
            <?php }?>
        </select><br>
    </div>
    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Create Package</button><br>
        <input type="hidden" id="itemCount" value="1" />
        <button id="addItem" type="button">Add Item</button><br>
        <button id="itemList" type="button">Item Locations</button>
    </div>
    <div>
</form>
<?php }else{?>
    <h3 class="title">Please login/register first</h3>
<?php }

function insertItem(){

}
?>

<?php require_once('foot.php'); ?>