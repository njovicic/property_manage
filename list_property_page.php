<?php
$subTitle = "list_property_page";
require_once('head.php');
// print_r($_SESSION);
?>
<?php if($u_name) {?>
<form class="form-ajax-post"
      data-action="./main/control.php?act=create_property"
      data-url="list_property_page.php">
    <h3 class="title">Create New Property</h3>
    <div class="form-group">
        <label>Subdivision:</label>
        <input name="subdivName" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Block:</label>
        <input name="blockNumber" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Lot #:</label>
        <input name="lotNumber" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="propStatus">
            <option value="available">Available</option>
            <option value="on_hold">On Hold</option>
            <option value="cond_offer">Conditional Offer</option>
            <option value="firm_offer">Firm Offer</option>
            <option value="need_pack">Needs Package</option>
            <option value="pack_select">Package Selected</option>
        </select>
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Add a Property</button>
    </div>
    <div>
</form>
<hr>
<h3 class="title">List of Properties</h3>
<?php $arr = list_properties(); ?>
<table class="table" border="2" cellpadding="5" cellspacing="3">
    <thead>
    <tr>
        <td>Subdivision</td>
        <td>Block</td>
        <td>Lot #</td>
        <td>Property Status</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </thead>
    <tbody>

    <?php foreach($arr as $k => $v){ ?>
    <tr>
        <td><?php echo $v["subdivName"] ;?></td>
        <td><?php echo $v["blockName"] ;?></td>
        <td><?php echo $v["lotNumber"] ;?></td>
        <td><?php echo $v["propStatus"] ;?></td>
        <td><a href="./main/control.php?act=view_package&propId=<?php echo $v["propId"]?>">View Package</a></td>
        <td><a href="./main/control.php?act=edit_property&propId=<?php echo $v["propId"]?>">Edit</a></td>
        <td><a href="./main/control.php?act=del_property&propId=<?php echo $v["propId"]?>">Delete</a></td>
    </tr>

    <?php  } ?>
    </tbody>
</table>
<?php }else{?>
<h3 class="title">Please login/register first</h3>
<?php }?>

<?php require_once('foot.php'); ?>