<?php
/**
* Template Name: Booking Success
*/
get_header();
$dt = bookcart::inst()->__stBkSucces();
$st =bookcart::inst()->__stInfoSucces();
$ss = bookcart::inst()->__stGetInfoRoom();?>
<div id="st-content-wrapper">
	<div class="st-breadcrumb">
		<div class="container">
			<ul>
				<li>
					<a href="#">Home</a>
				</li>
				<li><span>Booking Success</span></li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="st-checkout-page">
			<div class="row booking-success-notice">
				<div class="col-lg-8 col-md-8 col-left">
					<img src="<?php echo get_template_directory_uri(); ?>/application/libs/Images/ico_success.svg" alt="Thanh toán thành công">
					<div class="notice-success">
						<p class="line1">
							<span>
								<?php 
								echo $st['first_name'][0]." ".$st['last_name'][0]; ?>, 
							</span>
							Your order was submitted successfully
						</p>
						<p class="line2">
							Booking details has been sent to:
							<span>
								<?php  echo $dt->user_email; ?>
							</span>
						</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<ul class="booking-info-detail">
						<li><span>
							Booking Number	:
						</span>
						<?php echo $_GET['bill_id']; ?>
					</li>
					<li>
						<span>
							Booking Date :
						</span>
						<?php echo $datenow= date('d-m-Y') ?>
					</li>
					<li>
						<span>Payment Method : </span>
						Submit Form
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-lg-push-8 col-md-push-8">
				<h3 class="title">
				Your Items	</h3>
				<div class="cart-info">
					<div class="service-section">
						<div class="service-left">
							<h4 class="title"><a href="#"><?php echo $ss[0]->post_title ?></a></h4>
							<p class="address"><i class="fa fa-map-marker"></i> &ensp;<?php echo $ss[4][1]->name ?>, <?php echo $ss[4][0]->name ?></p>
						</div>
						<div class="service-right">
							<img width="110" height="110"  style="max-width:100%;height:auto" src="" sizes="(max-width: 110px) 100vw, 110px"></div>
						</div>
						<div class="info-section">
							<ul>
								<li><span class="label">Email:</span><span class="value">email@domain.com</span></li>
								<li><span class="label">Phone:</span><span class="value">+658099999</span></li>
								<li><span class="label">Room:</span><span class="value"><?php echo $ss[2]->post_title ?></span></li>
								<li><span class="label">Number of rooms</span><span class="value"><?php echo 1 ?></span></li>
								<li><span class="label">Check In:</span><span class="value"><?php echo "ngày đến" ?></span></li>
								<li><span class="label">Check Out:</span><span class="value"><?php echo "ngày đi" ?></span></li>
								<li><span class="label">Price:</span>
									<span class="value">€ <?php echo $ss[3]['st_contact_price_field'][0] ?></span>
								</li>
							</ul>
						</div>
						<div class="total-section">
							<ul>
								<li>
									<span class="label">Subtotal</span>
										<span class="value"><?php
										$price = $ss[3]['st_contact_price_field'][0];
										echo $price;
										?>
									</span>
								</li>
								<li>
									<span class="label">Extra Price</span>
									<span class="value">Free</span>
								</li>
								<!-- Hotel package -->
								<li>
									<span class="label">Tax</span>
									<span class="value">10%</span>
								</li>
								<li class="payment-amount">
									<span class="label">Pay Amount</span>
									<span class="value">
										€ <?php $vat= 0.1;
										$money = $price + $price*$vat;
										echo $money; ?>	
                            		</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-lg-pull-4 col-md-pull-4">
					<h3 class="title">Your Informatio</h3>
					<form class="" method="post" action="">
					<div class="info-form">
						<input type="hidden"  value="" name = "st_username" >
				<ul>
					<li><span class="label">First Name</span><span class="value" name="first_name"><?php echo $st['first_name'][0]; ?></span></li>
					<li><span class="label">Last name</span><span class="value" name="last_name"><?php echo $st['last_name'][0]; ?></span></li>
					<li><span class="label">Email</span><span class="value" name = "email"><?php echo $dt->user_email; ?></span></li>
					<li><span class="label">Address Line 1 </span><span class="value" name="add1"><?php echo $st['st_address'][0]; ?></span></li>
					<li><span class="label">Address Line 2 </span><span class="value" name="add2"><?php echo $st['st_address2'][0]; ?></span></li>
					<li><span class="label">City</span><span class="value" name="city"><?php echo $st['st_city'][0]; ?></span></li>
					<li><span class="label">State/Province/Region</span><span class="value" name="province"><?php echo $st['st_province'][0]; ?></span></li>
					<li><span class="label">ZIP code/Postal code</span><span class="value" name="zipcode"><?php echo $st['st_zip_code'][0]; ?></span></li>
					<li><span class="label">Country</span><span class="value" name="country"><?php echo $st['st_country'][0]; ?></span></li>
					<li><span class="label">Special Requirements</span><span class="value" name="note"><?php echo $st['st_note'][0]; ?></span></li>
				</ul>	
					</div>
					<div class="text-center mg20 mt30">
						<button type="submit" class="btn btn-primary" name="check_list">
						<i class="fa fa-book"></i> Booking Management </button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>