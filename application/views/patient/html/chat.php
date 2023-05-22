<div class="chat-header">
	<a id="back_user_list" href="javascript:void(0)" class="back-user-list">
		<i class="material-icons">chevron_left</i>
	</a>
	<a href="<?=BASEURL.'doctor-profile/'?><?=(strlen($resp['doctor']['username']) > 1) ? $resp['doctor']['username'] : $resp['doctor']['doctor_id']?>">
		<div class="media d-flex">
			<div class="media-img-wrap flex-shrink-0">
				<div class="avatar">
					<img src="<?=UPLOADS.$resp['doctor']['img']?>" alt="<?=$resp['doctor']['fname'].' '.$resp['doctor']['lname']?>" class="avatar-img rounded-circle">
				</div>
			</div>
			<div class="media-body flex-grow-1">
				<div class="user-name"><?=$resp['doctor']['fname'].' '.$resp['doctor']['lname']?></div>
				<!-- <div class="user-status">online</div> -->
			</div>
		</div>
	</a>
	<!-- <div class="chat-options">
		<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#voice_call">
			<i class="material-icons">local_phone</i>
		</a>
		<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#video_call">
			<i class="material-icons">videocam</i>
		</a>
		<a href="javascript:void(0)">
			<i class="material-icons">more_vert</i>
		</a>
	</div> -->
</div>
<div class="chat-body">
	<div class="chat-scroll">
		<!-- <a href="#newChatTag" id="newChatClickEvent">adasd</a> -->
		<ul class="list-unstyled">
			<?php $newMsgChk = false; ?>
			<?php foreach ($resp['chat'] as $key => $chat): ?>
				<?php if ($newMsgChk == false): ?>
					<?php if ($chat['status'] == 'new' && $chat['sender'] == 'doctor'): ?>
						<li class="chat-date" id="newChatTag">new</li>
						<?php $newMsgChk = true; ?>
					<?php endif ?>
				<?php endif ?>
				<li class="media <?=($chat['sender'] == 'doctor' ? 'received' : 'sent')?> d-flex">
					<div class="media-body flex-grow-1">
						<div class="msg-box">
							<div>
								<?=$chat['msg']?>
								<ul class="chat-msg-info">
									<li>
										<div class="chat-time">
											<?php if ($chat['status'] == 'new'): ?>
												<span><?=get_time_difference_php($chat['at'])?></span>
											<?php else: ?>
												<span><?=date('d-m-y H:i a',strtotime($chat['at']))?></span>
											<?php endif ?>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</li>
			<?php endforeach ?>
			<?php if ($newMsgChk == false): ?>
				<li id="newChatTag"></li>
			<?php endif ?>
		</ul>
	</div>
</div>
<div class="chat-footer">
	<input type="hidden" id="last_msg" value="<?=$chat['chat_id']?>">
	<div class="input-group">
		<input type="hidden" name="group" value="0">
		<input type="hidden" name="doctor">
		<input type="text" class="input-msg-send form-control" placeholder="Type something" id="chatTextInput">
		<!-- <button type="button" class="btn msg-send-btn ms-2"><i class="fa fa-paperclip"></i></button> -->
		<button type="button" class="btn msg-send-btn ms-2" id="chatSendBtn"><i class="fab fa-telegram-plane"></i></button>
	</div>
</div>


