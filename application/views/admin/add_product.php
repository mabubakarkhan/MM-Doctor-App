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
		  		if($mode != 'edit')echo BASEURL."admin/post-product";
			  	else echo BASEURL."admin/update-product";
		  		?>">
		  		<?php
				$required_string = "required";
				if(isset($mode) && $mode=="edit") {?>
					<input type="hidden" name="mode" value="edit" />
					<input type="hidden" name="aid" value="<?=$_GET['id']?>" />
					<input type="hidden" name="security" value="1ee344ecee344e778694777eb3323a" />
				<?php $required_string = '';
				}?>

	            <div class="row row-lg">

					<div class="col-lg-4 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Category</label>
							<div class=" col-lg-12 col-sm-9">
								<select name="category_id" class="form-control">
									<option value="">Select Category</option>
									<?php foreach ($cats as $key => $cat): ?>
										<option value="<?=$cat['category_id']?>" <?=($q['category_id'] == $cat['category_id']) ? 'selected="selected"' :"";?> ><?=$cat['title']?></option>
									<?php endforeach ?>
								</select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->
					
					<div class="col-lg-4 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Title
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="title" placeholder="Product Title" required="" value="<?=$q['title']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-4 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">URL Slug
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="slug" placeholder="Product URL Slug" required="" value="<?=$q['slug']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->


					<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Tag Line
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="tag_line" placeholder="Product Tag Line" value="<?=$q['tag_line']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-6 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Price</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="price" placeholder="Price" value="<?=$q['price']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-6 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Old Price</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="old_price" placeholder="Old Price" value="<?=$q['old_price']?>">
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
								<input type="file" id="input-file-now" data-plugin="dropify" required data-default-file="<?=UPLOADS.$q['image']?>"/>
								<input type="text" name="image" required value="<?=$q['image']?>" hidden>
							</div><!-- /example -->
						</div><!-- /example-wrap -->
	              	</div><!-- /12/form-horizontal -->
					
					<div class="col-lg-6 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Status
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<select name="status" class="form-control" required="required">
									<option value="">Select Status</option>
									<option value="active" <?=($q['status'] == 'active') ? 'selected="selected"' :"";?> >Active</option>
									<option value="inactive" <?=($q['status'] == 'inactive') ? 'selected="selected"' :"";?>>inactive</option>
								</select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-6 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">New Product
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<select name="new" class="form-control" required="required">
									<option value="">Select</option>
									<option value="yes" <?=($q['new'] == 'yes') ? 'selected="selected"' :"";?> >Yes</option>
									<option value="no" <?=($q['new'] == 'no') ? 'selected="selected"' :"";?>>No</option>
								</select>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-4 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Meta Title
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="meta_title" placeholder="Meta Title" required="" value="<?=$q['meta_title']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-4 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Meta Keywords
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="text" class="form-control" name="meta_key" placeholder="Meta Keywords" required="" value="<?=$q['meta_key']?>">
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

					<div class="col-lg-4 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Meta Description
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<textarea name="meta_desc" class="form-control" rows="3" required=""><?=$q['meta_desc']?></textarea>
							</div><!-- /12 -->
						</div><!-- /form-group -->
					</div><!-- /form-horizontal -->

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
	$("#input-file-now").on('change',function(){
		$("#validateButton1").text('Wait File Is Uploading');
		var data = new FormData();
    	data.append('img', $(this).prop('files')[0]);
	    $.ajax({
	        type: 'POST',
	        processData: false,
	        contentType: false,
	        data: data,
	        url: '<?=BASEURL?>admin/post-photo-ajax',
	        dataType : 'json',
	        success: function(resp){
	        	// resp = $.parseJSON(resp);
	        	console.log(resp.data);
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
})
</script>