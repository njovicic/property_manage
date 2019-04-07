<?php
$subTitle = "edit_item_page";
require_once('head.php');
$id = $_GET["id"];
$sql = "SELECT * FROM item WHERE itemId = '$id'";
$item = TCommon::getOne($sql);
//print_r($item);
?>
<form class="form-ajax-post"
      data-action="./main/control.php?act=edit_item"
      data-url="list_item_page.php">
    <h3 class="title">Edit <?php echo $item['itemName'] ?></h3>
    <input type="hidden" value="<?php echo $id?>" name="id" />
    <div class="form-group">
        <label>Item name:</label>
        <input name="itemName" type="text" value="<?php echo $item['itemName']?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Description:</label>
        <input name="itemDescription" type="text" value="<?php echo $item['itemDescription']?>" class="form-control"/>
    </div>

    <div class="form-group">
        <label>Standard:</label>
        <select name="itemStandard" value="<?php echo $item['itemStandard']?>">
            <option value="1">1</option>
            <option value="0">0</option>
        </select>
    </div>

    <div class="form-group">
        <label>Type:</label>
        <select name="itemType" value="<?php echo $item['ItemType_typeId']?>">
        <?php $types = listTypes();foreach($types as $k=>$v){?>
            <option value=<?php echo $v["typeId"]; if ($item['ItemType_typeId'] === $v["typeId"]){" selected";}?>><?php echo $v["typeName"]?></option>
        <?php }?>
        </select>
    </div>

    <div class="form-group">
        <label>Manufacturer:</label>
        <select name="itemManufacturer" value="<?php echo $item['ItemManufacturer_manuId']?>">
        <?php $manus = listManus(); foreach($manus as $p=>$j) {?>
            <option value=<?php echo $j["manuId"]?>><?php echo $j["manuName"]?></option>
        <?php }?>
        </select>
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Submit</button>
    </div>
</form>

<?php require_once('foot.php'); ?>