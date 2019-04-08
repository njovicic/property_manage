<?php
$subTitle = "edit_property_page";
require_once('head.php');
$id = $_GET["id"];
$sql = "SELECT property.*, client.clientName FROM property LEFT JOIN client ON property.clientId = client.clientId WHERE property.propertyId = '$id'";
$p = TCommon::getOne($sql);
?>

<form class="form-ajax-post"
      data-action="./main/control.php?act=edit_property"
      data-url="list_property_page.php">
    <input style="display:none" value="<?php echo $id ?>" name="id" />
    <h3 class="title">Edit Property on Lot # <?php echo $p['lotNum']?></h3>
    <div id="editProperty" class="form-group">
        <label>Subdivision:</label>
        <select id="editPropertySubdivision" name="p_sub">
            <option value="HWK"
                <?php echo $p['sub']=='HWK'?'selected':''?>>Huron Woods Kitchener</option>
            <option value="HRC"
                <?php echo $p['sub']=='HRC'?'selected':''?>>Highland Ridge Cambridge</option>
        </select>
    </div>
    <div id="editProperty" class="form-group" >
        <label>Block:</label>
        <input name="p_block" type="text" value="<?php echo $p['block']?>" class="form-control"/>
    </div>
    <div id="editProperty" class="form-group">
        <label>Lot #:</label>
        <input name="p_lotnum" type="text" value="<?php echo $p['lotNum']?>" class="form-control"/>
    </div>
    <div id="editProperty" class="form-group">
        <label>Size:</label>
        <input name="p_size" type="text" value="<?php echo $p['lotSize']?>" class="form-control"/>
    </div>
    <div id="editProperty" class="form-group">
        <label>Model:</label>
        <select id="editPropertyModel" name="p_model"">
            <option value="Bridgeport"
                <?php echo $p['lotModel']=='Bridgeport'?'selected':''?>>Bridgeport</option>
            <option value="Brookside"
                <?php echo $p['lotModel']=='Brookside'?'selected':''?>>Brookside</option>
            <option value="Meadow"
                <?php echo $p['lotModel']=='Meadow'?'selected':''?>>Meadow</option>
        </select>
    </div>
    <div id="editProperty" class="form-group">
        <label>Closing Date:</label>
        <input name="p_closingdate" type="Date" value="<?php echo $p['closingDate']?>" class="form-control"/>
    </div>
    <div id="editProperty" class="form-group">
        <label>Status:</label>
        <select id="editPropertyStatus" name="p_status">
            <option value="available"
                <?php echo $p['status']=='available'?'selected':''?>>Available</option>
            <option value="on_hold"
                <?php echo $p['status']=='on_hold'?'selected':''?>>On Hold</option>
            <option value="cond_offer"
                <?php echo $p['status']=='cond_offer'?'selected':''?>>Conditional Offer</option>
            <option value="firm_offer"
                <?php echo $p['status']=='firm_offer'?'selected':''?>>Firm Offer</option>
            <option value="pack_unselected"
                <?php echo $p['status']=='pack_unselected'?'selected':''?>>Needs Package</option>
            <option value="pack_selected"
                <?php echo $p['status']=='pack_selected'?'selected':''?>>Package Selected</option>
        </select>
    </div>
    <div id="editProperty" class="form-group">
        <label>Client:</label>
        <input name="p_buyer" type="text" value="<?php echo $p['clientName']?>" class="form-control"/>
    </div>

    <div id="editPropertyButton" class="form-group tT010 ">
        <button class="form-ajax-btn" type="submit">Submit</button>
    </div>
    <div>
</form>

<?php require_once('foot.php'); ?>