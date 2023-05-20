<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title"><?=$page_title?></h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?=$page_title?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container-fluid">
        <div class="row">

            <?php require_once('menu.php'); ?>

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (isset($medical_records_msg_status) && $medical_records_msg_status = true): ?>
                            <?php if ($medical_records_msg_type == true): ?>
                                <p class="alert alert-success"><?=$medical_records_msg?></p>
                            <?php elseif ($medical_records_msg_type == false): ?>
                                <p class="alert alert-danger"><?=$medical_records_msg?></p>
                            <?php endif ?>
                        <?php endif ?>
                        <form action="get-medical-records" method="post" class="medical-records-form">
                            <div class="row form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Appointment <span class="text-danger">*</span></label>
                                        <select name="appointment_id" class="form-control select2" required>
                                            <option value="">Select Appointment</option>
                                            <?php foreach ($appointments as $key => $appointmentQ): ?>
                                                <option value="<?=$appointmentQ['appointment_id']?>" <?=($appointment['appointment_id'] == $appointmentQ['appointment_id']) ? 'selected' : ''?> ><?=$appointmentQ['appointment_id']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-primary doctor-submit-btn" type="submit" style="margin-top: 27px;">Save</button>
                                    </div>
                                </div><!-- /6 -->
                            </div><!-- /row -->
                        </form>
                        <div class="medical-records-wrap">
                            <?=$medical_records?>
                        </div><!-- /medical-records-wrap -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






