jQuery(document).ready(function () {
    if($('#type-message').length){
        $('#type-message').on('keydown', function (e) {
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault();
                $('#message-form').submit();
            }
        });
        autosize();
        function autosize(){
            var text = $('#type-message');

            text.attr('rows',1);
            resizeMsg(text);

            text.on('input', function(e){
                resizeMsg($(this));
            });
            
            function resizeMsg ($text) {
                $text.css('height', 'auto');
                $text.css('height', $text[0].scrollHeight+'px');
            }
        }
    }
    function svgToggleOpen() {
        $('#sidebar-toggle').find('svg path').attr('d', 'M19.5 2A2.5 2.5 0 0 1 22 4.5v15a2.5 2.5 0 0 1-2.5 2.5h-15A2.5 2.5 0 0 1 2 19.5v-15A2.5 2.5 0 0 1 4.5 2h15zM18 4h-4a2 2 0 0 0-2 2h0v12a2 2 0 0 0 2 2h0 4a2 2 0 0 0 2-2h0V6a2 2 0 0 0-2-2h0zM9.121 9.707a1 1 0 0 0-1.517 1.294h0L5 11a1 1 0 1 0 0 2h0l2.828-.001-.121.122a1 1 0 0 0 1.414 1.414h0l1.414-1.414c.271-.271.354-.659.25-1.002a1 1 0 0 0-.25-.998h0z');

    }
    function svgToggleClose() {
        $('#sidebar-toggle').find('svg path').attr('d', 'M19.5 2A2.5 2.5 0 0 1 22 4.5v15a2.5 2.5 0 0 1-2.5 2.5h-15A2.5 2.5 0 0 1 2 19.5v-15A2.5 2.5 0 0 1 4.5 2h15zM10 4H6a2 2 0 0 0-2 2h0v12a2 2 0 0 0 2 2h0 4a2 2 0 0 0 2-2h0V6a2 2 0 0 0-2-2h0z');
    }
    $('#sidebar-toggle').on('click', function () {
        var sidebarWrapper = $('.sidebar-wrapper');
        if ($(window).width() > 1181) {
            if (!sidebarWrapper.hasClass('sidebar-sm')) {
                sidebarWrapper.addClass('sidebar-sm');
                $('.main-content-wrapper').addClass('main-100');
                svgToggleOpen();
            } else {
                sidebarWrapper.removeClass('sidebar-sm');
                $('.main-content-wrapper').removeClass('main-100');
                svgToggleClose();
            }
        } else {
            if (!sidebarWrapper.hasClass('sidebar-sm')) {
                sidebarWrapper.addClass('sidebar-sm');
                svgToggleOpen();
            } else {
                sidebarWrapper.removeClass('sidebar-sm');
                svgToggleClose();
            }
        }
    });

    function windowResizeCust() {
        var sidebarWrapper = $('.sidebar-wrapper');
        if ($(window).width() < 1181) {
            sidebarWrapper.addClass('sidebar-sm');
            $('.main-content-wrapper').addClass('main-100'); svgToggleOpen();
        } else {
            sidebarWrapper.removeClass('sidebar-sm');
            $('.main-content-wrapper').removeClass('main-100'); svgToggleClose();
        }
        if($(window).width() <= 767){
            sidebarWrapper.removeClass('sidebar-sm');
        }
    }
    windowResizeCust();
    $(window).resize(windowResizeCust);

    $('.btn-menu-toggle').on('click', function () {
        $('.main-wrapper').toggleClass('menu-active');
    });

    $('.dropdown-wrapper button').on('click', function () {
        if ($(this).hasClass('active')) {
            $(this).parent().removeClass('active');
            $(this).removeClass('active');
            $(this).next().toggle(200);
        } else {
            setTimeout(()=>{
                $(this).parent().addClass('active');
            },50);
            $(this).addClass('active');
            $(this).next().toggle(200);
        }
    });
    $(document).on('click', function (e) {
        var container = $('.dropdown');
        if(container.parent().hasClass('active')){
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.parent().removeClass('active');
                container.parent().children('button').removeClass('active');
                container.toggle(200);
            }
        }
    });

    $('.theme-toggle').on('click', function(){
        if($(this).hasClass('active')){
            $(this).find('svg path').attr('d', 'M195 125c0-26.3 5.3-51.3 14.9-74.1C118.7 73 51 155.1 51 253c0 114.8 93.2 208 208 208 97.9 0 180-67.7 202.1-158.9-22.8 9.6-47.9 14.9-74.1 14.9-106 0-192-86-192-192z');
            $(this).removeClass('active');
            $('body').removeClass('thm-dark');
        }else{
            $(this).find('svg path').attr('d', 'M277.3 32h-42.7v64h42.7V32zm129.1 43.7L368 114.1l29.9 29.9 38.4-38.4-29.9-29.9zm-300.8 0l-29.9 29.9 38.4 38.4 29.9-29.9-38.4-38.4zM256 128c-70.4 0-128 57.6-128 128s57.6 128 128 128 128-57.6 128-128-57.6-128-128-128zm224 106.7h-64v42.7h64v-42.7zm-384 0H32v42.7h64v-42.7zM397.9 368L368 397.9l38.4 38.4 29.9-29.9-38.4-38.4zm-283.8 0l-38.4 38.4 29.9 29.9 38.4-38.4-29.9-29.9zm163.2 48h-42.7v64h42.7v-64z');
            $(this).addClass('active');
            $('body').addClass('thm-dark');
        }
    });


    // Datepicker INIT
    var inputDatepicker = $('input.datepicker');
    if(inputDatepicker.length){
        inputDatepicker.datepicker({
            format: "dd/mm/yyyy"
        });
        inputDatepicker.on('keydown keyup', function(e){
            e.preventDefault();
        });
    }


    // Login Form Validation
    var loginForm = $('#login-form');
    if(loginForm.length){
        loginForm.validate({
            rules: {
                username: 'required',
                password: 'required'
            },
            messages: {
                username: 'Username or Email is required',
                password: 'Password is required'
            },
            invalidHandler: function(event, validator) {
                console.log(event, validator);
            },
            submitHandler: function(form) {
                window.location.href = 'subject.html';
            }
        });
    }



    // Register Form Validation
    var registerForm = $('#register-form');
    if(registerForm.length){
        registerForm.validate({
            rules: {
                name: 'required',
                school: 'required',
                class: 'required',
                roll_number: 'required',
                dob: 'required',
            },
            messages: {
                name: 'Name is required',
                school: 'School is required',
                class: 'Class is required',
                roll_number: 'Roll Number is required',
                dob: 'Date of Birth is required',
            },
            invalidHandler: function(event, validator) {
                console.log(event, validator);
            },
            submitHandler: function(form) {
                window.location.href = 'subject.html';
            }
        });
    }


    // Message On Send
    $('#message-form').on('submit', function(e){
        e.preventDefault();
        var message = $('#type-message').val();
        if(message.length > 0){
            $(this).parent().removeAttr('style');
            $('#type-message').val('').removeAttr('style');
            var userQuery = '<div class="user-question" style="display:none;">\
                                <p class="question">'+message+'</p>\
                                <div class="user-other-info">\
                                    <p class="query-time">Just now</p>\
                                    <div class="user-thumb">\
                                        <img src="assets/images/avatar.jpeg" alt="Avatar">\
                                    </div>\
                                </div>\
                            </div>';
            $('.chat-wrapper').append(userQuery);
            $('.chat-wrapper .user-question').fadeIn(300);
            queryScrollBottom();
            setTimeout(renderAnswer, 1000);
        }else{
            $(this).parent().css('border-color','#f00');
        }
        return false;
    });

    function renderAnswer(){
        var queryLength = $('.query-detail-wrapper');
        var queryClass = '';
        if(queryLength.length){
            queryClass = queryLength.length;
        }else{
            queryClass = '0';
        };
        var renderQuery = '<div class="query-detail-wrapper" style="display:none;" data-query="'+queryClass+'">\
                            <div class="query-text-wrapper">\
                                <div class="query-placeholder">\
                                    <span class="dot dot-1"></span>\
                                    <span class="dot dot-2"></span>\
                                    <span class="dot dot-3"></span>\
                                </div>\
                            </div>\
                            <div class="other-info">\
                                <div class="chat-logo">\
                                    <img src="assets/images/avatar-chat.jpeg" alt="Avatar">\
                                </div>\
                            </div>\
                        </div>';
        $('.chat-wrapper').append(renderQuery);queryScrollBottom();
        $('.chat-wrapper .query-detail-wrapper').fadeIn(300);
        setTimeout(() => {
            $('.query-detail-wrapper[data-query="'+queryClass+'"] .query-placeholder').fadeOut();
            $('.query-detail-wrapper[data-query="'+queryClass+'"] .query-text-wrapper').html('<div class="query"></div>');
            var txt = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
            typeText(txt, '.query-detail-wrapper[data-query="'+queryClass+'"] .query');
        }, 3000);
    }

    function typeText(text, ele){
        var i = 0;
        var txt = text;
        var speed = 50;
        typeWriter();
        function typeWriter() {
            if (i < txt.length) {
                document.querySelector(ele).classList.add("typing");
                document.querySelector(ele).innerHTML += txt.charAt(i);
                i++;
                setTimeout(typeWriter, speed);
                queryScrollBottom();
            }else{
                document.querySelector(ele).classList.remove("typing");
                i = 0;
                txt = '';
            }
        }
    };

    function queryScrollBottom(){
        $(".chat-wrapper").animate({ scrollTop: $(".chat-wrapper").prop('scrollHeight') }, 50);
    }

    var chapterItem = $('.chapter-content-wrapper .chapter-detail');
    if(chapterItem.length){
        chapterLoad();
        function chapterLoad(){
            var chapterThumb = $('.chapter-thumb-list .chapter-thumb-item');
            chapterItem.each(function(index){
                var zIndex = chapterItem.length - index;
                $(this).css('z-index',zIndex);
                if(chapterItem.length == index + 1){
                    $('.chapter-content-wrapper').addClass('active');
                }
            });
            $(chapterThumb[0]).addClass('active');
            $(chapterItem[0]).addClass('active');
            $(chapterItem[1]).addClass('active');
            setTimeout(()=> {
                chapterDetailPrint($(chapterItem[0]).find('.chapter-description').data('html'), $(chapterItem[0]).find('.chapter-description'));
            }, 500);
        };
        $('.chapter-detail-footer #next, .chapter-nav .btn-next').on('click', function(){
            var chapterFlippedEle = $('.chapter-content-wrapper .chapter-detail.flipped');
            var chapterThumbActive = $('.chapter-thumb-list .chapter-thumb-item.active');
            var fllipedLastEle = $(chapterFlippedEle[chapterFlippedEle.length - 1]);
            if(chapterItem.length > 1){
                if(!chapterFlippedEle.length){
                    $(chapterItem[0]).addClass('flipped');
                    $(chapterItem[0]).next().next().addClass('active');
                    chapterThumbActive.removeClass('active').fadeOut(300).next().addClass('active').fadeIn(300);
                    $('.chapter-nav .btn-prev').removeAttr('disabled');
                    setTimeout(()=> {
                        chapterDetailPrint($(chapterItem[0]).next().find('.chapter-description').data('html'), $(chapterItem[0]).next().find('.chapter-description'));
                    }, 1000);
                    setTimeout(()=>{
                        var html = $(chapterItem[0]).find('.chapter-description').data('html');
                        $(chapterItem[0]).find('.chapter-description').remove();
                        $(chapterItem[0]).append('<div class="chapter-description" data-html="'+html+'">');
                    },1000);
                }else{
                    if(fllipedLastEle.data('chapter') != chapterItem.length - 1){
                        $('.chapter-nav .btn-prev').removeAttr('disabled');
                        fllipedLastEle.next().addClass('flipped');
                        fllipedLastEle.next().next().next().addClass('active');
                        chapterThumbActive.removeClass('active').fadeOut(300).next().addClass('active').fadeIn(300);
                        setTimeout(()=> {
                            chapterDetailPrint(fllipedLastEle.next().next().find('.chapter-description').data('html'), fllipedLastEle.next().next().find('.chapter-description'));
                        }, 1000);
                        setTimeout(()=>{
                            var html = fllipedLastEle.next().find('.chapter-description').data('html');
                            fllipedLastEle.next().find('.chapter-description').remove();
                            fllipedLastEle.next().append('<div class="chapter-description" data-html="'+html+'">');
                        },1000);
                    }else{
                        $('.chapter-detail-footer #next, .chapter-nav .btn-next').attr('disabled', 'disabled');
                    }
                }
            }
        });
        $('.chapter-detail-footer #repeat, .chapter-nav .btn-prev').on('click', function(){
            var chapterFlippedEle = $('.chapter-content-wrapper .chapter-detail.flipped');
            var chapterThumbActive = $('.chapter-thumb-list .chapter-thumb-item.active');
            var fllipedLastEle = $(chapterFlippedEle[chapterFlippedEle.length - 1]);
            if(chapterFlippedEle.length){
                $('.chapter-detail-footer #next, .chapter-nav .btn-next').removeAttr('disabled');
                fllipedLastEle.removeClass('flipped');
                fllipedLastEle.next().next().removeClass('active');
                chapterThumbActive.removeClass('active').fadeOut(300).prev().addClass('active').fadeIn(300);
                setTimeout(()=> {
                    chapterDetailPrint(fllipedLastEle.find('.chapter-description').data('html'), fllipedLastEle.find('.chapter-description'));
                }, 500);
                setTimeout(()=>{
                    var html = fllipedLastEle.next().find('.chapter-description').data('html');
                    fllipedLastEle.next().find('.chapter-description').remove();
                    fllipedLastEle.next().append('<div class="chapter-description" data-html="'+html+'">');
                },1000);
                if(fllipedLastEle.data('chapter') == 1){
                    $('.chapter-nav .btn-prev').attr('disabled', 'disabled');
                }
            }
        });


        function chapterDetailPrint(html, ele){
            $(ele).typed({
                strings: [html],
                typeSpeed: 5,
                startDelay: 0,
                backSpeed: 60,
                contentType: 'html',
                showCursor: false
            });
        }
    }


    //Sm Toggle Timeline
    var timeline = $('#view-timeline');
    if(timeline.length){
        timeline.on('click', function(){
            if($(window).width() < 768){
                $(this).closest('.tutor-main').addClass('timeline-active');
            }
        });
        $('.tutor-thumb.timeline > button.btn.btn-none').on('click', function(){
            if($(window).width() < 768){
                $(this).closest('.tutor-main').removeClass('timeline-active');
            }
        });
    }
});