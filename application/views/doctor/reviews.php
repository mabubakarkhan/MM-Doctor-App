        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Reviews</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASEURL?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Reviews</li>
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
                                                        data-bs-toggle="tab">Pending</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#pat_refundrequest"
                                                        data-bs-toggle="tab">Published</a>
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
                                                                        <th>Doctor</th>
                                                                        <th>Appt Date</th>
                                                                        <th>Hospital</th>
                                                                        <th>Payment</th>
                                                                        <th>Paid Amount</th>
                                                                        <th>Status</th>
                                                                        <th>Appointment</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($appointments as $key => $q): ?>
                                                                        <?php if ($q['review'] == 'pending' && $q['status'] == 'done'): ?>
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
                                                                                    <span class="badge rounded-pill success-status">Done</span>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="table-action">
                                                                                        <a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View">
                                                                                            <i class="feather-eye"></i>
                                                                                        </a>
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
                                                                        <th>Doctor</th>
                                                                        <th>Appt Date</th>
                                                                        <th>Ratting</th>
                                                                        <th>Review</th>
                                                                        <th>Appointment</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="show-reviews">
                                                                    <?php foreach ($appointments as $key => $q): ?>
                                                                        <?php if ($q['review'] == 'done' && $q['status'] == 'done'): ?>
                                                                            <tr>
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
                                                                                <td>
                                                                                    <div class="rating">
                                                                                        <?php
                                                                                        for ($i=1; $i < 6; $i++) { 
                                                                                            if ($q['ratting'] >= $i) {
                                                                                                echo '<i class="fas fa-star filled"></i>';
                                                                                            }
                                                                                            else{
                                                                                                echo '<i class="fas fa-star"></i>';
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <?=$q['reviewNote']?>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="table-action">
                                                                                        <a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View">
                                                                                            <i class="feather-eye"></i>
                                                                                        </a>
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