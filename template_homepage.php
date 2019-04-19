<?php  
/*
 Template Name: Homepage
*/
 get_header();
 
 $hotel = homepage::inst()->__ShowListHotel();


 ?>

   
    <script type="text/javascript" src="public/js/khanh.js"></script>
  
    
    <div class="clear"></div>
    <!-- Banner -->
    <div id="banner">
        <div class="container-fuil">
            <div class="banner">
                <img src="<?php echo get_template_directory_uri()?> /application/libs/Images/background.jpg" >
                <div class="container">
                    <div class="row">
                        <!-- start Hoa -->
                        <div class="wpb_column column_container col-md-12">
                            <div class="vc_column-inner wpb_wrapper">
                                <div class="search-form-wrapper" >
                                    <h1 class="st-heading">Find Your Perfect Hotels</h1>
                                    <div class="sub-heading">Get the best prices on 20,000+ properties
                                    </div>
                                    <!-- seach form -->
                                    <!-- <start hoa> -->
                                    <div class="seach-form">
                                        <div class="row">
                                         <form action="index.php?c=slidebar&a=search" method="GET">  
                                            <div class="col-md-3 border-right">
                                                <div class="form-group form-extra-field dropdown clearfix field-detination has-icon">
                                                    <i class="fas fa-map-marker-alt search-form-checkIcon"></i>
                                                </div>
                                                <div class="search-form-section">
                                                    <label for="name"  class="text-muted1";">Detination</label><br/>
                                                    <input type="hidden" name="c" value="slidebar">

                                                    <div class="dropdown dropdown-list">
                                                        <div class="dropdown-toggle"
                                                        data-toggle="dropdown" id="menu1">
                                                        <?php
                                                        if (empty($_GET['cityid'])) {
                                                            $des = 'Where are you going?';
                                                        } else {
                                                            $des = $_GET['cityname'];
                                                        } ?>
                                                        <span class="destination" 
                                                        id="spankey"><?php echo $des ?></span>
                                                    </div>
                                                    <input type="hidden" name="cityname" id="namekey"
                                                    value="">
                                                    <input type="hidden" name="cityid" id="idkey"
                                                    value="">

                                                    <ul class="dropdown-menu form-item" role="menu"
                                                    aria-labelledby="menu1" onclick="change()" id="dropdownmenu">
                                                    <?php   foreach ($dataListCity as  $values){ ?>

                                                        <li data-value="<?php echo $values['city_id'] ?>" > 
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <?php echo $values['city_name'] ?>
                                                        </li>
                                                    <?php } ?>
                                                    <?php 
                                                    $get_data = $_GET;
                                                    $cityid ="";
                                                    $cityname ="";
                                                    $start="";
                                                    $end = "";
                                                    $date = "";
                                                    $number_room ="";
                                                    $number_adult ="";
                                                    $number_child ="";
                                                    if(isset($get_data['cityid']) && isset($get_data['cityname']))
                                                    {
                                                        $cityid = '&cityid=' . $get_data['cityid'];
                                                        $cityname = "&cityname" . $get_data['cityname'];


                                                    }
                                                    if( isset($get_data['start'])  && isset($get_data['end'])  && isset($get_data['date']))
                                                    {
                                                       $start = "&start" . $get_data['start'];
                                                       $end = "&end" . $get_data['end'];
                                                       $date = "&date" . $get_data['date'];

                                                   }
                                                   if(isset($get_data['number_room']) && isset($get_data['number_adult']) && $get_data['number_child']){
                                                    $number_room =  $get_data['number_room'];
                                                    $number_adult =  $get_data['number_adult'];
                                                    $number_child =  $get_data['number_child'];
                                                   }

                                                   echo '<a href="?c=slidebar&a=view'. $cityid . $cityname . $start . $end . $date . '"></a>';
                                                   ?>

                                               </ul>
                                               <script>
                                                $(function () {

                                                    $("#dropdownmenu li").click(function (e) {

                                                        $(".destination:first-child").text($(this).text());
                                                        $(".destination:first-child").val($(this).text());
                                                        var value = $(this).data("value");
                                                        $('#idkey').val(value);
                                                    });
                                                });
                                            </script>
                                            <script>
                                                function change() {
                                                    var input = document.getElementById('namekey');
                                                    var span = document.getElementById('spankey');
                                                    input.value = span.innerText;
                                                }
                                            </script>
                                        </div>

                                    </div>
                                </div>
                                <!--  date time -->
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
                                <div class="col-md-3 border-right">
                                    <div class="form-group form-extra-field dropdown clearfix field-detination has-icon">
                                        <i class="far fa-calendar-plus  search-form-checkIcon"></i>
                                    </div>
                                    <div class="search-form-section">
                                        <label for="radio-choice-1" class="language text-muted2" >Check In-Out</label><br/>
                                        <div class="dropdow-list1 ">
                                         <div id="reportrange">
                                            <?php echo $start . ' - ' . $end ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="start" id="start"  value="<?php echo $start; ?>">
                                    <input type="hidden" name="end" id="end" value="<?php echo $end; ?>">
                                    <input type="text" name="date" id="date" value="<?php echo $start . ' - ' . $end; ?>">
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('input[name="date"]').daterangepicker(
                                            {
                                                "autoApply": true,
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
                                                $('#date').val(start.format('DD/MM/YYYY hh:mm') + ' am- ' + end.format('DD/MM/YYYY hh:m$endm') + ' pm');
                                            }
                                            );
                                        });
                                    </script>
                                </div>
                            </div>
                            <!-- end Hoa -->

                            <div class="col-md-3 border-right">
                                <div class="form-group form-extra-field dropdown clearfix field-detination has-icon">
                                    <i class="fas fa-users"></i>

                                </div>

                                <div class="search-form-section">
                                    <div class="field_people_room">
                                        <span style="" class="text-muted">Guest</span>
                                        <div class="people-inner">
                                            <div class="dropdow-list2">
                                                <div class="people-group">
                                                    <span class="homepage_label">
                                                        <span class="homepage_value">
                                                            <span class="adult_values">1 Adult</span>
                                                            <span class="child_values">0 Children</span>
                                                            <i class="fa ml5 fa-angle-up"></i>
                                                        </span>
                                                    </span>
                                                    <div class="formdebook">
                                                        <div class="row">
                                                            <div class="people-dropdown" >
                                                                <div class="item gmz-number-wrapper">
                                                                    <span class="control minus">-</span>
                                                                    <span class="text txt-guest">
                                                                        <span class="value room">1</span>&nbsp; Room<small>(</small>s<small>)</small>                <input type="hidden" value="1" name="number_room" data-min="1" data-max="20">
                                                                    </span>
                                                                    <span class="control add">+</span>
                                                                </div>
                                                                <div class="item gmz-number-wrapper">
                                                                    <span class="control minus">-</span>
                                                                    <span class="text txt-guest">
                                                                        <span class="value adult">1</span>&nbsp; Adult<small>(</small>s<small>)</small>                <input type="hidden" value="1" name="number_adult" data-min="1" data-max="20">
                                                                    </span>
                                                                    <span class="control add">+</span>
                                                                </div>
                                                                <div class="item gmz-number-wrapper">
                                                                    <span class="control minus">-</span>
                                                                    <span class="text txt-guest">
                                                                        <span class="value child">1</span>&nbsp; Children<small>(</small>s<small>)</small>                <input type="hidden" value="0" name="number_child" data-min="0" data-max="15">
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
                                </div>
                            </div>
                            <div class="col-md-3 col-search-form search-form-style">
                                <div class="form-button">
                                    <div class="advantice">
                                        <div class="form-group form-extra-field dropdown clearfix field-advance">
                                            <label class="hidden-xs">
                                                Advantice
                                            </label>
                                            <div class="dropdown-factilities dropdow">
                                                <div class="render">
                                                    <span class="hidden-xs hidden-more">
                                                        More
                                                        <i class="fas fa-sort-down"></i>

                                                        <div class="dropdown-menu-facilities">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="item-title">
                                                                        <h4>Filter Price</h4>
                                                                    </div>
                                                                    <div class="demo">
                                                                      <input type="text" class="js-range-slider" name="my_range" value="" />
                                                                      <script type="text/javascript">
                                                                        $(".js-range-slider").ionRangeSlider({
                                                                            type:'double',
                                                                            min: 10,
                                                                            max: 315,
                                                                            skin: "big",
                                                                            prefix: "$"
                                                                        });
                                                                    </script>           
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="facilities">
                                                                <div class="item-title">
                                                                    <h4>
                                                                        Hotel Facilities
                                                                    </h4>
                                                                    <div class="check-radio-homepage">
                                                                        <div class="col-md-4">
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Air Conditioning <br>
                                                                            </p>
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  
                                                                                Flat Tv <br>
                                                                            </p>
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  
                                                                                Paking <br>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Airport Transport <br>
                                                                            </p>
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Heater
                                                                                <br>
                                                                            </p>
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Pool <br>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Fitness Centre <br>
                                                                            </p>
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Internet - Wifi <br>
                                                                            </p>
                                                                            <input type="checkbox" class="input-advantice" name="check" value="Air Conditioning"><p class="text-advantice">  Restaurant <br>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="btn-seach-homepage">
                                <button class="seach-homepage"> SEARCH</button>
                                    <input type="hidden" name="a" value="search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- end seach-form -->
        </div>
    </div>
