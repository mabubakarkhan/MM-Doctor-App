
<div class="page animsition">
    <div class="page-header">
      	<h1 class="page-title">
      		<?php error_reporting(0);
			if(isset($mode) && $mode=="edit") echo "Change Password";
			else echo "Change Password";
			?>
		</h1>
      	<ol class="breadcrumb">
	        <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li>Change Password</li>
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
	        <div class="panel-body">
	          <form id="exampleFullForm" autocomplete="off" enctype="multipart/form-data" method="post" action="<?=BASEURL?>admin/change_password">
		  		<?php
				$required_string = "required";
				if(isset($mode) && $mode=="edit") {?>
					<input type="hidden" name="mode" value="edit" />
					<input type="hidden" name="aid" value="<?=$_GET['id']?>" />
					<input type="hidden" name="security" value="1ee344ecee344e778694777eb3323a" />
				<?php $required_string = '';
				}?>
	            <div class="row row-lg">
	              	<div class="col-lg-12 form-horizontal">
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Password
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="password" name="password" class="form-control" placeholder="Password" required>
							</div><!-- /12 -->
						</div><!-- /form-group -->
						<div class="form-group form-material">
							<label class="col-lg-12 col-sm-3 control-label">Validate Password
								<span class="required">*</span>
							</label>
							<div class=" col-lg-12 col-sm-9">
								<input type="password" name="re_password" class="form-control" placeholder="Password" required>
							</div><!-- /12 -->
						</div><!-- /form-group -->
	              	</div><!-- /12/form-horizontal -->
	              	<div class="form-group form-material col-lg-12 text-right padding-top-m">
	                	<button type="submit" class="btn btn-primary" id="validateButton1">Submit</button> <a class="btn btn-danger waves-effect waves-light" href="<?=BASEURL?>admin" class="cancel">Cancel</a>
	              	</div><!-- /form-group -->
	            </div><!-- /row/row-lg -->
	          </form>
	        </div><!-- /panel-body -->
      </div><!-- /panel -->
    </div>
</div><!-- /page/animsition -->
<?php $menu = 'pass'; ?>