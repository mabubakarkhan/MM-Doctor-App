<?php if ($appointment): ?>
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
                            data-bs-toggle="tab">Prescription</a>
                    </li>
                </ul>
            </nav>

        </div>
        <div class="card-body p-0">

            <div class="tab-content pt-0">

                <div id="pat_medicalrecords" class="tab-pane fade show active">
                    <div class="card-body text-end">
                        <a href="#" class="add-new-btn mb-0" data-bs-toggle="modal" data-bs-target="#add_medical_records_modal">Add Medical Records</a>
                    </div>
                    <div class="border-top card-table mb-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 records">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($records as $key => $q): ?>
                                            <tr>
                                                <td><?=$key+1?></td>
                                                <td><?=$q['patientFname'].' '.$q['patientLname']?></td>
                                                <td><?=date('d M Y',strtotime($q['dated']))?></span></td>
                                                <td><?=$q['detail']?></td>
                                                <td>
                                                    <a href="<?=UPLOADS.$q['file']?>" title="Download attachment" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i></a>
                                                </td>
                                                <!-- <td>
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td> -->
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="pat_prescription">
                    <div class="border-top card-table mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 prescriptions">
                                    <thead>
                                        <tr>
                                            <th>Date </th>
                                            <th>Name</th>
                                            <th>Prescription</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=date('d M, Y',strtotime($appointment['appointment_date']))?></td>
                                            <td><?=$appointment['prescription_title']?></td>
                                            <td><?=$appointment['prescription']?></td>
                                            <td>
                                                <div class="table-action">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-sm bg-info-light get-appointment-info" data-id="<?=$appointment['appointment_id']?>">
                                                        <i class="far fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
<?php endif ?>