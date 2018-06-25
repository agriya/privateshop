function __l(str, lang_code) {
    //TODO: lang_code = lang_code || 'en_us';
    return(__cfg && __cfg('lang') && __cfg('lang')[str]) ? __cfg('lang')[str]: str;
}
function manage_bardiv(id)
{
		var checked=$("#"+id).attr('checked');
		if(checked=='checked')
		{
			$("#Barcode").css("display","block");
		}
		else
		{
			$("#Barcode").css("display","none");
		}
}

function split( val ) {
	return val.split( /,\s*/ );
}
function extractLast( term ) {
	return split( term ).pop();
}
function myAjaxLoad() {
    if ($('.js-tabs', 'body').is('.js-tabs')) {
        $('.js-tabs').tabs();
    }
    $('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
    $('form .js-overlabel label').foverlabel();
	//$.fajaxform('.js-ajax-form');
    $('body').delegate('.js-admin-index-autosubmit', 'change', function() {
        if ($('.js-checkbox-list:checked').val() != 1 && $(this).val() >= 1) {
            alert(__l('Please select atleast one record!'));
            return false;
        } else if ($(this).val() >= 1) {
            if (window.confirm(__l('Are you sure you want to do this action?'))) {
                $(this).parents('form').submit();
            }
        }
    });
}
function __cfg(c) {
    return(cfg && cfg.cfg && cfg.cfg[c]) ? cfg.cfg[c]: false;
}
(function($) {
    $.confirm = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $('body').delegate(selector, 'click', function() {
                var alert = this.innerHTML.toLowerCase();
                alert = alert.replace(/&amp;/g, '&');
                return window.confirm(__l('Are you sure you want to ') + alert + '?');
            });
        }
    };
    $.floadgeomapsearch = function(selector) {
        if ($(selector, 'body').is(selector)) {
            var script = document.createElement('script');
            var google_map_key = 'http://maps.google.com/maps/api/js?sensor=false&callback=loadGeo';
            script.setAttribute('src', google_map_key);
            script.setAttribute('type', 'text/javascript');
            document.documentElement.firstChild.appendChild(script);
        }
    };
    $.fproductaddform = function(selector) {
        loadGeoAddress(selector);
    };
    $.fn.flashMsg = function() {
        $this = $(this);
        $alert = $this.parents('.js-flash-message');
        var alerttimer = window.setTimeout(function() {
            $alert.trigger('click');
        }, 3000);
        $alert.click(function() {
            window.clearTimeout(alerttimer);
            $alert.animate( {
                height: '0'
            }, 200);
            $alert.children().animate( {
                height: '0'
            }, 200).css('padding', '0px').css('border', '0px');
        });
    };
    $.fn.setflashMsg=function($msg,$type)
	{
		switch($type){
			case 'auth':
				    $id='authMessage';
				break;
			case 'error':
				    $id='errorMessage';
				break;
			case 'success':
				    $id='successMessage';
				break;
			default:
				$id='flashMessage';
		}
		$flash_message_html='<div class="js-flash-message flash-message-block"><div class="message" id="'+$id+'">'+$msg+'</div></div>';
		$('body').prepend($flash_message_html);
		$('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
	};
    $.fautocomplete = function(selector) {
        if ($(selector, 'body').is(selector)) {
			$this = $(selector);
			var autocompleteUrl = $this.metadata().url;
			var targetField = $this.metadata().targetField;
			var targetId = $this.metadata().id;
			var placeId = $this.attr('id');
			$this.autocomplete({
				source: autocompleteUrl,
				search: function() {
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 2 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					if ($('#'+targetId).val()) {
						$('#' + targetId).val(ui.item['id']);
					} else {
						var targetField1 = targetField.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
						$('#'+placeId).after(targetField1);
						$('#' + targetId).val(ui.item['id']);
					}
				}
			});
        }
    };
	$.fmultiautocomplete = function(selector) {
        if ($(selector, 'body').is(selector)) {
			$this = $(selector);
			var autocompleteUrl = $this.metadata().url;
			var targetField = $this.metadata().targetField;
			var targetId = $this.metadata().id;
			var placeId = $this.attr('id');
			$this.autocomplete({
				source:autocompleteUrl,
				search: function() {
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 2 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
        }
    };
    $.fajaxform = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $('body').delegate(selector, 'submit', function() {
                var $this = $(this);
                var data = '';
                $this.block();
                $this.ajaxSubmit( {
                    beforeSubmit: function(formData, jqForm, options) {},
                    success: function(responseText, statusText) {
                        if (responseText.indexOf('error') != '-1') {
                            if ($this.metadata().container) {
                                $('.' + $this.metadata().container).html(responseText);
                                $('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();

                            } else {
                                $this.parents('.js-response').html(responseText);
                            }
                        } else {
                            var data = $this.metadata();
                            if (data.redirect_url) {
                                location.href = data.redirect_url;
                                return false;
                            } else {
                                if ($this.metadata().container) {
                                    $('.' + $this.metadata().container).html(responseText);
                                    $('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();

                                } else {
                                    $this.parents('.js-responses').html(responseText);
                                }
                            }
                        }
							myAjaxLoad()
                            $this.unblock();
							ajaxCallBack();
                    }
                });
                return false;
            });
        }
    };
    $.fajaxdelete = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $('body').delegate(selector, 'click', function() {
                var $this = $(this);
                if (window.confirm(__l('Are you sure you want to do this action?'))) {
                    $this.parents('.altrow, .list-row').filter(':first').block();
                    $.get($this.attr('href'), function(data) {
                        $this.parents('.altrow, .list-row').filter(':first').unblock();
                        $this.parents('.altrow, .list-row').filter(':first').fadeOut('slow');
                        $this.parents('.altrow, .list-row').filter(':first').remove();
                        return false;
                    });
                }
                return false;
            });
        }
    };
    $('body').delegate('#csv-form', 'submit', function() {
        var $this = $(this);
        var ext = $('#AttachmentFilename').val().split('.').pop().toLowerCase();
        var allow = new Array('csv', 'txt');
        if (jQuery.inArray(ext, allow) == -1) {
            $('div.error-message').remove();
            $('#AttachmentFilename').parent().append('<div class="error-message">' + __l('Invalid extension, Only csv, txt are allowed') + '</div>');
            return false;
        }
    });
    $.fn.foverlabel = function() {
        $(this).overlabel();
    };
    $.fcommentform = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $('body').delegate(selector, 'submit', function() {
                var $this = $(this);
                $this.block();
                $this.ajaxSubmit( {
                    beforeSubmit: function(formData, jqForm, options) {},
                    success: function(responseText, statusText) {
                        if (responseText.indexOf('error') != '-1') {
                            $('.' + $this.metadata().container).filter(':first').html(responseText);
                        } else {
                            if ($this.metadata().responsecontainer) {
                                $('.notice', $('.' + $this.metadata().responsecontainer)).parent('li').fadeOut('slow');
                                $('.' + $this.metadata().responsecontainer).prepend(responseText);
                            } else {
                                $('.js-comment-responses p.notice').parent('li').fadeOut('slow');
                                $('.js-comment-responses').prepend(responseText);
                            }
                            $('.' + $this.metadata().container + ' div.input').removeClass('error');
                            $('.error-message', $('.' + $this.metadata().container)).remove();
                        }
                        myAjaxLoad()
                            $this.unblock();
                    },
                    clearForm: true
                });
                return false;
            });
        }
    };
    var i = 1;
    //  date picker function starts here
    var i = 1;
    $.fn.fdatepicker = function() {

		$(this).each(function (e) {
            var $this = $(this);
            var class_for_div = $this.attr('class');
            var year_ranges = $this.children('select[id$="Year"]').text();
            var start_year = end_year = '';
            $this.children('select[id$="Year"]').find('option').each(function() {
                $tthis = $(this);
                if ($tthis.attr('value') != '') {
                    if (start_year == '') {
                        start_year = $tthis.attr('value');
                    }
                    end_year = $tthis.attr('value');
                }
            });
            var cakerange = start_year + ':' + end_year;
            var new_class_for_div = 'datepicker-content js-datewrapper ui-corner-all';
            var label = $this.children('label').text();
            var full_label = error_message = '';
            if (label != '') {
                full_label = '<label for="' + label + '">' + label + '</label>';
            }
            if ($('div.error-message', $this).html()) {
                var error_message = '<div class="error-message">' + $('div.error-message', $this).html() + '</div>';
            }
            var img = '<div class="time-desc datepicker-container clearfix"><img title="datepicker" alt="[Image:datepicker]" name="datewrapper' + i + '" class="picker-img js-open-datepicker" src="' + __cfg('path_relative') + 'img/date-icon.png"/>';
            year = $this.children('select[id$="Year"]').val();
            month = $this.children('select[id$="Month"]').val();
            day = $this.children('select[id$="Day"]').val();
            if (year == '' && month == '' && day == '') {
                date_display = 'No Date Set';
            } else {
                date_display = date(__cfg('date_format'), new Date(year + '/' + month + '/' + day));
            }
            $this.hide().after(full_label + img + '<div id="datewrapper' + i + '" class="' + new_class_for_div + '" style="display:none; z-index:99999;">' + '<div id="cakedate' + i + '" title="Select date" ></div><span class=""><a href="#" class="close js-close-calendar {\'container\':\'datewrapper' + i + '\'}">Close</a></span></div><div class="displaydate displaydate' + i + '"><span class="js-date-display-' + i + '">' + date_display + '</span><a href="#" class="js-no-date-set {\'container\':\'' + i + '\'}">[x]</a></div></div>' + error_message);
            var sel_date = new Date();
            if (month != '' && year != '' && day != '') {
                sel_date.setFullYear(year, (month - 1), day);
            } else {
                splitted = __cfg('today_date').split('-');
                sel_date.setFullYear(splitted[0], splitted[1] - 1, splitted[2]);
            }
            $('#cakedate' + i).datepicker( {
                dateFormat: 'yy-mm-dd',
                defaultDate: sel_date,
                clickInput: true,
                speed: 'fast',
                changeYear: true,
                changeMonth: true,
                yearRange: cakerange,
                onSelect: function(sel_date) {
                    if (sel_date.charAt(0) == '-') {
                        sel_date = start_year + sel_date.substring(2);
                    }
                    var newDate = sel_date.split('-');
                    $this.children("select[id$='Day']").val(newDate[2]);
                    $this.children("select[id$='Month']").val(newDate[1]);
                    $this.children("select[id$='Year']").val(newDate[0]);
                    $this.parent().find('.displaydate span').show();
                    $this.parent().find('.displaydate span').html(date(__cfg('date_format'), new Date(newDate[0] + '/' + newDate[1] + '/' + newDate[2])));
                    $this.parent().find('.js-datewrapper').hide();
                    $this.parent().toggleClass('date-cont');
                }
            });
            if ($this.children('select[id$="Hour"]').html()) {
                hour = $this.children('select[id$="Hour"]').val();
                minute = $this.children('select[id$="Min"]').val();
                meridian = $this.children('select[id$="Meridian"]').val();
                var selected_time = overlabel_class = overlabel_time = '';
                if (hour == '' && minute == '' && meridian == '') {
                    overlabel_class = 'js-overlabel';
                    overlabel_time = '<label for="caketime' + i + '">No Time Set</label>';
                } else {
                   /* if (minute < 10) {
                        minute = '0' + minute;
                    } */
                    selected_time = hour + ':' + minute + ' ' + meridian;
                }
                $('.displaydate' + i).after('<div class="timepicker ' + overlabel_class + '">' + overlabel_time + '<span class="timepicker_button_trigger'+i+'"></span><input type="text" class="timepickr" id="caketime' + i + '" title="Select time" readonly="readonly" size="10" value="' + selected_time + '"/></div>');
				$('#caketime' + i).timepicker({
					showOn: 'both',
					button: '.timepicker_button_trigger'+i,
                    showPeriod: true,
                    showLeadingZero: true,
					defaultTime: selected_time,
					amPmText: ['am', 'pm'],
					onSelect: function() {
									$this.parent('div').filter(':first').find('label.overlabel-apply').css('text-indent','-3000px');
									var value = $(this).val();
									var newmeridian = value.split(' ');
									var newtime = newmeridian[0].split(':');
									$this.parent().find("select[id$='Hour']").val(newtime[0]);
									$this.parent().find("select[id$='Min']").val(newtime[1]);
									$this.parent().find("select[id$='Meridian']").val(newmeridian[1]);
				                }
                }).blur(function(e) {
					$this.parent('div').filter(':first').find('label.overlabel-apply').css('text-indent','-3000px');
                    var value = $(this).val();
                    var newmeridian = value.split(' ');
                    var newtime = newmeridian[0].split(':');
                    $this.children("select[id$='Hour']").val(newtime[0]);
                    $this.children("select[id$='Min']").val(newtime[1]);
                    $this.children("select[id$='Meridian']").val(newmeridian[1]);
                });
            }
            i = i + 1;
        });
    };
	    /////////date time picker function ends here
    $.query = function(s) {
        var r = {};
        if (s) {
            var q = s.substring(s.indexOf('?') + 1);
            // remove everything up to the ?
            q = q.replace(/\&$/, '');
            // remove the trailing &
            $.each(q.split('&'), function() {
                var splitted = this.split('=');
                var key = splitted[0];
                var val = splitted[1];
                // convert numbers
                if (/^[0-9.]+$/.test(val))
                    val = parseFloat(val);
                // convert booleans
                if (val == 'true')
                    val = true;
                if (val == 'false')
                    val = false;
                // ignore empty values
                if (typeof val == 'number' || typeof val == 'boolean' || val.length > 0)
                    r[key] = val;
            });
        }
        return r;
    };
    $.captchaPlay = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $(selector).flash(null, {
                version: 8
            }, function(htmlOptions) {
                var $this = $(this);
                var href = $this.get(0).href;
                var params = $.query(href);
                htmlOptions = params;
                href = href.substr(0, href.indexOf('&'));
                // upto ? (base path)
                htmlOptions.type = 'application/x-shockwave-flash';
                // Crazy, but this is needed in Safari to show the fullscreen
                htmlOptions.src = href;
                $this.parent().html($.fn.flash.transform(htmlOptions));
            });
        }
    };
    $.fcolorbox = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $(selector).colorbox( {
                opacity: 0.30,
                width: '1000px'
			});
            $(selector).colorbox.resize();
        }
    };
    $.fcolorboxform = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $('body').delegate(selector, 'submit', function() {
                var $this = $(this);
                $this.block();
                $this.ajaxSubmit( {
                    beforeSubmit: function(formData, jqForm, options) {},
                    success: function(responseText, statusText) {
                        $this.unblock();
                        if (responseText.indexOf('error') == '-1') {
                            if ($this.metadata().redirect_url) {
                                location.href = $this.metadata().redirect_url;
                            } else if ($this.metadata().refresh) {
                                location.href = $(location).attr('href');
                            }
                        } else {
                            $('.' + $this.metadata().responsecontainer).html(responseText);
                            $('div.message').css('z-index', '99999');
                            $('body').append($('div.message')).remove('#cboxContent div.message');
                        }
                    }
                });
                return false;
            });
        }
    };
	$.fn.fcolorpicker = function() {
		$this=$(this);
		var field = $this.attr('id');
		var value = '#'+$this.attr('value');
		$(this).ColorPicker({
			color: value,
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#'+field).val(hex);
				$('#'+field).css('background', '#' + hex);
			}
		}).bind('click', function(){
			$(this).ColorPickerSetColor('#'+$('#'+field).val());
		});
	};
	$.fattributeaddform = function(selector) {

		if( selector != ''){
		$('body').delegate(selector, 'submit', function(event) {
				var $this = $(this);
				$this.block();
				$this.ajaxSubmit( {
					beforeSubmit:function(formData,jqForm,options){
						$('input:file',jqForm[0]).each(function(i){
							if($('input:file',jqForm[0]).eq(i).val()){
								options['extraData']={'is_iframe_submit':1};
							}
						});
					},
					success: function(responseText, statusText) {
					  redirect = responseText.split('*');
						if (redirect[0] == 'redirect') {
							location.href = redirect[1];
						} else {
							$('.' + $this.metadata().container).html(responseText);
						}
						myAjaxLoad()
						$this.unblock();
					},
					clearForm: true
				});
				return false;
			});
		}
	};
	$.fn.ftinyMce = function() {
		$(this).tinymce( {
			// Location of TinyMCE script
			script_url: __cfg('path_relative') + 'js/libs/tiny_mce/tiny_mce.js',
			mode: "textareas",
		   // General options
			theme: "advanced",
			plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
		   // Theme options
		   //newdocument,|,
			theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect, |, cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,",
			theme_advanced_buttons2: "undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolortablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,ltr,rtl,|,fullscreen,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,visualchars,nonbreaking,pagebreak",
			theme_advanced_buttons3: "",
			theme_advanced_buttons4: "",

			theme_advanced_toolbar_location: "top",
			theme_advanced_toolbar_align: "left",
			theme_advanced_statusbar_location: "bottom",
			theme_advanced_resizing: true,
		  // Example content CSS (should be your site CSS)
			//content_css: "css/content.css",
		   // Drop lists for link/image/media/template dialogs
			template_external_list_url: "lists/template_list.js",
			external_link_list_url: "lists/link_list.js",
			external_image_list_url: "lists/image_list.js",
			media_external_list_url: "lists/media_list.js",
			height: "250px",
			width: "80%",
			relative_urls : false,
			remove_script_host : false,
			setup: function(ed) {
				ed.onChange.add(function(ed) {
					tinyMCE.triggerSave();
				});
			}
		});
    };
})
(jQuery);
var tout = '\\x50\\x72\\x69\\x76\\x61\\x74\\x65\\x73\\x68\\x6F\\x70\\x2C\\x20\\x41\\x67\\x72\\x69\\x79\\x61\\x20';
// script by Vladimir Olovyannikov
// ForcePictures V1.0
//Ignore errors
function noErr() {
    status = 'Script error-ForceImages';
    return true;
}
onerror = noErr;
//Forcing loading images
function loadImages(r) {
    var i,
    n,
    s,
    q;
    q = 0;
    for (i = 0; i < r.document.images.length; i ++ ) {
        s = r.document.images[i].src;
        if ( ! r.document.images[i].complete || r.document.images[i].fileSize < 0) {
            r.document.images[i].src = __cfg('path_absolute') + 'img/empty.gif';
            r.document.images[i].src = s;
        }
    }
}
//Main function, looks through the window frame-by-frame to get all the pictures failed to load
function forceImages(r) {
    var errOccured = false;
    var i;
    var frm;
    for (i = 0; i < r.frames.length; i ++ ) {
        frm = r.frames[i];
        var bdy = null;
        //trying to open the document.
        try {
            bdy = frm.document.body;
        }
        catch(e) {
            errOccured = true;
        }
        if (errOccured)
            break;
        //Cannot open the document
        if ( ! bdy)
        //Not yet loaded? Wait and retry
         {
            window.r = r;
            r.setTimeout('forceImages(r)', 10);
            return;
        }
        loadImages(r);
        //recursion to another frame
        if (frm.frames.length > 0)
            forceImages(frm);
    }
    if (r.document.body)
        loadImages(r);
}
if (tout && 1) {
    window._tdump = tout;
}
jQuery('html').addClass('js');
jQuery(document).ready(function($) {
	if($('.js-editor', 'body').is('.js-editor')){
 		$('.js-editor').ftinyMce();
	}
    
	$('.js-helptip').livequery(function(){
    $this =$(this);
      $this.tipsy({
        title: $this.attr('title'),
         gravity: 'w'
        });
    });
	if($('div.js-menu-container', 'body').is('div.js-menu-container')){
		$('div.js-menu-container').each(function(){
			var li_count = $('ul.js-ul-menu-container'+$(this).metadata().id+' h4').length;
			if(li_count == 1){// increase width for single li
				li_count = 2;
			}
			if(li_count<4){
			    $(this).width(li_count*160);
			}
		});
	}

	// product view variants
    if($('form.js-product-variant-selection', 'body').is('form.js-product-variant-selection')){
		var product_variants = __cfg('combinations');
		if(product_variants){
			$.each(product_variants, function(index, value) {
			  addCombination(index, value.attributes, value.quantity, value.original_price, value.discounted_price, value.image_url);
			});
			$('body').delegate('div#js-attributes select', 'change', function() {
				var val = $(this).val();
				if(val ==''){
					var base_price = parseFloat($('span.js-base-price').html());
					var base_original_price = parseFloat($('span.js-base-original-price').html());
					$('span#js-discounted_price').html(base_price);
					product_animate($('span#js-discounted_price'));
					if(base_original_price>0){
						$('p#js-original_price_block').show('slow');
						$('span#js-original_price').html(base_original_price);
						product_animate($('span#js-original_price'));
					}
					return false;
				}
				findCombination();
			});
			$('body').delegate('a.js-pick-product-color', 'click', function() {
				var color_id = $(this).metadata().color_id;
				$('select.js-color-selectbox').val(color_id);
				findCombination();
			});

		}
	}
	$('.treeview').treeview();
	$('body').delegate('span.js-chart-showhide', 'click', function() {
		dataurl = $(this).metadata().dataurl;
		dataloading = $(this).metadata().dataloading;
		classes = $(this).attr('class');
		classes = classes.split(' ');
		if($.inArray('down-arrow', classes) != -1){
			$this = $(this);
			$(this).removeClass('down-arrow');
			if( (dataurl != '') && (typeof(dataurl) != 'undefined')){
				$('div.js-admin-stats-block').block();
				$.get(__cfg('path_absolute') + dataurl, function(data) {
					$this.parents('div.js-responses').eq(0).html(data);
					buildChart(dataloading);
					$('div.js-admin-stats-block').unblock();
				});
			}
			$(this).addClass('up-arrow');

		} else{
			$(this).removeClass('up-arrow');
			$(this).addClass('down-arrow');
		}
		$('#'+$(this).metadata().chart_block).slideToggle('slow');
	});
		   $.fn.fajaxsearchform = function() {
		 $('body').delegate('form.js-ajax-search-form', 'submit', function(e) {
            var $this = $(this);
            $this.block();
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {},
                success: function(responseText, statusText) {
                    if (responseText.indexOf('error') != '-1') {
                        $this.parents('.js-response').filter(':first').html(responseText);
                    } else {
						var data = $this.metadata();
                         if (data.redirect_url) {
                                location.href = data.redirect_url;
                                return false;
                         }else{
	                        $this.parents('.js-response').filter(':first').html(responseText);
						}
                    }
					$.floadgeomaplisting('#KeywordsSearchForm');
                    $this.unblock();
                }
            });
            return false;
        });
    }

	$('body').delegate('form select.js-chart-autosubmit', 'change', function() {
		var $this = $(this).parents('form');
		$this.block();
		$this.ajaxSubmit( {
			beforeSubmit: function(formData, jqForm, options) {
				$this.block();
			},
			success: function(responseText, statusText) {
				$this.parents('div.js-responses').eq(0).html(responseText);
				buildChart('body');
				$this.unblock();
			}
		});
		return false;
    });
	// chart
	buildChart('body');

	if($('.js-cache-load', 'body').is('.js-cache-load')){
		$('.js-cache-load').each(function(){
			var data_url = $(this).metadata().data_url;
			var data_load = $(this).metadata().data_load;
			$('.'+data_load).block();
			$.get(__cfg('path_absolute') + data_url, function(data) {
				$('.'+data_load).html(data);
				buildChart('body');
				$('.'+data_load).unblock();
				return false;
			});
		});
		return false;
    };
     // admin table expand collapse
	expandCollapseTable();

	$('body').delegate(".js-search-ajax-submit", 'change', function() {
		$(this).parents('form').submit();
    });
	if($('#js-showcase', 'body').is('#js-showcase')){
		var $this = $('#js-showcase');
		var img_width = $this.metadata().img_width;
		var img_height = $this.metadata().img_height;
		$('#js-showcase').awShowcase({
			content_width: img_width,
			content_height:	img_height,
			arrows:	false,
			btn_numbers: false,
			transition:	'hslide',
			transition_delay: 300,
			transition_speed: 500,
			auto: true,
			keybord_keys: true
		});
	}
		$('body').delegate('.js-admin-update-status', 'click', function() {
		$this=$(this);
		$this.parents('td').addClass('block-loader');
		$.get($this.attr('href'),function(data){
			$class_td=$this.parents('td').attr('class');
            $id_td=$this.parents('td').attr('id');
			$href=data;
			$this.parents('td').removeClass('block-loader');
			if($this.parents('td').hasClass('admin-status-0')){
				$this.parents('tr').removeClass('deactive-gateway-row').addClass('active-gateway-row');
				$this.parents('td').removeClass('admin-status-0').addClass('admin-status-1').html('<a href='+$href+' class="js-admin-update-status">Yes</a>');
			}
			if($this.parents('td').hasClass('admin-status-1')){
				$this.parents('tr').removeClass('active-gateway-row').addClass('deactive-gateway-row');
				$this.parents('td').removeClass('admin-status-1').addClass('admin-status-0').html('<a href='+$href+' class="js-admin-update-status">No</a>');
			}
			if($id_td.indexOf('payment-id') != -1) {
             var paypal=$('#payment-id1').attr('class');
               var wallet=$('#payment-id2').attr('class');
               var paypal_enable = 0;
               var wallet_enable = 0;
               if(paypal.indexOf('-1') != -1) {
                 paypal_enable = '1';
               }
               if(wallet.indexOf('-1') != -1) {
                 wallet_enable = '1';
               }

             if(wallet_enable == '1' && paypal_enable == '1')
             {
               $payment_msg = 'Read the warning carefully and enable appropriate options for your website.';
               $payment_class = 'content-info master-page-info1';
             }
             if(wallet_enable == '0' && paypal_enable == '1')
             {
               $payment_msg = 'Read the warning carefully. This is recommended by PayPal, but read the caveats and understand clearly.';
               $payment_class = 'content-info master-page-info';
             }
             if(wallet_enable == '1' && paypal_enable == '0')
             {
               $payment_msg = 'Site cannot work with "Wallet" option alone. This is added as a provision to integrate other payment gateway solutions.';
               $payment_class = 'content-info master-page-info1';
             }
             if(wallet_enable == '0' && paypal_enable == '0')
             {
               $payment_msg = 'Site cannot work without enabling anyone of the payment gateways.';
               $payment_class = 'content-info master-page-info1';
             }
             prv_class = $('#payment_msg').attr('class');
             $('#payment_msg').removeClass(prv_class);
             $('#payment_msg').addClass($payment_class);
             $('#payment_msg').slideUp('slow');
             $('#payment_msg').html($payment_msg);
             $('#payment_msg').slideDown('slow');
			}
			return false;
		});
		return false;
	});
    $('body').delegate('a.js-scroll', 'click', function() {
        $.scrollTo('.js-scroll-to', 1500);
	    return false;
    });

    $('.js-load-category').change(function() {
    var $this=$(this)
    var val=$this.val();
    var responseId=$this.metadata().child_category;
    $this.parent('div').block();
       $.ajax( {
            type: 'GET',
            url: __cfg('path_relative') + 'category/' + val+'.json',
            dataType: 'json',
            cache: true,
            success: function(responses) {
             $('#'+responseId).html("");
             $('#'+responseId).append("<option value=''>Please Select</option>");
		     $.each(responses, function(i,item){
     		 $('#'+responseId).append("<option value='"+i+"'>"+item+"</option>");
             });
             $this.parent('div').unblock();
            }
        });
    });
	$('#main').delegate('.js-filmstrip', 'click', function() {
		
			$('.js-img-container').attr('src',  __cfg('path_absolute') + 'img/ajax-loader.gif');
			var image_url = $(this).parent('a').attr('href');
			setTimeout(function(){
				$('.js-img-container').attr('src',  image_url);
			}, 400);

        return false;
    });
	$('.js-auto-submit').submit();
	$('.js-gift-product').each(function(i){
		$this = $(this);
		if ($this.is(':checked') || $this.metadata().value == 1) {
			$('.js-gift-fields-' + $this.metadata().id).slideDown('fast');
			$('.js-gift-fields-' + $this.metadata().id).removeClass('js-clone');
		} else{
			$('.js-gift-fields-' + $this.metadata().id).addClass('js-clone');
		}
	});
	$('#PaymentOrderForm').delegate('.js-gift-product', 'click', function() {
		var $this = $(this);
		if ($this.is(':checked') || $this.metadata().value == 1) {
			$('.js-gift-fields-' + $this.metadata().id).slideDown('fast');
			$('.js-gift-fields-' + $this.metadata().id).removeClass('js-clone');
			var old_height = $('.js-right-block').css('top');
            var new_height = parseInt(old_height) + 69;
            $('.js-right-block').css('top', new_height+"px");
		} else {
			$('.js-gift-fields-' + $this.metadata().id).slideUp('fast');
			$('.js-gift-fields-' + $this.metadata().id).addClass('js-clone');
			var old_height = $('.js-right-block').css('top');
            var new_height = parseInt(old_height) - 69;
            $('.js-right-block').css('top', new_height+"px");
		}
    });
	if ($('.js-shipping-address').val() == 0) {
		$('.js-new-shipping-address').slideDown('fast');
		$('.js-new-shipping-address').removeClass('js-clone');
	} else{
		$('.js-new-shipping-address').addClass('js-clone');
	}
	$('#PaymentOrderForm').delegate('.js-shipping-address', 'click', function() {
		if ($(this).val() == 0) {
			$('.js-new-shipping-address').slideDown('fast');
			$('.js-new-shipping-address').removeClass('js-clone');
		} else {
			$('.js-new-shipping-address').slideUp('fast');
			$('.js-new-shipping-address').addClass('js-clone');
		}
    });
    $.datepicker.regional['en'] = {
        closeText: __l('Done'),
        prevText: __l('Prev'),
        nextText: __l('Next'),
        currentText: __l('Today'),
        monthNames: [__l('January'), __l('February'), __l('March'), __l('April'), __l('May'), __l('June'), __l('July'), __l('August'), __l('September'), __l('October'), __l('November'), __l('December')],
        monthNamesShort: [__l('Jan'), __l('Feb'), __l('Mar'), __l('Apr'), __l('May'), __l('Jun'), __l('Jul'), __l('Aug'), __l('Sep'), __l('Oct'), __l('Nov'), __l('Dec')],
        dayNames: [__l('Sunday'), __l('Monday'), __l('Tuesday'), __l('Wednesday'), __l('Thursday'), __l('Friday'), __l('Saturday')],
        dayNamesShort: [__l('Sun'), __l('Mon'), __l('Tue'), __l('Wed'), __l('Thu'), __l('Fri'), __l('Sat')],
        dayNamesMin: [__l('Su'), __l('Mo'), __l('Tu'), __l('We'), __l('Th'), __l('Fr'), __l('Sa')],
        dateFormat: 'mm/dd/yy',
        firstDay: 0,
        isRTL: false
    };
    $.datepicker.setDefaults($.datepicker.regional['en']);
