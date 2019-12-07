<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/starability/2.4.2/starability-minified/starability-all.min.css">
<script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcIksEUAAAAAIpM_iyzM5jfRyyMF5pbJs_VLg6S"></script>
 

<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title"> <i class="mdi mdi-account-circle title_icon"></i> <?php echo get_phrase('add_new_listing'); ?></h4>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="row">
         
      </div>
    </div>
  </div>
</div>
   
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <!-- <h4 class="header-title mb-3"><?php echo get_phrase('add_listing'); ?></h4> -->
        <form action="<?php echo site_url('user/listings_submit'); ?>" method="post" role="form" class="form-horizontal form-groups-bordered listing_add_form" enctype="multipart/form-data">

          <div id="basicwizard">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
              <li class="nav-item" style="display: none;">
                <a href="#first" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                  <!-- <i class="mdi mdi-account-circle mr-1"></i>
                  <span class="d-none d-sm-inline">Details</span> -->
                </a>
              </li>
            
    
              
            </ul>

            <div class="tab-content mb-0 b-0">

              <div class="tab-pane" id="first">
                <div class="row justify-content-center">
                  <div class="col-lg-8">

                    <input type="hidden" name="total_listing" value="<?php echo $total_listing; ?>">
                    <input type="hidden" name="submited_listing" value="<?php echo $submited_listing; ?>">

                     <div class="form-group row mb-3">
                  <label class="col-md-2 col-form-label" for="title">Google Maps Location<span class="required">*</span></label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" id="location" name="location" placeholder="" required>
                  </div>
                </div>
                  <div class="form-group row mb-3">
                        

                    <div id="form-map"  style="height: 350px;width: 800px;margin: 0.6em;"></div>
                  </div>

                    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="is_spray"> Spray Available?</label>
                      <div class="col-md-10">
                        
                        
                        <select class="form-control" name="is_spray" id = "is_spray" onchange="hidespray(this.value)">
                          <option value="1"> YES </option>
                          <option value="0">NO</option>
                        </select>
                      </div>
                    </div>

                <!--      <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group row mb-3">
                      <label class="col-md-4 col-form-label" for="f_name">First Name</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="f_name" name="f_name" >
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group row mb-3">
                      <label class="col-md-4 col-form-label" for="l_name">Last Name</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="l_name" name="l_name" >
                      </div>
                    </div>
                  </div>
                </div> -->
                 <input type="hidden" name="f_name" value="">
                <input type="hidden" name="l_name" value="">
                <input type="hidden" name="email" value="">
            <!--     <div class="form-group row mb-3">
                  <label class="col-md-2 col-form-label" for="email">Email </label>
                  <div class="col-md-10">
                    <input type="email" class="form-control" placeholder="We will never use or expose your email address. Ever." id="email" name="email" required>
                  </div>
                </div> -->
                <input type="hidden" name="country_id" value="country">
                <input type="hidden" name="city_id" value="city">
                <!-- <div class="form-group row mb-3">
                  <label class="col-md-2 col-form-label" for="country">Country <span class="required">*</span></label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" id="country" name="country_id" placeholder="" required>
                  </div>
                </div>
                <div class="form-group row mb-3">
                  <label class="col-md-2 col-form-label" for="title">City <span class="required">*</span></label>
                  <div class="col-md-10">
                    <input placeholder="" type="text" class="form-control" id="city" name="city_id" required>
                  </div>
                </div> -->
                <!--  <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="country_id"> <?php echo get_phrase('country'); ?></label>
                      <div class="col-md-10">
                        <select class="form-control select2 " data-toggle="select2" name="country_id" id="placecomplete" onchange="getCityList(this.value)">
                          <option value=""><?php echo get_phrase('select_country'); ?></option>
                          
                        </select>
                      </div>
                    </div> -->

                 <!--    <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="city_id"> <?php echo get_phrase('city'); ?></label>
                      <div class="col-md-10">
                        <select class="form-control select2" data-toggle="select2" name="city_id" id="city_id">
                          <option value=""><?php echo get_phrase('select_city'); ?></option>
                        </select>
                      </div>
                    </div> -->
                    <input type="hidden" name="latitude" id="latitude" >
                    <input type="hidden" name="longitude" id="longitude" >
                       <!-- <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="latitude"><?php echo get_phrase('latitude'); ?></label>
                      <div class="col-md-10">
                        <input type="text" onblur="codeAddress()" class="form-control" id="latitude" name="latitude" placeholder="<?php echo get_phrase('you_can_provide_latitude_for_getting_the_exact_result'); ?>">
                      </div>
                    </div> -->

                    <!-- <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="longitude"><?php echo get_phrase('longitude'); ?></label>
                      <div class="col-md-10">
                        <input onblur="codeAddress()" type="text" class="form-control" id="longitude" name="longitude" placeholder="<?php echo get_phrase('you_can_provide_longitude_for_getting_the_exact_result'); ?>">
                      </div>
                    </div> -->
                <input type="hidden" name="is_featured" value="1">
                    <input type="hidden" name="handicap" value="1">
                    <!-- <div class="form-group row mb-3">
                      <label class="col-md-2 col-form-label" for="featured_type">Handicap Accessible?</label>
                      <div class="col-md-10">
                        
                        
                        <select class="form-control" name="handicap" id = "handicap" >
                         
                          <option value="1"> YES </option>
                          <option value="0">NO</option>
                        </select>
                      </div>
                    </div> -->
                    <input type="hidden" name="categories[]" value="1">
                    <input type="hidden" name="listing_thumbnail" value="">


                   <!--    <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="longitude"><?php echo get_phrase('listing_thumbnail'); ?> </label>
                    <div class="col-md-10">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name = "listing_thumbnail" id="listing_thumbnail" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                          <label class="custom-file-label ellipsis" for="listing_thumbnail"><?php echo get_phrase('choose_listing_thumbnail'); ?></label>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  

                  


                  <!-- <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="longitude"><?php echo get_phrase('listing_cover'); ?> </label>
                    <div class="col-md-10">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name = "listing_cover" id="listing_cover" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                          <label class="custom-file-label ellipsis" for="listing_cover"><?php echo get_phrase('choose_listing_cover'); ?></label>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  

                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="listing_images">Upload Image(s) </label>
                    <div class="col-md-10">
                      <div id="photos_area">
                        <div class="row">
                          <div class="col-10 pr-0">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="filestoupload" name = "listing_images[]" id="" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                <label class="custom-file-label ellipsis" for=""><?php echo get_phrase('choose_file'); ?></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-2">
                            <button type="button" class="btn btn-primary btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="appendPhotoUploader()"> <i class="fa fa-plus"></i> </button>
                          </div>
                        </div>
                      </div>
                      <div id="blank_photo_uploader">
                        <div class="row mt-2 appendedPhotoUploader">
                          <div class="col-10 pr-0">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name = "listing_images[]" id="" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                <label class="custom-file-label ellipsis" for=""><?php echo get_phrase('choose_file'); ?></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-2">
                            <button type="button" class="btn btn-danger btn-sm" style="margin-top: 2px; float: right;" name="button" onclick="removePhotoUploader(this)"> <i class="fa fa-minus"></i> </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <h4>Review</h4>
                   </div>
                  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="clean">Cleanliness </label>
                    <div class="col-md-10">
                      <div class="input-group">
                          <fieldset class="starability-basic">
                            <input type="radio" id="rate5" checked="" name="cleanliness" value="1" />
                            <label for="rate5" title="Amazing">5 stars</label>
                            <input type="radio" id="rate4" name="cleanliness" value="2" />
                            <label for="rate4" title="Very good">4 stars</label>
                            <input type="radio" id="rate3" name="cleanliness" value="3" />
                            <label for="rate3" title="Average">3 stars</label>
                            <input type="radio" id="rate2" name="cleanliness" value="4" />
                            <label for="rate2" title="Not good">2 stars</label>
                            <input type="radio" id="rate1" name="cleanliness" value="5" />
                            <label for="rate1" title="Terrible">1 star</label>
                          </fieldset>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-3 sprayrate">
                    <label class="col-md-2 col-form-label" for="preshsure">Spray Pressure </label>
                    <div class="col-md-10">
                      <div class="input-group">
                          <fieldset class="starability-basic">
                    <input type="radio" id="pres5" checked="" name="preshsure" value="1" />
                    <label for="pres5" title="Amazing">5 stars</label>
                    <input type="radio" id="pres4" name="preshsure" value="2" />
                    <label for="pres4" title="Very good">4 stars</label>
                    <input type="radio" id="pres3" name="preshsure" value="3" />
                    <label for="pres3" title="Average">3 stars</label>
                    <input type="radio" id="pres2" name="preshsure" value="4" />
                    <label for="pres2" title="Not good">2 stars</label>
                    <input type="radio" id="pres1" name="preshsure" value="5" />
                    <label for="pres1" title="Terrible">1 star</label>
                  </fieldset>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="privacy" value="">
                 <!--  <div class="form-group row mb-3">
                    <label class="col-md-2 col-form-label" for="longitude">Privacy </label>
                    <div class="col-md-10">
                      <div class="input-group">
                          <fieldset class="starability-basic">
                    <input type="radio" id="priv5" name="privacy" checked="" value="5" />
                    <label for="priv5" title="Amazing">5 stars</label>
                    <input type="radio" id="priv4" name="privacy" value="4" />
                    <label for="priv4" title="Very good">4 stars</label>
                    <input type="radio" id="priv3" name="privacy" value="3" />
                    <label for="priv3" title="Average">3 stars</label>
                    <input type="radio" id="priv2" name="privacy" value="2" />
                    <label for="priv2" title="Not good">2 stars</label>
                    <input type="radio" id="priv1" name="privacy" value="1" />
                    <label for="priv1" title="Terrible">1 star</label>
                  </fieldset>
                      </div>
                    </div>
                  </div> -->
                 
                 <div class="form-group row mb-3">
                  <label class="col-md-2 col-form-label" for="title">Comments</label>
                  <div class="col-md-10">
                    <textarea class="form-control" id="comments" name="comments"><?php echo $listing_details['comments']; ?></textarea>
                  </div>
                </div>



                  <div class="form-group row mb-3">
                   <p class="w-75 mb-2 mx-auto"><?php //echo get_phrase('you_are_almost_there').'. '.get_phrase('please_check_if_you_have_provided_all_the_necessary_things').'.'; ?></p>
                       <p> <input type="button" class="btn btn-primary" name="button" value="<?php echo get_phrase('submit'); ?>" onclick="checkMinimumFieldRequired()"></p>
                  </div>

                  </div> <!-- end col -->
                </div> <!-- end row -->
              </div>

               

           

 
             <!--  <div class="tab-pane fade" id="finish">
                <div class="row">
                  <div class="col-12">
                    <div class="text-center">
                      <h2 class="mt-0">
                        <i class="mdi mdi-check-all"></i>
                      </h2>
                      <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?> !</h3>
                      <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_almost_there').'. '.get_phrase('please_check_if_you_have_provided_all_the_necessary_things').'.'; ?></p>
			                 <p> <input type="button" class="btn btn-primary" name="button" value="<?php echo get_phrase('submit'); ?>" onclick="checkMinimumFieldRequired()"></p>
                      </div>
                    </div>
                  </div>
                </div> -->

                <!-- <ul class="list-inline wizard mt-3" style="text-align: center;">
                  <li class="previous list-inline-item"><a href="#" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a></li>
                  <li class="next list-inline-item"><a href="#" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a></li>
                </ul> -->

              </div> <!-- tab-content -->
            </div> <!-- end #rootwizard-->
          </form>

        </div> <!-- end card-body -->
      </div>
    </div>
  </div>
       
