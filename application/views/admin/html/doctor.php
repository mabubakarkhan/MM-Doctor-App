<div class="modal-header">
    <h4 class="modal-title"><?=$q['fname'].' '.$q['lname'].' ('.$q['doctor_id'].') - '.$q['status']?></h4>
    <p><a target="_blank" href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>" >Profile</a></p>
    <form id="doctor-profile-form">
        <input type="hidden" name="id" value="<?=$q['doctor_id']?>">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Is Featured</label>
                    <select name="featured" class="form-control">
                        <?php if ($q['featured'] == 'yes'): ?>
                            <option value="no">NO</option>
                            <option value="yes" selected>YES</option>
                        <?php else: ?>
                            <option value="no" selected>NO</option>
                            <option value="yes">YES</option>
                        <?php endif ?>
                    </select>
                </div>
            </div>
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
    <table class="table table-bordered table-success">
        <thead>
            <th style="color: #fff;">Services</th>
            <th style="color: #fff;">Specializations</th>
            <th style="color: #fff;">Social</th>
            <th style="color: #fff;">Earning</th>
            <th style="color: #fff;">Bank</th>
            <th style="color: #fff;">Ratting</th>
        </thead>
        <tbody>
            <tr>
                <td><?=$q['service_titles']?></td>
                <td><?=$q['specialization_titles']?></td>
                <td>
                    <a target="_blank" href="<?=$q['facebook']?>">Facebook</a><br>
                    <a target="_blank" href="<?=$q['instagram']?>">Instagram</a><br>
                    <a target="_blank" href="<?=$q['linkedin']?>">Linkedin</a><br>
                    <a target="_blank" href="<?=$q['twitter']?>">Twitter</a><br>
                    <a target="_blank" href="<?=$q['pinterest']?>">Pinterest</a><br>
                    <a target="_blank" href="<?=$q['youtube']?>">Youtube</a><br>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Earned</b></td>
                            <td><?=$q['earned']?></td>
                        </tr>
                        <tr>
                            <td><b>Balance</b></td>
                            <td><?=$q['balance']?></td>
                        </tr>
                        <tr>
                            <td><b>Payable</b></td>
                            <td><?=$q['payable']?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Bank</b></td>
                            <td><?=$q['bank_name']?></td>
                        </tr>
                        <tr>
                            <td><b>Branch</b></td>
                            <td><?=$q['bank_branch_code']?></td>
                        </tr>
                        <tr>
                            <td><b>Number</b></td>
                            <td><?=$q['bank_account_number']?></td>
                        </tr>
                        <tr>
                            <td><b>Title</b></td>
                            <td><?=$q['bank_account_title']?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Ratting</b></td>
                            <td><?=$q['ratting']?></td>
                        </tr>
                        <tr>
                            <td><b>Reviews</b></td>
                            <td><?=$q['review_count']?></td>
                        </tr>
                    </table>
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
                <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id']?>" target="_blank"><?=$appointments_count?></a></td>
                <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=pending'?>" target="_blank"><?=$appointments_count_pending?></a></td>
                <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=confirm'?>" target="_blank"><?=$appointments_count_confirm?></a></td>
                <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=done'?>" target="_blank"><?=$appointments_count_done?></a></td>
                <td>
                    <table class="table table-bordered">
                        <tr>
                            <td>All</td>
                            <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=cancel'?>" target="_blank"><?=$appointments_count_cancel?></a></td>
                        </tr>
                        <tr>
                            <td>By Doctor</td>
                            <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=cancel&cancel_by=doctor'?>" target="_blank"><?=$appointments_cancel_by_doctor?></a></td>
                        </tr>
                        <tr>
                            <td>By Patient</td>
                            <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=cancel&cancel_by=patient'?>" target="_blank"><?=$appointments_cancel_by_patient?></a></td>
                        </tr>
                        <tr>
                            <td>By Admin</td>
                            <td><a href="<?=BASEURL.'admin/appointments?doctor_id='.$q['doctor_id'].'&status=cancel&cancel_by=admin'?>" target="_blank"><?=$appointments_cancel_by_admin?></a></td>
                        </tr>
                    </table>
                </td>
                <td><?=$appointments_medical_record?></td>
            </tr>
        </tbody>

    </table>



    <h3>Hospitals</h3>

    <table class="table table-bordered table-striped table-primary">
        <thead>
            <th style="color: #fff;">Name</th>
            <th style="color: #fff;">Address</th>
            <th style="color: #fff;">Fee</th>
            <th style="color: #fff;">Timing</th>
        </thead>
        <tbody>
            <?php foreach ($hospitals as $key => $hospital): ?>
                <tr>
                    <td><?=$hospital['name']?></td>
                    <td>
                        <?=$hospital['address']?>,
                        <?=$hospital['cityName']?>
                    </td>
                    <td><?=$hospital['fee']?></td>
                    <td><?=$hospital['timing_note']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>

    <h3>Awards</h3>
    <table class="table table-bordered table-warning">
        <thead>
            <th style="color:#fff;">Title</th>
            <th style="color:#fff;">Year</th>
        </thead>
        <tbody>
            <?php foreach ($awards as $key => $award): ?>
                <tr>
                    <td><?=$award['title']?></td>
                    <td><?=$award['year']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h3>Education</h3>
    <table class="table table-bordered table-warning">
        <thead>
            <th style="color:#fff;">Degree</th>
            <th style="color:#fff;">Institute</th>
            <th style="color:#fff;">Year</th>
        </thead>
        <tbody>
            <?php foreach ($educations as $key => $education): ?>
                <tr>
                    <td><?=$education['degree']?></td>
                    <td><?=$education['institute']?></td>
                    <td><?=$education['year']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h3>Experiences</h3>
    <table class="table table-bordered table-warning">
        <thead>
            <th style="color:#fff;">Hospital</th>
            <th style="color:#fff;">Designation</th>
            <th style="color:#fff;">From</th>
            <th style="color:#fff;">To</th>
        </thead>
        <tbody>
            <?php foreach ($experiences as $key => $experience): ?>
                <tr>
                    <td><?=$experience['hospital']?></td>
                    <td><?=$experience['Designation']?></td>
                    <td><?=$experience['from']?></td>
                    <td><?=$experience['to']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h3>Memberships</h3>
    <table class="table table-bordered table-warning">
        <thead>
            <th style="color:#fff;">Title</th>
        </thead>
        <tbody>
            <?php foreach ($memberships as $key => $membership): ?>
                <tr>
                    <td><?=$membership['title']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h3>Registrations</h3>
    <table class="table table-bordered table-warning">
        <thead>
            <th style="color:#fff;">Title</th>
            <th style="color:#fff;">Year</th>
        </thead>
        <tbody>
            <?php foreach ($registrations as $key => $registration): ?>
                <tr>
                    <td><?=$registration['title']?></td>
                    <td><?=$registration['year']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>