<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
	$(document).on('change', 'input[name="payment_method"]', function(event) {
		event.preventDefault();
		if ($(this).val() == 'online') {
			$('.card-input').attr('required',true);
		}
		else{
			$('.card-input').removeAttr('required');
		}
	});
	$(document).on('submit', '#payment-form', function(event) {
		event.preventDefault();
		ajaxBtnLoader($(".checkout-form-btn"));
		if ($('input[name="payment_method"]:checked').val() == 'online') {
			$("#loading").fadeIn(400);

			var $form         = $("#payment-form");

			var $form         = $("#payment-form"),
			inputSelector = ['input[type=text]'].join(', '),
			$inputs       = $form.find('.required').find(inputSelector),
			$errorMessage = $form.find('div.show-check-out-error'),
			valid         = true;

			$inputs.each(function(i, el) {
				var $input = $(el);
				if ($input.val() === '') {
					// $errorMessage.show();
				        // e.preventDefault();
				}
			});

			if (!$form.data('cc-on-file')) {
			    	// e.preventDefault();
				Stripe.setPublishableKey($form.data('stripe-publishable-key'));
				Stripe.createToken({
					number: $('#card-number').val(),
					cvc: $('#card-cvc').val(),
					exp_month: $('#card-expiry-month').val(),
					exp_year: $('#card-expiry-year').val()
				}, stripeResponseHandler);
			}

			function stripeResponseHandler(status, response) {
				if (response.error) {
					msgE(response.error.message);
					$(".checkout-form-btn").html('Confirm and Pay');
				} else {
					var token = response['id'];
					$form.find('input[type=text]').empty();
					$('#stripe_token').val(token);
					msgS('Payment in process... please wait.');
					$.post("<?=BASEURL.'submit-checkout'?>", {data: $("#payment-form").serialize()}, function(resp) {
						resp = $.parseJSON(resp);
						if (resp.status = true) {
							msgS(resp.msg);
							$(".checkout-form-btn").html('redirecting...');
							window.location.replace("<?=BASEURL?>patient/dashboard");
						}
						else{
							msgE(resp.msg);
							$(".checkout-form-btn").html('Confirm and Pay');
						}
					});//post
				}
			}
		}
		else{
			$.post("<?=BASEURL.'submit-checkout'?>", {data: $("#payment-form").serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				if (resp.status = true) {
					msgS(resp.msg);
					$(".checkout-form-btn").html('redirecting...');
					window.location.replace("<?=BASEURL?>patient/dashboard");
				}
				else{
					msgE(resp.msg);
					$(".checkout-form-btn").html('Confirm and Pay');
				}
			});//post
		}
	});
</script>

<!-- 5555555555554444 -->