<?php
$subTitle = "list_property_page";
require_once('head.php');
// print_r($_SESSION);
?>
<?php if($u_name) {?>
<form class="form-ajax-post"
      data-action="./main/control.php?act=create_property"
      data-url="list_property_page.php">
    <h3 class="title">Create New Property</h3><br>
    <div class="form-group">
        <label>Subdivision:</label>
        <input name="subdivName" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Block:</label>
        <input name="blockName" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Lot #:</label>
        <input name="lotNumber" type="text" class="form-control"/>
    </div>
    <div class="form-group">
        <label>Status:</label>
        <select name="propStatus">
            <option value="available">Available</option>
            <option value="on_hold">On Hold</option>
            <option value="cond_offer">Conditional Offer</option>
            <option value="firm_offer">Firm Offer</option>
            <option value="pack_unselected">Needs Package</option>
            <option value="pack_selected">Package Selected</option>
        </select>
    </div>

    <div class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Add a Property</button>
    </div>
    <br>
</form>
<h3 class="title">List of Properties</h3><br>
<?php $arr = list_properties(); ?>
<table class="table">
    <thead>
    <tr>
        <td>Subdivision</td>
        <td>Block</td>
        <td>Lot #</td>
        <td>Lot Size</td>
        <td>Lot Model</td>
        <td>Closing Date</td>
        <td>Status</td>
        <td>Client Name</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($arr as $k => $v){ ?>
        <tr>
            <td><?php echo $v["sub"] ;?></td>
            <td><?php echo $v["block"] ;?></td>
            <td><?php echo $v["lotNum"] ;?></td>
            <td><?php echo $v["lotSize"] ;?></td>
            <td><?php echo $v["closingDate"] ;?></td>
            <td><?php echo $v["lotModel"] ;?></td>
            <td><?php echo $v["status"] ;?></td>
            <td><?php echo $v["clientName"] ;?></td>
            <td>
                <?php
                if($v["status"]=="pack_unselected"){
                    ?><a href="./create_package_page.php"><?php echo "Create Package" ?></a><?php ;
                }
                else if($v["status"]=="pack_selected"){
                    ?><a href="./view_package_page.php"><?php echo "View Package" ?></a><?php ;
                }
                else{
                    echo "";
                }
                ?>
            </td>
            <td><a href="./edit_property_page.php?id=<?php echo $v['propertyId']?>">Edit</a></td>
            <td><a href="./main/control.php?act=del_property&lotNum=<?php echo $v["lotNum"]?>">Delete</a></td>
        </tr>
    <?php  } ?>
    </tbody>
</table>
<?php }else{?>
<h3 class="title">Please login/register first</h3>
<?php }?>

<?php require_once('foot.php'); ?>