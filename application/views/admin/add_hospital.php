<div class="page animsition">
    <div class="page-header">
      	<h1 class="page-title">
      		<?=$page_title?>
		</h1>
      	<ol class="breadcrumb">
	        <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li><?=$page_title?></li>
      	</ol>
      	<div class="page-header-actions">
	        <a class="btn btn-sm btn-primary btn-round" href="<?=BASEURL?>" target="_blank">
          		<i class="icon md-link" aria-hidden="true"></i>
	          	<span class="hidden-xs">Website</span>
	        </a>
      	</div><!-- /page-header-actions -->
    </div><!-- /page-header -->
    <?php if (isset($_GET['msg'])):?>
		<div class="bg-success well">
			<p><?=$_GET['msg']?></p>
		</div>
	<?php endif;?>
    <div class="page-content container-fluid">
      	<div class="panel">
	        <div class="panel-heading">
	          	<h3 class="panel-title"><?=$page_title?></h3>
	        </div><!-- /panel-heading -->
	        <div class="panel-body">
	          <form id="exampleFullForm" autocomplete="off" enctype="multipart/form-data" method="post" action="
	          	<?php
		  		if($mode != edit)echo BASEURL."admin/post-hospital";
			  	else echo BASEURL."admin/update-hospital";
		  		?>">
		  		<?php
				$required_string = "required";
				if(isset($mode) && $mode=="edit") {?>
					<input type="hidden" name="aid" value="<?=$_GET['id']?>" />
				<?php $required_string = '';
				}?>

	            <div class="row row-lg">
					
					<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Name
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="name" placeholder="Name" required="" value="<?=$q['name']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-6 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">State
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<select name="state_id" class="form-control" required>
									<option value="">Select State</option>
									<?php foreach ($states as $key => $state): ?>
										<?php if ($state['state_id'] == $q['state_id']): ?>
											<option value="<?=$state['state_id']?>" selected><?=$state['name']?></option>
										<?php else: ?>
											<option value="<?=$state['state_id']?>"><?=$state['name']?></option>
										<?php endif ?>
									<?php endforeach ?>
								</select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-6 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">City
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<select name="city_id" class="form-control" required>
									<option value="">Select City</option>
									<?php foreach ($cities as $key => $city): ?>
										<?php if ($city['city_id'] == $q['city_id']): ?>
											<option value="<?=$city['city_id']?>" selected><?=$city['name']?></option>
										<?php else: ?>
											<option value="<?=$city['city_id']?>"><?=$city['name']?></option>
										<?php endif ?>
									<?php endforeach ?>
								</select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Address
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="address" placeholder="Address" required="" value="<?=$q['address']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-12 form-horizontal">
		            	<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Detail</label>
							<div class=" col-lg-12 col-sm-9">
								<textarea class="form-control" placeholder="Detail" name="detail" data-plugin="summernote"><?=$q['detail']?></textarea>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /12/form-horizontal -->

					<div class="col-lg-12 form-horizontal">
		                <div class="example-wrap">
							<h4 class="example-title">Image</h4>
							<div class="example">
								<input type="file" id="input-file" data-plugin="dropify" required data-default-file="<?=UPLOADS.$q['image']?>"/>
								<input type="text" name="image" required value="<?=$q['image']?>" hidden>
							</div><!-- /example -->
						</div><!-- /example-wrap -->
	              	</div><!-- /12/form-horizontal -->

	              	<div class="form-group form-material col-lg-12 text-right padding-top-m">
	                	<button type="submit" class="btn btn-primary" id="validateButton1">Submit</button>
	              	</div><!-- /form-group -->
	            </div><!-- /row/row-lg -->
	          </form>
	        </div><!-- /panel-body -->
      </div><!-- /panel -->
    </div>
</div><!-- /page/animsition -->


<script>
$(function(){
	$("#input-file").on('change',function(){
		$("#validateButton1").text('Wait File Is Uploading');
		var data = new FormData();
    	data.append('img', $(this).prop('files')[0]);
    	$(".theatre-cover").fadeIn(300);
	    $.ajax({
	        type: 'POST',
	        processData: false,
	        contentType: false,
	        data: data,
	        url: '<?=BASEURL?>admin/post-photo-ajax',
	        dataType : 'json',
	        success: function(resp){
	        	$(".theatre-cover").fadeOut(300);
	       		if (resp.status == true)
	       		{
	       			$("#validateButton1").removeAttr('disabled');
	       			$("#validateButton1").text('Submit');
	       			$("input[name='image']").val(resp.data);
	       		}
	       		else
	       		{
	       			alert(resp.msg)
	       			$("#validateButton1").text('Upload An Image First');
	       		}
	        }
	    });
	})

 	$(document).on('change', 'select[name="state_id"]', function(event) {
	  	event.preventDefault();
	  	$this = $(this);
	  	$('select[name="city_id"]').html("<option value=''>Select City</option>");
	  	if ($this.val().length > 0) {
	  		$(".theatre-cover").fadeIn(100);
	  		$.post('<?=BASEURL?>admin/get-city-by-state-ajax', {id: $this.val()}, function(resp) {
	  			resp = $.parseJSON(resp);
  				$(".theatre-cover").fadeOut(100);
	  			if (resp.status == true) {
	  				$('select[name="city_id"]').html(resp.html);
	  			}
	  		});
	  	}
	  });


})
</script>