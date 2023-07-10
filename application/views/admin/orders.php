<script type="text/javascript">
function del_q(id) {
    cnfr = confirm("Wait a min. Are you really going to delete the Order with id:" + id);
    if (cnfr) {
        document.location = "<?=BASEURL?>admin/delete-order?id="+id;
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
                <table class="table table-bordered table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Delivery Detail</th>
                            <th>Amount</th>
                            <th>Items</th>
                            <th>Method</th>
                            <th>AT</th>
                            <th>Status</th>
                            <th>View Items</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Delivery Detail</th>
                            <th>Amount</th>
                            <th>Items</th>
                            <th>Method</th>
                            <th>AT</th>
                            <th>Status</th>
                            <th>View Items</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (count($orders) > 0) {
                            foreach ($orders as $q): ?>
                                <tr id="order-row-<?=$q['order_id']?>">
                                    <td><?=$q['order_id']?></td>
                                    <td><a href="javascript://" class="get-patient" data-id="<?=$q['patient_id']?>"><?=$q['fname'].' '.$q['lname']?></a></td>
                                    <td>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Address Line 1</td>
                                                <td><?=$q['address_line_1']?></td>
                                            </tr>
                                            <tr>
                                                <td>Address Line 2</td>
                                                <td><?=$q['address_line_2']?></td>
                                            </tr>
                                            <tr>
                                                <td>City</td>
                                                <td><?=$q['cityName']?></td>
                                            </tr>
                                            <tr>
                                                <td>State</td>
                                                <td><?=$q['stateName']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td><?=$q['sub_total']?></td>
                                            </tr>
                                            <tr>
                                                <td>Tax</td>
                                                <td><?=$q['tax']?></td>
                                            </tr>
                                            <tr>
                                                <td>Deliver Charges</td>
                                                <td><?=$q['deliver_charges']?></td>
                                            </tr>
                                            <tr>
                                                <td>Discount</td>
                                                <td><?=$q['discount']?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><?=$q['total']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?=$q['items']?></td>
                                    <td><?=$q['payment_method']?></td>
                                    <td><?=date('d-m-Y H:i',strtotime($q['at']))?></td>
                                    <td>
                                        <?php if ($q['status'] == 'pending'): ?>
                                            <span class="badge badge-info">Pending</span>
                                        <?php elseif ($q['status'] == 'in process'): ?>
                                            <span class="badge badge-info">IN Process</span>
                                        <?php elseif ($q['status'] == 'on way'): ?>
                                            <span class="badge badge-warning">ON Way</span>
                                        <?php elseif ($q['status'] == 'delivered'): ?>
                                            <span class="badge badge-success">Delivered</span>
                                        <?php elseif ($q['status'] == 'returned'): ?>
                                            <span class="badge badge-danger">Returned</span>
                                        <?php elseif ($q['status'] == 'cancelled'): ?>
                                            <span class="badge badge-danger">Cancelled</span>
                                        <?php endif ?>
                                        <hr>
                                        <select name="status" data-id="<?=$q['order_id']?>" class="form-control">
                                            <option value="">Change Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="in process">In Process</option>
                                            <option value="on way">On Way</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="returned">Returned</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-action">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row get-order-info" data-id="<?=$q['order_id']?>">
                                                <i class="icon md-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;
                        } //end if
                        else {
                            ?>
                            <tr>
                                <td>
                                    No Order found in the database
                                </td>
                                <td></td>
                                <td></td>
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
        $.post('<?=BASEURL."admin/change-order-status"?>', {status: $status, id: $id}, function(resp) {
            resp = JSON.parse(resp);
            alert(resp.msg);
            location.reload();
        });
    });
    $(document).on('click', '.get-order-info', function(event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        $("#modal-order-detail table tbody").html('<tr><td colspan="5">loading...</td></tr>');
        $("#modal-order-detail").modal('show');
        $.post('<?=BASEURL."admin/get-order-detail"?>', {order: $id}, function(resp) {
            resp = $.parseJSON(resp);
            console.log(resp.html);
            $("#modal-order-detail table tbody").html(resp.html);
        });
    });
});
</script>

<div class="modal fade custom-modal" id="modal-order-detail">
    <div class="modal-dialog modal-dialog-centered modal-dialog-wide">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-transform: capitalize;">Order Detail</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Title</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div><!-- /modal-body -->
        </div>
    </div>
</div><!-- #modal-order-detail -->