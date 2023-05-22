<div class="content">
	<div class="container-fluid">
		<div class="">
			<div class="">
				<div class="row chat-window">

					<div class="col-lg-4">
						<div class="chat-cont-left">
							<div class="chat-header">
								<span>Chats</span>
								<a href="javascript:void(0)" class="chat-compose" id="chatListRefresh">
									<i class="material-icons">refresh</i>
								</a>
							</div>
							<form class="chat-search">
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="fas fa-search"></i>
									</div>
									<input type="text" class="form-control rounded-pill placeholder=" Search id="chat-search">
								</div>
							</form>
							<div class="chat-users-list" id="chatGroupArea">
								<?=$groups?>
							</div>
						</div>
					</div>


					<div class="col-lg-8 chat-cont-right" id="chatArea">
						<!-- chat -->
					</div>

				</div>
			</div>
		</div>

	</div>
</div>