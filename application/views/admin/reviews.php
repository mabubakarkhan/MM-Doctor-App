<script type="text/javascript">
    function del_q(id) {
        cnfr = confirm("Are you sure you want to delete this Testimonial");
        if (cnfr) {
            document.location = "<?=BASEURL?>admin/delete-review/?id=" + id;
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
                <span class="hidden-xs">Add Testimonial</span>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Message</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Message</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($data) > 0) {
                            foreach ($data as $q): ?>
                                <tr>
                                    <td><img src="<?=UPLOADS.$q['image']?>" width="100"></td>
                                    <td><?=$q['name']?></td>
                                    <td><?=$q['country']?></td>
                                    <td><?=$q['msg']?></td>
                                    <td class="actions">
                                        <a href="javascript:del_q('<?=$q['review_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                                        data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No Testimonial found in the database
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                <h4 class="modal-title">Add Testimonial</h4>
            </div><!-- /modal-header -->
            <div class="modal-body">
                

                <form action="<?=BASEURL.'admin/post-review'?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required="required">
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" required="required">
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="msg" class="form-control" rows="5" required="required"></textarea>
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <label>Image</label>
                        <div class="example">
                            <input type="file" id="input-file-now" data-plugin="dropify" required data-default-file=""/>
                            <input type="text" name="image" required value="" hidden>
                        </div><!-- /example -->
                    </div><!-- /form-group -->
                    <div class="form-group">
                        <button class="btn btn-default" id="validateButton1">Post</button>
                    </div><!-- /form-group -->
                </form>

            </div><!-- /modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div><!-- /modal-footer -->
        </div><!-- /modal-content -->
    </div><!-- /modal-dialog -->
</div><!-- #modal-add-product -->



<script>
$(function(){
    $("#input-file-now").on('change',function(){
        $("#validateButton1").text('Wait File Is Uploading...');
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
                if (resp.status == true)
                {
                    $("#validateButton1").removeAttr('disabled');
                    $("#validateButton1").text('Submit');
                    $("input[name='image']").val(resp.data);
                }
                else
                {
                    alert(resp.msg)
                    $("#validateButton1").text('Post');
                }
            }
        });
    })
})
</script>