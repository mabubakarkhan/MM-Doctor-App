<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title" style="text-transform: uppercase;"><?=$page_title?></h1>
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
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-hover dataTable table-striped width-full" id="appointments-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Actions</th>
                            <th>Status</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Appointment Date</th>
                            <th>Hospital</th>
                            <th>Amount</th>
                            <th>Prescription</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Actions</th>
                            <th>Status</th>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Appointment Date</th>
                            <th>Hospital</th>
                            <th>Amount</th>
                            <th>Prescription</th>
                        </tr>
                    </tfoot>
                    <tbody>
                       
                    </tbody>
                </table>
            </div><!-- /panel-body -->
        </div><!-- /panel -->
      <!-- End Panel Basic -->
    </div><!-- /page-content -->
</div><!-- /page/animsition -->



<form id="appointment-form"  style="display: none;">
<?php if (isset($get['patient_id'])): ?>
    <input type="text" name="patient_id" value="<?=$get['patient_id']?>">
<?php endif ?>

<?php if (isset($get['doctor_id'])): ?>
    <input type="text" name="doctor_id" value="<?=$get['doctor_id']?>">
<?php endif ?>

<?php if (isset($get['status'])): ?>
    <input type="text" name="status" value="<?=$get['status']?>">
<?php endif ?>

<?php if (isset($get['cancel_by'])): ?>
    <input type="text" name="cancel_by" value="<?=$get['cancel_by']?>">
<?php endif ?>
</form>

<script>
$(document).ready(function() {
    $.post('<?=BASEURL."admin/get-appointments-ajax"?>', {data: $('#appointment-form').serialize()}, function(resp) {
        resp = $.parseJSON(resp);
        $("#appointments-table tbody").html(resp.html);
        $('#appointments-table').DataTable().destroy();
        $('#appointments-table').DataTable();
    });
});
</script>