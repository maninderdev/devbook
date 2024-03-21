setInterval(realtime, 500);
function realtime(){
	if ($('.messages').attr('id') > 0) {
	var message_to = $('.messages').attr('id');
	var last_id_fetch = $('.messaging-wrapper').attr('id');
	var update = "update";
	$.ajax({

			url:"../registration-login/include/message.get.inc.php",
			type: "POST",
			data: {message_to:message_to, update:update, last_id_fetch:last_id_fetch},
			dataType: "json",
			beforeSend:function(){

			},
			success:function(updatedata){
				var updatehtml = "";
				for (var u = 0; u < updatedata.length; u++) {
				var getfile = "";
				var getimgsrc = "";
				var msghtml = "";
				if(updatedata[u].file){
					if(updatedata[u].file.length > 5){
						var getfilename = updatedata[u].file.split("\\").pop();
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
	                		getimgsrc = updatedata[u].file;
						}
						getfile = '<a href="'+updatedata[u].file+'" target="_blank"><img src="'+getimgsrc+'"/></a>';
					}
				}
				if(updatedata[u].chat_message){
					if(updatedata[u].chat_message.length > 0){
						msghtml = '<p class="msg_text">\
									'+updatedata[u].chat_message+'\
								   </p>';
					}
				}
					if(updatedata[u].type == "from"){
					updatehtml += '<div class="fecth_msg_wrapper" id="'+updatedata[u].type+'">\
						<div class="fecth_msg">\
							<img src="'+updatedata[u].img+'">\
							<div class="msg_content">\
								<p class="msg_fname">\
									'+updatedata[u].fname+', \
									<span class="msg_date_time">'+updatedata[u].reg_date+'</span>\
								</p>\
								<div class="msg-wrapper">\
									'+getfile+'\
									'+msghtml+'\
								</div>\
							</div>\
						</div>\
					</div>';
					$('.messaging-wrapper').attr('id', updatedata[u].chat_msg_id);
					}

				$(".messages").append(updatehtml);
				}
				$(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight") }, 10);
			}
	});
	}
}