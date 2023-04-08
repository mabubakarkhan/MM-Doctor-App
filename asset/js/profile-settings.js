/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.0
*/

(function($) {
    "use strict";
	
	// Pricing Options Show
	
	$('#pricing_select input[name="fee_type"]').on('click', function() {
		if ($(this).val() == 'free') {
			$('#custom_price_cont').hide();
		}
		if ($(this).val() == 'custom') {
			$('#custom_price_cont').show();
		}
		else {
		}
	});
	
	// Education Add More
	
    $(".education-info").on('click','.trash', function () {
		let chkDelete = $(this).closest('.education-cont').find('input[name="id[]"]').val();
		if (chkDelete == '0') {
			$(this).closest('.education-cont').remove();
		}
		else{
			$(this).closest('.education-cont').find('input[name="delete[]"]').val('yes');
			$(this).closest('.education-cont').removeClass('cont-wrap');
			$(this).closest('.education-cont').hide();
		}
		return false;
    });

    $(".add-education").on('click', function () {
		
		var educationcontent ='<div class="row form-row education-cont cont-wrap">' +
			'<input type="hidden" name="id[]" value="0" required>'+
			'<input type="hidden" name="delete[]" value="no" required>'+
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Degree</label>' +
							'<input type="text" name="degree[]"  class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>College/Institute</label>' +
							'<input type="text" name="institute[]" class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Year of Completion</label>' +
							'<input type="text" name="year[]" class="form-control" required>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>' +
		'</div>';
		
        $(".education-info").append(educationcontent);
        return false;
    });
	
	// Experience Add More
	
    $(".experience-info").on('click','.trash', function () {
		let chkDelete = $(this).closest('.experience-cont').find('input[name="id[]"]').val();
		if (chkDelete == '0') {
			$(this).closest('.experience-cont').remove();
		}
		else{
			$(this).closest('.experience-cont').find('input[name="delete[]"]').val('yes');
			$(this).closest('.experience-cont').removeClass('cont-wrap');
			$(this).closest('.experience-cont').hide();
		}
		return false;
    });

    $(".add-experience").on('click', function () {
		
		var experiencecontent = '<div class="row form-row experience-cont cont-wrap">' +
			'<input type="hidden" name="id[]" value="0" required>'+
			'<input type="hidden" name="delete[]" value="no" required>'+
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Hospital Name</label>' +
							'<input type="text" name="hospital[]"  class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Designation</label>' +
							'<input type="text" name="designation[]" class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-2">' +
						'<div class="form-group">' +
							'<label>From</label>' +
							'<input type="text" name="from[]" class="form-control" required>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-2">' +
						'<div class="form-group">' +
							'<label>To</label>' +
							'<input type="text" name="to[]" class="form-control" required>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a></div>' +
		'</div>';
		
        $(".experience-info").append(experiencecontent);
        return false;
    });
	
	// Awards Add More
	
    $(".awards-info").on('click','.trash', function () {
		let chkDelete = $(this).closest('.award-cont').find('input[name="id[]"]').val();
		if (chkDelete == '0') {
			$(this).closest('.award-cont').remove();
		}
		else{
			$(this).closest('.award-cont').find('input[name="delete[]"]').val('yes');
			$(this).closest('.award-cont').removeClass('cont-wrap');
			$(this).closest('.award-cont').hide();
		}
		return false;
    });

    $(".add-award").on('click', function () {

        var regcontent = '<div class="row form-row awards-cont cont-wrap">' +
        	'<input type="hidden" name="id[]" value="0" required>'+
			'<input type="hidden" name="delete[]" value="no" required>'+
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Awards</label>' +
					'<input type="text" name="title[]" class="form-control" required>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" name="year[]" class="form-control" required>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a>' +
			'</div>' +
		'</div>';
		
        $(".awards-info").append(regcontent);
        return false;
    });
	
	// Membership Add More
	
    $(".memberships-info").on('click','.trash', function () {
    	let chkDelete = $(this).closest('.membership-cont').find('input[name="id[]"]').val();
		if (chkDelete == '0') {
			$(this).closest('.membership-cont').remove();
		}
		else{
			$(this).closest('.membership-cont').find('input[name="delete[]"]').val('yes');
			$(this).closest('.membership-cont').removeClass('cont-wrap');
			$(this).closest('.membership-cont').hide();
		}
		return false;
    });

    $(".add-membership").on('click', function () {

        var membershipcontent = '<div class="row form-row membership-cont cont-wrap">' +
        	'<input type="hidden" name="id[]" value="0" required>'+
			'<input type="hidden" name="delete[]" value="no" required>'+
			'<div class="col-12 col-md-10 col-lg-5">' +
				'<div class="form-group">' +
					'<label>Memberships</label>' +
					'<input type="text" name="title[]" class="form-control" required>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a>' +
			'</div>' +
		'</div>';
		
        $(".memberships-info").append(membershipcontent);
        return false;
    });
	
	// Registration Add More
	
    $(".registrations-info").on('click','.trash', function () {
		let chkDelete = $(this).closest('.registration-cont').find('input[name="id[]"]').val();
		if (chkDelete == '0') {
			$(this).closest('.registration-cont').remove();
		}
		else{
			$(this).closest('.registration-cont').find('input[name="delete[]"]').val('yes');
			$(this).closest('.registration-cont').removeClass('cont-wrap');
			$(this).closest('.registration-cont').hide();
		}
		return false;
    });

    $(".add-reg").on('click', function () {

        var regcontent = '<div class="row form-row registrations-cont cont-wrap">' +
        	'<input type="hidden" name="id[]" value="0" required>'+
			'<input type="hidden" name="delete[]" value="no" required>'+
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>registrations</label>' +
					'<input type="text" name="title[]" class="form-control" required>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" name="year[]" class="form-control" required>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="javascript://" class="btn btn-danger trash"><i class="far fa-times-circle"></i></a>' +
			'</div>' +
		'</div>';
		
        $(".registrations-info").append(regcontent);
        return false;
    });


    $(".registrations-info").on('click','.trash', function () {
		$(this).closest('.reg-cont').remove();
		return false;
    });
	
})(jQuery);