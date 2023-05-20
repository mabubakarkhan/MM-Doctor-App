        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Invoices</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Invoices</li>
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
                                <div class="card">
                                    <div class="card-header">

                                        <nav class="user-tabs">
                                            <ul class="nav nav-tabs nav-tabs-bottom">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#pat_accounts"
                                                        data-bs-toggle="tab">Cash</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#pat_refundrequest"
                                                        data-bs-toggle="tab">Online</a>
                                                </li>
                                            </ul>
                                        </nav>

                                    </div>
                                    <div class="">

                                        <div class="tab-content pt-0">

                                            <div id="pat_accounts" class="tab-pane fade show active">
                                                <div class="card-table mb-0">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Patient</th>
                                                                        <th>Appt Date</th>
                                                                        <th>Hospital</th>
                                                                        <th>Payment</th>
                                                                        <th>Paid Amount</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($appointments as $key => $q): ?>
                                                                        <?php if ($q['payment_method'] == 'cash'): ?>
                                                                            <tr class="tr-appointment-<?=$q['appointment_id']?>">
                                                                                <td><?=$q['appointment_id']?></td>
                                                                                <td>
                                                                                    <h2 class="table-avatar">
                                                                                        <a href="javascript://"
                                                                                            class="avatar avatar-sm me-2">
                                                                                            <img class="avatar-img rounded-circle"
                                                                                                src="<?=UPLOADS.$q['patientImg']?>"
                                                                                                alt="User Image">
                                                                                        </a>
                                                                                        <a href="javascript://"><?=$q['patientFname'].' '.$q['patientLname']?></a>
                                                                                    </h2>
                                                                                </td>
                                                                                <td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
                                                                                <td><?=$q['hospitalName']?></td>
                                                                                <td><?=$q['payment_method']?></td>
                                                                                <td><?=CURRENCY.number_format($q['total'])?></td>
                                                                                <td class="status">
                                                                                    <?php if ($q['status'] == 'confirm'): ?>
                                                                                        <span class="badge rounded-pill success-status">Confirm</span>
                                                                                    <?php elseif ($q['status'] == 'done'): ?>
                                                                                        <span class="badge rounded-pill success-status">Done</span>
                                                                                    <?php elseif ($q['status'] == 'pending'): ?>
                                                                                        <span class="badge rounded-pill warning-status">Pending</span>
                                                                                    <?php elseif ($q['status'] == 'cancel'): ?>
                                                                                        <span class="badge rounded-pill danger-status">Cancel</span>
                                                                                    <?php endif ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="table-action">
                                                                                        <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                                                            <i class="feather-printer"></i>
                                                                                        </a>
                                                                                        <a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View">
                                                                                            <i class="feather-eye"></i>
                                                                                        </a>
                                                                                        <?php if ($q['status'] == 'pending'): ?>
                                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-success-light make-appointment-confirm" data-id="<?=$q['appointment_id']?>" title="Confirm This Appointment ?">
                                                                                                <i class="feather-check-circle"></i>
                                                                                            </a>
                                                                                        <?php elseif ($q['status'] == 'confirm'): ?>
                                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-success-light done-appointment" data-id="<?=$q['appointment_id']?>" title="Complete This Appointment ?">
                                                                                                <i class="feather-check-circle"></i>
                                                                                            </a>
                                                                                        <?php endif ?>
                                                                                        <?php if ($q['status'] == 'pending'): ?>
                                                                                            <a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
                                                                                                <i class="feather-x-circle"></i>
                                                                                            </a>
                                                                                        <?php endif ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="pat_refundrequest">
                                                <div class="card-table mb-0">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Patient</th>
                                                                        <th>Appt Date</th>
                                                                        <th>Hospital</th>
                                                                        <th>Payment</th>
                                                                        <th>Paid Amount</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($appointments as $key => $q): ?>
                                                                        <?php if ($q['payment_method'] == 'online'): ?>
                                                                            <tr class="tr-appointment-<?=$q['appointment_id']?>">
                                                                                <td><?=$q['appointment_id']?></td>
                                                                                <td>
                                                                                    <h2 class="table-avatar">
                                                                                        <a href="javascript://"
                                                                                            class="avatar avatar-sm me-2">
                                                                                            <img class="avatar-img rounded-circle"
                                                                                                src="<?=UPLOADS.$q['patientImg']?>"
                                                                                                alt="User Image">
                                                                                        </a>
                                                                                        <a href="javascript://"><?=$q['patientFname'].' '.$q['patientLname']?></a>
                                                                                    </h2>
                                                                                </td>
                                                                                <td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
                                                                                <td><?=$q['hospitalName']?></td>
                                                                                <td><?=$q['payment_method']?></td>
                                                                                <td><?=CURRENCY.number_format($q['total'])?></td>
                                                                                <td class="status">
                                                                                    <?php if ($q['status'] == 'confirm'): ?>
                                                                                        <span class="badge rounded-pill success-status">Confirm</span>
                                                                                    <?php elseif ($q['status'] == 'done'): ?>
                                                                                        <span class="badge rounded-pill success-status">Done</span>
                                                                                    <?php elseif ($q['status'] == 'pending'): ?>
                                                                                        <span class="badge rounded-pill warning-status">Pending</span>
                                                                                    <?php elseif ($q['status'] == 'cancel'): ?>
                                                                                        <span class="badge rounded-pill danger-status">Cancel</span>
                                                                                    <?php endif ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="table-action">
                                                                                        <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                                                            <i class="feather-printer"></i>
                                                                                        </a>
                                                                                        <a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View">
                                                                                            <i class="feather-eye"></i>
                                                                                        </a>
                                                                                        <?php if ($q['status'] == 'pending'): ?>
                                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-success-light make-appointment-confirm" data-id="<?=$q['appointment_id']?>" title="Confirm This Appointment ?">
                                                                                                <i class="feather-check-circle"></i>
                                                                                            </a>
                                                                                        <?php elseif ($q['status'] == 'confirm'): ?>
                                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-success-light done-appointment" data-id="<?=$q['appointment_id']?>" title="Complete This Appointment ?">
                                                                                                <i class="feather-check-circle"></i>
                                                                                            </a>
                                                                                        <?php endif ?>
                                                                                        <?php if ($q['status'] == 'pending'): ?>
                                                                                            <a href="javascript://" class="btn btn-sm bg-danger-light delete-doctor-hospital cancel-appointment" data-id="<?=$q['appointment_id']?>" data-date="<?=date('d M, Y',strtotime($q['appointment_date']))?>" data-time="<?=date('h:i a',strtotime($q['time_start']))?>" title="Cancel This Appointment ?">
                                                                                                <i class="feather-x-circle"></i>
                                                                                            </a>
                                                                                        <?php endif ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>