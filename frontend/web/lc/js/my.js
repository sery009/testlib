$(document).ready(function () {

    $(document).on('click','.copy_ref_link',function (){
        copyLink("#link");
    })




    $(document).on('click','.lock_status',function () {
        if($(this).data('line')==1)
            $('#add_user_popup p').html('Средства будут зачислены на баланс после заполнения всех позиций <b>2-го уровня</b> вашей структуры\n' +
                '                     либо после оплаты участия в текущем раунде <b>1 Вашим рефералом</b>');
        else if($(this).data('line')==2)
            $('#add_user_popup p').html('Средства будут зачислены на баланс после заполнения всех позиций <b>3-го уровня</b> вашей структуры\n' +
                '                     либо после оплаты участия в текущем раунде <b>2 Вашими рефералами</b>');
        else if($(this).data('line')==3)
            $('#add_user_popup p').html('Средства будут зачислены на баланс после заполнения всех позиций <b>4-го уровня</b> вашей структуры\n' +
                '                    либо после оплаты участия в текущем раунде <b>3 Вашими рефералами</b>');
        else if($(this).data('line')==4)
            $('#add_user_popup p').html('Средства будут зачислены на баланс после оплаты участия в текущем раунде <b>6 Вашими рефералами</b>');
        else if($(this).data('line')==5)
            $('#add_user_popup p').html('Средства будут зачислены на баланс после оплаты участия в текущем раунде <b>24 Вашими рефералами</b>');
        else if($(this).data('line')==6)
            $('#add_user_popup p').html('Средства будут зачислены на баланс после оплаты участия в текущем раунде <b>72 Вашими рефералами</b>');
    })

    $(document).on('click','.confirm_payment_usdt',function () {
        alert('Пожалуйста ожидайте проверки транзакции');
        window.location.reload();
    })

    $(document).on('click','.confirm_payment_rub',function () {
        var form_data=new FormData();
        form_data.append('id',$(this).data('id'))
        $.ajax({
            type: "POST", //Метод отправки
            url: "/wallet/confirm", //путь до php фаила отправителя
            data: form_data,
            contentType:false,
            processData:false,
            success: function (res) {
                console.log(res);
                alert('Пожалуйста ожидайте проверки транзакции');
                window.location.reload();
            }
        });

    })
    $(document).on('click','.cancel',function () {
        $('.js-tabs-btn.active').removeClass('active')
        $('.js-tabs-item.active').removeClass('active')
    })
    $(document).on('click','.cancel2',function () {
        $('.js-tabs-btn.active').removeClass('active')
        $('.js-tabs-item.active').removeClass('active')
        $('.card_info').html('');
        let id=$(this).data('id')
        $.ajax({
            type: "GET", //Метод отправки
            url: "/wallet/cancel?id="+id, //путь до php фаила отправителя
            data: {},
            contentType:false,
            processData:false,
            success: function (res) {

            }
        });
    })


    $(".mobile_toggle").click(function (){
        $(".mobile_toggle").toggleClass("active");
        $(".left").toggleClass("open");
    });


    $('.sum_add').on('input',function () {
        var sum=$(this).val();
        $('.sum_to_get').html(sum+' ₽');

        $('.add_sum_copy').html(sum);
        sum=sum.replace(/[^0-9]/g,"")
        $('.pay_sum').html(sum*1.075+' ₽');
        var usdt_sum=sum/$(this).data('kurs');
        $('.sum_add_usdt').html(usdt_sum.toFixed(2)+' USDT')
        $('.sum_copy_text').attr('data-copy-text',usdt_sum.toFixed(2))
    })
    $('.sum_request').on('input',function () {
        var sum=$(this).val();
        sum=sum.replace(/[^0-9]/g,"")
        var usdt_sum=sum/$(this).data('kurs');
        $('.sum_request_usdt').html(usdt_sum.toFixed(2))
        $('.sum_request_rub').html((sum*0.925).toFixed(2))
    })

    $('.js-pay-usdt-btn').click(function () {
        var form_data=new FormData();
        form_data.append('sum_rub',$('.sum_add').val())
        form_data.append('sum_usd',$('.sum_add_usdt').html())
        $.ajax({
            type: "POST", //Метод отправки
            url: "/wallet/rate", //путь до php фаила отправителя
            data: form_data,
            contentType:false,
            processData:false,
            success: function (res) {
                console.log(res);
                // alert('Ваше сообщение успешно отправлено');
                //код в этом блоке выполняется при успешной отправке сообщения
            //    this1.trigger('reset');
            }
        });
    })

    $('.moneyrequest_form').submit(function (e) {
        e.preventDefault();
        var sum=$('.sum_request').val()
        sum=sum.replace(/[^0-9]/g,"")
        
        if(sum<1080)
            alert('Минимальная сумма вывода 1080 рублей')
        else
        {
            var form_data=new FormData($('.moneyrequest_form')[0]);
            $.ajax({
                type: "POST", //Метод отправки
                url: "/wallet/request", //путь до php фаила отправителя
                data: form_data,
                contentType:false,
                processData:false,
                success: function (res) {
                    res=JSON.parse(res);
                    console.log(res)
                    if(res.error)
                        alert(res.error);
                    else
                    {
                        alert(res.success)
                        window.location.reloal();
                    }
                }
            });
        }

        return false;
    })

    $('.transfer_form').submit(function (e) {
        e.preventDefault();
        var form_data=new FormData($('.transfer_form')[0]);
        $.ajax({
            type: "POST", //Метод отправки
            url: "/wallet/transfer", //путь до php фаила отправителя
            data: form_data,
            contentType:false,
            processData:false,
            success: function (res) {
                res=JSON.parse(res);
                console.log(res)
                if(res.error)
                    alert(res.error);
                else
                {
                    alert(res.success)
                    window.location.reloal();
                }
            }
        });
        return false;
    })

    $(document).on('click','.video_pop',function () {
        $('#video h4').html($(this).data('name'))
        $('#video .ifra').html($(this).data('ifra'))
        open_popup2("#video")
    })

    $(document).on('click','.game_line_item_show',function () {
        var $this=$(this)
        var id=$(this).data('id');
        var line=$(this).data('line');
        var first=$(this).data('first');
        if($(this).hasClass('active'))
        {

        }
        else
        {
            $(this).closest('.game_line').find('.active').removeClass('active')
            $(this).addClass('active')
            $(this).closest('.game_line').removeClass('first_active');
            $(this).closest('.game_line').removeClass('last_active');
            $(this).closest('.game_line').addClass('first_active')
            $(this).closest('.game_line').nextAll().remove();
            var url="/rounds/info?id="+id+"&line="+line+"&first="+first;
            if($this.closest('.game_box').data('show'))
                url+='&not_show=1';
            $.ajax({
                type: "GET", //Метод отправки
                url: url, //путь до php фаила отправителя
                success: function (res) {
                    $this.closest('.game_box').append(res)
                }
            });
        }


    })
    $(document).on('click','.js-copy-link2',function () {
        var $tmp = $("<textarea>");
        $("body").append($tmp);
        $tmp.val($(this).data('copy-text')).select();
        document.execCommand("copy");
        $tmp.remove();
    })


    let timer2 = null;
    function startTimer2() {
        var minute = 29;
        var sec = 60;
        if (timer2) {
            clearInterval(timer2);
        }
        timer2 = setInterval(function () {
            document.querySelector(".js-countdown2").innerHTML =
                minute.toString().padStart(2, "0") +
                ":" +
                sec.toString().padStart(2, "0");
            sec--;
            if (sec == 00) {
                minute--;
                sec = 60;
                if (minute == 0) {
                    minute = 5;
                }
            }
        }, 1000);
    }

    window.startTimer2 = startTimer2;

    var timer_in_process2=false

    $('.ruble_pay_card_item').click(function () {
        //if($('.transfer_info.success').length)
        //{
        //    alert("У вас имеется неоплаченная заявка на пополнение. Пожалуйста, оплатите или отмените текущую заявку для того, чтобы создать новую");
        //}
        //else
        if($('.sum_add').val()<1000)
        {
            alert('Минимальная сумма пополнения 1000 рублей')
        }
        else
        {
            $('.card_info').html('<img src="/lc/img/loader.svg" style="margin: 0 auto">');
            $('.card_info').fadeIn();
            $('.ruble_pay_cards_list .ruble_pay_card_item').removeClass('active')
            $(this).addClass('active')
            let bank=$(this).data('value')
            var form_data=new FormData();
            form_data.append('sum_rub',$('.sum_add').val())
            $.ajax({
                type: "POST", //Метод отправки
                url: "/wallet/rouble?bank="+bank, //путь до php фаила отправителя
                data: form_data,
                contentType:false,
                processData:false,
                success: function (res) {
                    //console.log(res);
                    //$('.card_info').html(res);
                    //startTimer2();
                    //timer_in_process2=true;
                    window.location=res
                }
            });
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



})

function open_popup2(e) {
    $(".black_layout").fadeIn(200);
    var st = $(window).scrollTop();
    // if (popup_arr.length) {
    //     $(popup_arr[popup_arr.length - 1]).fadeOut(200);
    // }
    // $(e).css("top", st + "px").fadeIn(200);
    $(e).fadeIn(200);
    // popup_arr.push(e);
    // $(".page_wrapper").css( "cssText", "filter: blur(8px); overflow: hidden; position: relative; height: 100%; padding-right:"+getScrollbarWidth()+"px" );

}

function copyLink(el) {
    var $tmp = $("<textarea>");
    $("body").append($tmp);
    $tmp.val($(el).text()).select();
    document.execCommand("copy");
    $tmp.remove();
}