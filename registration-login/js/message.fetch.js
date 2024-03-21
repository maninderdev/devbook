$(document).ready(function(){
	$(".message-btn").click(function(){
		$(".messaging-wrapper").addClass("active");
		$("body").addClass("msg_box_active");
		var message_to = $(this).data('message_to');
		$('.messages').attr('id', message_to);  	
		var fetch = "fetch";
		$.ajax({

			url:"../registration-login/include/messageall.fetch.inc.php",
			type: "POST",
			data: {message_to:message_to, fetch:fetch},
			dataType: "json",
			beforeSend:function(){
				var html = "";
				
				$(".messages").html(html);
			},
			success:function(fetchdata){
				var html = "";
			for (var i = 0; i < fetchdata.length; i++) {
				var getfile = "";
				var getimgsrc = "";
				var msghtml = "";
				if(fetchdata[i].file){
					if(fetchdata[i].file.length > 5){
						var getfilename = fetchdata[i].file.split("\\").pop();
						var getfileexe = getfilename.split('.').pop();
						switch (getfileexe){
	                		case "pdf":
	                		getimgsrc = "../siteimages/pdf_logo.webp";
	                		break;
	                		case "zip":
	                		getimgsrc = "../siteimages/winrar.jpg";
	                		break;
	                		case "xd":
	                		getimgsrc = "../siteimages/xd_logo.webp";
	                		break;
	                		case "psd":
	                		getimgsrc = "../siteimages/psd_logo.png";
	                		break;
	                		case "html":
	                		getimgsrc = "../siteimages/html_logo.png";
	                		break;
	                		case "css":
	                		getimgsrc = "../siteimages/css_logo.png";
	                		break;
	                		case "php":
	                		getimgsrc = "../siteimages/php_logo.png";
	                		break;
	                		default:
	                		getimgsrc = fetchdata[i].file;
						}
						getfile = '<a href="'+fetchdata[i].file+'" target="_blank"><img src="'+getimgsrc+'"/></a>';
					}
				}
				if(fetchdata[i].chat_message){
					if(fetchdata[i].chat_message.length > 0){
						msghtml = '<p class="msg_text">\
									'+fetchdata[i].chat_message+'\
								   </p>';
					}
				}
				switch(fetchdata[i].type){
					case 'self':
					html += '<div class="fecth_msg_wrapper" id="'+fetchdata[i].type+'">\
						<div class="fecth_msg">\
							<p class="msg_fname"> \
								<span class="msg_date_time">'+fetchdata[i].reg_date+'</span>\
							</p>\
						<div class="msg-wrapper">\
							'+getfile+'\
							'+msghtml+'\
								</div>\
						</div>\
					</div>';
					break;
					case 'from':
					html += '<div class="fecth_msg_wrapper" id="'+fetchdata[i].type+'">\
						<div class="fecth_msg">\
							<img src="'+fetchdata[i].img+'">\
							<div class="msg_content">\
								<p class="msg_fname">\
									'+fetchdata[i].fname+', \
									<span class="msg_date_time">'+fetchdata[i].reg_date+'</span>\
								</p>\
						<div class="msg-wrapper">\
								'+getfile+'\
								'+msghtml+'\
								</div>\
							</div>\
						</div>\
					</div>';
					break;
					default:
					$('.messaging-wrapper').attr('id', fetchdata[i].last_id);
					html += "";
				}

				$(".messages").html(html);
				}
				setTimeout(function(){
					$(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight")+9999 }, 1);
				},100);
			}
		});

	});

});