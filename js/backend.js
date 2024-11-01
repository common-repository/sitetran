jQuery(document).ready(function() {

	// Ajax function to update sitetran_pages db table when admin clicks on Use SEO checkbox in Pages Tab (Plugin Settings)
	jQuery('.sitetran-dnt').click(function() {
		var stPageID = jQuery(this).attr('page_id');
		//console.log(postID);

		if(jQuery(this).is(":checked")) {
			var sitetranTranslate = 'Y';
		} else {
			var sitetranTranslate = 'N';
		}

		// on checkbox click hide dialog box and show loader
		jQuery(".sitetran-success-message").hide();
		jQuery(".sitetran-error-message").hide();
		jQuery(".sitetran-loader").css("display", "flex");

		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_dnt_ajax&stPageID=' + stPageID + '&sitetranTranslate=' + sitetranTranslate,
			success : function(response) {
				// on ajax response hide loader and show message
				jQuery(".sitetran-loader").hide();
				if(response.status == 'success') { // Updated page SEO
					jQuery(".sitetran-success-message-text").html(response.message);
					jQuery(".sitetran-success-message").show();
				}
				if(response.status == 'error') {
					jQuery(".sitetran-error-message-text").html(response.message);
					jQuery(".sitetran-error-message").show();
				}
			},
			error: function() {
				alert('Error code: 135. Please contact us.');
			}
		});

	});

	// Ajax function to update sitetran_pages db table when admin clicks on Translate checkbox in Pages Tab (Plugin Settings)
	jQuery('.sitetran-dns').click(function() {
		var stPageID = jQuery(this).attr('page_id');
		var stPageUrl = jQuery(this).attr('page_url');
		//console.log(postID);

		if(jQuery(this).is(":checked")) {
			var sitetranSEO = 'Y';
			// Enable Update SEO Button for page if SEO is checked
			jQuery(this).closest("tr").find(".sitetran-upseo").prop('disabled', false);
		} else {
			var sitetranSEO = 'N';
			// Disable Update SEO Button for page if SEO is unchecked
			jQuery(this).closest("tr").find(".sitetran-upseo").prop('disabled', true);
		}

		// on checkbox click hide dialog box and show loader
		jQuery(".sitetran-success-message").hide();
		jQuery(".sitetran-error-message").hide();
		jQuery(".sitetran-loader").css("display", "flex");

		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_dns_ajax&stPageID=' + stPageID + '&stPageUrl=' + stPageUrl + '&sitetranSEO=' + sitetranSEO,
			success : function(response) {
				// console.log(response);
				// on ajax response hide loader and show message
				jQuery(".sitetran-loader").hide();
				if(response.status == 'success') { // Updated page SEO
					jQuery(".sitetran-success-message-text").html(response.message);
					jQuery(".sitetran-success-message").show();
				}
				if(response.status == 'error') {
					jQuery(".sitetran-error-message-text").html(response.message);
					jQuery(".sitetran-error-message").show();
				}
			},
			error: function() {
				alert('Error code: 136. Please contact us.');
			}
		});

	});

	// on dialog box close button click hide dialog box
	jQuery(".sitetran-close-btn").click(function() {
		jQuery(this).parent().hide();
	});


	// Ajax function to update page_body in wp_sitetran_page_to_lang db table when admin clicks on Update SEO for page in Pages Tab (Plugin Settings)
	jQuery('.sitetran-upseo').click(function() {
		var stPageID = jQuery(this).attr('page_id');
		var stPageUrl = jQuery(this).attr('page_url');
		
		// on update cache button click hide dialog box and show loader
		jQuery(".sitetran-success-message").hide();
    	jQuery(".sitetran-error-message").hide();
    	jQuery(".sitetran-loader").css("display", "flex");

		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_upseo_ajax&stPageID=' + stPageID + '&stPageUrl=' + stPageUrl,
			success : function(response) {
				// on ajax response hide loader and show message
				jQuery(".sitetran-loader").hide();
				if(response.status == 'success') { // Updated page SEO
					jQuery(".sitetran-success-message-text").html(response.message);
					jQuery(".sitetran-success-message").show();
				}
				if(response.status == 'error') {
					jQuery(".sitetran-error-message-text").html(response.message);
					jQuery(".sitetran-error-message").show();
				}
			},
			error: function() {
				alert('Error code: 137. Please contact us.');
			}
		});
		return false;
	});

	// Ajax function to update all caches in wp_sitetran_page_to_lang db table when admin clicks on Update Caches button in Pages Tab at bottom right (Plugin Settings)
	jQuery('.sitetran_update_caches').click(function() {
		
		// on update caches button click hide dialog box and show loader
		jQuery(".sitetran-success-message").hide();
    	jQuery(".sitetran-error-message").hide();
    	jQuery(".sitetran-loader").css("display", "flex");
		
		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_update_caches_ajax',
			success : function(response) {
				// on ajax response hide loader and show message
				jQuery(".sitetran-loader").hide();
				if(response.status == 'success') { // Updated page SEO
					jQuery(".sitetran-success-message-text").html(response.message);
					jQuery(".sitetran-success-message").show();
				}
				if(response.status == 'error') {
					jQuery(".sitetran-error-message-text").html(response.message);
					jQuery(".sitetran-error-message").show();
				}
			},
			error: function() {
				alert('Error code: 138. Please contact us.');
			}
		});
		return false;
	});


	// Code to show edit auth key settings in plugin settings authenticate tab
	jQuery('#sitetran-edit-auth').click(function() {
		jQuery(".sitetran-edit-auth-key").hide();
		jQuery(".sitetran_auth_tab_other_settings").hide();
		jQuery(".sitetran-save-auth-key").show();
		return false;
	});

	// Code to hide edit auth key settings in plugin settings authenticate tab
	jQuery('#sitetran-edit-auth-cancel').click(function() {
		jQuery(".sitetran-save-auth-key").hide();
		jQuery(".sitetran-edit-auth-key").show();
		jQuery(".sitetran_auth_tab_other_settings").show();
		return false;
	});


	// Toggle Icon options on widget icon radio button clicks in plugin settings widget styles tab
	jQuery("#sitetran_use_icon").click(function() {
		jQuery(".sitetran_widget_icon_main").show();
	});
	jQuery("#sitetran_no_icon").click(function() {
		jQuery(".sitetran_widget_icon_main").hide();
	});


	jQuery('#sitetran_auth_form').on('submit', function() {

		var submit_button = document.getElementById('sitetran_auth_form_submit');
		submit_button.disabled = true;
		submit_button.style.cursor = 'not-allowed';
		submit_button.value = 'Please wait...';

		// on auth key form submit show the loader
		jQuery(".sitetran-success-message").hide();
		jQuery(".sitetran-error-message").hide();
		jQuery(".sitetran-loader").css("display", "flex");

		var loading_messages = [
			"Loading...", "Integrating WordPress with SiteTran...", "Loading...", 
			"Sending posts to SiteTran...", "Loading...", "Adding languages...", 
			"Loading...", "Enabling SEO translations...", "Loading..."
		];

		const cycle = document.querySelector(".sitetran-loader-message-text");
		cycle.innerHTML = "Loading...";

		var i = 0;

		function cycleText() {
			cycle.innerHTML = loading_messages[i];

			// If i is even then it shows 'Loading...' for 3 seconds else show for 6 seconds
			var msToWait = 6000;
			if ( i % 2 == 0 ) {
				msToWait = 3000;
			}

			i++;
			if ( i > loading_messages.length - 1 ) {
				cycle.innerHTML = "If you have a large site, it may take a few minutes to finish setting everything up.";
			} else {
				setTimeout(cycleText, msToWait);
			}
		}

		cycleText();
	});

	// Update google analytics settings
	jQuery("#sitetran_connect_google_analytics").click(function() {
		var sitetran_connect_google_analytics;
		if ( jQuery(this).is(":checked") ) {
			sitetran_connect_google_analytics = 'Y';
		} else {
			sitetran_connect_google_analytics = 'N';
		}

		// on checkbox click hide dialog box and show loader
		jQuery(".sitetran-success-message").hide();
		jQuery(".sitetran-error-message").hide();
		jQuery(".sitetran-loader").css("display", "flex");

		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_google_analytics_ajax&sitetran_connect_google_analytics=' + sitetran_connect_google_analytics,
			success : function(response) {
				// on ajax response hide loader and show message
				jQuery(".sitetran-loader").hide();
				if ( response.status == 'success' ) { // Updated Google Analytics Settings
					jQuery(".sitetran-success-message-text").html(response.message);
					jQuery(".sitetran-success-message").show();
				}
				if(response.status == 'error') {
					jQuery(".sitetran-error-message-text").html(response.message);
					jQuery(".sitetran-error-message").show();
				}
			},
			error: function() {
				alert('Error code: 135. Please contact us.');
			}
		});

	});

	// Update auto detect language settings
	jQuery("#sitetran_auto_detect_language").click(function() {
		var sitetran_auto_detect_language;
		if ( jQuery(this).is(":checked") ) {
			sitetran_auto_detect_language = 'Y';
		} else {
			sitetran_auto_detect_language = 'N';
		}

		// on checkbox click hide dialog box and show loader
		jQuery(".sitetran-success-message").hide();
		jQuery(".sitetran-error-message").hide();
		jQuery(".sitetran-loader").css("display", "flex");

		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_auto_detect_language_ajax&sitetran_auto_detect_language=' + sitetran_auto_detect_language,
			success : function(response) {
				// on ajax response hide loader and show message
				jQuery(".sitetran-loader").hide();
				if ( response.status == 'success' ) { // Updated Auto Detect Language Settings
					jQuery(".sitetran-success-message-text").html(response.message);
					jQuery(".sitetran-success-message").show();
				}
				if(response.status == 'error') {
					jQuery(".sitetran-error-message-text").html(response.message);
					jQuery(".sitetran-error-message").show();
				}
			},
			error: function() {
				alert('Error code: 135. Please contact us.');
			}
		});

	});

	// Initializing tippy tooltips
	tippy('[data-tippy-content]', {
		theme: 'light',
	});

	// Function to get the value of a URL parameter
    function sitetranGetURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
    }

	// Function to update status of whether initialization success message was seen by user
	function updateSiteTranInitializeMessageStatusAjax() {

		jQuery.ajax({
			url:ajaxurl,
			type:'POST',
			dataType: "json",
			data:'action=sitetran_update_intialize_message_status_ajax',
			success : function(response) {
				// We don't need to do anything here
			},
			error: function() {
				alert('Error code: 135. Please contact us.');
			}
		});
	}

	// Check if you are on a specific page and URL parameter
    if (window.location.pathname === '/wp-admin/admin.php' && sitetranGetURLParameter('page') === 'sitetran-settings' && sitetranGetURLParameter('auth') === 'success' && sitetranGetURLParameter('sitetran-updated') === 'true') {

		// Send data to SiteTran if it has not been sent yet and update WordPress database
		// This should happen only once right after authentication
		if( SITETRAN_js_variables.SITETRAN_pages_sent == 'NULL' ) {

			jQuery(".sitetran-success-message-text").html("Sending your site's data to SiteTran...");
			jQuery(".sitetran-success-message").show();

			jQuery.ajax({
				url:ajaxurl,
				type:'POST',
				dataType: "json",
				data:'action=sitetran_send_and_save_data_on_auth_ajax',
				success : function(response) {
					if ( response.status == 'success' ) {
						jQuery(".sitetran-success-message-text").html(response.message);
						jQuery(".sitetran-success-message").show();
						updateSiteTranInitializeMessageStatusAjax();
					}
				},
				error: function() {
					alert('Error code: 135. Please contact us.');
				}
			});
		
		}
    }


	// Check if you are on a specific page and URL parameter
    if (window.location.pathname === '/wp-admin/admin.php' && sitetranGetURLParameter('page') === 'sitetran-settings') {

		// If we started sending data to SiteTran but have not yet finished sending it...
		if( SITETRAN_js_variables.SITETRAN_pages_sent == 'N' ) {
			jQuery(".sitetran-success-message-text").html("Sending your site's data to SiteTran...");
			jQuery(".sitetran-success-message").show();

			var checkStatusAjaxLoop;

			// function to check status of initialization
			function checkSiteTranInitializationAjax() {
				jQuery.ajax({
					url: ajaxurl,
					type: 'GET',
					dataType: "json",
					data:'action=sitetran_pages_sent_status_message_ajax',
					success: function(response) {
						// If initialization has completed but success message has not been seen...
						if (response.sitetran_pages_sent == 'Y' && response.sitetran_intialize_success_message_seen == 'N') {
							clearInterval(checkStatusAjaxLoop); // Stop the loop
							jQuery(".sitetran-success-message-text").html("Successfully sent your site's data to SiteTran");
							updateSiteTranInitializeMessageStatusAjax();
						}
					},
					error: function(xhr, status, error) {
						console.error('AJAX Error:', error);
					}
				});
			}

			// Check status of initialization every two seconds until initialization has completed
			checkStatusAjaxLoop = setInterval(checkSiteTranInitializationAjax, 2000); // 2000 milliseconds = 2 seconds
		
		}
		// If data was sent to SiteTran, but success message was not yet seen...
		else if (SITETRAN_js_variables.SITETRAN_pages_sent == 'Y' && SITETRAN_js_variables.SITETRAN_intialize_success_message_seen == 'N') {

			jQuery(".sitetran-success-message-text").html("Successfully sent your site's data to SiteTran");
			jQuery(".sitetran-success-message").show();

			updateSiteTranInitializeMessageStatusAjax();
		}

    }


});