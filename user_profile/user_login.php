<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<h5 class="AJDWP_header mt-4 m-2 fw-bold"><?php _e('Access Your Account'); ?></h5>
<fieldset>
	<div class="page_form-popup page_AJDWP_form" id="page_myForm">
		<div class="page_form-container" id="page_form-container">
			<div class="" id="page_ql_err_msg"></div>
			<?php 
				wp_nonce_field('pl2_custom_user_login_nonce', 'pl2_user_quick_login_field');
				// Display the login form
				echo wp_login_form(array(
							'id_username' => 'page_ql_username',
							'id_password' => 'page_ql_password',
							'label_log_in' => 'SIGN IN',
							'id_submit' => 'page_ql_form_submit',
							'remember' => false,
							'form_id' => 'page-loginform'
						));
			?>

		</div>
	</div>
</fieldset>
<script>

	jQuery(document).ready(function($) {
		// Attach a click event to your login button
		$('#page_ql_form_submit').on('click', function() {
			// Get the values from the login form
			var username = $('#page_ql_username').val();
			var password = $('#page_ql_password').val();
			var nonce = $('#pl2_user_quick_login_field').val();
			event.preventDefault();
			// console.log('11111'+username+' // '+password);
			// Make an Ajax request to the server
			$.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					action: 'pl2_custom_user_login', // The action to be performed on the server
					username: username,
					password: password,
					pl2_user_quick_login_field: nonce, // Pass the nonce value
				},
				success: function(response) {
					// Handle the response from the server
					// alert(response);
					var jsonResponse = JSON.parse(response);

					if (jsonResponse.status == 'error') {
						$('#ql_err_msg').html(jsonResponse.message).addClass('alert alert-danger');   
					} else {
						$('#ql_err_msg').html(jsonResponse.message).addClass('alert alert-success');

						// Check if the user ID is available in the response
						var redirect_url = jsonResponse.redirect_url;
						console.log(redirect_url);
						// Redirect to the author page if the user ID is available
						if (redirect_url) {
							setTimeout(function() {
								window.location.href = redirect_url;
							}, 1000); // 1000 milliseconds (1 second) for demonstration purposes
						}
					}
				}

			});
		});
	});

</script>
