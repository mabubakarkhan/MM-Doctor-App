<script type="text/javascript">
    function del_q(id) {
        cnfr = confirm("Are you sure you want to delete this Hospital");
        if (cnfr) {
            document.location = "<?=BASEURL?>admin/delete-hospital/?id=" + id;
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
    <div class="page-content">
        <div class="panel">
            <header class="panel-heading">
                <div class="panel-actions"></div>
                <h3 class="panel-title">Data</h3>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="margin-bottom-15">
                            <button id="addToTable" class="btn btn-primary" type="button" onClick="document.location='<?=BASEURL?>admin/add-hospital';">
                                <i class="icon md-plus" aria-hidden="true"></i> Add Hospital
                            </button>
                        </div><!-- /margin-bottom-15 -->
                    </div><!-- /6 -->
                </div><!-- /row -->
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($hospitals) > 0) {
                            foreach ($hospitals as $q): ?>
                                <tr>
                                    <td><?=$q['hospital_id']?></td>
                                    <td><?=$q['name']?></td>
                                    <td>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>State</td>
                                                <td><?=$q['stateName']?></td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td><?=$q['cityName']?></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td><?=$q['address']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <?php if ($q['doctor_id'] > 0): ?>
                                            <a href="javascript://" data-id="<?=$q['doctor_id']?>" class="get-doctor"><?=$q['doctorFname'].' '.$q['doctorLname']?></a>
                                        <?php else: ?>
                                            Admin
                                        <?php endif ?>
                                    </td>
                                    <td class="actions">
                                        <a href="<?=BASEURL?>admin/edit-hospital?id=<?=$q['hospital_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                                        <a href="<?=BASEURL.'hospital/'.str_replace(' ', '-', $q['name']).'/'.$q['hospital_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" target="_blank"><i class="icon md-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No Hospital found in the database
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



<script>
$(function(){
    $(document).on('change', 'select[name="status"]', function(event) {
        event.preventDefault();
        $this = $(this);
        $id = $this.attr('data-id');
        $status = $this.val();
        $.post('<?=BASEURL."admin/change-cat-status"?>', {status: $status, id: $id}, function(resp) {
            resp = JSON.parse(resp);
            alert(resp.msg);
            location.reload();
        });
    });
});
</script>