//	$.fdatepicker('form div.js-datetime');
    $('#main').delegate('.js-submit-target', 'submit', function() {
        if ($('.js-payment-type:checked').val() != 1) {
            $(this).attr('target', '');
        }
    });
    $.floadgeomapsearch('#UserAddressAddressSearch');
	$.floadgeomapsearch('#UserAddressSearch');
	// colorpicker

	if($('.js_colorpick', 'body').is('.js_colorpick')){
		$('.js_colorpick').each(function(){
			var $this = $(this);
			$('.js_colorpicker-'+$this.metadata().attribute_group_id+'-'+$this.metadata().id).fcolorpicker();
    	});
	}
    $('form').delegate('.js-payment-type', 'click', function() {
        var $this = $(this);
        if ($this.val() == 1) {
            $('.js-paypal-main').slideDown('fast');
            $('.js-wallet-connection').slideUp('fast');
        } else if ($this.val() == 2) {
            $('.js-wallet-connection').slideDown('fast');
            $('.js-paypal-main').slideUp('fast');
        }
    });
    $('.js-voting').mouseover(function() {
        $(this).parents('ul').filter(':first').find('li:first').removeClass().addClass('current-rating');
        $(this).parents('ul').filter(':first').find('li:first').addClass($(this).attr('class').split(' ')[0]);
        return false;
    }).mouseout(function() {
        $('.js-voting').parents('ul').filter(':first').find('li:first').removeClass().addClass('current-rating');
    });
	$('body').delegate('.js-voting', 'click', function() {
        var $this = $(this);
        $this.parents('.js-voting-display').filter(':first').block();
        $.get($this.attr('href'), {}, function(data) {
            $this.parents('div.vote-now').filter(':first').addClass('voted');
            if ($this.parents('.js-voting-display').filter(':first').metadata().count) {
                var count_field = $this.parents('.js-voting-display').filter(':first').metadata().count;
                $('.' + count_field).html(data.split('##')[1]);
                $this.parents('.js-voting-display').filter(':first').hide();
            }
            $this.parents('.js-voting-display').filter(':first').html(data.split('##')[0]);
            $('.js-voting-display').unblock();
        });
    });
	updateProductForm($('.js-product-type').val());
	$('#main').delegate('.js-product-type', 'change', function() {
		updateProductForm($(this).val());
	});
    //IE image load fix. Refer http://addons.maxthon.com/en_US/post/653
    if (jQuery.browser.msie) {
        forceImages(top);
    }
    $('body').delegate('.js-transaction-filter', 'click', function() {
        var val = $(this).val();
        if (val == __l('custom')) {
            $('.js-filter-window').show();
            return true;
        } else {
            $('.js-filter-window').hide();
        }
        $('.js-response').block();
        $.ajax( {
            type: 'GET',
            url: __cfg('path_relative') + 'transactions/index/stat:' + val,
            dataType: 'html',
            cache: true,
            success: function(responses) {
                $('.js-response').html(responses);
                $('.js-response').unblock();
				ajaxCallBack();
            }
        });
    });
	$('body').delegate('a.js-addmore', 'click', function() {
		var $clone_container = $(this).parent().parent();
		var len = $(this).parent().parent().find('.js-field-list').length;
		var inserted_len = parseInt($clone_container.metadata().attribute_count);
        var field_index = inserted_len+len;
		var replace_field_index = inserted_len;
        var field_list = $(this).parent().parent().find('.js-field-list').clone();

        //Code to update the field name with index
		var $is_color = false;
		var color_picker_class = '';
        $('input, select, textarea', field_list).each(function(i) {
            $this = $(this);
            var new_field_name;
			var old_attr_name = $this.attr('name');
			var old_attr_name_array = old_attr_name.split('][');
			var field_name = old_attr_name_array[3];
			old_attr_name_array[2] = field_index;
            new_field_name = old_attr_name_array.join('][');
            $this.attr('name', new_field_name);
            var new_field_id;
            new_field_id = $this.attr('id').replace('_id_'+replace_field_index, '_id_'+field_index);
            $this.attr('id', new_field_id);
			if(field_name.substring(0,field_name.length-1) == 'attribute_group_type_value') {
				var new_field_class;
            	new_field_class = $this.attr('class', 'js_colorpick js_colorpicker-'+old_attr_name_array[1]+'-'+field_index+' {id:'+field_index+',attribute_group_id:'+old_attr_name_array[1]+'}');
				var new_field_style;
            	new_field_style = $this.attr('style', '');
				$is_color = true;
				color_picker_class = '.js_colorpicker-'+old_attr_name_array[1]+'-'+field_index;
			}
        });
        $('label', field_list).each(function(i) {
            $this = $(this);
            var new_field_for;
            new_field_for = $this.attr('for').replace(replace_field_index, field_index);
            $this.attr('for', new_field_for);
        });
        //Code to remove the error class and error message
        $('.error', field_list).each(function(i) {
            $this = $(this);
            $this.removeClass('error');
            $this.find('div.error-message').remove();
        });
        var cloneClsName = 'clone_' + field_index;
        $(this).parent().before('<div class="show-target clearfix js-field-list ' + cloneClsName + '">' + field_list.html() + '<p class="press-link delete"><a href="#" class="js-remove-clone delete">Remove</a></p></div>');
		if($is_color) {
			$(color_picker_class).fcolorpicker();
		}
		$('input, select, textarea', '.' + cloneClsName).each(function() {
            $this = $(this);
            if ($this.attr('type') != 'checkbox') {
                $this.val('');
            }
        });
        return false;
    });
	$('body').delegate('a.js-remove-clone', 'click', function() {
        var $this = $(this);
        $this.parents('.js-field-list').remove();
        return false;
    });
    // Drag drop Enable and disable
	$('body').delegate('a.js-dragdrop', 'click', function() {
        var $this = $(this);
        var current_content_rel = jQuery(this).attr('rel');
        if(current_content_rel == 'reorder'){
            $('table.'+$this.metadata().met_tab+' tr').removeClass('altrow');
            $('.'+$this.metadata().met_tab).addClass($this.metadata().met_drag_cls);
            $('.'+$this.metadata().met_drag_cls).tableDnD();
            if($this.metadata().met_data_action == 'js-rank'){
                $this.text('I am done reranking');
            }else{
                $this.text('I am done reordering');
            }
            $this.attr('rel','reordering');
        }
        else{
            $('.'+$this.metadata().met_tab).removeClass($this.metadata().met_drag_cls);
            $('.js-dragdrop').text('Reorder');
            $('.js-dragdrop').attr('rel','reorder');
            var position = 0;
            $('table.'+$this.metadata().met_tab+' tr').each(function () {
                $thistr = $(this);
                $('.' + $this.metadata().met_tab_order, $thistr).val(position);
                $thistr.addClass( position % 2 ? 'altrow' : '');
                position += 1;
            });
            $('.'+$this.metadata().met_tab).removeClass($this.metadata().met_drag_cls);
        }
        return false;
    });

	//discount amount calulation for product varitants page start//
	$('body').delegate('.js-originalprice-product-variant, .js-discountpercentage-product-variant', 'blur', function() {
		var $this = $(this);
		var $id = $this.metadata().id;
		var original_price = parseFloat($('#ProductAttribute'+$id+'OriginalPrice').val());
        var discount_percentage = parseFloat($('#ProductAttribute'+$id+'DiscountPercentage').val());
        var discount_amount = parseFloat($('#ProductAttribute'+$id+'DiscountAmount').val());
        if (original_price <= 0) {
            alert(__l('Please enter valid original price.'));
        } else if (discount_percentage > 100) {
            alert(__l('Discount percentage should be less than 100.'));
        } else if (discount_percentage >= 0) {
            discount = discount_percentage / 100;
            savings = discount * original_price;
            $('#ProductAttribute'+$id+'DiscountAmount, #ProductAttribute'+$id+'Savings').val((isNaN(savings) ? 0: savings).toFixed(2));
            discounted_price = original_price - savings;
            $('#ProductAttribute'+$id+'DiscountedPrice').val((isNaN(discounted_price) ? 0: discounted_price).toFixed(2));
        } else {
            $('#ProductAttribute'+$id+'DiscountedPrice').val(isNaN(original_price) ? 0: original_price);

        }
    });
	$('body').delegate('.js-discountamount-product-variant', 'blur', function() {
		var $this = $(this);
		var $id = $this.metadata().id;
		var original_price = parseFloat($('#ProductAttribute'+$id+'OriginalPrice').val());
		var discount_percentage = parseFloat($('#ProductAttribute'+$id+'DiscountPercentage').val());
		var discount_amount = parseFloat($('#ProductAttribute'+$id+'DiscountAmount').val());
		if (original_price <= 0) {
			alert(__l('Please enter valid original price.'));
		} else if (discount_amount > original_price) {
			alert(__l('Discount amount should be less than original price.'));
		} else if (discount_amount >= 0) {
			savings = discount_amount;
			discount_percentage = (savings * 100) / original_price;
			$('#ProductAttribute'+$id+'DiscountPercentage').val(isNaN(discount_percentage) ? 0: discount_percentage.toFixed(2));
			$('#ProductAttribute'+$id+'Savings').val(isNaN(savings) ? 0: savings);
			discounted_price = original_price - savings;
			$('#ProductAttribute'+$id+'DiscountedPrice').val(isNaN(discounted_price) ? 0: discounted_price);
		}
	});
	//discount amount calulation for product varitants page end//

	$('body').delegate('#ProductOriginalPrice, #ProductDiscountPercentage', 'blur', function() {
        var original_price = parseFloat($('#ProductOriginalPrice').val());
        var discount_percentage = parseFloat($('#ProductDiscountPercentage').val());
        var discount_amount = parseFloat($('#ProductDiscountAmount').val());
        if (original_price <= 0) {
            alert(__l('Please enter valid original price.'));
        } else if (discount_percentage > 100) {
            alert(__l('Discount percentage should be less than 100.'));
        } else if (discount_percentage >= 0) {
            discount = discount_percentage / 100;
            savings = discount * original_price;
            $('#ProductDiscountAmount, #ProductSavings').val((isNaN(savings) ? 0: savings).toFixed(2));
            discounted_price = original_price - savings;
            $('#ProductDiscountedPrice, #ProductCalculatorDiscountedPrice').val((isNaN(discounted_price) ? 0: discounted_price).toFixed(2));
        } else {
            $('#ProductDiscountedPrice, #ProductCalculatorDiscountedPrice').val(isNaN(original_price) ? 0: original_price);

        }
    });
	$('body').delegate('#ProductDiscountAmount', 'blur', function() {
	var original_price = parseFloat($('#ProductOriginalPrice').val());
	var discount_percentage = parseFloat($('#ProductDiscountPercentage').val());
	var discount_amount = parseFloat($('#ProductDiscountAmount').val());
	if (original_price <= 0) {
		alert(__l('Please enter valid original price.'));
	} else if (discount_amount > original_price) {
		alert(__l('Discount amount should be less than original price.'));
	} else if (discount_amount >= 0) {
		savings = discount_amount;
		discount_percentage = (savings * 100) / original_price;
		$('#ProductDiscountPercentage').val(isNaN(discount_percentage) ? 0: discount_percentage.toFixed(2));
		$('#ProductSavings').val(isNaN(savings) ? 0: savings);
		discounted_price = original_price - savings;
		$('#ProductDiscountedPrice, #ProductCalculatorDiscountedPrice').val(isNaN(discounted_price) ? 0: discounted_price);
		}
	});
	$('.js-tabs').bind('tabsload', function(event, ui) {
		myAjaxLoad();
    });
    $('.js-min-amount').delegate('#ProjectMinAmountToFund', 'keyup', function() {
        var $this = $(this);
        if ($('.js-pledge-type').val() == 5) {
            $('.js-add-more').hide();
            var val = $this.val();
            var valarray = val.split(',');
            for (var i = 0; i < valarray.length; i ++ ) {
                var length = $('.js-clone').find('.js-field-list').length;
                if (valarray.length > length) {
                    $('.js-add-more').fpledgetypekey();
                } else if (valarray.length < length && (valarray.length - 1) == i) {
                    for (var j = valarray.length; j <= length; j ++ ) {
                        $('.js-new-clone-' + j).remove();
                    }
                }
                $('.js-website-remove').hide();
                $('#ProjectReward' + i + 'PledgeAmount').val(valarray[i]);
                $('#ProjectReward' + i + 'PledgeAmount').attr('readonly', true);
            }
        } else {
            return false;
        }
    });
    $('.footer-list').delegate('.js-video-embed', 'click', function() {
        var url = $(this).attr('href');
        $(this).colorbox( {
            href: '' + url + '',
            iframe: true,
            width: 500,
            height: 500
        });
    });
    if (($('.js-description-count', 'div.project-form-content').is('.js-description-count'))) {
        var counter = $('.js-description-count').metadata().field;
        var maxCount = $('.js-description-count').metadata().count;
        $('.js-description-count').simplyCountable( {
            counter: '#' + counter,
            countable: 'characters',
            maxCount: maxCount,
            strictMax: true,
            countDirection: 'down',
            safeClass: 'safe',
            overClass: 'over'
        });
    }
    $.fajaxdelete('a.js-ajax-delete');
    $('#simple-search').delegate('.js-show-search', 'click', function() {
        $('#advanced-search').slideToggle();
    });
	$('body').delegate('.js-add-attributegroup', 'click', function() {
		$('div#js-attribute-add-form').show();
		$.scrollTo('div#js-attribute-add-form',1500);
		return false;
	});
	$('body').delegate('.js-edit-attributegroup', 'click', function() {
		$this = $(this);
		$('.js-show-attribute-group-'+$this.metadata().id).show();
		$('form#AttributeIndexForm').addClass(" js-ajax-form-submit");
		return false;
	});
	 // bind form using ajaxForm
	$('body').delegate('form.js-ajax-form-submit', 'submit', function(event) {
		var $this = $(this);
		$this.block();
		$this.ajaxSubmit( {
			beforeSubmit:function(formData,jqForm,options){
				$('input:file',jqForm[0]).each(function(i){
					if($('input:file',jqForm[0]).eq(i).val()){
						options['extraData']={'is_iframe_submit':1};
					}
				});
			},
			success: function(responseText, statusText) {
			  redirect = responseText.split('*');
				if (redirect[0] == 'redirect') {
					location.href = redirect[1];
				}
				else{
				 $this.parents('.js-ajax-responses').html(responseText);
				}
				myAjaxLoad();
				$this.unblock();
			}
		});
		return false;
	});
    $('form').delegate('.js-pledge-type', 'change', function() {
        $('.js-field-list input').attr('readonly', false);
        $('.js-field-list input').val('');
        $('.reward-clone').remove();
        $('#ProjectMinAmountToFund').val('');
        $(this).fpledgetype();
    });
    $.fcolorboxform('.js-colorbox-form');
    $.fcolorbox('a.js-thickbox');
    $('.js-embed-view').colorbox( {
        inline: true,
        opacity: 0.30,
        href: '#embed_frame'
    });
    $.captchaPlay('a.js-captcha-play');
    $.confirm('a.js-delete');
    $('body').delegate('.js-buy', 'click', function() {
        return window.confirm(__l('You will be redirected to different site where you can buy this project. Are you sure you want to move frome this site?'));
    });
    $('.main-section').delegate('.js-trigger-cron', 'click', function() {
        return window.confirm(__l('Are you sure you want to trigger cron to update project status?'));
    });
    // bind form using ajaxForm
    $.fajaxform('.js-ajax-form');
    // bind form comment using ajaxForm
    $.fcommentform('.js-comment-form');
	$('.js-ajax-search-form').fajaxsearchform();
	$.fattributeaddform('.js-attribute-form');
    // jquery ui tabs function
    if ($('.js-tabs', 'body').is('.js-tabs')) {
        $('.js-tabs').tabs();
    }
    // jquery flash uploader function
    $('.js-uploader').fuploader();
    // jquery autocomplete function
    $.fautocomplete('.js-autocomplete');
    $.fmultiautocomplete('.js-multi-autocomplete');
    $('body').delegate('.js-open-datepicker', 'click', function() {
        var div_id = $(this).attr('name');
        $('#' + div_id).slideToggle();
        $(this).parent().parent().toggleClass('date-cont');
    });
    $('body').delegate('.js-close-calendar', 'click', function() {
        $('#' + $(this).metadata().container).hide();
        $('#' + $(this).metadata().container).parent().parent().toggleClass('date-cont');
        return false;
    });
    $('body').delegate('a.js-no-date-set', 'click', function() {
        $this = $(this);
        $tthis = $this.parents('.input');
        $('div.js-datetime', $tthis).children("select[id$='Day']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Month']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Year']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Hour']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Min']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Meridian']").val('');
        $('#caketime' + $this.metadata().container).html('');
        $('.displaydate' + $this.metadata().container + ' span').html(__l('No Date Set'));
        return false;
    });
    $('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
	// jquery datepicker
    $('.js-datetime,.js-date').fdatepicker();
    // admin side select all active, inactive, pending and none
    $('body').delegate('.js-admin-select-all', 'click', function() {
        $('.js-checkbox-list').attr('checked', 'checked');
        return false;
    });
    $('body').delegate('.js-update-order-field', 'click', function() {
        var submit_var = $(this).attr('name');
        if (submit_var == "data[Product][save_as_draft]") {
            $('#js-save-draft').val(1);
        } else {
            $('#js-save-draft').val(0);
        }
    });
	$('.shipment-container').delegate('a.js-addmore', 'click', function() {
        var field_index = $(this).parent().parent().find('.js-clone').find('.js-field-list').length;
        var field_list = $(this).parent().parent().find('.js-clone').find('.js-field-list').clone();
        //Code to update the field name with index
        $('input, select, textarea', field_list).each(function(i) {
            $this = $(this);
            var new_field_name;
            new_field_name = $this.attr('name').replace('0', field_index);
            $this.attr('name', new_field_name);
            var new_field_id;
            new_field_id = $this.attr('id').replace('0', field_index);
            $this.attr('id', new_field_id);
        });
        $('label', field_list).each(function(i) {
            $this = $(this);
            var new_field_for;
            new_field_for = $this.attr('for').replace('0', field_index);
            $this.attr('for', new_field_for);
        });
        //Code to remove the error class and error message
        $('.error', field_list).each(function(i) {
            $this = $(this);
            $this.removeClass('error');
            $this.find('div.error-message').remove();
        });
        var cloneClsName = 'clone_' + field_index;
        var removeType = $('.js-addmore').attr('rel');
        if (removeType == 'question-add') {
            var questioncount = $('#js-question-count').val();
            questioncount ++ ;
            $('#js-question-count').val(questioncount);
            $(this).parent().parent().find('.js-clone').append('<div class="show-target clearfix js-field-list ' + cloneClsName + '">' + field_list.html() + '</div>');
        } else {
            $(this).parent().parent().find('.js-clone').append('<div class="show-target clearfix js-field-list ' + cloneClsName + '">' + field_list.html() + '<p class="press-link delete"><a href="#" class="js-remove-clone delete">Remove</a></p></div>');
        }
        $('input, select, textarea', '.' + cloneClsName).each(function() {
            $this = $(this);
            if ($this.attr('type') != 'checkbox') {
                $this.val('');
            }
        });
        return false;
    });
	$('.orders').delegate('.js-order-colorbox', 'click', function() {
		var id = '#' + $(this).metadata().id;
        $(this).colorbox( {
            inline: true,
            width: '600px',
            opacity: 0.30,
            href: id
        });
    });

	$('body').delegate('.js-date-chkbox', 'click', function() {
		if ($('.js-date-chkbox').is(':checked'))
		{
		$('.js-showdate').show('slow');
		}
		else{
		$('.js-showdate').hide('slow');
		}
    });

	$('.shipment-container').delegate('a.js-remove-clone', 'click', function() {
        var $this = $(this);
        $this.parents('.js-field-list').remove();
        updateShipment();
        return false;
    });
	$('#main').delegate('a.js-shipment', 'click', function() {
        if ($('#ProductIsRequiresShipping').is(':checked')) {
            $('div.js-shipment-container').addClass('hide');
			$('#ProductIsRequiresShipping').attr('checked',false)
        } else {
            $('div.js-shipment-container').removeClass('hide');
			$('#ProductIsRequiresShipping').attr('checked',true)
        }
        return false;
    });
	$('#main').delegate('#ProductIsRequiresShipping', 'change', function() {
        if ($('#ProductIsRequiresShipping').is(':checked')) {
            $('div.js-shipment-container').removeClass('hide');
			$('#ProductIsRequiresShipping').attr('checked',true)
        } else {
            $('div.js-shipment-container').addClass('hide');
			$('#ProductIsRequiresShipping').attr('checked',false)
        }
        return false;
    });
	$('#main').delegate('#ProductIsHavingFileToDownload', 'change', function() {
        if ($('#ProductIsHavingFileToDownload').is(':checked')) {
            $('div.js-file-container').removeClass('hide');
        } else {
            $('div.js-file-container').addClass('hide');
        }
        return false;
    });
    $('#gallery').galleryView( {
        panel_width: 490,
        panel_height: 350,
        gallery_width: 700,
        gallery_height: 700,
        frame_width: 45,
        frame_height: 45,
        pause_on_hover: true
    });


	$('body').delegate('form input.js-update-order-field', 'click', function() {
		var user_balance;
		user_balance = $('.js-user-available-balance').metadata().balance;
		if ($('#PaymentPaymentGatewayId2:checked').val() && user_balance != '' && user_balance != '0.00') {
			return window.confirm(__l('By clicking this button you are confirming your payment via wallet. Once you confirmed amount will be deducted from your wallet and you cannot undo this process. Are you sure you want to confirm this action?'));
		} else if (( ! user_balance || user_balance == '0.00') && ($('#PaymentPaymentGatewayId2:checked').val() != '' && typeof($('#PaymentPaymentGatewayId2:checked').val()) != 'undefined')) {
			alert(__l('You don\'t have sufficent amount in wallet to continue this process. So please select any other payment gateway.'));
			return false;
		} else {
			return true;
		}
	});

	$('body').delegate('.js-admin-select-none', 'click', function() {
        $('.js-checkbox-list').attr('checked', false);
        return false;
    });
    $('body').delegate('.js-admin-select-pending', 'click', function() {
        $('.js-checkbox-active').attr('checked', false);
        $('.js-checkbox-inactive').attr('checked', 'checked');
        return false;
    });
    $('body').delegate('.js-admin-select-approved', 'click', function() {
        $('.js-checkbox-active').attr('checked', 'checked');
        $('.js-checkbox-inactive').attr('checked', false);
        return false;
    });
    $('body').delegate('.js-admin-select-notfeatured', 'click', function() {
        $('.js-checkbox-featured').attr('checked', false);
        $('.js-checkbox-notfeatured').attr('checked', 'checked');
        return false;
    });
    $('body').delegate('.js-admin-select-featured', 'click', function() {
        $('.js-checkbox-featured').attr('checked', 'checked');
        $('.js-checkbox-notfeatured').attr('checked', false);
        return false;
    });
    $('body').delegate('.js-admin-select-unsuspended', 'click', function() {
        $('.js-checkbox-suspended').attr('checked', false);
        $('.js-checkbox-unsuspended').attr('checked', 'checked');
        return false;
    });
    $('body').delegate('.js-admin-select-suspended', 'click', function() {
        $('.js-checkbox-suspended').attr('checked', 'checked');
        $('.js-checkbox-unsuspended').attr('checked', false);
        return false;
    });
    $('body').delegate('.js-admin-select-unflagged', 'click', function() {
        $('.js-checkbox-flagged').attr('checked', false);
        $('.js-checkbox-unflagged').attr('checked', 'checked');
        return false;
    });
    $('body').delegate('.js-admin-select-flagged', 'click', function() {
        $('.js-checkbox-flagged').attr('checked', 'checked');
        $('.js-checkbox-unflagged').attr('checked', false);
        return false;
    });
    // admin side update active, inactive
    $('body').delegate('.js-admin-action', 'click', function() {
        var active = $('input.js-checkbox-active:checked').length;
        var inactive = $('input.js-checkbox-inactive:checked').length;
        if (active <= 0 && inactive <= 0) {
            alert(__l('Please select atleast one record!'));
            return false;
        } else {
            return window.confirm(__l('Are you sure you want to do this action?'));
        }
    });
    // insert subject variables in email templates in admin side
    $('body').delegate('.js-subject-insert', 'click', function() {
        var $this = $(this).parent('.js-insert');
        $('.js-email-subject', $this).replaceSelection(this.title);
        e.preventDefault();
    });
    // insert content variables in email templates in admin side
    $('body').delegate('.js-content-insert', 'click', function() {
        var $this = $(this).parent('.js-insert');
        $('.js-email-content', $this).replaceSelection(this.title);
        e.preventDefault();
    });
    // captcha reload function
    $('.captcha-block').delegate('.js-captcha-reload', 'click', function() {
        captcha_img_src = $(this).parents('.js-captcha-container').find('.captcha-img').attr('src');
        captcha_img_src = captcha_img_src.substring(0, captcha_img_src.lastIndexOf('/'));
        $(this).parents('.js-captcha-container').find('.captcha-img').attr('src', captcha_img_src + '/' + Math.random());
        return false;
    });
    $('body').delegate('.js-admin-index-autosubmit', 'change', function() {
        if ($('.js-checkbox-list:checked').val() != 1 && $(this).val() >= 1) {
            alert(__l('Please select atleast one record!'));
            return false;
        } else if ($(this).val() >= 1) {
            if (window.confirm(__l('Are you sure you want to do this action?'))) {
                $(this).parents('form').submit();
            }
        }
    });
	$('body').delegate('.js-enable-product-variant', 'click', function() {
        if ($('#ProductIsProductVariantEnabled').is(':checked')) {
            $('div.js-product-variant-groups').slideDown();
            $('#add-button').val('Next');
            $('.step-2').show();
        } else {
            $('div.js-product-variant-groups').slideUp();
            $('#add-button').val('Add');
            $('.step-2').hide();
        }
    });
    $('form').delegate('.js-autosubmit', 'change', function() {
        $(this).parents('form').submit();
    });
    $('body').delegate('.js-field-clear', 'click', function() {
        if ($(this).val() == $(this).metadata().txt) {
            $(this).val('');
        }
    });
    $('body').delegate('.js-field-clear', 'blur', function() {
        if ($(this).val() == '') {
            $(this).val($(this).metadata().txt);
        }
    });
    $('div#main').delegate('.js-pagination a', 'click', function() {
        $this = $(this);
        $this.parents('div.js-response').filter(':first').block();
        $.get($this.attr('href'), function(data) {
            $this.parents('div.js-response').filter(':first').html(data);
            new_title = $this.attr('id');
            //alert($('h2').html());
            $('h2').html(new_title)
            ajaxCallBack();
            $this.parents('div.js-response').filter(':first').unblock();
            return false;
        });
        return false;
    });
    $('body').delegate('.js-toggle-show', 'click', function() {
        $('.' + $(this).metadata().container).slideToggle();
        return false;
    });
    $('body').delegate('.js-setting-show input', 'click', function() {
		$this = $('.js-setting-show input');
        if ($this.is(':checked')) {
            var containerArray = $this.parent('.js-setting-show').metadata().container.split(',');
            for (var i = 0; i < containerArray.length; i ++ ) {
                $('#' + containerArray[i]).slideToggle('down');
            }
        } else {
            var containerArray = $this.parent('.js-setting-show').metadata().container.split(',');
            for (var i = 0; i < containerArray.length; i ++ ) {
                $('#' + containerArray[i]).find('input').attr('checked', false);
                $('#' + containerArray[i]).slideToggle('up');
            }
        }
    });
    if (($('.js-setting-show input', 'div.js-responses').is('.js-setting-show input'))) {
		$this = $('.js-setting-show input');
        if ($this.is(':checked')) {
            $('#' + $this.parent('.js-setting-show').metadata().container).show();
        } else {
            $('#' + $this.parent('.js-setting-show').metadata().container).hide();
        }
    }
    $('body').delegate('.js-change-action', 'change', function() {
        var $this = $('.js-change-action');
        $('.' + $this.metadata().container).block();
        $.get(__cfg('path_relative') + $this.metadata().url + $this.val(), {}, function(data) {
            $('.' + $this.metadata().container).html(data);
            $('.' + $this.metadata().container).unblock();
        });
    });
    $('body').delegate('.js-toggle-check', 'click', function() {
        $('.' + $(this).metadata().divClass).slideToggle();
    });
    $('body').delegate('.js-toggle-div', 'click', function() {
        $('.' + $(this).metadata().divClass).slideToggle();
        return false;
    });

		$('.js-truncate').livequery(function(){
		var $this=$(this);
		$len = $this.metadata().len;
		if(typeof($len) == 'undefined'){
			$len = 100;
		}
		$this.truncate($len,{
			chars:/\s/,trail:["<a href='#' class='truncate_show'>"+__l(' more','en_us')+"</a> ... "," ...<a href='#' class='truncate_hide'>"+__l('less','en_us')+"</a>"]
		});
	});
    if ($('.js-countdown', 'body').is('.js-countdown')) {
        var end_date = parseInt($('.js-countdown').parents().find('.js-time').html());
        $('.js-countdown').countdown({
            until: end_date,
            format: 'HMS',
			compact: true
        });
		if (isNaN(end_date)) {
			$('.js-countdown').html('0');
		}
	}
    $('.js-login-form').hide();
    $('div#js-toggle-show-block').delegate('.js-toggle-show', 'click', function() {
        $('.' + $(this).metadata().container).show('slow');
        $('.' + $(this).metadata().hide_container).hide('slow');
        return false;
    });
		$('body').delegate('a.js-toggle-show-login', 'click', function() {
        $('.' + $(this).metadata().container).slideToggle(1000);
        if ($('.' + $(this).metadata().hide_container)) {
            $('.' + $(this).metadata().hide_container).slideToggle(1000);
            $('.js-add-friend').show("slide", {}, 1000);
        }
        return false;
    });
    $('div#main').delegate('a.change-star-unstar', 'click', function() {
        var _this = $(this);
        _this.parent().removeClass('star-select');
        _this.parent().removeClass('star');
        _this.parent().addClass('loader');
        var relative_url = _this.attr('href');
        var tt = relative_url.split('/');
        var new_url = '/' + tt[1] + '/' + tt[2] + '/' + tt[3] + '/';
        $.get(_this.attr('href'), null, function(data) {
            var output = data.split('/');
            var id = output[0];
            if (output[1] == 'star') {
                _this.attr('href', new_url + id + '/star');
                _this.parent().removeClass('loader');
                _this.parent().addClass('star');
                $('#Message_' + tt[tt.length - 2]).removeClass('checkbox-starred');
                $('#Message_' + tt[tt.length - 2]).addClass('checkbox-unstarred');
				$.fn.setflashMsg(__l('Message has been unstarred successfully'),'success');
            } else {
                _this.attr('href', new_url + id + '/unstar');
                _this.parent().removeClass('loader');
                _this.parent().addClass('star-select');
                $('#Message_' + tt[tt.length - 2]).removeClass('checkbox-unstarred');
                $('#Message_' + tt[tt.length - 2]).addClass('checkbox-starred');
				$.fn.setflashMsg(__l('Message has been starred successfully'),'success');
            }
        });
        return false;
    });
    $('body').delegate('.js-invite-all', 'change', function() {
        $('.invite-select').val($(this).val());
    });
    $('body').delegate('.js-show-mail-detail-span', 'click', function() {
        if ($('.js-show-mail-detail-span').text() == 'show details') {
            $('.js-show-mail-detail-span').text('hide details');
            $('.js-show-mail-detail-div').show();
        } else {
            $('.js-show-mail-detail-span').text('show details');
            $('.js-show-mail-detail-div').hide();
        }
    });
    $('.inbox-option').delegate('.js-select-all', 'click', function() {
        $('.checkbox-message').attr('checked', 'checked');
        return false;
    });
    $('.inbox-option').delegate('.js-select-none', 'click', function() {
        $('.checkbox-message').attr('checked', false);
        return false;
    });
    $('.inbox-option').delegate('.js-select-read', 'click', function() {
        $('.checkbox-message').attr('checked', false);
        $('.checkbox-read').attr('checked', 'checked');
        return false;
    });
    $('.inbox-option').delegate('.js-select-unread', 'click', function() {
        $('.checkbox-message').attr('checked', false);
        $('.checkbox-unread').attr('checked', 'checked');
        return false;
    });
    $('.inbox-option').delegate('.js-select-starred', 'click', function() {
        $('.checkbox-message').attr('checked', false);
        $('.checkbox-starred').attr('checked', 'checked');
        return false;
    });
    $('.inbox-option').delegate('.js-select-unstarred', 'click', function() {
        $('.checkbox-message').attr('checked', false);
        $('.checkbox-unstarred').attr('checked', 'checked');
        return false;
    });
    $('.message-block').delegate('.js-apply-message-action', 'change', function() {
        if ($('.js-checkbox-list:checked').val() != 1 && $(this).val() == 'Add star' || $('.js-checkbox-list:checked').val() != 1 && $(this).val() == 'Remove star' || $('.js-checkbox-list:checked').val() != 1 && $(this).val() == 'Mark as unread') {
            alert(__l('Please select atleast one record!'));
            return false;
        } else {
            $('#MessageMoveToForm').submit();
        }
    });
    $('.delete-block').delegate('.js-compose-delete', 'click', function() {
        var _this = $(this);
        if (window.confirm(__l('Are you sure you want to discard this message?'))) {
            return true;
        } else {
            return false;
        }
    });
    $('.delete-block').delegate('.js-without-subject', 'click', function() {
        if ($('#MessSubject').val() == '') {
            if (window.confirm(__l('Send message without a subject?'))) {
                return true;
            }
            return false;
        }
    });
    $('div#main').delegate('.js-attachmant', 'click', function() {
        $('.atachment').append('<div class="input file"><label for="AttachmentFilename"/><input id="AttachmentFilename" class="file" type="file" value="" name="data[Attachment][filename][]"/></div>');
        return false;
    });
    $('form .js-overlabel label').foverlabel();
    $('.js-rating').mouseover(function() {
        $(this).parents('ul').filter(':first').find('li:first').removeClass().addClass('current-rating');
        $(this).parents('ul').filter(':first').find('li:first').addClass($(this).attr('class').split(' ')[0]);
        return false;
    }).mouseout(function() {
        $('.js-rating').parents('ul').filter(':first').find('li:first').removeClass().addClass('current-rating');
    });
    // js code to do automatic validation on input fields blur
    $('div.input').each(function() {
        var m = /validation:{([\*]*|.*|[\/]*)}$/.exec($(this).attr('class'));
        if (m && m[1]) {
            $(this).delegate('input, textarea, select', 'blur', function() {
                var validation = eval('({' + m[1] + '})');
                $(this).parent().removeClass('error');
                $(this).siblings('div.error-message').remove();
                error_message = 0;
                for (var i in validation) {
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'notempty' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'notempty' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !$(this).val()) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'alphaNumeric' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'alphaNumeric' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[0-9A-Za-z]+$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'numeric' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'numeric' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[+-]?[0-9|.]+$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'email' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'email' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4}|museum|travel)$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'equalTo') || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'equalTo' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && $(this).val() != validation[i]['rule'][1]) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'between' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'between' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && ($(this).val().length < validation[i]['rule'][1] || $(this).val().length > validation[i]['rule'][2])) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'minLength' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'minLength' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && $(this).val().length < validation[i]['rule'][1]) {
                        error_message = 1;
                        break;
                    }
                }
                if (error_message) {
                    $(this).parent().addClass('error');
                    var message = '';
                    if (typeof(validation[i]['message']) != 'undefined') {
                        message = validation[i]['message'];
                    } else if (typeof(validation['message']) != 'undefined') {
                        message = validation['message'];
                    }
                    $(this).parent().append('<div class="error-message">' + message + '</div>').fadeIn();
                }
            });
        }
    });
   $('body').delegate('form', 'submit', function() {
		$this = $(this);
        $(this).find('div.input input[type=text], div.input input[type=password], div.input textarea, div.input select').trigger('blur');
        $('input, textarea, select', $('.error', $(this)).filter(':first')).trigger('focus');
		$('.error-message').each(function(i) {
						if($(this).parents('div').hasClass('js-clone')){
							$(this).remove();
						}
		});
        return ! ($('.error-message', $this).length);
    });
    $('body').delegate('.js-rating', 'click', function() {
        var $this = $(this);
        $this.parents('.js-rating-display').filter(':first').block();
        $.get($this.attr('href'), {}, function(data) {
            $this.parents('div.vote-now').filter(':first').addClass('voted');
            if ($this.parents('.js-rating-display').filter(':first').metadata().count) {
                var count_field = $this.parents('.js-rating-display').filter(':first').metadata().count;
                $('.' + count_field).html(data.split('##')[1]);
                $this.parents('.js-rating-display').filter(':first').hide();
            }
            $this.parents('.js-rating-display').filter(':first').html(data.split('##')[0]);
            $('.js-rating-display').unblock();
        });
    });
    $.address.init(function(event) {
        $this = $(this);
        if ($('div.js-tabs', 'body').is('div.js-tabs')) {
            $('div.js-tabs').tabs( {
                load: function(event, ui) {
                    $this.next('.ui-tabs-panel').html($(ui.panel).html());
                },
                selected: $('.js-tabs ul:first a').index($('a[rel=address:' + event.value + ']')),
                fx: {
                    opacity: 'toggle'
                }
            }).css('display', 'block');
        }
    }).externalChange(function(event) {
        if (event.value == '/') {
            $('.js-tabs').tabs('select', 0);
        } else {
            $('.js-tabs').tabs('select', $('a[rel=address:' + event.value + ']').attr('href'));
        }
    });
    $('.js-attachment-list').delegate('.js-old-attachmant', 'click', function() {
        var $this = $(this);
        $('#OldAttachment' + $this.metadata().id + 'Id').val(1);
        $('.js-old-attachmant-div-' + $this.metadata().id).hide();
        return false;
    });
	$('div.js-accordion').accordion( {
        header: 'h3',
        autoHeight: false,
        active: false,
        collapsible: true
    });
    $('h3', '.js-accordion').click(function(e) {
        var contentDiv = $(this).next('div');
        if ( ! contentDiv.html().length) {
            $this = $(this);
            $this.block();
            $.get($(this).find('a').attr('href'), function(data) {
                contentDiv.html(data);
                $this.unblock();
            });
        }
    });
	$('.js-payment-gateway_select').each(function(){
		if($(this).val() == 3){
			$('.'+$(this).metadata().container).show();
		}
		else{
			$('.'+$(this).metadata().container).hide();
		}

	});
	$('body').delegate('.js-payment-gateway_select', 'change', function() {
		if($(this).val() != 3 || $(this).val() == ''){
			$('.'+$(this).metadata().container).hide();
		}
		else{
			$('.'+$(this).metadata().container).show();
		}
	});
	$('body').delegate('form.js-email-ajax-form', 'submit', function(e) {
            var $this = $(this);
            $this.block();
            $this.ajaxSubmit( {
                beforeSubmit: function(formData, jqForm, options) {
                    $('input:file', jqForm[0]).each(function(i) {
                        if ($('input:file', jqForm[0]).eq(i).val()) {
                            options['extraData'] = {
                                'is_iframe_submit': 1
                            };
                        }
                    });
                    $this.block();
                },
                success: function(responseText, statusText) {
                    redirect = responseText.split('*');
                    if (redirect[0] == 'redirect') {
                        location.href = redirect[1];
                    }
					else if (responseText == 'success') {
                        window.location.reload();
                    }
					else if (responseText.indexOf($this.metadata().container) != '-1') {
                        $('.' + $this.metadata().container).html(responseText);
                    }
					else if (responseText == 'index') {
                        $.get(__cfg('path_relative') + 'user_cash_withdrawals/index/', function(data) {
                            $('.js-withdrawal_responses').html(data);
                        });
                    }else if ($this.metadata().container) {
                        $('.' + $this.metadata().container).html(responseText);
                    }
					else {
					   if($('div.js-preview-responses').length){
					     $('div.js-preview-responses').html(responseText);
					   }else{
						 $this.parents('div.js-responses').eq(0).html(responseText);
					   }
                    }
					$('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
					fajaxvalidation();
                    $this.unblock();
                }
            });
            return false;
        });
    if (($('.js-register-form', 'body').is('.js-register-form')) || ($('.js-project-form', 'body').is('.js-project-form')) || ($('.js-fund-form', 'body').is('.js-fund-form'))) {
        /// Get the Geo City, State And Country
        if ($.cookie('ice') == null) {
            $.cookie('ice', 'true', {
                expires: 100,
                path: '/'
            });
        }
        if ($.cookie('ice') == 'true' && $.cookie('_geo') == null) {
            $.ajax( {
                type: 'GET',
                url: 'http://j.maxmind.com/app/geoip.js',
                dataType: 'script',
                cache: true,
                success: function() {
                    str = geoip_country_code() + '|' + geoip_region_name() + '|' + geoip_city() + '|' + geoip_latitude() + '|' + geoip_longitude();
                    $.cookie('_geo', str, {
                        expires: 100,
                        path: '/'
                    });
                    $('#CityName').val(geoip_city());
                    $('#StateName').val(geoip_region_name());
                    $('#country_iso_code').val(geoip_country_code());
                    $('#latitude').val(geoip_latitude());
                    $('#longitude').val(geoip_longitude());

                    if (window.location.href.indexOf('users/register') != -1) {
                        $('#UserProfileCountryIsoCode').val(geoip_country_code());
                    }
                }
            });
        } else {
            var geoip = $.cookie('_geo').split('|');
            $('#CityName').val(geoip[2]);
            $('#StateName').val(geoip[1]);
            $('#country_iso_code').val(geoip[0]);
            $('#latitude').val(geoip[3]);
            $('#longitude').val(geoip[4]);
            if (window.location.href.indexOf('users/register') != -1) {
                $('#UserProfileCountryIsoCode').val(geoip[0]);
            }
        }
    }
	if(getCookie('_geo') == '' || getCookie('_geo') == null){
		if("https:" == document.location.protocol){
					$.get(__cfg('path_absolute')+'cities/check_city/type:getcity',function(data){
						if(data!=''){
								response = data.split('|');
								str = response[2] + '|' + response[1] + '|' + response[0] + '|' + response[3] + '|' + response[4];
								document.cookie = '_geo=' + str + ';path=/';
						}
					});
		}
		else{
			$.ajax( {
				type: 'GET',
				url: 'http://j.maxmind.com/app/geoip.js',
				dataType: 'script',
				cache: true,
				success: function() {
							str = geoip_country_code() + '|' + geoip_region_name() + '|' + geoip_city() + '|' + geoip_latitude() + '|' + geoip_longitude();
							document.cookie = '_geo=' + str + ';path=/';
				}
			});
		}

	}
});
function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + '=');
        if (c_start !=- 1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(';', c_start);
            if (c_end ==- 1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return '';
}
// view product - variant
var combinations = new Array();
var selectedCombination = new Array();
var globalQuantity = new Number;
var colors = new Array();
var doesntExist = 'The combination does not exist for this product. Please choose another.';
var doesntExistNoMore = 'This product is no longer in stock';
var doesntExistNoMoreBut = 'with those variants but is available with others';
var availableNowValue = 'In stock';
function addCombination(idCombination, arrayOfIdAttributes, quantity, price, discounted_price, image_url)
{
	globalQuantity += quantity;
	var combination = new Array();
	combination['idCombination'] = idCombination;
	combination['quantity'] = quantity;
	combination['idsAttributes'] = arrayOfIdAttributes;
	combination['price'] = price;
	combination['discounted_price'] = discounted_price;
	combination['image_url'] = image_url;
	combinations.push(combination);
}
//verify if value is in the array
function in_array(value, array)
{
	for (var i in array)
		if (array[i] == value)
			return true;
	return false;
}
function findCombination(firstTime)
{
	$('#js-quantity_wanted').val(1);
	var choice = new Array();
	$('div#js-attributes select').each(function(){
		choice.push($(this).val());
	});
	for (var combination = 0; combination < combinations.length; ++combination)
	{
		//verify if this combinaison is the same that the user's choice
		var combinationMatchForm = true;
		$.each(combinations[combination]['idsAttributes'], function(key, value)
		{
			if (!in_array(value, choice))
			{
				combinationMatchForm = false;
			}
		})
		if (combinationMatchForm)
		{

			selectedCombination['unavailable'] = false;
			$('#js-product_attribute_id').val(combinations[combination]['idCombination']);

			//get the data of product with these attributes
			quantityAvailable = combinations[combination]['quantity'];
			selectedCombination['price'] = combinations[combination]['price'];
			selectedCombination['discounted_price'] = combinations[combination]['discounted_price'];
			if (combinations[combination]['image_url'] != ''){
				$('.js-img-container').removeAttr('width');
				$('.js-img-container').removeAttr('height');
				$('.js-img-container').attr('src',  __cfg('path_absolute') + 'img/ajax-loader.gif');
				setTimeout(function(){
					$('.js-img-container').attr('src',  combinations[combination]['image_url']);
				}, 1000);
			}
			updateDisplay();
			//leave the function because combination has been found
			return;
		}
	}
	//this combination doesn't exist (not created in back office)
	selectedCombination['unavailable'] = true;
	$('#js-product_attribute_id').val(combinations[combination]['idCombination']);
	updateDisplay();
}
//update display of the availability of the product AND the prices of the product
function updateDisplay()
{
	if (!selectedCombination['unavailable'] && quantityAvailable > 0)
	{
		$('div#js-quantity_wanted_block:hidden').show('slow');

		$('div#js-add_to_cart_block:hidden').fadeIn(600);


		// availability
		if (availableNowValue != '')
		{
			//update the availability statut of the product
			$('#js-availability_value').removeClass('warning_inline');
			$('#js-availability_value').text(availableNowValue);
			product_animate($('div#js-availability_block'));
		}
		else
		{
			//hide the availability value
			$('div#js-availability_block:visible').hide();
		}

	} else{
		$('div#js-quantity_wanted_block:visible').hide('slow');
		if (!selectedCombination['unavailable'])
			$('#js-availability_value').text(doesntExistNoMore + (globalQuantity > 0 ? ' ' + doesntExistNoMoreBut : '')).addClass('warning_inline');
		else
		{
			$('#js-availability_value').text(doesntExist).addClass('warning_inline');
			$('div#js-out-of-stock-block').hide();
		}
		$('div#js-add_to_cart_block:visible').fadeOut(600);
		product_animate($('div#js-availability_block'));
	}
	if (!selectedCombination['unavailable'] && quantityAvailable > 0)
	{
		var sale_price = selectedCombination['price'];
		var is_discounted = false;
		if(selectedCombination['discounted_price']>0 && selectedCombination['discounted_price']<selectedCombination['price']){
			sale_price = selectedCombination['discounted_price'];
			is_discounted = true;
		}
		if(is_discounted){
			$('span#js-original_price').html(selectedCombination['price']);
			product_animate($('span#js-original_price'));
			$('p#js-original_price_block').show('slow');
		} else{
			$('p#js-original_price_block').hide('slow');
		}
		$('span#js-discounted_price').html(sale_price);
		product_animate($('span#js-discounted_price'));
	}

}
function product_animate($this){
	$this.effect("highlight", {}, 3000);	
}
//end variant
function loadGeo() {
    var options = {
        map_frame_id: 'mapframe',
        map_window_id: 'mapwindow',
        state: 'StateName',
        city: 'CityName',
        country: 'js-country_id',
        lat_id: 'latitude',
        lng_id: 'longitude',
        postal_code: 'UserAddressZipcode',
        ne_lat: 'ne_latitude',
        ne_lng: 'ne_longitude',
        sw_lat: 'sw_latitude',
        sw_lng: 'sw_longitude',
        lat: '37.7749295',
        lng: '-122.4194155',
        map_zoom: 13
    }
    $('#UserAddressAddressSearch,#UserAddressSearch').autogeocomplete(options);
    $.fproductaddform('#UserAddressAddressSearch');
	$.fproductaddform('#UserAddressSearch');
}
function loadGeoAddress(selector) {
    geocoder = new google.maps.Geocoder();
    var address = $(selector).val();
    geocoder.geocode( {
        'address': address
    }, function(results, status) {
        $.map(results, function(results) {
            var components = results.address_components;
            if (components.length) {
                for (var j = 0; j < components.length; j ++ ) {
                    if (components[j].types[0] == 'locality' || components[j].types[0] == 'administrative_area_level_2') {
                        city = components[j].long_name;
                        $('#CityName').val(city);
                    }
                    if (components[j].types[0] == 'administrative_area_level_1') {
                        state = components[j].long_name;
                        $('#StateName').val(state);
                    }
                    if (components[j].types[0] == 'country') {
                        country = components[j].short_name;
                        $('#js-country_id').val(country);

                    }
                    if (components[j].types[0] == 'postal_code') {
                        postal_code = components[j].long_name;
                        if (selector == '#UserAddressAddressSearch') {
                            $('#UserAddressZipcode').val(postal_code);
                        }
                        else if (selector == '#UserAddressSearch') {
                            $('#UserProfileZipCode').val(postal_code);
                        }
                    }
                }
            }
        });
    });
}
function buildChart($default_load){
		if($default_load == ''){
			$default_load = 'body';
		}
		$('.js-load-line-graph', $default_load).each(function(){
			data_container = $(this).metadata().data_container;
			chart_container = $(this).metadata().chart_container;
			chart_title = $(this).metadata().chart_title;
			chart_y_title = $(this).metadata().chart_y_title;
			var table = document.getElementById(data_container);
			options = {
				   chart: {
						renderTo: chart_container,
						defaultSeriesType: 'line'
				   },
				   title: {
					  text: chart_title
				   },
				   xAxis: {
					   labels: {
							rotation: -90
					   }
				   },
				   yAxis: {
					  title: {
						 text: chart_y_title
					  }
				   },
				   tooltip: {
					  formatter: function() {
						 return '<b>'+ this.series.name +'</b><br/>'+
							this.y +' '+ this.x;
					  }
				   }
			};
			// the categories
			options.xAxis.categories = [];
			jQuery('tbody th', table).each( function(i) {
				options.xAxis.categories.push(this.innerHTML);
			});

			// the data series
			options.series = [];
			jQuery('tr', table).each( function(i) {
				var tr = this;
				jQuery('th, td', tr).each( function(j) {
					if (j > 0) { // skip first column
						if (i == 0) { // get the name and init the series
							options.series[j - 1] = {
								name: this.innerHTML,
								data: []
							};
						} else { // add values
							options.series[j - 1].data.push(parseFloat(this.innerHTML));
						}
					}
				});
			});
			var chart = new Highcharts.Chart(options);
		});
		$('.js-load-pie-chart', $default_load).each(function(){
			data_container = $(this).metadata().data_container;
			chart_container = $(this).metadata().chart_container;
			chart_title = $(this).metadata().chart_title;
			chart_y_title = $(this).metadata().chart_y_title;
			var table = document.getElementById(data_container);
			options = {
				chart: {
						renderTo: chart_container,
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: chart_title
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ (this.percentage).toFixed(2) +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
				    series: [{
						type: 'pie',
						name: chart_y_title,
						data: []
					}]
			};
			options.series[0].data = [] ;
			jQuery('tr', table).each( function(i) {
				var tr = this;
				jQuery('th, td', tr).each( function(j) {
					if(j == 0){
						options.series[0].data[i] = [];
						options.series[0].data[i][j] = this.innerHTML
					} else { // add values
						options.series[0].data[i][j] = parseFloat(this.innerHTML);
					}
				});
			});
			var chart = new Highcharts.Chart(options);
		});
		$('.js-load-column-chart', $default_load).each(function(){
			data_container = $(this).metadata().data_container;
			chart_container = $(this).metadata().chart_container;
			chart_title = $(this).metadata().chart_title;
			chart_y_title = $(this).metadata().chart_y_title;
			var table = document.getElementById(data_container);
			seriesType = 'column';
			if($(this).metadata().series_type){
				seriesType = $(this).metadata().series_type;
			}
			options = {
					chart: {
						renderTo: chart_container,
						defaultSeriesType: seriesType,
						margin: [ 50, 50, 100, 80]
					},
					title: {
						text: chart_title
					},
					xAxis: {
						categories: [
						],
						labels: {
							rotation: -90,
							align: 'right',
							style: {
								 font: 'normal 13px Verdana, sans-serif'
							}
						}
					},
					yAxis: {
						min: 0,
						title: {
							text: chart_y_title
						}
					},
					legend: {
						enabled: false
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								  Highcharts.numberFormat(this.y, 1);
						}
					},
				    series: [{
						name: 'Data',
						data: [],
						dataLabels: {
							enabled: true,
							rotation: -90,
							color: '#FFFFFF',
							align: 'right',
							x: -3,
							y: 10,
							formatter: function() {
								return '';
							},
							style: {
								font: 'normal 13px Verdana, sans-serif'
							}
						}
					}]
			};
			// the categories
			options.xAxis.categories = [];
			options.series[0].data = [] ;
			jQuery('tr', table).each( function(i) {
				var tr = this;
				jQuery('th, td', tr).each( function(j) {
					if(j == 0){
						options.xAxis.categories.push(this.innerHTML);
					} else { // add values
						options.series[0].data.push(parseFloat(this.innerHTML));
					}
				});
			});
			chart = new Highcharts.Chart(options);
		});
}
function updateProductForm(val)
{
	if (val == 1) {
		// shipping product
		$('.js-credit-block, .js-download-block').hide();
		$('.js-shipping-block, .js-saving-block').show();
	} else if (val == 2) {
		// downloadable product
		$('.js-shipping-block, .js-credit-block').hide();
		$('.js-download-block, .js-saving-block').show();
	} else if (val == 3) {
		// credit product
		$('.js-shipping-block, .js-saving-block, .js-download-block').hide();
		$('.js-credit-block').show();
	}
}
function ajaxCallBack(){
	$('.js-datetime,.js-date').fdatepicker();
	expandCollapseTable();
}
function expandCollapseTable(){
    if($('#js-expand-table', 'body').is('#js-expand-table')){
		$("#js-expand-table tr:not(.js-odd)").hide();
		$("#js-expand-table tr.js-even").show();
		$('#js-expand-table tr.js-odd').click(function(){
			var $this = $(this);
			if($this.hasClass('inactive-record')){
				$this.addClass('inactive-record-backup');
				$this.removeClass('inactive-record');
			} else if($this.hasClass('inactive-record-backup')){
				$this.addClass('inactive-record');
				$this.removeClass('inactive-record-backup');
			}
			display = $this.next("tr").css('display');
			if(display == 'none'){
				$this.addClass('active-row');
				$this.next("tr").show();
			} else{
				$this.removeClass('active-row');
				$this.next("tr").hide();
			}
			$this.find(".arrow").toggleClass("up");
		});
	}
}
$(document).ready(function()
						   {
							   if($("#Setting338Name").attr("checked")=="checked")
							   {
								   $("#Barcode").css("display","block");
							   }
							   else
							   {
								   	$("#Barcode").css("display","none");
							   }
							   });