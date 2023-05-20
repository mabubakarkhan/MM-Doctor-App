<?php foreach ($appointments as $key => $q): ?>
    <?php if ($q['review'] == 'done' && $q['status'] == 'done'): ?>
        <tr>
            <td><?=$q['appointment_id']?></td>
            <td>
                <h2 class="table-avatar">
                    <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"
                        class="avatar avatar-sm me-2">
                        <img class="avatar-img rounded-circle"
                            src="<?=UPLOADS.$q['img']?>"
                            alt="User Image">
                    </a>
                    <a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($q['username']) > 1) ? $q['username'] : $q['doctor_id']?>"><?=$q['doctorFname'].' '.$q['doctorLname']?>
                        <span><?=$q['specialization_titles']?></span></a>
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