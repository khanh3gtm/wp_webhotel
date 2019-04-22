<?php get_header(); ?>

  <div id="st-content-wrapper">
    <div class="st-breadcrumb">
      <div class="container">
        <ul>
          <li><a href="">Home</a></li>
          <li><a href="">United States</a></li>
          <li>
            <!-- <?php 
            if(!empty($data_hotel)){
              ?>
              <?php 
              foreach ($data_hotel as $values) {
                ?>
                <a href=""><?php echo $values['hotel_name'] ?></a>
                <?php     
              }?>
            <?php } ?> -->

            <!-- <?php 
            global $wpdb;
              // $results = $wpdb->get_results("SELECT post_title, ID FROM wp_posts INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id;");
              $results = $wpdb->get_results("SELECT meta_value, post_id FROM wp_postmeta INNER JOIN wp_posts ON wp_postmeta.post_id = wp_posts.ID;");
              if(!empty($results)){
                foreach ($results as $value) {
                  echo $results->meta_value;
                }
              }

             ?> -->
          </li>
          <?php $query = get_post(get_the_ID());
          $title = apply_filters('the_title', $query->post_title);
          echo $title; ?>
        </ul>
      </div>
    </div>
    <div class="clear"></div>
    <!-- slide -->
    <?php
    if(!empty($data_room)){
      ?>
            <!-- <tr>
                <th>ID</th>
                <th>Room</th>
              </tr> -->
              <?php
              foreach ($data_room as $values){
                ?>
                <div class="container-fuild">
                  <div class="banner" 
                  style="background: url('<?php echo $values['room_images']; ?>');min-height: 355px;background-size: cover;background-position: center;background-repeat: no-repeat;">

                </div>
              </div>
              <?php
            }?>
          <?php } ?>


          <!-- slide -->
          <div class="container">
            <!-- st-content-hotel -->
            <div class="st-hotel-content">
              <div class="hotel-target-book-mobile" >
                <div class="price-wrapper">
                  from <span class="price">€565</span>                        
                </div>
                <button type="submit" class="btn-book" name="room_add_to_cart">Book Now</button>
              </div>
            </div>
            <div class="clear"></div>
            <div class="row">
              <div class="col-md-9">
                <!--  -->
                <div class="row">
                  <div class="col-md-12 col-sm-10 col-xs-12">
                    <div class="double-room">
                      <h2 class="st-heading"><?php echo $values['room_name']; ?></h2>
                      <div class="sub-heading">
                        <i class="fas fa-map-marker-alt"></i><span> Hotel :    
                          <?php
                          $hotel = get_post_meta(get_the_ID(), 'st_contact_hotel_field', true);
                          $resHotel = get_the_title($hotel);
                          echo $resHotel;
                           ?>
                        </span>
                      </div>
                    </div>
                    <div class="st-right ">
                      <i class="fa fa-star" ></i>
                      <i class="fa fa-star" ></i>
                      <i class="fa fa-star" ></i>
                      <i class="fa fa-star" ></i>
                      <i class="fa fa-star" ></i>
                    </div>
                  </div>
                </div>
                <!--  -->
                <!-- biểu tượng -->
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="theicon">

                      <hr>
                      <div class="row">
                        <div class="col-md-3 col-xs-6">
                          <div class="icon">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            
                            <?php 
                              $superficies = get_post_meta(get_the_ID(), 'st_contact_superficies_field', true);
                              echo $superficies; 
                            ?>
                            
                          </div>
                        </div>
                        <div class="col-md-3 col-xs-6">
                          <div class="icon">
                            <i class="fa fa-bed" aria-hidden="true"></i>
                            <?php 
                              $beds = get_post_meta(get_the_ID(), 'st_contact_bed_field', true);
                              echo $beds; 
                            ?>

                          </div>

                        </div>
                        <div class="col-md-3 col-xs-6">
                          <div class="icon">
                            <i class="fa fa-venus-double" aria-hidden="true"></i><p> 
                            <?php $adult = get_post_meta(get_the_ID(), 'st_contact_adult_field', true);
                              echo $adult;
                             ?>
                            </p></div>
                          </div>
                          <div class="col-md-3 col-xs-6">
                            <div class="icon">
                              <i class="fa fa-child" aria-hidden="true"></i>
                              <?php

                                $children = get_post_meta(get_the_ID(), 'st_contact_children_field', true);
                                echo $children;
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end biểu tượng -->
                  <hr >
                  <!-- slide -->
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="fotorama" data-width="1100" data-ratio="3/2" data-fit="cover" data-allowfullscreen="native">
                        <?php $image = get_post_meta(get_the_ID(), 'metabox-image-id', true);
                        $url = explode(',', $image); ?>
                        <?php 
                          if(!empty($url)){
                            foreach ($url as $value) {
                              if(!empty($value)){
                                $url_image = wp_get_attachment_image_url($value, 'thumbnail');
                                echo '<img src="'. $url_image .'" alt="" data-id="'. $value .'">';
                              }
                            }
                          }
                         ?>
              
                        <!-- <a href="libs/Images/khanh1.jpg" ></a>
                        <a href="libs/Images/khanh2.jpg" ></a>
                        <a href="libs/Images/khanh3.jpg" ></a>
                        <a href="libs/Images/khanh4.jpg" ></a>
                        <a href="libs/Images/khanh5.jpg" ></a>
                        <a href="libs/Images/khanh6.jpg" ></a> -->
                      </div>
                    </div>
                  </div>
                  <!-- end slide -->
                  <hr >
                  <!-- description -->
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <h2 class="st-heading-section">Description
                      </h2> 
                      <?php $query = get_post(get_the_ID()); 
                      $content = apply_filters('the_content', $query->post_content);
                      echo $content; ?>
                      <!-- <?php $res =  get_post_meta(get_the_ID(), 'post_content', true);
                      echo $res; ?> -->
                      <div class="st-description" data-toggle-section="st-description" data-show-all="st-description" data-height="120" >
                        <p></p>
                        <div class="cut-gradient"></div>
                      </div>
                    </div>
                  </div>
                     <?php $data = get_post(1852);
                    dd($data); ?>
                    <?php $data1 = get_post_meta(1852);
                    dd($data1); ?>
                  <a href="#"><span class="text">View more</span></a>
                  <!-- end description -->
                  <hr >
                  <!-- Amenities -->
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <h2 class="st-heading-section">Amenities
                      </h2>
                      <div class="facilities">
                        <div class="container-fuild">
                          <div class="row">
                           <?php
                           if(!empty($data_amenities)){
                            ?>
                            <?php
                            foreach ($data_amenities as $values){
                              ?>
                              <div class="col-xs-6 col-sm-6 col-md-4 fac">
                                <i class="fa <?php echo $values['service_icon']; ?>"></i>
                                <p><?php echo $values['service']; ?></p>

                              </div> 
                              <?php
                            //dd($data_amenities);
                            }?>
                          <?php } ?> 
                          <!-- <?php $res = get_post(1852);
                              dd($res); ?> -->
                        </div>

                      </div>
                    </div>
                    <?php if(count($data_amenities) >6){ ?>
                    <a href="#"><span class="text1">Show all</span></a> 
                  <?php } ?> 
                  </div>

                  

                  <!-- end facilities -->

                  <!-- Rules -->

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <hr >
                    <div class="rules">
                      <h2 class="st-heading-section">Rules</h2>
                      <div class="row">
                        <div class="col-md-4">
                          <p>Check In</p>
                        </div>
                        <div class="col-md-8">
                          <p>12:00 AM - 23:00 PM</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <p>Check Out</p>
                        </div>
                        <div class="col-md-8">
                          <p>6:00 AM - 12:00 AM</p>
                        </div>
                      </div>

                    </div>
                  </div>
                  <hr />
                  <!-- end Rules -->
                  <!-- Review -->

                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                      <div class="col-sm-8">
                        <h2 class="st-heading-section">Review</h2>
                      </div>
                      <div class="col-sm-4">
                        <div class="st-re">
                          <p>45 Review
                            <i class="fa fa-star st-room" style="color:yellow"></i>
                            <i class="fa fa-star st-room" style="color:yellow"></i>
                            <i class="fa fa-star st-room" style="color:yellow"></i>
                            <i class="fa fa-star st-room" style="color:yellow"></i>
                            <i class="fa fa-star st-room" style="color:black"></i>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end review -->
                  <!-- review-list -->
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="review-list">
                        <div class="comment-item">
                          <div class="comment-item-head">
                            <div class="media">
                              <div class="media-left">
                                <img alt="avatar" width="50" height="50" src="libs/Images/8.jpg" class="avatar avatar-96 photo origin round">                    
                              </div>
                              <div class="media-body1">
                                <h4 class="media-heading">Travis Tan</h4>
                                <div class="date">11/12/2018</div>
                              </div>
                            </div>
                          </div>
                          <div class="comment-item-body">
                            <div class="form-group check-like">
                              <span class="number"><span class="like">9999</span> Like</span>
                              <span class="glyphicon glyphicon-thumbs-up"></span>
                            </div>
                            <div class="st-cmt">
                              <i class="fa fa-star st-room "  ></i>
                              <i class="fa fa-star st-room "  ></i>
                              <i class="fa fa-star st-room "  ></i>
                              <i class="fa fa-star st-room "  ></i>
                              <i class="fa fa-star st-room "  ></i>
                            </div>
                            <div class="detail">
                              <div class="st-description" data-show-all="st-description-163">
                                Great location, great host, hot water, big bed. Kitchen and washer/dryer work well. It is a tiny space but is advertised that way. I’d come back because the location is amazing and I also felt very secure here. My baby boomer mom had to climb stairs to reach the bed, but it was very cozy and she’s spry enough.                    
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--  -->
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="comment-item">
                              <div class="comment-item-head">
                                <div class="media">
                                  <div class="media-left">
                                    <img alt="avatar" width="50" height="50" src="libs/Images/8.jpg" class="avatar avatar-96 photo origin round">                    
                                  </div>
                                  <div class="media-body1" >
                                    <h4 class="media-heading">Donald Wolf</h4>
                                    <div class="date">07/12/2018</div>
                                  </div>
                                </div>

                              </div>
                              <div class="comment-item-body">
                               <div class="form-group check-like">
                                <span class="number"><span class="like" >999999</span> Like</span>
                                <span class="glyphicon glyphicon-thumbs-up"></span>
                              </div>
                              <div class="st-cmt">
                                <i class="fa fa-star st-room "  ></i>
                                <i class="fa fa-star st-room "  ></i>
                                <i class="fa fa-star st-room "  ></i>
                                <i class="fa fa-star st-room "  ></i>
                                <i class="fa fa-star st-room "  ></i>
                              </div>
                              <div class="detail">
                                <div class="st-description" data-show-all="st-description-96">
                                  The bathroom was super old! 30 years old!! Pieces of tiles were missing... regardless of the fact that it was clean, it looks really old. 
                                  The food at breakfast was of very poor quality. The scrambled and boiled eggs were practically inedible. I find the variety of food at breakfast very limited for a 4 star hotel which charges 300 euro a night.                    
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
                <!--review-list  -->
                <!-- write  -->
                <div id="review-room">
                  <h4 class="heading">
                    <div class="dangky">Write a review
                      
                    </div>
                    <div class="chodeformdangki">
                      <div class="formdangky">
                        <div class="row">
                          <div class="col-md-12">
                            <form>
                              <div class="row">
                                <br>
                                <div class="col-md-6">
                                  <!-- Name -->
                                  <input type="text" class="form-control" placeholder="Name" required="">
                                </div>
                                <div class="col-md-6">
                                  <!-- Email -->
                                  <input type="email" class="form-control" placeholder="Email*" required="">
                                </div>
                              </div>
                              <div class="row">
                                <br>
                                <br>
                                <div class="col-md-6">
                                  <!-- Title -->
                                  <input type="text" class="form-control" placeholder="Title" required="">
                                </div>              
                                <div class="col-md-6">
                                  <!-- Rating -->
                                  <label class="abc1">Your Rating</label>
                                  <div class="stars-room">
                                    <form action="">
                                      <input class="star star-5" id="star-5" type="radio" name="star"/>
                                      <label class="star star-5" for="star-5"></label>
                                      <input class="star star-4" id="star-4" type="radio" name="star"/>
                                      <label class="star star-4" for="star-4"></label>
                                      <input class="star star-3" id="star-3" type="radio" name="star"/>
                                      <label class="star star-3" for="star-3"></label>
                                      <input class="star star-2" id="star-2" type="radio" name="star"/>
                                      <label class="star star-2" for="star-2"></label>
                                      <input class="star star-1" id="star-1" type="radio" name="star"/>
                                      <label class="star star-1" for="star-1"></label>
                                    </form>
                                  </div>
                                </div>
                                <div class="row">
                                  <!-- Content -->
                                  <div class="form-group">
                                    <div class="form-message col-xs-12">
                                      <textarea class="control-custom" rows="10" cols="5" placeholder="Content"></textarea>
                                      <span class="bar"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group" style="padding-top: 20px;">
                                <button class="btn-cmt">Leave a Review</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </h4>
                </div>
                <!-- end write -->
              </div></div>
              <div class="col-md-3 abc"  >
                <!-- widget -->
                <form action="" method="post">
                  <input type="hidden" name="room_id" value="<?php echo '1815'; ?>" />
                  <div class="container-fluid widgetroom">
                    <div class="widgets"  >
                      <div class="form-head">
                        from
                        <?php
                          $price = get_post_meta(get_the_ID(), 'st_contact_price_field', true);
                          echo $price;
                        ?>

                       
                        <!--  <input type="hidden" name="room_id" value="<?php $values['room_id'] ?>" > -->
                        <span class="unit">/night</span>
                      </div>
                      <div class="row">
                        <p class="abc2">Check in - Check out</p>
                        <?php
                                    //Co $_GET['start'];
                                    //Kho cos

                        $start = date('d-m-Y');
                        $end = date('d-m-Y', strtotime(' + 1 days'));
                        $date = date('d-m-Y') . ' 12:00 am - ' . date('d-m-Y', strtotime(' + 1 days')) . ' 11:59 pm';

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

                        <input type="hidden" name="start" id="start" value="<?php echo $start; ?>">
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
                      <hr/>
                      <div class="row">

                        <div class="col-md-12">
                          <div class="" id="guests1">
                            <div class="abc3">
                              Guests
                            </div>
                            <br>
                            <label >
                              <div class="row">
                                <div class="field_people_room">
                                  <div class="people-inner">
                                    <div class="people-group">
                                      <span class="label">
                                        <span class="value">
                                          <span class="adult">1 Adult</span> -
                                          <span class="child">0 Child</span>
                                        </span>
                                      </span>
                                      <div class="bookphong">
                                        <i class="fa ml5 fa-angle-up" ></i>
                                      </div>
                                      <div class="formdebook">
                                        <div class="people-dropdown">
                                          <div class="item gmz-number-wrapper">
                                            Rooms
                                            <span class="control minus">-</span>
                                            <span class="text">
                                              <span class="value room">1</span>               
                                              <input type="hidden" value="1" name="number_room" data-min="1" data-max="20">
                                            </span>
                                            <span class="control add">+</span>
                                          </div>
                                          <div class="item gmz-number-wrapper">
                                            Adults
                                            <span class="control minus">-</span>
                                            <span class="text">
                                              <span class="value adult" id="test1">1</span>               
                                              <input type="hidden" value="1" name="number_adult" data-min="1" data-max="20">
                                            </span>
                                            <span class="control add">+</span>
                                          </div>
                                          <div class="item gmz-number-wrapper">
                                            Children
                                            <span class="control minus">-</span>
                                            <span class="text">
                                              <span class="value child">1</span>                
                                              <input type="hidden" value="0" name="number_child" data-min="0" data-max="15">
                                            </span>
                                            <span class="control add">+</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div> 
                      <!-- more -->
                      <div class="row">
                        <div class="" id="bt1">
                          <div class="form-group form-more-extra">
                            <div class="more">
                              <a href="#dropdown-more-extra" class="dropdown">
                                More Option
                                <i class="fa fa-caret-down"></i></a>
                              </div>
                              <ul class="extras">
                                <div class="row">
                                  <li class="item mt10">
                                    <div class="st-flex space-between">
                                      <div class="col-sm-9">
                                        <span>Adult(€280.00)</span>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="select-wrapper">
                                          <select class="chon-adult" data-extra-price="280">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" name="extra_price[price][extra_adult]" value="280">
                                    <input type="hidden" name="extra_price[title][extra_adult]" value="Adult">
                                  </li>
                                </div>
                                <div class="row">
                                  <li class="item mt10">
                                    <div class="st-flex space-between">
                                      <div class="col-sm-9">
                                        <span>Children(€245.00)</span>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="select-wrapper">
                                          <select class="chon-children" data-extra-price="245">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                          </select>
                                        </div>
                                      </div>
                                      <input type="hidden" name="extra_price[price][extra_children]" value="245">
                                      <input type="hidden" name="extra_price[title][extra_children]" value="Children">
                                    </li>
                                  </div>
                                  <div class="row">
                                    <li class="item mt10">
                                      <div class="st-flex space-between">
                                        <div class="col-sm-9">
                                          <span>Vip services(€175.00)</span>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="select-wrapper">
                                            <select class="chon-services" data-extra-price="175">
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <input type="hidden" name="extra_price[price][extra_service]" value="175">
                                      <input type="hidden" name="extra_price[title][extra_service]" value="Vip services">
                                    </li>
                                  </div>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <!-- book -->
                          <div class="row">
                            <div class="booknow">
                              <button type="submit" class="btn-book" name="room_add_to_cart">Book Now</button>
                            </div>
                          </div>
                        </div>
                      </div>          
                      <!-- end widget -->
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- form nhỏ -->

            <!-- book -->

          </div>
        </div>
<?php get_footer(); ?>