"use strict";
$(document).ready(function(){

    $(".rating_tab_head a").click(function (e) {
        e.preventDefault();
        let t = $(this),
            tb = t.closest(".rating_tab").find(".rating_tab_body");
        if(!t.hasClass("active")) {
            t.siblings().removeClass("active");
            t.addClass("active");
            tb.children().removeClass('active');
            tb.children().eq(t.index()).addClass('active');
        }
    })

    $(document).click(function (e){
        if(!$(e.target).closest(".user_nav").length) {
            $(".user_nav").removeClass("active");
        }
    });
    $(".user_nav > a").click(function (e){
        e.preventDefault();
        $(this).closest(".user_nav").toggleClass("active");
        //$('.left').toggleClass('open')
    });
    $("main .mobile_toggle").click(function (e){
        e.preventDefault();
        $(this).toggleClass('active')
        $('.left').toggleClass('open')
    });
    $('.check_position').submit(function (e) {
        e.preventDefault();
        if($('.rating_body_line[data-nick="'+$(this).find('input').val().toLowerCase()+'"]').length)
        {
            var u=$('.rating_body_line[data-nick="'+$(this).find('input').val().toLowerCase()+'"]');
            $('.self_res_item').html('\n' +
                '                <p>Место <span id="self_place">'+u.data('place')+'</span></p>\n' +
                '                <p>Пригласил <span id="self_counter">'+u.data('cnt')+'</span></p>\n' +
                '                <p>Приз <span id="self_prize">'+u.data('prize')+'</span> ₽</p>\n' +
                '            ')
        }
        else
        {
            $('.self_res_item').html('<p>такого никнейма не обнаружено в рейтинге</p>')
        }
        return false;
    })

    $(document).on('click','.copy_btn',function () {
        var $tmp = $("<textarea>");
        $("body").append($tmp);
        $tmp.val($('.get_link_res p').text()).select();
        document.execCommand("copy");
        $tmp.remove();
        alert('Скопировано');
        updateTable();
    })
    $('.scrollbar-inner').each(function(){
        $(this).scrollbar();
    });

    /* js-timer */
    console.log($('#days').length)
    if($('body').data('time')&&$('#days').length)
        CountDownTimer2($('body').data('time'));

    function CountDownTimer2(dt)
    {
        var end = new Date(dt);
        console.log(end);

        let _second = 1000;
        let _minute = _second * 60;
        let _hour = _minute * 60;
        let _day = _hour * 24;
        let timer;
        function showRemaining() {
            let now = new Date();
            let distance = end - now;
            if (distance < 0) {
                end = now.setDate(now.getDate() + 1);
                distance = end - now;
            }

            let days = Math.floor(distance / _day);
            let hours = Math.floor((distance % _day) / _hour);
            let minutes = Math.floor((distance % _hour) / _minute);
            let seconds = Math.floor((distance % _minute) / _second);

            if (days<10) { days = '0' + days; }
            if (hours<10) { hours = '0' + hours; }
            if (minutes<10) { minutes = '0' + minutes; }
            if (seconds<10) { seconds = '0' + seconds; }

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
        }

        timer = setInterval(showRemaining, 1000);
    }
    /* js-timer */
    $('.get_link_form').submit(function (e) {
        e.preventDefault()
        var data=$(this).serialize()
        $.ajax({
            type: "GET", //Метод отправки
            url: "/site/link", //путь до php фаила отправителя
            data:data,
            success: function (res) {
                $('.get_link_res').css('display','block')
                $('body').append(res);
                updateTable();
            }
        });
        return false;
    })

    function updateTable()
    {
        $.ajax({
            type: "GET", //Метод отправки
            url: "/site/table", //путь до php фаила отправителя
            data: {},
            success: function (res) {
                $('.to').html(res);
                $('.scrollbar-inner').each(function(){
                    $(this).scrollbar();
                });
            }
        });
    }


    $('.remember a').click(function () {
        $(this).toggleClass('active');
        if($(this).hasClass('active'))
        {
            $(this).html('Я новый пользователь');
            $('.get_link_form .btn').html('Напомнить ссылку');
            $('.hidden_login').val(1);
        }
        else
        {
            $(this).html('У меня уже есть ссылка. Напомните');
            $('.get_link_form .btn').html('Получить ссылку');
            $('.hidden_login').val(0);
        }
    })

    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);
    if(iframe && player)
    {
        player.on('ended', function() {
            player.destroy();
        });
    }
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