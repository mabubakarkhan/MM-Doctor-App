<script type="text/javascript">
    function del_q(id) {
        cnfr = confirm("Are you sure you want to delete this News");
        if (cnfr) {
            document.location = "<?=BASEURL?>admin/delete-blog/?id=" + id;
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
            <a class="btn btn-sm btn-success btn-round" href='<?=BASEURL."admin/add-blog"?>'>
                <i class="icon md-plus" aria-hidden="true"></i>
                <span class="hidden-xs">Add News</span>
            </a>

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
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>at</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>at</th>
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($blog) > 0) {
                            foreach ($blog as $q): ?>
                                <tr>
                                    <td><?=$q['at']?></td>
                                    <td><?=$q['title']?></td>
                                    <td><?=$q['short']?></td>
                                    <td class="actions">
                                        <a href="javascript:del_q('<?=$q['blog_id']?>')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"><i class="icon md-delete" aria-hidden="true"></i></a>
                                        <a href="<?=BASEURL.'admin/edit-blog?id='.$q['blog_id'].'/'?>" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"><i class="icon md-edit" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No News found.
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