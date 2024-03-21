var links = document.querySelectorAll('.nav-link');
for(var i = 0; i < links.length; i++){
	links[i].addEventListener("click", function(){
		var current = document.getElementsByClassName("active");
  		current[0].className = current[0].className.replace(" active", "");
  		this.className += " active";
	});
}


var navAccount = document.querySelector(".admin-text");
var admin = document.querySelector(".user-opions");
navAccount.addEventListener("click", function(){
	this.classList.toggle("active");
	admin.classList.toggle("active");
});


var menulinks = document.querySelectorAll(".navbar-wrapper .nav-list .nav-link");
for(var l = 0; l < menulinks.length; l++){
	var linkurl = menulinks[l].href;
	if(linkurl == window.location){
		menulinks[l].classList.add('active');
	}
}

var editProfile = document.querySelector('#edit-profile');
if(editProfile){
	editProfile.addEventListener("click", function(){
		var editform = document.querySelector('.changes-form-wrapper');
		editform.classList.add("active");
	});
}


var closeeditProfile = document.querySelector('.form-close');
if(closeeditProfile){
	closeeditProfile.addEventListener("click", function(){
		var editform2 = document.querySelector('.changes-form-wrapper');
		editform2.classList.remove("active");
	});

}




var editimg = document.querySelector('#user_img-update');
if(editimg){
	editimg.addEventListener("click", function(){
		var editimgform = document.querySelector('.update-image');
		editimgform.classList.add("active");
	});
}

var closeeditimg = document.querySelector('.img-form-close');
if(closeeditimg){
	closeeditimg.addEventListener("click", function(){
		var editimgform2 = document.querySelector('.update-image');
		editimgform2.classList.remove("active");
	});
}


var msgformclose = document.querySelector('.msg-form-close');
if(msgformclose){
	msgformclose.addEventListener("click", function(){
		var removeidmessage = document.querySelector('.messages');
		removeidmessage.removeAttribute("id")
		var messageform2 = document.querySelector('.messaging-wrapper');
		messageform2.classList.remove("active");
		document.body.classList.remove("msg_box_active");
	});

}
var menubtn = document.querySelector('.menu-bar');
if(menubtn){
	menubtn.addEventListener("click", function(){
		var body = document.querySelector('body');
		body.classList.toggle("menu_open");
	});

}

var ajaxObject=false;
    	$(document).ready(function(){
        	$("#searchbar").keyup(function(){
        		$('#search_close').addClass("active");
        		$('#query_result').addClass("active");
        		$('#search_close').click(function(){
        			$('#searchbar').val("");
        			$('#search_close').removeClass("active");
        			$('#query_result').removeClass("active");
        		});
        		if ($(this).val() == "") {
        			$('#search_close').removeClass("active");
        			$('#query_result').removeClass("active");
        		}
        		var search_query = $(this).val();
                   if(ajaxObject)
                   	  ajaxObject.abort();
        	ajaxObject=	$.ajax({

        			url:"search_action.php",
        			type: "POST",
        			data: {search_query:search_query},
        			dataType: "json",
        			beforeSend:function(){
        				if ($('#query_result').attr('class') == 'active') {
	        				$('#query_result').html('<i class="fa-duotone fa-spinner"></i> Searching');
        				}
					},
        			success:function(html){
        				setTimeout(intervalsearch,600);
        				function intervalsearch(){
                           var itemHtml='<ul>';
                           var btntype = '';
                          for(i=0;i<html.length;i++){
                          		switch(html[i].type){
                          			case 'Accept':
                          			btntype = '<a class="friend-btn" href="messaging.php">Message</a>';
                          			break;
                          			case 'Pending':
                          			btntype = '<button class="friend-btn" disabled="disabled">Pending</button>';
                          			break;
                          			case 'Reject':
                          			btntype = '<button class="friend-btn" disabled="disabled">Rejected</button>';
                          			break;
                          			default:
                          			btntype = '<a href="javascript:void(0)" class="friend-btn request_id_'+html[i].id+'" data-usertoid="'+html[i].id+'" >Add Friend</a>';
                          		}
                               itemHtml+='<li class="search_result">\
											<a href="profile_user.php?query='+html[i].id+'">\
												<img src="'+html[i].img+'">\
											</a>\
											<h4 class="user-name">'+html[i].fname+' '+html[i].lname+'</h4>\
											'+btntype+'\
										</li>';
                          }
                          itemHtml+='</ul>';
	        				$('#query_result').html(itemHtml);
	        				$(".friend-btn").click(function(){
								var data_to_id = $(this).data('usertoid');
								var action = 'Send_request';
									
									$.ajax({

									url:"friend_action.php",
									type: "POST",
									data: {data_to_id:data_to_id, action:action},
									dataType: "text",
									beforeSend:function(){
										$('.request_id_'+data_to_id).attr('disabled', 'disabled');
										$('.request_id_'+data_to_id).html('<i class="fa-duotone fa-spinner"></i> Sending...');
									},
									success:function(data){
										setTimeout(function(){
											$('.request_id_'+data_to_id).html('<i class="fa-solid fa-clock"></i> Request Send');
									     },600);
									}
								});
							});
						};
        			}
        		});
        	});
        });