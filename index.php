<?php
$subTitle = "login";
require_once('head.php');
?>
<!-- welcome message -->
<div id="welcome">
    <div class="form_container">
        <div class="row">
            <div class="col-md-12">
                <div id="heading">
                    <h2>Welcome to Property Management for Freure Homes</h2>
                    <img src="/images/icons/under-heading.png" alt="" >
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($u_name) {?>
    <form class="form-ajax-post"
        data-action="./main/control.php?act=create_appointment"
        data-url="index.php">
        <h3 class="title">Create New Appointment</h3><br>
        <div id="newAppointment" class="form-group">
            <label for="clientName">Client name:</label>
            <input name="clientName" type="text" class="form-control"/>
        </div>
        <div id="newAppointment" class="form-group">
            <label for="apptDate">Date and Time:</label>
            <input name="apptDate" type="text" placeholder="YYYY-MM-DD HH:MM:SS" data-clear-btn="true" class="form-control"/>
        </div>
        <div id="newAppointmentButton" class="form-group ">
            <button class="form-ajax-btn " type="submit">Submit</button>
        </div>
        <br>
    </form>
    <h3 class="title">My Upcoming Appointments</h3><br>
    <?php $arr = list_appointments(); ?>
    <table class="table">
        <thead>
        <tr>
            <td>Appointment time</td>
            <td>Client name</td>
            <td>Client phone</td>
            <td>Client email</td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($arr as $k => $v){ ?>
            <tr>
                <td><?php echo $v["apptDate"] ;?></td>
                <td><?php echo $v["clientName"] ;?></td>
                <td><?php echo $v["clientPhone1"] ;?></td>
                <td><?php echo $v["clientEmail"] ;?></td>
                <td><a href="./edit_appointment_page.php?apptDate=<?php echo $v['apptDate']?>">Edit</a></td>
                <td><a href="./main/control.php?act=del_appointment&apptDate=<?php echo $v['apptDate']?>?>">Delete</a></td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>
<?php }else{?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p style="text-align: center">Please login to see your appointments!</p>
            <h6 style="text-align: center"><a href="user_login.php">Login</a> | <a href="user_register.php">Register</a></h6>
        </div>
    </div>

    <!-- slides -->
    <div id="slider">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <div class="slider-caption">
                        <h1>Sagamore</h1>
                        <p>This split level home houses 2,230 sq. ft. and wonderful 11’ ceilings in a sunken great room.<br><br>
                            The Sagamore provides 4 bedrooms and a 2nd floor “flex” room ideal for lounging on a day off.<br><br>
                            With 3 optional elevations such as modern façade and gabled roof, this home is an amazing<br><br>
                            place to live.</p>
                        <a href="./list_property_page.php">View Properties</a>
                    </div>
                    <img src="./images/slides/slides-image-1.png" alt="" />
                </li>
                <li>
                    <div class="slider-caption">
                        <h1>Charleston</h1>
                        <p>In this this gorgeous 2,573 sq. ft. home there are 3 different elevation styles. <br><br>
                            With 4 bedrooms, an unfinished basement rec room, 2nd floor family retreat <br><br>
                            and laundry room on the main floor, this home is perfect for any family. <br><br>
                            The Charleston provides lots of room and options to customize your home <br><br>
                            how you see fit.</p>
                        <a href="./list_property_page.php">View Properties</a>
                    </div>
                    <img src="./images/slides/slides-image-2.png" alt="" />
                </li>
                <li>
                    <div class="slider-caption">
                        <h1>Willowstone</h1>
                        <p>With a total of 3,464 sq. ft. this is one of our largest and most luxurious models. <br><br>
                            With 4 bedrooms, a 2nd floor family retreat, breakfast nook, dining room, den, <br><br>
                            and 1st floor laundry, the Willowstone is the perfect home for a large single family, <br><br>
                            with large amounts of room and 2 elevations to choose from.</p>
                        <a href="./list_property_page.php">View Properties</a>
                    </div>
                    <img src="./images/slides/slides-image-3.png" alt="" />
                </li>
            </ul>
        </div>
    </div>
<?php } require_once('foot.php'); ?>