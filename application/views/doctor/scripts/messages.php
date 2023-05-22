<script type="text/javascript" src="http://demos.flesler.com/jquery/scrollTo/js/jquery.scrollTo-min.js?2.1.2"></script>
<script>
$(document).on('click', '.chat-user', function(event) {
	event.preventDefault();
	$('.chat-user').removeClass('active');
	$this = $(this);
	$this.addClass('active');
	$("#chatArea").html('<p>loading</p>');
	$.post('<?=BASEURL."doctor/get-chat"?>', {id: $this.attr('data-id'), patient: $this.attr('data-patient')}, function(resp) {
		resp = $.parseJSON(resp);
		$("#chatArea").html(resp.html);
		$("#chatGroupArea").html(resp.groups);
		$("#chatArea input[name='group']").val($this.attr('data-id'));
		$("#chatArea input[name='patient']").val($this.attr('data-patient'));

	    $('#chatArea .chat-scroll').animate({
	      scrollTop: $("#newChatTag").offset().top - $('#chatArea .chat-scroll').offset().top + $('#chatArea .chat-scroll').scrollTop()
	    }, 0);

		


	});
});

$(document).on('click', '#newChatClickEvent', function(event) {
	event.preventDefault();
	console.log('click');
	var targetElement = $("#newChatTag");
    $('#chatArea ul.list-unstyled').animate({
      scrollTop: targetElement.offset().top - $('#chatArea ul.list-unstyled').offset().top + $('#chatArea ul.list-unstyled').scrollTop()
    }, 1000);
});


$(document).on('click', '#chatSendBtn', function(event) {
	event.preventDefault();
	$text = $("#chatTextInput").val();
	if ($text.length > 0) {
		ajaxBtnLoader($("#chatSendBtn"));
		$.post('<?=BASEURL."doctor/post-message"?>', {
			text: $text,
			group: $("#chatArea input[name='group']").val(),
			patient: $("#chatArea input[name='patient']").val()
		}, function(resp) {
			resp = $.parseJSON(resp);
			$("#newChatTag").remove();
			$("#chatSendBtn").html('<i class="fab fa-telegram-plane"></i>');
			$("#chatArea ul.list-unstyled").append(resp.html);
			$(".chat-scroll .active .last-msg-wrap").text($text);
			$("#last_msg").val(resp.last_msg);
			$("#chatTextInput").val('');
			$("#chatTextInput").focus();
			$('#chatArea .chat-scroll').animate({
		      scrollTop: $("#newChatTag").offset().top - $('#chatArea .chat-scroll').offset().top + $('#chatArea .chat-scroll').scrollTop()
		    }, 0);
		});
	}
});

//auto new messages
setInterval(function()
{
	$id = $("#last_msg").val();
	if (typeof($id) != "undefined" && $id !== null) {
	    $.post('<?=BASEURL."doctor/new-messages-auto"?>', {
	    	last_id: $id,
			group: $("#chatArea input[name='group']").val(),
			patient: $("#chatArea input[name='patient']").val()
	    }, function(resp) {
			resp = $.parseJSON(resp);
			if (resp.status == true) {
				$("#newChatTag").remove();
				$("#chatArea ul.list-unstyled").append(resp.html);
				$(".chat-scroll .active .last-msg-wrap").text(resp.last_text);
				$("#last_msg").val(resp.last_msg);
				$(".chat-scroll .active .last-chat-time").text(resp.last_msg_at);
				$('#chatArea .chat-scroll').animate({
			      scrollTop: $("#newChatTag").offset().top - $('#chatArea .chat-scroll').offset().top + $('#chatArea .chat-scroll').scrollTop()
			    }, 0);
			}
	    });
	}
}, 1000);//time in milliseconds 

//auto group refresh
setInterval(function()
{
	$chkSearch = $("#chat-search").val();
	if (!($chkSearch.length > 0)) {
	    $.post('<?=BASEURL."doctor/groups-list-auto"?>', {
			group: $("#chatArea input[name='group']").val()
	    }, function(resp) {
			resp = $.parseJSON(resp);
			$("#chatGroupArea").html(resp.groups);
	    });
	}
}, 1000);//time in milliseconds 


$(document).on('click', '#chatListRefresh', function(event) {
	event.preventDefault();
	$("#chat-search").val('');
});


$("#chat-search").on("keyup", function() {
    var value = $(this).val();
    $this = $(this);
    $(".chat-scroll a.chat-user").each(function(index, val) {

        $row = $(this);
        var id = $row.find(".user-name").text().toLowerCase();
        if (id.indexOf(value) > -1) {
        	$(this).removeClass('d-none');
        	$(this).addClass('d-flex');
        }
        else {
        	$(this).removeClass('d-flex');
        	$(this).addClass('d-none');
        }
    });
});

</script>