</div>
<!-- end Hoa -->
</div>

</div>

</div>
</div>
</div>
<!-- end banner -->
<div class="clear"> </div>
<div class="vc_row wpb_row st bg-holder vc_custom_1542955832597">
    <div class="container">
        <div class="row">
            <div class="wpb_column column_container col-md-4">
                <div class="vc_column-inner wpb_wrapper">
                    <div class="row-col-image">
                        <img src="https://homap.travelerwp.com/wp-content/uploads/2018/12/ico_eath.svg">
                    </div>
                    <div class="row-col-text">
                        <div class="title">
                            <p>20,000+ properties</p>
                        </div>
                        <div class="desc">
                            <p>Morbi semper fames lobortis ac hac penatibus</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wpb_column column_container col-md-4">
                <div class="vc_column-inner wpb_wrapper">

                    <div class="row-col-image">
                        <img src="https://homap.travelerwp.com/wp-content/uploads/2018/12/ico_insurance.svg">
                    </div>
                    <div class="row-col-text">
                        <div class="title">
                            <p>Trust & Safety</p>
                        </div>
                        <div class="desc">
                            <p>Morbi semper fames lobortis ac hac penatibus</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wpb_column column_container col-md-4">
                <div class="vc_column-inner wpb_wrapper">
                    <div class="row-col-image">
                        <img src="https://homap.travelerwp.com/wp-content/uploads/2018/12/ico_piggy-bank.svg">
                    </div>
                    <div class="row-col-text">
                        <div class="title">
                            <p>Best Price Guarantee</p>
                        </div>
                        <div class="desc">
                            <p>Morbi semper fames lobortis ac hac penatibus</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="vc_row wpb_row st bg-holder vc_custom_1542167625295 vc_row-has-fill">
    <div class="container">
        <div class="row">
            <div class="wpb_column column_container col-md-12 vc_custom_1542167696382">
                <div class="vc_column-inner wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element  fs-28 fs-normal">
                        <div class="wpb_wrapper">
                            <h2>The Most Preferential Price</h2>
                        </div>
                        <!-- Start Manh -->
                        <div class="services-grid">
                        
                            <div class="row">
                                
                              <?php if($hotel->have_posts()) : ?>
                                <?php while($hotel->have_posts()) : $hotel->the_post(); ?>
                                    <?php $s= get_post(get_the_ID());

                                        
                                  ?>
                                     <div class="last-minute">
                                            <div class="col-xs-6 col-sm6 col-md-3 has-matchHeight">
                                                <div class="row-content">
                                                    <div class="wpb-content-image">
                                                        <a href="#">
                                                            <?php the_post_thumbnail(get_the_ID()); ?>
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


                                                                <?php the_title(); ?>

                                                            </a>
                                                        </div>
                                                        <div class="wpb-room-adress">
                                                            <p> <i class="fas fa-map-marker-alt"></i>
                                                                <?php  $location =get_the_terms(get_the_ID(),'location'); 
                                                                
                                                                echo $location[0]->name.", ".$location[1]->name;                                
                                                           
                                                           ?>

                                                        </p>

                                                        </div>
                                                        <div class="review">
                                                            <div class="rate">
                                                                <p><?php echo($s->hotel_point); ?>/5 excellent</p>
                                                            </div>
                                                            <div class="sumary">
                                                                <li>5 reviews</li>
                                                            </div>
                                                        </div>
                                                        <div class="price-wrapper">
                                                            <span>
                                                                <i class="fas fa-bolt"></i>
                                                                <span class="price-from">from</span> <span class="price-money"> € <?php echo($s->price); ?> </span>
                                                                <span class="price-from">
                                                                    /night
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                <?php endwhile; ?>
                              <?php endif; ?>
                                
                            </div>
                              
                                
                             
                                  
                            </div>
                        
                        </div>
                    </div>
                    <!-- end Manh -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<div class="wpb_column column_container vc_custom_1543548162184">
    <div class="container">
        <div class="vc_row wpb_row st bg-holder">
            <div class="container">
                <div class="row">
                    <div class="vc_column-inner wpb_wrapper">
                        <div class="wpb_text_column wpb_content_element  fs-28 fs-normal">
                            <div class="wpb_wrapper">
                                <h2>Top Destinations</h2>
                            </div>
                        </div>
                        <!-- Start Manh -->
                        <div class="row list-destination">
                              
                              <?php if($hotel->have_posts()) : ?>
                                <?php while($hotel->have_posts()) : $hotel->the_post(); ?>
                                    <?php $s= get_post(get_the_ID());

                                        
                                  ?>

                            <div class="col-xs-6 col-sm-6 col-md-4 ">
                                <div class="destination-item">
                                    <a href="?c=slidebar&a=search&cityname=<?=$val['city_name']?>&cityid=<?=$val['city_id']?>&start=<?=$start ?>&end=<?=$end?>&date=<?=$date ?>">
                                        <?php 


                                        $location_image = get_post_meta(get_the_ID(),'_owner',true);   
                                        dd($location_image);die;    
                                        $data = wp_get_attachment_image_src($location_image);
                                        
                                        echo '<img src="'. $data[0] .'">';
                                         ?>
                                    </a>

                                    <div class="text-content">
                                        <div class="title-name">
                                            <h2>Hotel_name</h2>

                                            <div class="desc-inf">
                                                <h3> Số hotel properties</h3>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                             <?php endwhile; ?>
                              <?php endif; ?>
                     
                    </div>
                    <!-- end Manh -->
                </div>
            </div>
            <div class="view-all">
                <div class="btn-view-all">
                    <button>View all destinations</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<?php get_footer() ?>