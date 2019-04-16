<?php
/**
* Template Name: Checkout
*/
get_header();
$st = bookcart::inst()->__stGetInfoRoom();
$err = bookcart::inst()->__stCheckErr();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-lg-push-8 col-md-push-8 info-booking">
            <h3 class="title">Your Booking</h3>
            <div class="cart-info" id="cart-info">
                 <div class="service-section">
                    <div class="service-left">
                        <h4 class="title"><a href="#"><?php echo $st[0]->post_title ?></a></h4>
                        <p class="address"><i class="input-icon field-icon fa"><svg height="15px" width="15px">
                            <title>Ico_maps</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <img src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/gps.svg">
                        </svg></i>&ensp;<?php echo $st[4][1]->name ?>, <?php echo $st[4][0]->name ?> </p>
                    </div>
                    <div class="service-right">
                        <img class="img-responsive" src=""style =" width: 150px; height: auto "><?php 
                        echo get_avatar($st[2]->ID); ?>
                    </div>
                </div>
                <div class="info-section">
                    <ul>
                        <li><span class="lable_section">Room : </span><span class="value"><?php echo $st[2]->post_title ?></span></li>
                    <li>
                     <span class="lable_section">Date : </span>
                     <span class="value">
                        ngày đến -đi &nbsp;    
                        <a class="st-link" style="font-size: 12px;" href="#">Edit</a>
                    </span>
                </li>

                <li class="ad-info">
                    <ul>
                        <li><span class="lable_section">Number of Night : </span>
                            <span class="value"></span></li>
                            <li><span class="lable_section">Number of Room : </span>
                                <span class="value">number room</span></li>
                                <li><span class="lable_section">Number of Adult : </span><span class="value"> number adult</span></li>
                            </ul>
                        </li>
                    </ul>

                </div>
                <div class="total-section">
                    <ul>
                        <li><span class="label_section">Subtotal : </span><span class="value">€ <?php 
                             
                            if ($sl_night>1) {
                                $price = $sl_night * $st[3]['st_contact_price_field'][0];
                             }
                            else {
                                $price = $st[3]['st_contact_price_field'][0];
                             }
                             echo $price;
                            ?>
                                
                            </span></li>
                        <li>
                            <span class="label_section">Extra Price : </span>
                            <span class="value">€0.00</span>
                        </li>
                        <li><span class="label_section">Tax : </span><span class="value">10 %</span></li>

                        <li class="payment-amount">
                            <span class="label_section">Pay Amount : </span>
                            <span class="value">€ <?php $vat= 0.1;
                            $money = $price + $price*$vat;
                            echo $money; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-lg-pull-4 col-md-pull-4">
            <h3 class="title">Booking Submission</h3>
            <?php  $check = is_user_logged_in();
            if($check==1) {
                    $key= wp_get_current_user()->ID;
                    $data = bookcart::inst()->__stInfoBook($key);
                    ?>
            <form class="" method="post" action="bookingsucces?bill_id=$user_id">
                <div class="check-out-form">

                    <div class="entry-content"></div>

                    <input type="hidden"  value="<?php echo wp_get_current_user()->ID ?>" name = "st_username" >
                    <div class="clearfix">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_first_name">First Name <span class="require">*</span> </label>
                                    <i class="fa fa-user input-icon"></i>
                                    <input class="form-control required" id="field-st_first_name" value="<?php echo $data['first_name'][0] ?>" name="st_first_name" placeholder="First Name" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_last_name">Last Name <span class="require">*</span> </label>
                                    <i class="fa fa-user input-icon"></i>
                                    <input class="form-control required" id="field-st_last_name" value="<?php echo $data['last_name'][0] ?>" name="st_last_name" placeholder="Last Name" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_email">Email <span class="require">*</span> </label>
                                    <i class="fa fa-envelope input-icon"></i>&nbsp;&nbsp;
                                    
                                    <input class="form-control required" id="field-st_email" value="<?php echo wp_get_current_user()->user_email ?>" name="st_email" placeholder="email@domain.com" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_phone">Phone <span class="require">*</span> </label>
                                    <i class="fa fa-phone input-icon"></i>
                                    <input class="form-control required" id="field-st_phone" value="<?php echo $data['st_phone'][0] ?>" name="st_phone" placeholder="Your Phone" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_address">Address Line 1  </label>
                                    <i class="fa fa-map-marker input-icon"></i>
                                    <input class="form-control" id="field-st_address" value="<?php echo $data['st_address'][0] ?>" name="st_address" placeholder="Your Address Line 1" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_address2">Address Line 2  </label>
                                    <i class="fa fa-map-marker input-icon"></i>
                                    <input class="form-control" id="field-st_address2" value="<?php echo $data['st_address2'][0] ?>" name="st_address2" placeholder="Your Address Line 2" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_city">City  </label>
                                    <i class="fa fa-map-marker input-icon"></i>
                                    <input class="form-control" id="field-st_city" value="<?php echo $data['st_city'][0] ?>" name="st_city" placeholder="Your City" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_province">State/Province/Region  </label>
                                    <i class="fa fa-map-marker input-icon"></i>                <input class="form-control" id="field-st_province" value="<?php echo $data['st_province'][0] ?>" name="st_province" placeholder="State/Province/Region" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_zip_code">ZIP code/Postal code  </label>
                                    <i class="fa fa-map-marker input-icon"></i>                <input class="form-control" id="field-st_zip_code" value="<?php echo $data['st_zip_code'][0] ?>" name="st_zip_code" placeholder="ZIP code/Postal code" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_country">Country  </label>
                                    <i class="fa fa-globe input-icon"></i>                
                                    <input class="form-control" id="field-st_country" value="<?php echo $data['st_country'][0] ?>" name="st_country" placeholder="Country" type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="field-st_note">Special Requirements  </label>
                                    <textarea rows="6" class="form-control" id="field-st_note" name="st_note" placeholder="Special Requirements"><?php echo $data['st_note'][0] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="lang" value="en">
                <div class="cond-form">
                    <div class="st-icheck create-account st_check_create_account">
                        <div class="st-icheck-item">
                            <label>
                                <input name="create_account" type="checkbox" value=" " checked="" disabled="" required="">
                                <span class="payment-title">
                                    Create Traveler account<small>(password will be sent to your e-mail)</small>
                                </span>
                                
                                <span class="checkmark fcheckbox"></span>
                                <br>
                                <p>
                                   <?php
                                   if(!empty($err)){
                                    foreach ($err as $key => $value) {
                                        echo $value . '<br />';
                                       }
                                    }
                                   ?>
                                </p>
                            </label>
                        </div>
                    </div>
                    <div class="st-icheck accerpt-cond st_check_term_conditions">
                        <div class="st-icheck-item">
                            <label>
                                <input class="i-check" value="1" name="term_condition" type="checkbox">
                                <span class="payment-title">I have read and accept the<a target="_blank" href=""> terms and conditions</a> and <a href="#" target="_blank">Privacy Policy</a></span>
                                
                                <span class="checkmark fcheckbox"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="st_cart" value="">
                <div class="alert form_alert hidden"></div>
                <button type="submit" class="btn btn-primary btn-checkout btn-st-checkout-submit btn-st-big " name="checkout_submit">Submit <i class=""></i></button>
            </form>
        <?php } 
        else {?>
            <form class="" method="post" action="">
                <div class="check-out-form">
                    <div class="entry-content"></div>
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_first_name">First Name <span class="require">*</span> </label>
                                    <i class="fa fa-user input-icon"></i>
                                    <input class="form-control required" id="field-st_first_name" value="<?php echo isset($_POST['st_first_name'])  ? $_POST['st_first_name'] : ''; ?>" name="st_first_name" placeholder="First Name" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_last_name">Last Name <span class="require">*</span> </label>
                                    <i class="fa fa-user input-icon"></i>
                                    <input class="form-control required" id="field-st_last_name" value="<?php echo isset($_POST['st_last_name'])  ? $_POST['st_last_name'] : ''; ?>" name="st_last_name" placeholder="Last Name" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_email">Email <span class="require">*</span> </label>
                                    <i class="fa fa-envelope input-icon"></i>&nbsp;&nbsp;
                                  
                                    <input class="form-control required" id="field-st_email" value="<?php echo isset($_POST['st_email'])  ? $_POST['st_email'] : ''; ?>" name="st_email" placeholder="email" required >
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_phone">Phone <span class="require">*</span> </label>
                                    <i class="fa fa-phone input-icon"></i>
                                    <input class="form-control required" id="field-st_phone" value="<?php echo isset($_POST['st_phone'])  ? $_POST['st_phone'] : ''; ?>" name="st_phone" placeholder="Your Phone" type="text" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_address">Address Line 1  </label>
                                    <i class="fa fa-map-marker input-icon"></i>
                                    <input class="form-control" id="field-st_address" value="<?php echo isset($_POST['st_address'])  ? $_POST['st_address'] : ''; ?>" name="st_address" placeholder="Your Address Line 1" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_address2">Address Line 2  </label>
                                    <i class="fa fa-map-marker input-icon"></i>
                                    <input class="form-control" id="field-st_address2" value="<?php echo isset($_POST['st_address2'])  ? $_POST['st_address2'] : ''; ?>" name="st_address2" placeholder="Your Address Line 2" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_city">City  </label>
                                    <i class="fa fa-map-marker input-icon"></i>
                                    <input class="form-control" id="field-st_city" value="<?php echo isset($_POST['st_city'])  ? $_POST['st_city'] : ''; ?>" name="st_city" placeholder="Your City" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_province">State/Province/Region  </label>
                                    <i class="fa fa-map-marker input-icon"></i>                <input class="form-control" id="field-st_province" value="<?php echo isset($_POST['st_province'])  ? $_POST['st_province'] : ''; ?>" name="st_province" placeholder="State/Province/Region" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_zip_code">ZIP code/Postal code  </label>
                                    <i class="fa fa-map-marker input-icon"></i>                <input class="form-control" id="field-st_zip_code" value="<?php echo isset($_POST['st_zip_code'])  ? $_POST['st_zip_code'] : ''; ?>" name="st_zip_code" placeholder="ZIP code/Postal code" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-icon-left">                
                                    <label for="field-st_country">Country  </label>
                                    <i class="fa fa-globe input-icon"></i>                
                                    <input class="form-control" id="field-st_country" value="<?php echo isset($_POST['st_country'])  ? $_POST['st_country'] : ''; ?>" name="st_country" placeholder="Country" type="text">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="field-st_note">Special Requirements  </label>
                                    <textarea rows="6" class="form-control" id="field-st_note" name="st_note" placeholder="Special Requirements"><?php echo isset($_POST['st_note'])  ? $_POST['st_note'] : ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="lang" value="en">
                <div class="cond-form">
                    <div class="st-icheck create-account st_check_create_account">
                        <div class="st-icheck-item">
                            <label>
                                <input name="create_account" type="checkbox" value=" " checked="" disabled="" required="">
                                <span class="payment-title">
                                    Create Traveler account<small>(password will be sent to your e-mail)</small>
                                </span>
                                
                                <span class="checkmark fcheckbox"></span>
                            </label>
                        </div>
                    </div>
                    <div class="st-icheck accerpt-cond st_check_term_conditions">
                        <div class="st-icheck-item">
                            <label>
                                <input class="i-check" value="1" name="term_condition" type="checkbox">
                                <span class="payment-title">I have read and accept the<a target="_blank" href=""> terms and conditions</a> and <a href="#" target="_blank">Privacy Policy</a></span>
                                
                                <span class="checkmark fcheckbox"></span>
                                <br>
                                <p>
                                   <?php
                                   if(!empty($err)){
                                    foreach ($err as $key => $value) {
                                        echo $value . '<br />';
                                       }
                                    }
                                   ?>
                                </p>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="st_cart" value="">
                <div class="alert form_alert hidden"></div>
                <button type="submit" class="btn btn-primary btn-checkout btn-st-checkout-submit btn-st-big " name="checkout_submit">Submit <i class=""></i></button>               </form>
        <?php } ?>
        </div>
    </div>
</div>
</div>
<?php
get_footer();