<?php
/**
* Template Name: Booking History
*/
get_header();
$us = wp_get_current_user();
$key= $us->data->ID;
$ds = bookcart::inst()->__stList($key);
$id = $_GET['user_id'];
$check = is_user_logged_in();
?>
<div class="container">
	<?php if ($check==1) {
		?>
		<div class="list_bill">
			<h3>Booking History</h3>
			<?php
			if (empty($ds)) {
				?>
				<div class="record">
					<p style="text-align: center;font-size: 20px;">Has No Record</p>
				</div>
				<?php
			}else{?>
				<form class="" method="post" action="?c=bookcart&a=listBill">
					<table class="table table-bordered table-inverse">
						<thead>
							<tr>	
								<th>Bill ID</th>
								<th>Title</th>
								<th>Order Date</th>
								<th>Execution Time</th>
								<th>Cost</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach ($ds as $dt){ ?>
								<?php $room = get_post($dt->room_id)->post_title; ?>
								
								<tr>
									<td><?php echo $dt->bill_id; ?></td>
									<td><?php echo $room ?></td>
									<td><?php echo $dt->date_order; ?></td>
									<td><?php echo $dt->checkin.' => '.$dt->checkout ?></td>
									<td><?php echo $dt->totalmoney ?></td>
									
								
									</tr>
								<?php } 
							} ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<?php
	}else{
		?>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<br></br>
			<p style="text-align: center;font-size: 30px;">Please Login Now !!! <a href="<?php get_template_directory_uri() ?>/wordpress/wp-login.php" style="text-align: center;font-size: 30px;">Login</a></p>
			<br>
		</div>

		<?php
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	}				
	?>
</div>
<?php get_footer(); ?>