<<<<<<< HEAD
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=<?php echo GOOGLE_API ?>" type="text/javascript"></script>
=======
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=" type="text/javascript"></script>
>>>>>>> 109015e421422deed9de8bfd7a71aa9dd56b8439

  <script type="text/javascript">

$(document).ready(function () {
    initSummerNote(['#comments']);
  });
  // User Specific Data
  var highestNumberOfCategories = parseInt('<?php echo get_feature_limit('number_of_categories'); ?>');
  var highestNumberOfPhotos     = parseInt('<?php echo get_feature_limit('number_of_photos'); ?>');
  var highestNumberOfTags       = parseInt('<?php echo get_feature_limit('number_of_tags'); ?>');

  var blank_category = $('#blank_category_field').html();
  var blank_photo_uploader = $('#blank_photo_uploader').html();
  var blank_special_offer_div = $('#blank_special_offer_div').html();
  var blank_food_menu_div = $('#blank_food_menu_div').html();
  var blank_hotel_room_specification_div = $('#blank_hotel_room_specification_div').html();
  var listing_type_value = $('.listing-type-radio').val();

  $(document).ready(function() {
    $('#blank_category_field').hide();
    $('#blank_photo_uploader').hide();
    $('#blank_special_offer_div').hide();
    $('#blank_food_menu_div').hide();
    $('#blank_hotel_room_specification_div').hide();
    $("input[name='tags']").tagsinput({
        maxTags: highestNumberOfTags
    });
  });

  function countElements(class_name) {
      var numItems = $('.'+class_name).length
      return numItems;
  }

  function getCityList(country_id) {
    $.ajax({
      type : 'POST',
      url : '<?php echo site_url('home/get_city_list_by_country_id'); ?>',
      data : {country_id : country_id},
      success : function(response) {
        $('#city_id').html(response);
      }
    });
  }

  function appendHotelRoomSpecification() {

    jQuery('#hotel_room_specification_div').append(blank_hotel_room_specification_div);
    let selector = jQuery('#hotel_room_specification_div .hotel_room_specification_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'room-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'room-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeHotelRoomSpecification(elem) {
    jQuery(elem).closest('.hotel_room_specification_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
  }

  function appendFoodMenu() {

    jQuery('#food_menu_div').append(blank_food_menu_div);
    let selector = jQuery('#food_menu_div .food_menu_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'menu-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'menu-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeFoodMenu(elem) {
    jQuery(elem).closest('.food_menu_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
  }

  function appendSpecialOffer() {

    jQuery('#special_offer_div').append(blank_special_offer_div);
    let selector = jQuery('#special_offer_div .special_offer_div');

    let rand = Math.random().toString(36).slice(3);

    $(selector[selector.length - 1]).find('label.btn').attr('for', 'product-image-' + rand );
    $(selector[selector.length - 1]).find('input.image-upload').attr('id', 'product-image-' + rand );
    $(".bootstrap-tag-input").tagsinput('items');
    initImagePreviewer();
  }

  function removeSpecialOffer(elem) {
    jQuery(elem).closest('.special_offer_div').remove();
    $(".bootstrap-tag-input").tagsinput('items');
  }

  function appendCategory() {
    if (countElements('appendedCategoryFields') >= highestNumberOfCategories) {
        error_notify('<?php echo get_phrase('upgrade_your_package_for_adding_more_category'); ?>')
    }else {
        jQuery('#category_area').append(blank_category);
    }
  }

  function removeCategory(categoryElem) {
    jQuery(categoryElem).closest('.appendedCategoryFields').remove();
  }

  function appendPhotoUploader() {
    if (countElements('appendedPhotoUploader') >= highestNumberOfPhotos) {
        error_notify('<?php echo get_phrase('upgrade_your_package_for_adding_more_photos'); ?>')
    }else {
        jQuery('#photos_area').append(blank_photo_uploader);
    }
  }

  function removePhotoUploader(photoElem) {
    jQuery(photoElem).closest('.appendedPhotoUploader').remove();
  }

  function showListingTypeForm(listing_type) {
  	listing_type_value = listing_type;
  	if (listing_type === "shop") {
  		$('#special_offer_parent_div').show();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_products'); ?>');
  	}
  	else if (listing_type === "hotel") {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').show();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_rooms'); ?>');
  	}
  	else if (listing_type === "restaurant") {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').show();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('preview_food_menu'); ?>');
  	}else {
  		$('#special_offer_parent_div').hide();
  		$('#food_menu_parent_div').hide();
  		$('#hotel_room_specification_parent_div').hide();
  		$('#demo-btn').html('<i class="mdi mdi-eye"></i> <?php echo get_phrase('no_preview_available'); ?>');
  	}
  }

  // This fucntion checks the minimul required fields of listing form
  function checkMinimumFieldRequired() {
    
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  	var email = $('#email').val();
  	// var country = $('#country').val();
  	var filestoupload = $('#filestoupload').val();
  	var location = $('#location').val();
  	if ( location === "") {
  		error_notify(' Location <?php echo get_phrase('can_not_be_empty'); ?>');
  	}else {
      grecaptcha.ready(function() {
        grecaptcha.execute('6LcIksEUAAAAAIpM_iyzM5jfRyyMF5pbJs_VLg6S', {action: 'subscribe_newsletter'}).then(function(token) {
            $('#newsletterForm').prepend('<input type="hidden" name="token" value="' + token + '">');
            $('#newsletterForm').prepend('<input type="hidden" name="action" value="subscribe_newsletter">');
            //$('.listing_add_form').submit();
            $('.listing_add_form').unbind('submit').submit();
        });;
    });

  		
  	}
  }

  // Show Listing Type Wise Demo
  function showListingTypeWiseDemo(param) {
  	if (listing_type_value === 'hotel') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/hotel_room', '<?php echo get_phrase('preview'); ?>');
  	}
  	if (listing_type_value === 'restaurant') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/food_menu', '<?php echo get_phrase('preview'); ?>');
  	}
  	if (listing_type_value === 'shop') {
  		showAjaxModal('<?php echo base_url();?>modal/popup/preview_of_details/special_offers', '<?php echo get_phrase('preview'); ?>');
  	}
  }



 




