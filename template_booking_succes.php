<?php
/**
* Template Name: Booking Success
*/
get_header();
?>
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
								echo get_user_meta($user_id,'st_first_name').' '.get_user_meta($user_id,'st_last_name'); ?>, 
							</span>
							Your order was submitted successfully
						</p>
						<p class="line2">
							Booking details has been sent to:
							<span>
								<?php  echo $list['st_email'] ?>
							</span>
						</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-4">
					<ul class="booking-info-detail">
						<li><span>
							Booking Number	
						</span>
						8444
					</li>
					<li>
						<span>
							Booking Date
						</span>
						<?php echo $datenow= date('d-m-Y') ?>
					</li>
					<li>
						<span>Payment Method</span>
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
					<?php $rooms=array_shift($room) ?>
					<div class="service-section">
						<div class="service-left">
							<h4 class="title"><a href="#"><?php echo $rooms['hotel_name'] ?></a></h4>
							<p class="address"><i class="fa fa-map-marker"></i> <?php echo $rooms['city_name'] ?></p>
						</div>
						<div class="service-right">
							<img width="110" height="110"  style="max-width:100%;height:auto" src="<?php echo $rooms['images'] ?>" sizes="(max-width: 110px) 100vw, 110px"></div>
						</div>
						<div class="info-section">
							<ul>
								<li><span class="label">Email:</span><span class="value">email@domain.com</span></li>
								<li><span class="label">Phone:</span><span class="value">+658099999</span></li>
								<li><span class="label">Room:</span><span class="value"><?php echo $rooms['room_name'] ?></span></li>
								<li><span class="label">Number of rooms</span><span class="value"><?php echo $check['number_room'] ?></span></li>
								<li><span class="label">Check In:</span><span class="value"><?php echo $check['start'] ?></span></li>
								<li><span class="label">Check Out:</span><span class="value"><?php echo $check['end'] ?></span></li>
								<li><span class="label">Price:</span>
									<span class="value">€ <?php echo $rooms['price'] ?></span>
								</li>
							</ul>
						</div>
						<div class="total-section">
							<ul>
								<li>
									<span class="label">Subtotal</span>
										<span class="value">
										price
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
					<form class="" method="post" action="?c=bookcart&a=listBill">
					<div class="info-form">
						<input type="hidden"  value="<?php echo $list['st_email'] ?>" name = "st_username" >
				<ul>
					<li><span class="label">First Name</span><span class="value" name="first_name"><?php echo $list['st_first_name'] ?></span></li>
					<li><span class="label">Last name</span><span class="value" name="last_name"><?php echo $list['st_last_name'] ?></span></li>
					<li><span class="label">Email</span><span class="value" name = "email"><?php echo $list['st_email'] ?></span></li>
					<li><span class="label">Address Line 1 </span><span class="value" name="add1"><?php echo $list['st_address'] ?></span></li>
					<li><span class="label">Address Line 2 </span><span class="value" name="add2"><?php echo $list['st_address2'] ?></span></li>
					<li><span class="label">City</span><span class="value" name="city"><?php echo $list['st_city'] ?></span></li>
					<li><span class="label">State/Province/Region</span><span class="value" name="province"><?php echo $list['st_province'] ?></span></li>
					<li><span class="label">ZIP code/Postal code</span><span class="value" name="zipcode"><?php echo $list['st_zip_code'] ?></span></li>
					<li><span class="label">Country</span><span class="value" name="country"><?php echo $list['st_country'] ?></span></li>
					<li><span class="label">Special Requirements</span><span class="value" name="note"><?php echo $list['st_note'] ?></span></li>
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