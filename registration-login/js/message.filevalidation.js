function remove(element){
    		element.parentElement.remove();
    		document.getElementById('file').value = '';
    	}
    	function fileValidation() {
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            var filenamepath = filePath.split("\\").pop();
            var filename = filenamepath.split(".").shift() + Math.random().toString(16).slice(2);
            var fileexe = filenamepath.split('.').pop();
            var uniquefilename = filename + "."+fileexe;
            var extensionpreview = "false";
            var sizepreview = "false";
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.svg|\.gif|\.webm|\.mp4|\.m4p|\.pdf|\.zip|\.xd|\.psd|\.html|\.css|\.php)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            } 
            else {
	            if (fileInput.files && fileInput.files[0]) {
	                var extensionpreview = "true";
	            }
            }

            if (fileInput.files.length > 0) {
            for (var i = 0; i <= fileInput.files.length - 1; i++) {
  
	                const fsize = fileInput.files.item(i).size;
	                const file = Math.round((fsize / 10024));
	                // The size of the file.
	                if (file >= 20000) {
	                	fileInput.value = '';
	                    alert("File too Big, please select a file less than 10mb");
	                }else{
	                	sizepreview = "true";
	                }
	            }
	        }
	        if(extensionpreview == "true" && sizepreview == "true"){
	        	var reader = new FileReader();
                reader.onload = function(e) {
                	var imagesrc = "";
                	switch(filePath.split('.').pop()){
                		case "pdf":
                		imagesrc = "../siteimages/pdf_logo.webp";
                		break;
                		case "zip":
                		imagesrc = "../siteimages/winrar.jpg";
                		break;
                		case "xd":
                		imagesrc = "../siteimages/xd_logo.webp";
                		break;
                		case "psd":
                		imagesrc = "../siteimages/psd_logo.png";
                		break;
                		case "html":
                		imagesrc = "../siteimages/html_logo.png";
                		break;
                		case "css":
                		imagesrc = "../siteimages/css_logo.png";
                		break;
                		case "php":
                		imagesrc = "../siteimages/php_logo.png";
                		break;
                		default:
                		imagesrc = e.target.result;
                	}
                    document.getElementById(
                        'imagePreview').innerHTML = 
                        '<div class="image_msg_wrapper"> <img src="' +imagesrc+ '"/>\
                        <a onclick = "remove(this)"><i class="fa-solid fa-xmark"></i></a> </div> ';
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }