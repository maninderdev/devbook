messagesubmit();
function messagesubmit(){
	$("#message-form").submit(function(){
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var uniquefilenamepath = "";
        if(filePath.length > 0){
            var filenamepath = filePath.split("\\").pop();
            var filename = filenamepath.split(".").shift() + Math.random().toString(16).slice(2);
            var fileexe = filenamepath.split('.').pop();
            var uniquefilename = filename + "."+fileexe;
		    var form_data = new FormData();
		    form_data.append("file", fileInput.files[0], uniquefilename);
		    fetch('chat_file_upload.php',{method:"POST", body:form_data});
		    uniquefilenamepath = "../chat_files/"+uniquefilename;
        }
	  	var message_to_user = $('.messages').attr('id');
	    var message = $(".emojionearea-editor").html();
	    var filename = uniquefilenamepath;
	    var action = "Message_sent";
	    if (message.length > 0 || filePath.length > 0) {
	    	$("#message").val("");
	    	$(".emojionearea-editor").html("");
	    	$("#imagePreview").html("");
	    	$("#file").val("");
		    $.ajax({

				url:"../registration-login/include/message.submit.inc.php",
				type: "POST",
				data: {message:message, message_to_user:message_to_user,filename:filename},
				dataType: "json",
				beforeSend:function(){

				},
				success:function(datasubmit){
					var htmlsubmit = "";
					var getimgsrc = "";
					var getfile = "";
					var msghtml = "";
				for (var i = 0; i < datasubmit.length; i++) {
					if(datasubmit[i].file.length > 5){
						var getfilename = datasubmit[i].file.split("\\").pop();
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
	                		getimgsrc = datasubmit[i].file;
						}
						getfile = '<a href="'+datasubmit[i].file+'" target="_blank"><img src="'+getimgsrc+'"/></a>';
					}
					if(datasubmit[i].type == 'self'){
						if(datasubmit[i].chat_message.length > 0){
							msghtml = '<p class="msg_text">\
									'+datasubmit[i].chat_message+'\
								</p>';
						}
						htmlsubmit += '<div class="fecth_msg_wrapper" id="'+datasubmit[i].type+'">\
							<div class="fecth_msg">\
								<p class="msg_fname"> \
									<span class="msg_date_time">'+datasubmit[i].reg_date+'</span>\
								</p>\
								<div class="msg-wrapper">\
							 		'+getfile+'\
								'+msghtml+'\
								</div>\
							</div>\
						</div>';
					}

				$(".messages").append(htmlsubmit);
				}
				setTimeout(function(){
				    $(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight")+9999 }, 1);
				},250);
				
				}
			});	
	    }else{
	    	alert("Type a Message");
    	}
	  	return false;
	  });
}