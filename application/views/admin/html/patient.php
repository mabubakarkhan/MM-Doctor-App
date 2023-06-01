<div class="modal-header">
    <h4 class="modal-title"><?=$q['fname'].' '.$q['lname'].' ('.$q['patient_id'].') - '.$q['status']?></h4>
    <!-- <p><a target="_blank" href="<?=BASEURL.'patient-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['patient_id']?>" >Profile</a></p> -->
    <form id="patient-profile-form">
        <input type="hidden" name="id" value="<?=$q['patient_id']?>">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="new" <?=($q['status'] == 'new') ? 'selected' : ''?> >New</option>
                        <option value="active" <?=($q['status'] == 'active') ? 'selected' : ''?> >Active</option>
                        <option value="inactive" <?=($q['status'] == 'inactive') ? 'selected' : ''?> >Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-success" type="submit" style="margin-top: 27px;">Update</button>
                </div>
            </div>
        </div><!-- /row -->
    </form>
</div>
<div class="modal-body">
    

    <table class="table table-bordered table-success">
        <thead>
            <th style="color: #fff;">Image</th>
            <th style="color: #fff;">Phone</th>
            <th style="color: #fff;">Email</th>
            <th style="color: #fff;">Gender</th>
            <th style="color: #fff;">DoB</th>
            <th style="color: #fff;">Biography</th>
            <th style="color: #fff;">Address</th>
        </thead>
        <tbody>
            <tr>
                <td><img src="<?=UPLOADS.$q['img']?>" width="150"></td>
                <td><?=$q['phone']?></td>
                <td><?=$q['email']?></td>
                <td><?=$q['gender']?></td>
                <td><?=$q['dob']?></td>
                <td><?=$q['biography']?></td>
                <td>
                    <?=$q['countryName']?>,
                    <?=$q['stateName']?>,
                    <?=$q['cityName']?>,
                    <?=$q['postcode']?>,
                    <?=$q['address_line_1']?>,
                    <?=$q['address_line_2']?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>Appointments</h3>
    <table class="table table-bordered table-dark">
        <thead>
            <th style="color:#fff;">All</th>
            <th style="color:#fff;">Pending</th>
            <th style="color:#fff;">Confirm</th>
            <th style="color:#fff;">Done</th>
            <th style="color:#fff;">Cancel</th>
            <th style="color:#fff;">Medical Records</th>
        </thead>
        <tbody>
            <tr>
                <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id']?>" target="_blank"><?=$appointments_count?></a></td>
                <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=pending'?>" target="_blank"><?=$appointments_count_pending?></a></td>
                <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=confirm'?>" target="_blank"><?=$appointments_count_confirm?></a></td>
                <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=done'?>" target="_blank"><?=$appointments_count_done?></a></td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>All</td>
                            <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=cancel'?>" target="_blank"><?=$appointments_count_cancel?></a></td>
                        </tr>
                        <tr>
                            <td>By Doctor</td>
                            <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=cancel&cancel_by=doctor'?>" target="_blank"><?=$appointments_cancel_by_doctor?></a></td>
                        </tr>
                        <tr>
                            <td>By Patient</td>
                            <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=cancel&cancel_by=patient'?>" target="_blank"><?=$appointments_cancel_by_patient?></a></td>
                        </tr>
                        <tr>
                            <td>By Admin</td>
                            <td><a href="<?=BASEURL.'admin/appointments?patient_id='.$q['patient_id'].'&status=cancel&cancel_by=admin'?>" target="_blank"><?=$appointments_cancel_by_admin?></a></td>
                        </tr>
                    </table>
                </td>
                <td><?=$appointments_medical_record?></td>
            </tr>
        </tbody>

    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>