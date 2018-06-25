/*------------------------------------------------------

	@Google Maps Autocomplete

------------------------------------------------------- */

(function($) {

    // google map variables
    var geocoder;
    var map;
    var marker;
    
    // set this to true if you want US only results
    var US_only = false;
    
    // set plugin options
    var map_frame_id;
    var map_window_id;
    var lat_id;
    var lng_id;
    var addr_id;
    var lat;
    var lng;
    var state;
    var city;
	var country;
	var postal_code;
    var map_zoom;
	var request_string;
	var ne_lat;
	var ne_lng;
	var sw_lat;
	var sw_lng;    
	var mapblock;

    $.fn.extend({
        
        autogeocomplete: function(options){
        
            // extend plugin options            
            options = $.extend({}, $.fn.autogeocomplete.defaults, options);
            map_window_id = options.map_window_id;
            map_frame_id = options.map_frame_id;
            lat_id = options.lat_id;
            lng_id = options.lng_id;
            addr_id = options.addr_id;
            lat = options.lat;
            lng = options.lng;
            state = options.state;
            city = options.city;
            postal_code = options.postal_code;
            country = options.country;
            map_zoom = options.map_zoom;   
            ne_lat = options.ne_lat;
            ne_lng = options.ne_lng;
            sw_lat = options.sw_lat;
            sw_lng = options.sw_lng;   

            // init google map and geocoder
            this.initialize();
            geocoder = new google.maps.Geocoder();
            
            this.autocomplete({
            
                // fetch address values
                source: function(request, response) {
					request_string = request.term;
                    geocoder.geocode( {'address': request.term}, function(results, status) {
                        
                        // limit number of returned values to top 5
                        var item_count = 0;
                        
                        // limit to US only results
                        var filter_results = [];
                       
                        if(US_only){
                            $.each(results, function(item){
                                if(results[item].formatted_address.toLowerCase().indexOf(", usa") !== -1)
                                {
                                    filter_results.push(results[item]);
                                }
                            });
                        }
                        else{
                            filter_results = results;
                        }
                        // default render map to top result
						if(filter_results != ''){
	                        setMap(filter_results[0].geometry.location.lat(), filter_results[0].geometry.location.lng());
						}
                        
                        // parse and format returned suggestions
                        response($.map(filter_results, function(item) {
                        
                            // split returned string
                            var place_parts = item.formatted_address.split(",");
                            var place = place_parts[0];
                            var place_details = "";
                            
                            // parse city, state, and zip
                            for(i=1;i<place_parts.length;i++){
                                place_details += place_parts[i];
                                if(i !== place_parts.length-1) place_details += ",";
                            }
                            
                            // return top 5 results
                            if (item_count < 5) {

								var street = '';
								var area = '';
								var city ='';
								var country ='';
								var state = '';
								var postal_code= '';
								var ne_lat = '';
								var ne_lng = '';
								var sw_lat = '';
								var sw_lng = '';
								var components = item.address_components;
								if(components.length){
									for(var j=0; j<components.length; j++){
										if(components[j].types[0]=="route"){
											street = components[j].long_name;
										}
										if(components[j].types[0]=="sublocality"){
											area = components[j].long_name;
										}
										if(components[j].types[0]=="locality" || components[j].types[0]=="administrative_area_level_2"){
											city = components[j].long_name;
										}
										if(components[j].types[0]=="administrative_area_level_1"){
											state = components[j].long_name;
										}
										if(components[j].types[0]=="country"){
											country = components[j].short_name;
										
										}
										if(components[j].types[0]=="postal_code"){
											postal_code = components[j].long_name;
										}
									}
								}
								if(components.length <= 2){
									sw_lat = item.geometry.bounds.getSouthWest().lat();
									sw_lng = item.geometry.bounds.getSouthWest().lng();
									ne_lat = item.geometry.bounds.getNorthEast().lng();
									ne_lng = item.geometry.bounds.getNorthEast().lng();
								}

                                item_count++;
                                return {
                                    label:  place,
                                    value: item.formatted_address,
                                    desc: place_details,
                                    area: area,
                                    city: city,
                                    state: state,
                                    country: country,
									postal_code:postal_code,
									sw_lat:sw_lat,
									sw_lng:sw_lng,
									ne_lat:ne_lat,
									ne_lng:ne_lng,
                                    latitude: item.geometry.location.lat(),
                                    longitude: item.geometry.location.lng()
                                }
                            }

                        }));
                    })
                },
                // set the minimum length of string to autocomplete
                minLength: 2,
                // set geocoder data when an address is selected
                select: function(event, ui) {
					$('#address-info').hide();
					$('#address-info').removeClass('error-message');
					$("#" + lat_id).val(ui.item.latitude);
                    $("#" + lng_id).val(ui.item.longitude);
                    $("#" + state).val(ui.item.state);
                    $("#" + city).val(ui.item.city);
					$('.js-city').html(ui.item.city);
                    $("#" + postal_code).val(ui.item.postal_code);
					$("#" + sw_lat).val(ui.item.sw_lat);
					$("#" + sw_lng).val(ui.item.sw_lng);
					$("#" + ne_lat).val(ui.item.ne_lat);
					$("#" + ne_lng).val(ui.item.ne_lng);
					$("#" + country).val(ui.item.country);
					$('.js-country').html(ui.item.country);
					if ($(this).attr('id') == 'PropertyAddressSearch' || $(this).attr('id') == 'RequestAddressSearch') {
						if (!ui.item.sw_lat) {
							$('#js-sub').attr('disabled', false);
							$('#js-sub').addClass('active-search');
						} else {
							$('#js-sub').attr('disabled', true);
							$('#address-info').show();
							$('#address-info').addClass('error-message');
							$('#js-sub').removeClass('active-search');
						}
					} else {
						$('#js-sub').attr('disabled', false);
						$('#js-sub').addClass('active-search');
					}
               },
                // set map to visible when autosuggester is activated
                open: function(event, ui){
                    $("#" + map_frame_id).css("visibility", "visible");
                    $("#mapblock").css("display", "block");
                    $("#" + map_window_id).css("z-index", "0");
                    $(".ui-autocomplete").css("z-index", "10");
                    
                    // hard coded css width in javascript to avoid editing jQuery css files
                    $('.ui-menu-item').css("width", "auto");
                      $('.ui-menu-item').css("z-index", "10000");
					google.maps.event.trigger(map, 'resize');
					setMap(first_lat, first_lng);
				},
                // set map to invisible when autosuggester is deactivated
                close: function(event, ui){
                    $("#" + map_frame_id).css("visibility", "hidden");
					 $("#mapblock").css("display", "none");
                },
                // update map rendering on mouseover / keyover
                focus: function(event, ui){
                    setMap(ui.item.latitude, ui.item.longitude);  
                }             
            })
            // format how each suggestions is presented
            /*.data( "autocomplete" )._renderItem = function( ul, item ) {
					test = $( "<li></li>" )
				    .data( "item.autocomplete", item )	
					.addClass('js-open-element {"search" : "'+ item.value +'"}')
    				.append( "<a class='js-mouseover-focus'><strong>" + item.label + "</strong><br>" + item.desc + "</a>");
					test1 = $( "<li></li>" )
				    .data( "item.autocomplete", item )		
					.addClass('js-open-element open-element-list {"search" : "'+ request_string +'"}')
    				.append( "<a class='js-mouseover-focus'><strong>" + request_string + "</strong></a>");
					$resultdata = $( "<ul></ul>" ).addClass('focus-element-block js-focus-element hide').append(test).append(test1);
					
				return $( "<li></li>" )				 	
				    .data( "item.autocomplete", item )
    				.append( "<a class='js-mouseover-focus'><strong>" + item.label + "</strong><br>" + item.desc + "</a>")
					.append($resultdata)
	       			.appendTo( ul );
            };*/
			.data( "autocomplete" )._renderMenu = function( menuUl, items ) {
				  $.each( items, function( index, item ) {
					first =  request_string.split(' ');
					second =  (item.value).split(' ');
					
					$(first).each(function(index, item) {
						$is_array = true;
						temp = item.replace(",", "").toLowerCase();
						if(temp == 'street')
							item = 'St,'
						$(second).each(function(se_index, se_item) {
							if(se_item.replace(",", "").toLowerCase() == item.replace(",", "").toLowerCase() && $is_array != false){
								first[index] = '';
							}
							
						});
					});
					
					/*third = $.merge( $.merge([],first), second);
					var arrDistinct = new Array();
					$(third).each(function(index, item) {
						$is_array = true;
						temp = item.replace(",", "").toLowerCase();
						if(temp == 'street')
							item = 'St,'
						$(arrDistinct).each(function(index, item1) {							
							if(item.replace(",", "").toLowerCase() == item1.replace(",", "").toLowerCase() && $is_array != false){
								$is_array = false;
							}
						});
						if($is_array){
								arrDistinct.push(item);
						}
					});*/

					generate_string = first.join(" ") + item.value;


					var li = $( "<li></li>" )
						.data( "item.autocomplete", item )						
						.select(function() {	
						   $(this).children('ul').show();
						  return false;
						})
						.mouseover(function() {	
						  $(this).children('ul').show();
						  return false;
						})
						.mouseout(function() {
						 $(this).children('ul').hide();
						  return false;
						})
						.appendTo( menuUl ),
			
					  label = $( "<a></a>" )
						.text(  item.value )
						.appendTo( li ),
								  
					  mapblock=$('#mapblock');

					  ul = $( "<ul></ul>" )
					  	.addClass('menu-over-ul')
						.css("display","none")
						.appendTo(li);
						
					$( "<li></li>" )
					 .append( $( "<h3></h3>" ).text( 'Refine Address' ) )
					 .appendTo( ul );	
					 
					 $( "<li></li>" )
					 .addClass('menu-over-address')
					 .append( $( "<a></a>" ).text( generate_string) )
					 .click(function( event ) {
						  menuUl.menu( "activate", event, li );
						  li.data( "item.autocomplete", {
							label: generate_string,
							value: generate_string,
							latitude: item.latitude,
							longitude: item.longitude,
							area: item.area,
							city: item.city,
							state: item.state,
							country: item.country,
							postal_code:item.postal_code,
							sw_lat:item.sw_lat,
							sw_lng:item.sw_lng,
							ne_lat:item.ne_lat,
							ne_lng:item.ne_lng,
							desc: item.desc
						  })
						})
					 .appendTo( ul );
					 $( "<li></li>" )
					 .addClass('menu-over-address')
					 .append( $( "<a></a>" ).text( item.value ) )
					 .click(function( event ) {
						  menuUl.menu( "activate", event, li );
						  li.data( "item.autocomplete", {
							label: '<strong>' + item.label + '</strong><br>' + item.desc,
							value: item.value,
							latitude: item.latitude,
							longitude: item.longitude,
							area: item.area,
							city: item.city,
							state: item.state,
							country: item.country,
							postal_code:item.postal_code,
							sw_lat:item.sw_lat,
							sw_lng:item.sw_lng,
							ne_lat:item.ne_lat,
							ne_lng:item.ne_lng,
							desc: item.desc
						  })
						})
					 .appendTo( ul );
					 $( "<li></li>" )
					 .addClass('menu-over-address')
					 .append( $( "<a></a>" ).text( request_string ) )
					 .click(function( event ) {
						  menuUl.menu( "activate", event, li );
						  li.data( "item.autocomplete", {
							label: '<strong>' + request_string + '</strong>',
							value: request_string,
							latitude: item.latitude,
							longitude: item.longitude,
							area: item.area,
							city: item.city,
							state: item.state,
							country: item.country,
							postal_code:item.postal_code,
							sw_lat:item.sw_lat,
							sw_lng:item.sw_lng,
							ne_lat:item.ne_lat,
							ne_lng:item.ne_lng,
							desc: item.desc
						  })
						})
					 .appendTo( ul );			
				  menuUl.appendTo(mapblock);
				  });
				 
				};
            
            // update geo coordinates and refresh map display
            function setMap(lat, lng){
				$('.menu-over-ul').hide();
				$('#ui-active-menuitem').siblings('ul').show();
                $("#" + lat_id).val(lat);
                $("#" + lng_id).val(lng);
                map_location = new google.maps.LatLng(lat, lng);
                marker.setPosition(map_location);
                map.setCenter(map_location);     
            }
        },
        
        initialize: function(){
           
            // init map
            var latlng = new google.maps.LatLng(lat, lng);
            var myOptions = {
                zoom: map_zoom,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scaleControl : false,
                mapTypeControl : false
            }
            map = new google.maps.Map(document.getElementById(map_window_id), myOptions); 
            marker = new google.maps.Marker({
                map: map,
                draggable: false
            }); 
            
            google.maps.event.addListener(map, 'click', function(event){
            
                // put the lat and lng values in the input boxes
                $("#" + lat_id).val(event.latLng.b);
                $("#" + lng_id).val(event.latLng.c);
            
                // set marker position to event click
                var marker_position = event.latLng;
                
                // create new marker
                var newMarker = new google.maps.Marker({
                    map: map,
                    draggable: false,
                    position: marker_position
                });
                
                // create a new geocode object to reverse geocode click position
                var reversegeocoder = new google.maps.Geocoder();
                
                // geocoder returns an array or nearest matching address, take the first result and put it in the relevant drop down box 
                reversegeocoder.geocode({ 'latLng': event.latLng }, function(results, status){
                    $("#" + addr_id).val(results[0].formatted_address);
                });        
            });
        }
            
    });
    
    // set default values for everything
    $.fn.autogeocomplete.defaults = {    
        map_frame_id: "mapframe",
        map_window_id: "mapwindow",
        lat_id: "filter_lat",
        lng_id: "filter_lng",
        addr_id: "filter_address",
        lat: "37.7749295",
        lng: "-122.4194155",
        map_zoom: 13
    };
    
})(jQuery);

