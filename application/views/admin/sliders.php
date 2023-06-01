<script type="text/javascript">
    function del_q(photo_id) {
        cnfr = confirm("Are you sure you want to delete this Slide");
        if (cnfr) {
            document.location = "<?=BASEURL?>admin/delete-slider/?id=" + photo_id;
        }
    }
</script>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title"><?=$page_title?></h1>
        <ol class="breadcrumb">
            <li><a href="<?=BASEURL?>admin">Admin</a></li>
            <li><?=$page_title?></li>
        </ol>
        <div class="page-header-actions">
            <a class="btn btn-sm btn-primary btn-round" href="<?=BASEURL?>" target="_blank">
                <i class="icon md-link" aria-hidden="true"></i>
                <span class="hidden-xs">Website</span>
            </a>

            <a class="btn btn-sm btn-success btn-round" data-toggle="modal" href='#modal-add-product'>
                <i class="icon md-plus" aria-hidden="true"></i>
                <span class="hidden-xs">Add Multiple Slides</span>
            </a>

        </div><!-- /page-header-actions -->
    </div><!-- /page-header -->
    <?php if ($msg_code): ?>
    <div class="bg-success well">
        <p><?=$msg_code?></p>
    </div>
    <?php endif;?>
    
    <div class="page-content">
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Data</h3>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Photo</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($photos) > 0) {
                            foreach ($photos as $q): ?>
                                <tr>
                                    <td><img src="<?=UPLOADS.$q['image']?>" width="100"></td>
                                    <td class="actions">
                                        <a href="javascript:del_q('<?=$q['slider_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No Slide found in the database
                                </td>
                                <td></td>
                            </tr>
                            <?php
                        }?>
                    </tbody>
                </table>
            </div><!-- /panel-body -->
        </div><!-- /panel -->
      <!-- End Panel Basic -->
    </div><!-- /page-content -->
</div><!-- /page/animsition -->


<div class="modal fade" id="modal-add-product">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Photos</h4>
            </div><!-- /modal-header -->
            <div class="modal-body">
                

                <form action="<?=BASEURL.'admin/post-sliders'?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Photos</label>
                        <input type="file" multiple name="image[]" required="required">
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <button class="btn btn-default">Post</button>
                    </div><!-- /form-group -->
                </form>

            </div><!-- /modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div><!-- /modal-footer -->
        </div><!-- /modal-content -->
    </div><!-- /modal-dialog -->
</div><!-- #modal-add-product -->