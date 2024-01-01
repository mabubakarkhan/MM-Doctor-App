
    <div class="card">
        <div class="card-header">

            <nav class="user-tabs mb-0">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item">
                        <a class="nav-link active" href="#pat_medicalrecords"
                            data-bs-toggle="tab">Medical Records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pat_prescription"
                            data-bs-toggle="tab">Self uploaded</a>
                    </li>
                </ul>
            </nav>

        </div>
        <div class="card-body p-0">

            <div class="tab-content pt-0">

                <div id="pat_medicalrecords" class="tab-pane fade show active">
                    <div class="border-top card-table mb-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 records">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Appointment #</th>
                                            <th>Dated</th>
                                            <th>Doctor</th>
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($records as $key => $q): ?>
                                            <?php if ($q['appointment_id'] > 0): ?>
                                                <tr>
                                                    <td><?=$key+1?></td>
                                                    <td><?=$q['appointment_id']?></td>
                                                    <td><?=date('d M Y',strtotime($q['dated']))?></td>
                                                    <td><?=$q['doctorFname'].' '.$q['doctorLname']?></td>
                                                    <td><?=$q['detail']?></td>
                                                    <td>
                                                        <a href="<?=UPLOADS.$q['file']?>" title="Download attachment" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$q['appointment_id']?>" title="Detail View"><i class="feather-eye"></i></a>
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


                <div class="tab-pane fade" id="pat_prescription">
                    <div class="card-body text-end">
                        <a href="#" class="add-new-btn mb-0" data-bs-toggle="modal" data-bs-target="#add_medical_records_modal">Add Medical Records</a>
                    </div>
                    <div class="border-top card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 records">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dated</th>
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($records as $key => $q): ?>
                                            <?php if ($q['appointment_id'] == 0): ?>
                                                <tr>
                                                    <td><?=$key+1?></td>
                                                    <td><?=date('d M Y',strtotime($q['dated']))?></td>
                                                    <td><?=$q['detail']?></td>
                                                    <td>
                                                        <a href="<?=UPLOADS.$q['file']?>" title="Download attachment" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-sm bg-danger-light remove-record" data-id="<?=$q['medical_record_id']?>">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
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
