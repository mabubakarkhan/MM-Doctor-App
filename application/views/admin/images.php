<script type="text/javascript">
    function del_q(image_id) {
        cnfr = confirm("Are you sure you want to delete this Image");
        if (cnfr) {
            document.location = "<?=BASEURL?>admin/delete-image/?id=" + image_id;
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
        </div><!-- /page-header-actions -->
    </div><!-- /page-header -->
    <?php if ($msg_code): ?>
    <div class="bg-success well">
        <p><?=$msg_code?></p>
    </div>
    <?php endif;?>
    
    <div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><?=$page_title?></h3>
            </div><!-- /panel-heading -->
            <div class="panel-body">
                <form id="exampleFullForm" autocomplete="off" enctype="multipart/form-data" method="post" action="<?=BASEURL."admin/post-image"?>">
                    <div class="row row-lg">
                        <div class="col-lg-12 form-horizontal">
                            <div class="form-group form-material">
                                <label class="col-lg-12 col-sm-3 control-label">Title
                                    <span class="required">*</span>
                                </label>
                                <div class=" col-lg-12 col-sm-9">
                                    <input type="text" class="form-control" name="title" placeholder="Property Title" required="" value="<?=$q['title']?>">
                                </div><!-- /12 -->
                            </div><!-- /form-group -->
                        </div><!-- /form-horizontal -->
                        <div class="col-lg-12 form-horizontal">
                            <div class="example-wrap">
                                <h4 class="example-title">Photo</h4>
                                <div class="example">
                                    <input type="file" id="input-file-now" data-plugin="dropify" required data-default-file="<?=UPLOADS.$q['img']?>"/>
                                    <input type="text" name="img" required value="<?=$q['img']?>" hidden>
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
    </div><!-- /page-content -->



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
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($images) > 0) {
                            foreach ($images as $q): ?>
                                <tr>
                                    <td><?=$q['image_id']?></td>
                                    <td><?=$q['title']?></td>
                                    <td><img src="<?=UPLOADS.$q['img']?>" width="100"></td>
                                    <td class="actions">
                                        <a href="javascript:del_q('<?=$q['image_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No Image found in the database
                                </td>
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





<script>
$(function(){
    var img = $("input[name='img']").val();
    if (img.length > 3)
    {
        $("#validateButton1").removeAttr('disabled');
    }
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
                    $("input[name='img']").val(resp.data);
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