<?php  

get_header();
?>
<div class="clear"></div>
	<!--content -->
	<div id="st-content-wrapper">
		<div class="st-breadcrumb">
			<div class="container">
				<ul>
					<li><a href="?c=homepage&a=view">Home</a></li>
					<li><a href="#">United States</a></li>
					
					<li class="active"> city name</li> 
				
					
					<li class="active">cityname</li> 
				
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<div class="container">
			<!-- st-content-hotel -->
			<div class="st-hotel-content">
				<div class="hotel-target-book-mobile" >
					
					<div class="price-wrapper">
						from <span class="price">€ hotel_price</span>                        
					</div>
				
					<a href="" class="btn btn-green">Check Availability</a>
				</div>
			</div>
			<!-- end st-content-hotel -->
			<!--  st-hotel-header -->
			<div class="st-hotel-header">
				<div class="left">
					<div class="st-stars ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
					</div>
					 
					<h2 class="st-heading"> hotel_name</h2>
                 
					<div class="sub-heading">
						
							<i class="fas fa-map-marker-alt"></i>Hà Nội,Việt Nam
					
					</div>
				</div>
				<div class="right">
					<div class="review-score">
						<div class="head clearfix">
							<div class="left">
								<span class="head-rating" >Excellent</span>
								<span class="text-rating">from 2 reviews</span>
							</div>
							<div class="score">
								
								4.5<span>/5</span>
								
							</div>
						</div>
						<div class="foot">
							100% of guests recommend
						</div>
					</div>
				</div>
			</div>
			<!-- end  st-hotel-header -->
			<div class="clear"></div>
			<div class="row">
				<div class="col-xs-12 col-md-9">
					<!-- slide -->
					<div class="slidehotel">
						<div class="fotorama "
						data-nav="thumbs" data-thumbwidth="135px" data-thumbheight="135px" data-fit="none" data-width="870px" data-height="500px" data-allowfullscreen="native" data-thumbfit="cover" data-thumbmargin="8" >
						<a href="libs/Images/khanh1.jpg"><img src="<?php echo get_template_directory_uri() ?>/application/libs/Images/khanh1.jpg"  width="135px" height="135px"></a>
						<a href="libs/Images/khanh2.jpg"><img src="<?php echo get_template_directory_uri() ?>/application/libs/Images/khanh2.jpg"  width="135px" height="135px"></a>
						<a href="libs/Images/khanh3.jpg"><img src="<?php echo get_template_directory_uri() ?>/application/libs/Images/khanh3.jpg"  width="135px" height="135px"></a>
						<a href="libs/Images/khanh4.jpg"><img src="<?php echo get_template_directory_uri() ?>/application/libs/Images/khanh4.jpg"  width="135px" height="135px"></a>
						<a href="libs/Images/khanh5.jpg"><img src="<?php echo get_template_directory_uri() ?>/application/libs/Images/khanh5.jpg"  width="135px" height="135px"></a>
						<a href="libs/Images/khanh6.jpg"><img src="<?php echo get_template_directory_uri() ?>/application/libs/Images/khanh6.jpg"  width="135px" height="135px"></a>
					</div>
					</div>
					<!-- end slide -->
					<hr style="width: 100%;">
					<!-- description -->
					<div>
						<h2 class="st-heading-section">Descripton
							<i class="fa fa-angle-down down-icon" aria-hidden="true" ></i>
						</h2>
						<div class="st-description" data-toggle-section="st-description" data-show-all="st-description" data-height="120"  >
							
							
							<p class="more-content">hotel_description</p>
							

								<div class="cut-gradient"></div>
								<div class="showmore_des" >
									Show All 
								</div> 
						</div>
						<!-- <script>	
							$(".more-content").shorten({
								"showChars" : 500,
								"moreText"  : "View more",
								"lessText"  : "View less",
							});
						</script> -->
					</div>
					<!-- description -->
					<hr style="width: 100%;">
					<!-- facilities -->
					<div>
						<h2 class="st-heading-section">Facilities
							<i class="fa fa-angle-down down-icon1" aria-hidden="true"></i>
						</h2>
						<div class="facilities" >
							<div class="container-fuild">
								<div class="row room-facility">
									<?php foreach ($data_fac as $val) {?>
									<div class="col-xs-4  fac" " >
										
										<i class="fa <?php echo $val['service_icon']; ?> " aria-hidden="true"></i>  <?php echo $val['service']; ?>
                                      
									</div>
										  <?php } ?>			
								</div>
								<?php
								if(count($data_fac) > 6 ){  
								?>
								<div class="showmore" >
									Show All
								</div> 
							<?php } ?>
							
							</div>	
						</div>
					</div>
					<!-- end facilities -->
					<hr style="width: 100%;">
					<!-- rules -->
					<div class="rules">
						<div class="">
							<h2>Rules</h2>
							<div class="row">
								<div class="col-md-4 col-xs-4 ">
									Check In
								</div>
								<div class="col-md-8 col-xs-8">
									3:00 PM
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-xs-4">
									Check Out
								</div>
								<div class="col-md-8 col-xs-8">
									7:00 PM
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-xs-4" >
									Hotel Policies
								</div>
								<div class="col-md-8 col-xs-8" id="rules">
									<h4>What kind of foowear is most suitable ?</h4>
									
									
									<div class="more_content_rule">
										<p>Morbi mollis vestibulum sollicitudin. Nunc in eros a justo facilisis rutrum. Aenean id ullamcorper libero. Vestibulum imperdiet nibh vel magna lacinia ultrices. Sed id interdum urna. Nam ac elit a ante commodo tristique. Duis lacus urna, </p>
										<p>
											condimentum a vehicula a, hendrerit ac nisi Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate, tortor nec commodo ultricies, lectus nisl facilisis enim, vitae viverra urna nulla sed turpis. Nullam lacinia faucibus risus, a euismod lorem tincidunt id. Vestibulum imperdiet nibh vel magna lacinia ultrices. Sed id interdum urna. Nam ac elit a ante commodo tristique. Duis lacus urna, condimentum a vehicula a, hendrerit ac nisi Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate, tortor nec commodo ultricies, vitae viverra urna nulla sed turpis. Nullam lacinia faucibus risus, a euismod lorem tincidunt id
										</p>
										<h4>Can i bring Alcohol top this trip?</h4>
										<p>
											Duis lacus urna, condimentum a vehicula a, hendrerit ac nisi Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate, tortor nec commodo ultricies, enim, vitae viverra urna nulla sed turpis. Nullam lacinia faucibus risus, a euismod lorem tincidunt id. Vestibulum imperdiet nibh vel magna lacinia ultrices. Sed id interdum urna. Nam ac elit a ante commodo tristique. Duis lacus urna, condimentum a vehicula a, hendrerit ac nisi Lorem ipsum dolor sit amet, consectetur adipiscing elit.
										</p>
										<h4>Can i bring Alcohol top this trip?</h4>
										<p>Duis lacus urna, condimentum a vehicula a, hendrerit ac nisi Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vulputate, tortor nec commodo ultricies, lectus nisl facilisis enim, vitae viverra urna nulla sed turpis. Nullam lacinia faucibus risus, a euismod lorem tincidunt id. Vestibulum imperdiet nibh vel magna lacinia ultrices. Sed id interdum urna. Nam ac elit a ante commodo tristique. Duis lacus urna, condimentum a vehicula a, hendrerit ac nisi Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>	
									<div class="cut_gradient_rule"></div>
								<div class="showmore_rule" >
									Show All 
								</div>								
								</div>

							</div>
						</div>
					</div>
					<!-- end rules -->
					<hr style="width: 100%;">

					<!-- room -->
					<!-- Start Manh -->
					<?php
					$get_data = $_GET;

					$start='';
					$end='';
					$date = '';

					if(isset($get_data['start'])){
						$start = "&start=" .  $get_data['start'];
					}else{
						$start ="";
					}

					if(isset($get_data['end'])){
						$end = "&end=" .  $get_data['end'];
					}
					else{
						$end ="";
					}
					if(isset($get_data['date'])){
						$date = "&date=" .   $get_data['date'];
					}
					else{
						$date ="";
					}

					?>
					<!-- end Manh -->
					<!-- start Hoa -->
					<div class="sroom">
						<h2 class="st-heading-section">Rooms
							<i  class="fa fa-angle-down down-icon2" aria-hidden="true" ></i>
						</h2>
						<div class="container-fluid roomsm">
							<?php foreach ($data_room as $v) {
								
							 ?>
							<div class="row sheration">
								<div class="col-xs-12 col-md-4 images">
									<div class="image">
										<img src=" <?php echo $v['room_images'] ?> "  class="img-responsive ">
									</div>
								</div>
								<div class="col-xs-12 col-md-8">
									<h2 ><a href="?c=room&a=view&room_id=<?php echo $v['room_id']  ?><?=$start ?>&<?=$end ?><?=$date ?> "><?php echo $v['room_name'] ?></a></h2>
									<div class="row">
										<div class="col-xs-12 col-md-8 inf" >
											<div class="col-xs-2">
												<i class="fas fa-square" aria-hidden="true"></i>
												<br>
												<span><?php echo $v['size'];  ?>m<sup>2</sup></span>
											</div>
											<div class="col-xs-2">
												<i class="fa fa-bed" aria-hidden="true"></i>
												<br>
												<span>x<?php echo $v['bed'];  ?></span>
											</div>
											<div class="col-xs-2">
												<i class="fa fa-venus-double" aria-hidden="true"></i>
												<br>
												<span>x<?php echo $v['people'];  ?></span>
											</div>
											<div class="col-xs-2">
												<i class="fa fa-child" aria-hidden="true"></i>
												<br>
												<span>x<?php echo $v['people'];  ?></span>
											</div>
										</div>
										<div class="col-xs-12 col-md-4 ">
											<div class="price-room"  >
												<span class="money-price">€<?php echo $v['price']; ?> </span>
												<span class="unit"> /1 night</span>
											</div>

												<a href="?c=room&a=view&room_id=<?php echo $v['room_id']  ?><?=$start ?>&<?=$end ?><?=$date ?> " class="btn"  style="">SHOW PRICE</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<!--  -->
					<div class="broom">
						<h2 class="st-heading-section">Rooms
							<i class="fa fa-angle-down down-icon2" aria-hidden="true" ></i>
						</h2>
						<div class="roomlg">
							<?php foreach ($data_room as$v) {
								
							 ?>
							<div class="row sheration"  >
								<div class="col-sm-4 edit" ><img src=" <?php echo $v['room_images'] ?> " class="img-responsive "   alt=""></div>
								<div class="col-sm-8">
									<div >
										
										
										<h2 ><a href="?c=room&a=view&room_id=<?php echo $v['room_id']  ?><?=$start ?><?=$end ?><?=$date ?> "><?php echo $v['room_name'] ?></a></h2>
										<div class="row" class="">
											<div class="col-sm-8">
												<div class="col-sm-2">
													<i class="fa fa-square" aria-hidden="true"></i>
													<br>
													<span><?php echo $v['size'] ?>m<sup>2</sup></span>
												</div>
												<div class="col-sm-2">
													<i class="fa fa-bed" aria-hidden="true"></i>
													<br>
													<span>x<?php echo $v['bed'];  ?></span>
												</div>
												<div class="col-sm-2">
													<i class="fa fa-venus-double" aria-hidden="true"></i>
													<br>
													<span>x<?php echo $v['people'];  ?></span>
												</div>
												<div class="col-sm-2">
													<i class="fa fa-child" aria-hidden="true"></i>
													<br>
													<span>x<?php echo $v['people'];  ?></span>
												</div>
												
											</div>

											<div class="col-sm-4 " >
												<div class="price-room"  ><span class="money-price">€<?php echo $v['price']; ?> </span><span class="unit"> /1 night</span></div>


												<a  href="?c=room&a=view&room_id=<?php echo $v['room_id']  ?><?=$start ?><?=$end ?><?=$date ?> " class="btn"  style="">ROOM DETAIL</a>												
											</div>
										</div>
									</div>                 
								</div>
							</div>

							<?php } ?>
							
						</div>
					</div>
					<!-- end Hoa -->
					<hr style="width: 100%;">
					<!-- reviews -->
					<div class="reviews">
						<h2>Reviews</h2>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-sm-4 reviews-score"  >
									<div class="square">
										<h2 class="heading">Review score</h2>
										<div class="review-box-score">
											<div class="review-score">4.7<span class="per-total">/5</span></div>
											<div class="review-score-text">Excellent</div>
											<div class="review-score-base">
												Based on<span> 3 reviews</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 rating" >
									<div class="square" >
										<h2 class="heading">Traveler rating</h2>
										<div class="item">
											<div class="progress">
												<div class="percent green" "></div>
											</div>
											<div class="label">
												Excellent <div class="number">0</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent darkgreen" ></div>
											</div>
											<div class="label">
												Very Good <div class="number">3</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent green" ></div>
											</div>
											<div class="label">
												Average <div class="number">0</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent green" ></div>
											</div>
											<div class="label">
												Poor <div class="number">0</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent green" ></div>
											</div>
											<div class="label">
												Terrible <div class="number">0</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 summary" >
									<div class="square" >
										<h2 class="heading">Summary</h2>
										<div class="item">
											<div class="progress">
												<div class="percent location" ></div>
											</div>
											<div class="label">
												Location
												<div class="number">
													4.7/5
												</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent service " ></div>
											</div>
											<div class="label">
												Service 
												<div class="number">
													4.3 /5
												</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent clearness" ></div>
											</div>
											<div class="label">
												Clearness 
												<div class="number">
													5 /5
												</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent room" ></div>
											</div>
											<div class="label">
												Rooms 
												<div class="number">
													5/5
												</div>
											</div>
										</div>
										<div class="item">
											<div class="progress">
												<div class="percent sleep" ></div>
											</div>
											<div class="label">
												Sleep 
												<div class="number">
													4.7/5
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row summarys" >
								<div class="col-md-12">
									3 reviews on this Hotel - Showing 1 to 3
								</div>

							</div>
						</div>
					</div>
					<!-- end review  -->
					<hr style="width: 100%;">
					<!-- review-list -->
					<div class="review-list">
						<div class="comment-item">
							<div class="comment-item-head">
								<div class="media">
									<div class="media-left">
										<img alt="avatar" width="50" height="50" src="https://homap.travelerwp.com/wp-content/uploads/bfi_thumb/people_8-1-37jk0455r1ut9uns0zq58g.jpg" class="avatar avatar-96 photo origin round">                    
									</div>
									<div class="media-body2">
										<h4 class="media-heading">Travis Tan</h4>
										<div class="date">11/12/2018</div>
									</div>
								</div>
								<div class="like  check-like">
									<div class="form-group1 check-like">
										<span class="">4</span><span class="number"> Likes this</span>
										<span class="glyphicon glyphicon-thumbs-up"></span>
									</div>
								</div>
							</div>
							<div class="comment-item-body">
								<span class="comment-rate">4.6</span>                                    
								<div class="detail">
									<div class="st-description" data-show-all="st-description-163">
										Great location, great host, hot water, big bed. Kitchen and washer/dryer work well. It is a tiny space but is advertised that way. I’d come back because the location is amazing and I also felt very secure here. My baby boomer mom had to climb stairs to reach the bed, but it was very cozy and she’s spry enough.                    
									</div>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="comment-item">
							<div class="comment-item-head">
								<div class="media">
									<div class="media-left">
										<img alt="avatar" width="50" height="50" src="https://homap.travelerwp.com/wp-content/uploads/bfi_thumb/people_10-1-37jiio2qgpw8izfqv5nitc.jpg" class="avatar avatar-96 photo origin round">                    
									</div>
									<div class="media-body2">
										<h4 class="media-heading">Donald Wolf</h4>
										<div class="date">07/12/2018</div>
									</div>
								</div>
								<div class="like">
									<div class="form-group1 check-like">
										<span class="number"><span class="">2 </span> Likes this</span>
										<span class="glyphicon glyphicon-thumbs-up"></span>
									</div>
								</div>
							</div>
							<div class="comment-item-body">
								<h4 class="title">
									<span class="comment-rate">4.6</span>                        "Good location, quality should be better"
								</h4>
								<div class="detail">
									<div class="st-description" data-show-all="st-description-96">
										The bathroom was super old! 30 years old!! Pieces of tiles were missing... regardless of the fact that it was clean, it looks really old. 
										The food at breakfast was of very poor quality. The scrambled and boiled eggs were practically inedible. I find the variety of food at breakfast very limited for a 4 star hotel which charges 300 euro a night.                    
									</div>
								</div>
							</div>
						</div>
						<!--  -->
						<div class="comment-item">
							<div class="comment-item-head">
								<div class="media">
									<div class="media-left">
										<img alt="avatar" width="50" height="50" src="https://homap.travelerwp.com/wp-content/uploads/bfi_thumb/images-37jjdsv8akbybpoam2sav4.jpg" class="avatar avatar-96 photo origin round">                    
									</div>
									<div class="media-body2">
										<h4 class="media-heading">Quillen</h4>
										<div class="date">07/12/2018</div>
									</div>
								</div>
								<div class="like">
									<div class="form-group1 check-like">
										<span class="number"><span class="">2</span> Likes this</span>
										<span class="glyphicon glyphicon-thumbs-up"></span>
									</div>
								</div>
							</div>
							<div class="comment-item-body">
								<h4 class="title">
									<span class="comment-rate">4.8</span>"Beautiful spot with a lovely view"
								</h4>
								<div class="detail">
									<div class="st-description" data-show-all="st-description-94">
										Beautiful spot with a lovely view. It's warm and cozy and had everything we needed. I am very particular about cleanliness and this place was spotless! Very quick to respond and extended check out for us. Truly perfect!                   
									</div>
								</div>
							</div>
						</div>
						<!--  -->
					</div> 
					<!--review-list  -->
					
					<!-- write  -->
					<div id="write-review">
						<div class="">
							<div class="">
								<div class="">
									<h4 class="heading">
										<a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
											Write a review  <span class="dangky"><i class="fa ml5 fa-angle-up"></i></span>
										</a>
									</h4>
									<div class="collapse" id="collapseExample">
										<div class="card card-body">
											<div class="col-md-12" class="form">
												<div class="row" >
													<div class="col-md-6">
														<input type="text" placeholder="Name*"  />
													</div>
													<div class="col-md-6">
														<input type="text" placeholder="Email*"  />
													</div>
												</div>
												<div class="row" >
													<div class="col-md-10">
														<input type="text" placeholder="Title"  />
													</div>
												</div>
												<div class="row">
													<div class="col-md-8">
														<textarea name="comment" class="form-control has-matchHeight" placeholder="Content" ></textarea>
													</div>
													<div class="col-md-4">
														<div class="form-group1 review-items has-matchHeight" >
															<div class="item">
																<label>Sleep</label>
																<input class="st_review_stats" type="hidden" name="st_review_stats[Sleep]">
																<div class="rates">
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																</div>
															</div>
															<div class="item">
																<label>Location</label>
																<input class="st_review_stats" type="hidden" name="st_review_stats[Location]">
																<div class="rates">
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																</div>
															</div>
															<div class="item">
																<label>Service</label>
																<input class="st_review_stats" type="hidden" name="st_review_stats[Service]">
																<div class="rates">
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																</div>
															</div>
															<div class="item">
																<label>Clearness</label>
																<input class="st_review_stats" type="hidden" name="st_review_stats[Clearness]">
																<div class="rates">
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																</div>
															</div>
															<div class="item">
																<label>Rooms</label>
																<input class="st_review_stats" type="hidden" name="st_review_stats[Rooms]">
																<div class="rates">
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																	<i class="fa fa-smile-o" aria-hidden="true"></i>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- btf -->
												<div class="text-center">
													<input type="hidden" id="comment_post_ID" name="comment_post_ID" value="6556">
													<input type="hidden" id="comment_parent" name="comment_parent" value="0">
													<input id="submit" type="submit" name="submit" class="btn btn-green upper font-medium" value="Leave a Review">
												</div>
												<!-- end btf -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end write -->
					
				</div>
				<!-- start Manh -->
				<div class="col-md-3"  >
					<!-- widget -->
					<div class="widget">
						<div class="widgets" >
							<div class="" id="money">
								<?php foreach ($data_hotel as $value) {
									
								?>
								<div class="col-md-12 " >
									from <span class="money-price" >€<?php echo $value['hotel_price'] ?></span> /night
								</div>
							<?php } ?>
							</div> 
							<?php
                                    //Co $_GET['start'];
                                    //Kho cos
                                    $start = date('d/m/Y');
                                    $end = date('d/m/Y', strtotime(' + 1 days'));
                                    $date = date('d/m/Y') . ' 12:00 am - ' . date('d/m/Y', strtotime(' + 1 days')) . ' 11:59 pm';
                                    if (isset($_GET['start']) && isset($_GET['end']) && isset($_GET['date'])) {
                                        if (!empty($_GET['start'])) {
                                            $start = $_GET['start'];
                                        }
                                        if (!empty($_GET['end'])) {
                                            $end = $_GET['end'];
                                        }
                                        if (!empty($_GET['date'])) {
                                            $date = $_GET['date'];
                                        }
                                    }
                                    ?>  
							<div class="" id="check">
								<div class="col-md-12">
									Check In-Out
									<br>
									  <div id="reportrange">
                                            <?php echo $start . ' - ' . $end ?>
                                        </div>
                                        <input type="hidden" name="start" id="start"  value="<?php echo $start; ?>">
                                        <input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                                        <input type="text" name="date" id="date" value="<?php echo $start . ' - ' . $end; ?>">

                                          <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('input[name="date"]').daterangepicker(
                                        {
                                            "autoApply": true,
                                             opens    : 'left',
                                            "minDate" : moment().startOf('hour'),
                                            "locale": {
                                                "format": "DD/MM/YYYY",
                                            },
                                        },
                                        function (start, end, label) {
                                            console.log("Callback has been called!");
                                            $('#reportrange').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                                            $('#start').val(start.format('DD/MM/YYYY'));
                                            $('#end').val(end.format('DD/MM/YYYY'));
                                            $('#date').val(start.format('DD/MM/YYYY hh:mm') + ' am- ' + end.format('DD/MM/YYYY hh:mm') + ' pm');
                                        }
                                        );
                                    });
                                </script>
								</div>
							</div>
							<div class="" id="guests">
								<div class="col-md-12">
									Guests
									<br>
									<label >
										<div class="">
											<div class="row field-people-row">
												<div class="col-sm-6 field_people_room">
													<div class="people-inner">
														<div class="people-group">

															<span class="value">
																<span class="adult search-element1">1 Adult</span> -

																<span class="child search-element2">0 Child</span>
															</span>
														</div>
													</div>

													<div class="formbook" >
														<div class="people-dropdown aaa"  >
															<div class="item gmz-number-wrapper">
																Rooms
																<span class="control minus">-</span>
																<span class="text">

																	<span class="value room">1</span>               <input type="hidden" value="1" name="number_room" data-min="1" data-max="20">
																</span>
																<span class="control add">+</span>
															</div>
															<div class="item gmz-number-wrapper">
																Adults
																<span class="control minus ">-</span>
																<span class="text">
																	<span class="value adult">1</span>               <input type="hidden" value="1" name="number_adult" data-min="1" data-max="20">
																</span>
																<span class="control add">+</span>
															</div>
															<div class="item gmz-number-wrapper">
																Children
																<span class="control minus">-</span>
																<span class="text">
																	<span class="value child">1</span>                <input type="hidden" value="0" name="number_child" data-min="0" data-max="15">
																</span>
																<span class="control add">+</span>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
									</label>
								</div>            
							</div>
							<div class="" id="bt">
								<div class="col-md-12">
									<label >
										<button>Check availability</button>
									</label>
								</div>
							</div>
						</div>
						<div class="widget-box">
							<div class="row">
								<div class="col-sm-4"><img id="avt" src="https://homap.travelerwp.com/wp-content/uploads/bfi_thumb/people_8-1-37jk0455rmyknqn5gp7uo0.jpg" alt="" /></div>
								<?php foreach ($data_hotel as $value) {
									
								 ?>
								<div class="col-sm-8 owner_name " >
									<?php echo $value['owner']; ?> <br>
									<a href="">Member Since 2018</a>
								</div>
							<?php } ?>
							</div>
						</div>
					</div>					
					<!-- end widget -->
				</div>
				<!-- end Manh -->
			</div>
		</div>
	</div>
	<!-- end content -->
	<hr style="width: 100%">
	<h2 class="st-heading text-center">Hotel Nearby</h2>
	<!-- nearby -->
	<div>
	<div class="vc_row wpb_row st bg-holder vc_custom_1542167625295 vc_row-has-fill">
		<div class="container">
			<div class="row">
				<div class="wpb_column column_container col-md-12 vc_custom_1542167696382">
					<div class="vc_column-inner wpb_wrapper">
						<div class="wpb_text_column wpb_content_element  fs-28 fs-normal">	
							<div class="services-grid">
								<!-- start Manh -->
								<div class="row">
                                    <?php
                                    foreach ($data as   $values) {

                                    ?>
									<div class="last-minute">
										<div class="col-xs-6 col-sm-6 col-md-3 has-matchHeight">
											<div class="row-content">
												<div class="wpb-content-image">
													<a href="?c=detailhotel&a=view&hotel_id=<?php echo $values['hotel_id']?> ">
                                                        <img src="<?php echo $values['images']; ?>" >
													</a>
													<div class="review-star">
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
													</div>
												</div>
												<div class="wpb-content-text">
													<div class="wpb-room-name">
														<a href="#">
                                                            <?php echo $values['hotel_name']; ?>
														</a>
													</div>
													<div class="wpb-room-adress">
														<p> <i class="fas fa-map-marker-alt"></i><?php echo $values['city_name'] ?>,<?php echo $values['country'] ?></p>

													</div>
													<div class="review">
														<div class="rate">
															<p>4.5/5 excellent</p>
														</div>
														<div class="sumary">
															<li>5 reviews</li>
														</div>

													</div>
													<div class="price-wrapper">
														<span>
															<i class="fas fa-bolt"></i>
															<span class="price-from">from</span> <span class="price-money"> €<?php echo $values['medium_price'] ?> </span>
															<span class="price-from">
																/night
															</span>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>

									
								
                                <?php } ?>
                                </div>
                                <!-- end Manh -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- end nearby -->

	<div class="clear"></div>

<?php get_footer() ?>