var markers = [];
    //    var map; 
    var Ireland = "Dhaka, Bangladesh";
    function initialize() {
      var myLatitude = parseFloat('34.0204989');
      var myLongitude = parseFloat('-118.4117325');
      var myLatlng = new google.maps.LatLng(myLatitude,myLongitude);
      geocoder = new google.maps.Geocoder();
      var mapOptions = {
          center: myLatlng,
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          styles: ''
      };
      map = new google.maps.Map(document.getElementById("form-map"), mapOptions);
      var ex_latitude = $('#latitude').val();
      var ex_longitude = $('#longitude').val();
      if (ex_latitude != '' && ex_longitude != ''){
          map.setCenter(new google.maps.LatLng(ex_latitude, ex_longitude));//center the map over the result
          var marker = new google.maps.Marker(
              {
                  map: map,
                  draggable:true,
                  animation: google.maps.Animation.DROP,
                  position: new google.maps.LatLng(ex_latitude, ex_longitude)
              });
          markers.push(marker);
          google.maps.event.addListener(marker, 'dragend', function()
          {
              var marker_positions = marker.getPosition();
              $('#latitude').val(marker_positions.lat());
              $('#longitude').val(marker_positions.lng());
//                        console.log(marker.getPosition());
          });
      }
        }

 

  var input_loc = document.getElementById('location');
  var loc =new google.maps.places.Autocomplete(input_loc);
  google.maps.event.addListener(loc, 'place_changed', function(){
     var place = loc.getPlace();

     if(place.formatted_address){
      //codeAddress(place.name+', '+place.formatted_address);
      codeAddress(place.geometry.location.lat(),place.geometry.location.lng());
    }else{
      $("#location").val('');
    }
     
     
  })

  var input_coun = document.getElementById('country');
  new google.maps.places.Autocomplete(input_coun,{types: ['(regions)']});
  
  var input_city = document.getElementById('city');
  new google.maps.places.Autocomplete(input_city,{types: ['(cities)']});
  

   function codeAddress(latv, lngv) {
    
      setAllMap(null);
      var lat = $('#latitude').val();
      var lng = $('#longitude').val();
      
    //  var add ={'location': { address }} ;
      // if(address){
      //   add ={address:address}
      // }
      
      // if(!address && lat !='' && lng !=''){
      //   add ={'location': {lat: parseFloat(lat), lng: parseFloat(lng)}};
      // }
      add ={'location': {lat: parseFloat(latv), lng: parseFloat(lngv)}};
      console.log(add);
      geocoder.geocode( add, function(results, status)
      {
          if (status == google.maps.GeocoderStatus.OK)
          {
              $('#latitude').val(results[0].geometry.location.lat());
              $('#longitude').val(results[0].geometry.location.lng());
              map.setCenter(results[0].geometry.location);//center the map over the result
              //place a marker at the location
              var marker = new google.maps.Marker(
                  {
                      map: map,
                      draggable:true,
                      animation: google.maps.Animation.DROP,
                      position: results[0].geometry.location
                  });
              markers.push(marker);
              google.maps.event.addListener(marker, 'dragend', function()
              {
                  var marker_positions = marker.getPosition();
                  $('#latitude').val(marker_positions.lat());
                  $('#longitude').val(marker_positions.lng());
              });
          } else {
              alert('Geocode was not successful for the following reason: ' + status);
          }
      });   
    }
  function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
  }
  google.maps.event.addDomListener(window, 'load', initialize);
   
  function hidespray(id) {
    if(id == 0){
      $(".sprayrate").css('display','none');
    }else{
       $(".sprayrate").css('display','');
    }
  }
</script>
