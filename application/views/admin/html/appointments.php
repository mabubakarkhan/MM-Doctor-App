<?php
if (count($appointments) > 0) {
    foreach ($appointments as $q): ?>
        <tr>
            <td><?=$q['appointment_id']?></td>
            <td class="actions">
                <?php if ($q['status'] != 'cancel' && $q['status'] != 'done'): ?>
                    <a href="javascript://" class="btn btn-sm btn-danger appointment-cancel" data-id="<?=$q['appointment_id']?>"><i class="icon md-delete" aria-hidden="true"></i></a><br><br>
                <?php endif ?>
                <a href="javascript://" class="btn btn-sm btn-primary get-medical-records" data-id="<?=$q['appointment_id']?>"><i class="icon md-download" aria-hidden="true"></i></a>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td>Status</td>
                        <td><?=$q['status']?></td>
                    </tr>
                    <?php if ($q['status'] == 'cancel'): ?>
                        <tr>
                            <td>By</td>
                            <td><?=$q['cancel_by']?></td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td><?=$q['cancel_note']?></td>
                        </tr>
                    <?php endif ?>
                </table>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td><a href="javascript://" data-id="<?=$q['doctor_id']?>" class="get-doctor"><img src="<?=UPLOADS.$q['img']?>" alt="User Image" width="100"></a></td>
                        <td><a href="javascript://" data-id="<?=$q['doctor_id']?>" class="get-doctor"><?=$q['doctorFname'].' '.$q['doctorLname']?></a></td>
                    </tr>
                    <tr>
                        <td>Specialization</td>
                        <td><?=$q['specialization_titles']?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td><a href="javascript://" data-id="<?=$q['patient_id']?>" class="get-patient"><img src="<?=UPLOADS.$q['patientImg']?>" alt="User Image" width="100"></a></td>
                        <td><a href="javascript://" data-id="<?=$q['patient_id']?>" class="get-patient"><?=$q['patientFname'].' '.$q['patientLname']?></a></td>
                    </tr>
                </table>
            </td>
            <td><?=date('d M, Y',strtotime($q['appointment_date']))?> <span class="d-block text-info"><?=date('h:i a',strtotime($q['time_start']))?></span></td>
            <td>
                <?php
                if (empty($q['hospitalName'])) {
                    echo 'Online';
                }
                else{
                    echo $q['hospitalName'];
                }
                ?>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td>Method</td>
                        <td><?=$q['payment_method']?></td>
                    </tr>
                    <tr>
                        <td>Fee</td>
                        <td><?=$q['fee']?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><?=CURRENCY.number_format($q['total'])?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td><?=$q['prescription_title']?></td>
                    </tr>
                    <tr>
                        <td>Prescription</td>
                        <td><?=$q['prescription']?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php endforeach;
} //end if
else {
    ?>
    <tr>
        <td>
            No Appointment found in the database
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