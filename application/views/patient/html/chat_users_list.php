<div class="chat-scroll">
	<?php foreach ($groups as $key => $group): ?>
		<a href="javascript:void(0);" class="media d-flex <?=($group['chat_group_id'] == $group_id) ? 'active' : ''?> chat-user" data-id="<?=$group['chat_group_id']?>" data-doctor="<?=$group['doctor_id']?>" data-name="<?=$group['doctorFname'].' '.$group['doctorLname']?>" data-img="<?=UPLOADS.$group['img']?>">
			<div class="media-img-wrap flex-shrink-0">
				<div class="avatar">
					<img src="<?=UPLOADS.$group['img']?>" alt="User Image" class="avatar-img rounded-circle">
				</div>
			</div>
			<div class="media-body flex-grow-1">
				<div>
					<div class="user-name"><?=$group['doctorFname'].' '.$group['doctorLname']?></div>
					<div class="user-last-chat last-msg-wrap"><?=$group['last_msg']?></div>
				</div>
				<div>
					<?php if (strlen($group['last_msg']) > 0): ?>
						<div class="last-chat-time block"><?=get_time_difference_php($group['last_msg_at'])?></div>
					<?php endif ?>
					<?php if ($group['for_patient_new'] > 0): ?>
						<div class="badge badge-success rounded-pill"><?=$group['for_patient_new']?></div>
					<?php endif ?>
				</div>
			</div>
		</a>
	<?php endforeach ?>
</div>