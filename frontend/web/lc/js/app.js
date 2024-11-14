"use strict";
$(document).ready(function(){
    $('.show_info').click(function () {
        var id=$(this).data('id');
        if($('#info_'+id).length)
        {
            open_popup('#info_'+id)
        }
        else
        {
            var form_data=new FormData();
            form_data.append('id',id)
            $.ajax({
                type: "POST", //Метод отправки
                url: "/wallet/info", //путь до php фаила отправителя
                data: form_data,
                contentType:false,
                processData:false,
                success: function (res) {
                    $('body').append(res)
                    open_popup('#info_'+id)
                }
            });
        }

    })

    $(document).click(function (e){
        if(!$(e.target).closest(".hold_select").length) {
            $(".hold_select_body").removeClass("active");
        }

    });
    $(".hold_select > p ").click(function (){
        $(".hold_select_body").toggleClass('active');
    });
    $(".hold_select_body li").click(function (){
        let tt = $(this).text();
        let ti = $(this).index();
        $(this).closest(".hold_select").children("p").text(tt);
        $(".hold_select_body").removeClass("active");
        if(!$(".hold_body_item ").eq(ti).hasClass("active")) {
            $(".hold_body_item ").removeClass('active');
            $(".hold_body_item ").eq(ti).addClass("active");
        }

    })
    const ms = $('.study_slider');
    ms.each(function () {
        let t = $(this);
        t.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true
        });
        t.on('beforeChange', function(event, slick, currentSlide, nextSlide){
            let ciframe = $(t.slick('getSlick').$slides[currentSlide]).find("iframe");
            if(ciframe[0]) {
                let cp = new Vimeo.Player(ciframe);
                cp.pause();
            }

            let niframe = $(t.slick('getSlick').$slides[nextSlide]).find("iframe");
            if(niframe[0]) {
                let cp = new Vimeo.Player(niframe);
                //cp.play();

            }

        });
    })
    // $('iframe').each(function () {
    //     var th=$(this);
    //     let cp = new Vimeo.Player($(this));
    //     cp.getDuration().then(function(duration) {
    //         th.closest('.study_slide').find('.duration').html('Длительность: '+Math.floor(duration/60)+'м '+duration%60+'с');
    //         //console.log(duration)
    //         // duration = the duration of the video in seconds
    //     }).catch(function(error) {
    //         //console.log(error)
    //     });
    // })

    $(".ruble_pay_card_item").click(function (){
        if(!$('.transfer_info.success').length)
        {
            let t = $(this);
            if(!t.hasClass("active")) {
                let nc = t.data("class");
                $(".ruble_pay_card_item").removeClass("active");
                t.addClass("active");
                if(nc) {
                    $(".card_wrap").attr("class", "card_wrap "+nc );
                }
                else {
                    $(".card_wrap").attr("class", "card_wrap");
                }
            }
        }

    })

    $(".toggle_wrap .toggle").click(function (e) {
        e.preventDefault();
        let t = $(this),
            ti = $(this).index();
        if(!t.hasClass("active")){
            $(".toggle").removeClass("active");
            t.addClass("active");
            $(".game_box").removeClass("active");
            $(".game_box").eq(ti).addClass("active");
        }

    })

    $(document).on('click',".game_line_item",function (){
        let t = $(this),
            ti = $(this).index(),
            tc = t.closest(".game_line"),
            tcn = t.closest(".game_line").next(".game_line");
        if(!t.hasClass("active") && (tc.hasClass("active") || tc.index() === 0) && !t.hasClass("empty")) {
            t.siblings().removeClass("active");
           // t.addClass("active");
            tc.removeClass("first_active");
            tc.removeClass("last_active");
            tc.addClass("active");
            tc.nextAll(".game_line").removeClass("active");
            tc.next(".game_line").addClass("active");
            tcn.find(".game_line_item").removeClass("active");
            if(ti === 0 && !t.hasClass("about")) {
                tc.addClass("first_active");
            }
            else if (ti === 2 && !t.hasClass("about")){
                tc.addClass("last_active");
            }
            else {}
        }
        else {

            if(t.hasClass("active") ) {
                var id=$(this).data('id');
                if($("#user_popup_"+id).length)
                {
                    open_popup("#user_popup_"+id);
                }
                else
                {
                    $.ajax({
                        type: "GET", //Метод отправки
                        url: "/rounds/modal?id="+id, //путь до php фаила отправителя
                        success: function (res) {
                            $('body').append(res)
                            open_popup("#user_popup_"+id);
                        }
                    });
                }



            }
            else {
                // if(tc.hasClass("active") && t.hasClass("empty") && t.siblings().length > 0) {
                //     open_popup("#add_user_popup")
                // }
            }

        }
    });


    let popup_arr = [];
    let st;

    $(document).on("click", ".popup_open", function (e) {
        e.preventDefault();
        open_popup($(e.target)[0].attributes["href"].nodeValue);
    });
    $(document).on("click", ".close_popup,.close_btn", function (e) {
        e.preventDefault();
        close();
    });
    $(document).on("click", ".back_popup,.back_btn", function (e) {
        e.preventDefault();
        back();
    });

    $(".black_layout,.popup_wrapper").mousedown(function (e) {
        if ($(e.target).closest(".popup").length) return 0;
        else close();
    });

    function open_popup(e) {
        $(".black_layout").fadeIn(200);
        st = $(window).scrollTop();
        if (popup_arr.length) {
            $(popup_arr[popup_arr.length - 1]).fadeOut(200);
        }
        // $(e).css("top", st + "px").fadeIn(200);
        $(e).fadeIn(200);
        popup_arr.push(e);
        // $(".page_wrapper").css( "cssText", "filter: blur(8px); overflow: hidden; position: relative; height: 100%; padding-right:"+getScrollbarWidth()+"px" );

    }

    function close() {
        $(".page_wrapper").removeAttr('style');
        $(".black_layout").fadeOut(200);
        $(".popup_wrapper").fadeOut(200);
       // $("html,body").scrollTop(st);
        popup_arr = [];
    }

    function back() {
        $(popup_arr[popup_arr.length - 1]).fadeOut(200);
        popup_arr.splice(-1, 1);
        if (popup_arr.length) {
            $(popup_arr[popup_arr.length - 1]).fadeIn(200);
        }
    }

    $(".form").submit(function() {
        var this1= $(this);
        var form_data = $(this).serialize(); //собераем все данные из формы
        if (is_empty(this1)){
            $.ajax({
                type: "POST", //Метод отправки
                url: "php/mail.php", //путь до php фаила отправителя
                data: form_data,
                success: function (res) {
                    console.log(res);
                    // alert('Ваше сообщение успешно отправлено');
                    //код в этом блоке выполняется при успешной отправке сообщения
                    this1.trigger('reset');
                }
            });
        }
        else {
            alert("Все поля обязательны к заполенению")
        }
        return false;
    });
    $('.form input[type="text"]').focus(function(){
        if($(this).hasClass('invalid')){
            $(this).removeClass('invalid');
        }
    });

});

function is_empty(elem){
    var a;
    elem.find('.req').each(function(){
        if($(this).val().length==0 || !$(this).val().replace(/\s+/g, '')) {
            $(this).addClass('invalid');
            a = 0;
        }
        else if($(this).hasClass("phone") && $(this).val().length!=17) {
            $(this).addClass('invalid');
            a = 0;
        }
        else if($(this).hasClass("mail") && !validateEmail($(this).val())) {
            $(this).addClass('invalid');
            a = 0;
        }
        else $(this).removeClass('invalid');
    });
    if (a!=0) a = 1;
    return a;
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}


function getScrollbarWidth() {
    var outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.width = "100px";
    outer.style.msOverflowStyle = "scrollbar";
    document.body.appendChild(outer);
    var widthNoScroll = outer.offsetWidth;
    outer.style.overflow = "scroll";
    var inner = document.createElement("div");
    inner.style.width = "100%";
    outer.appendChild(inner);
    var widthWithScroll = inner.offsetWidth;
    outer.parentNode.removeChild(outer);
    return widthNoScroll - widthWithScroll;
}