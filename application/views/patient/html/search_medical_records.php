<?php if ($records): ?>
    <div class="card">
        <div class="card-header">

            <nav class="user-tabs mb-0">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item">
                        <a class="nav-link active" href="#pat_medicalrecords"
                            data-bs-toggle="tab">Medical Records</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#pat_prescription"
                            data-bs-toggle="tab">Prescription</a>
                    </li> -->
                </ul>
            </nav>

        </div>
        <div class="card-body p-0">

            <div class="tab-content pt-0">

                <div id="pat_medicalrecords" class="tab-pane fade show active">
                    <div class="border-top card-table mb-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 records" id="medicalRecordsSearchResultsTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Doctor</th>
                                            <th>AT</th>
                                            <th>Description</th>
                                            <th>Attachment</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($records as $key => $q): ?>
                                            <tr>
                                                <td><?=$key+1?></td>
                                                <td><?=$q['doctorFname'].' '.$q['doctorLname']?></td>
                                                <td><?=date('d M Y',strtotime($q['dated']))?> <span class="d-block text-info"><?=date('H:i A',strtotime($q['dated']))?></span></td>
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

            </div>

        </div>
    </div>
<?php endif ?>