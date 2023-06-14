<script type="text/javascript">
function del_q(id) {
    cnfr = confirm("Wait a min. Are you really going to delete the Product with id:" + id);
    if (cnfr) {
        document.location = "<?=BASEURL?>admin/delete-product?id="+id;
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
                            <button id="addToTable" class="btn btn-primary" type="button" onClick="document.location='<?=BASEURL?>admin/add-product';">
                                <i class="icon md-plus" aria-hidden="true"></i> Add Product
                            </button>
                        </div><!-- /margin-bottom-15 -->
                    </div><!-- /6 -->
                </div><!-- /row -->
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Photos</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Photos</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($products) > 0) {
                            foreach ($products as $q): ?>
                                <tr>
                                    <td><?=$q['product_id']?></td>
                                    <td><?=$q['title']?></td>
                                    <td><?=$q['category']?></td>
                                    <td>
                                        <?php
                                        echo $q['price'];
                                        if (strlen($q['old_price']) > 0 && $q['old_price'] > 0) {
                                            echo '<br><span style="text-decoration: line-through;">'.$q['old_price'].'</span>';
                                        }
                                        ?>        
                                    </td>
                                    <td>
                                        <?=$q['status']?>
                                        <select name="status" data-id="<?=$q['product_id']?>" class="form-control">
                                            <option value="">Change Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </td>
                                    <td><a href="<?=BASEURL?>admin/photos/product/<?=$q['product_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default" target="_blank"><i class="icon md-plus"></i></a></td>
                                    <td class="actions">
                                        <a href="<?=BASEURL?>admin/edit-product?id=<?=$q['product_id']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                        <a href="javascript:del_q('<?=$q['product_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                        <a href="<?=BASEURL?>product/<?=$q['slug']?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" target="_blank"><i class="icon md-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No Product found in the database
                                </td>
                                <td></td>
                                <td></td>
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
        $.post('<?=BASEURL."admin/change-product-status"?>', {status: $status, id: $id}, function(resp) {
            resp = JSON.parse(resp);
            alert(resp.msg);
            location.reload();
        });
    });
});
</script>