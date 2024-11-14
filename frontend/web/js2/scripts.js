$(document).ready(function() { 
    $(document).on('click','.partners_table a',function () {
        if($(this).hasClass('active'))
        {
            $(this).removeClass('active');
            $(this).closest('.dt_line').next('.parts').slideUp()
        }
        else
        {
            $(this).addClass('active');
            if($(this).hasClass('already'))
            {
                $(this).closest('.dt_line').next('.parts').slideDown()
            }
            else
            {
                $(this).addClass('already');
                var th=$(this);
                var v=$(this).data('id');
                var line=$(this).closest('.dt_line').data('line');
                $.ajax(
                    {
                        'type': 'GET',
                        'beforeSend': function (e, u) {

                        },
                        'url': '/user/partners_ajax?id=' + v +"&line="+line,
                        'cache': false,
                        'data': '',
                        'success': function (html) {
                            th.closest('.dt_line').after(html);
                        }
                    });
            }

        }

    })
// Profile popup
var pp = window.matchMedia('all and (max-width: 800px)');
if (pp.matches) {
    $(".tp_profile").click(function(e) {
		    $('.nav_popup').slideToggle('fast');
		    e.preventDefault();
		});

		//central content pusher		
} else {
	// $(".left_panel").hover(function() {
	// 	    $('.main_content').toggleClass('l_opened');
	// });
}

//nav popup
$(".nav>li.pop > a").click(function(e) {
    $(this).closest('li').children('ul').slideToggle('fast');
    //e.preventDefault();
    $(this).toggleClass('opened');
});

//mobile menu
$(".burger").on('click', function() {
        $(this).toggleClass('opened');
    $(".left_panel").slideToggle(00, function() {
        if ($(this).css('display') === 'none') {
            $(this).removeAttr('style');
        }
    });
});


//ct_text_popup
$(".ct_more").click(function(e) {
    $(this).siblings('.ct_text_popup').slideDown('fast');
    $(this).hide();
    e.preventDefault();
});


//pro_contribution
    $(".pro_contribution > span").click(function() {
    $(".pro_contribution > span").removeClass('selected');
    $(this).addClass('selected');
    $('input[name=vznos]').val($(this).data('vznos'))
        if($(this).data('vznos')==30)
        {
            $('.date_cc').html('210 дней');
            $('.sum_cc').html(parseInt($('input[name=sum]').val()*0.3)+" RGM");
        }
        else if($(this).data('vznos')==40)
        {
            $('.date_cc').html('160 дней');
            $('.sum_cc').html(parseInt($('input[name=sum]').val()*0.4)+" RGM");
        }
        else if($(this).data('vznos')==50)
        {
            $('.date_cc').html('120 дней');
            $('.sum_cc').html(parseInt($('input[name=sum]').val()*0.5)+" RGM");
        }
});
//m_table_mob
    $(".mtm_head").click(function() {
        $(this).siblings('.mtm_popup').slideToggle('fast');
        $(this).toggleClass('opened');
    });
//pro_choices
    $(".pro_choices > i").click(function() {
    $(".pro_choices > i").removeClass('selected');
    $(this).addClass('selected');
    $('input[name=condition]').val($(this).data('condition'))
});


//styled scrolls
$(".lp_content").niceScroll({cursorcolor:"#ffffff", cursorwidth : "6px", cursorborderradius:"4px"  });
$(".d_table, .m_table, .a_table, .pro_table").niceScroll({cursorcolor:"#DFDFDF", cursorwidth : "6px", autohidemode: false });

//radiobox check
$('input[name="radio"]').click(function(e) {
    if ($('#rsecond').is(':checked')){
        $('.t_btn.next').addClass('disabled');        
    } else {
        $('.t_btn.next').removeClass('disabled');
    }
});


//Timer
function get_timer(string) {
    var date_new = string;
    var date_x = new Date(date_new);
    var date = new Date();
    var timer = date_x - date;
    if (date_x > date) {
        var day = parseInt(timer / (60 * 60 * 1000 * 24));
        if (day < 10) { day = "0" + day; } day = day.toString();
        var hour = parseInt(timer / (60 * 60 * 1000)) % 24;
        if (hour < 10) { hour = "0" + hour; } hour = hour.toString();
        var min = parseInt(timer / (1000 * 60)) % 60;
        if (min < 10) { min = "0" + min; } min = min.toString();
        var sec = parseInt(timer / 1000) % 60;
        if (sec < 10) { sec = "0" + sec; } sec = sec.toString();
        timethis = day + " : " + hour + " : " + min + " : " + sec;
        $(".x-day").text(day);
        $(".x-hour").text(hour);
        $(".x-minute").text(min);
        $(".x-second").text(sec);
    } else {
        $(".x-day").text("00");
        $(".x-hour").text("00");
        $(".x-minute").text("00");
        $(".x-second").text("00");
    }
}
function timer_x() {
    string = $('body').data('goal_time');//"08/30/2021 00:00"; // "месяц/число/год час:мин"
    get_timer(string);
    setInterval(function() { get_timer(string); }, 1000);
}
$(document).ready(function() { timer_x(); });

$('#verification_type').change(function () {
    checkVer()
})
    checkVer();
function checkVer()
{
    if($('#verification_type').val()=='Паспорт')
    {
        $('.zgr_fields').hide();
        $('.pass_fields').show();
    }
    else
    {
        $('.zgr_fields').show();
        $('.pass_fields').hide();
    }
}
/*
//passport_select
$('.ps_head').click(function () {
    $('.ps_list').toggleClass('visible');
});
$('#pasp').click(function () {
    $('.ps_list').toggleClass('visible');
    $('.zagran_fields').hide();
    $('.pasp_fields').show();
});
$('#zagran').click(function () {
    $('.ps_list').toggleClass('visible');
    $('.zagran_fields').show();
    $('.pasp_fields').hide();
});
*/

//modal
$('[data-modal=modal]').click(function(e) {
    e.preventDefault();
    var id = $(this).attr('data-pop');
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    $('.mask').css({'width':maskWidth,'height':maskHeight});
    $('.mask').fadeIn(0);
    var winH = $(window).height();
    var winW = $(window).width();
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);
    $(id).fadeIn(200);
});
$('.window .close').click(function (e) {
    e.preventDefault();
    $('.mask, .window').hide();
});
$('.mask').click(function () {
    $('.mask').hide();
    $('.window').hide();
});



});


$(document).ready(function() {
    if($('.i2_slider').length)
    {
        var inputs,
            slider = $('.i2_slider').slider({
                // range: true,
                min: 1000,
                max: 1000000,
                // values: [0, 50000],
                slide: function(event, ui) {


                    inputs.eq(ui.handleIndex).val(ui.value);
                    if($('#btc_invest').length)
                    {
                        var v=ui.value/$('#btc_invest').data('rate')
                        $('#btc_invest').html(v.toFixed(8))
                    }
                    if($('.sum_cc').length)
                    {
                        $('.sum_cc').html(ui.value+' RGM')
                    }

                }
            });
        $( "input[name=sum]" ).on( "input", function() {
            slider.slider( "value", $(this).val() );
            if($('#btc_invest').length)
            {
                var v=$(this).val()/$('#btc_invest').data('rate')
                $('#btc_invest').html(v.toFixed(8))
            }
            if($('.sum_cc').length)
            {
                $('.sum_cc').html($(this).val()*$('input[name=vznos]').val()/100+' RGM')
            }
        });
        inputs = $('.i2s_input').on('.i2s_input', function(){
            var values = inputs.map(function(i, el){
                var v = +$(el).val();
                return isNaN(v) ? 0 : v;
            }).get();
            slider.slider('values', values);
        });
    }
    if($('.i3_slider').length)
    {
        var inputs,
            slider = $('.i3_slider').slider({
                // range: true,
                min: 1000,
                max: 400000,
                // values: [0, 50000],
                slide: function(event, ui) {


                    inputs.eq(ui.handleIndex).val(ui.value);
                    if($('#btc_invest').length)
                    {
                        var v=ui.value/$('#btc_invest').data('rate')
                        $('#btc_invest').html(v.toFixed(8))
                    }
                    if($('.sum_cc').length)
                    {
                        $('.sum_cc').html(ui.value*$('input[name=vznos]').val()/100+' RGM')
                    }

                }
            });
        $( "input[name=sum]" ).on( "input", function() {
            slider.slider( "value", $(this).val() );
            if($('#btc_invest').length)
            {
                var v=$(this).val()/$('#btc_invest').data('rate')
                $('#btc_invest').html(v.toFixed(8))
            }
            if($('.sum_cc').length)
            {
                $('.sum_cc').html($(this).val()*$('input[name=vznos]').val()/100+' RGM')
            }
        });

        inputs = $('.i2s_input').on('.i2s_input', function(){
            var values = inputs.map(function(i, el){
                var v = +$(el).val();
                return isNaN(v) ? 0 : v;
            }).get();
            slider.slider('values', values);
        });
    }
    if($('.i4_slider').length)
    {
        var inputs,
            slider = $('.i4_slider').slider({
                // range: true,
                min: 10000,
                max: 1500000,
                // values: [0, 50000],
                slide: function(event, ui) {


                    inputs.eq(ui.handleIndex).val(ui.value);

                    if($('.sum_cc').length)
                    {
                        $('.sum_cc').html(ui.value*$('input[name=vznos]').val()/100+' RGM')
                    }

                }
            });
        $( "input[name=sum]" ).on( "input", function() {
            slider.slider( "value", $(this).val() );

            if($('.sum_cc').length)
            {
                $('.sum_cc').html($(this).val()*$('input[name=vznos]').val()/100+' RGM')
            }
        });
        inputs = $('.i2s_input').on('.i2s_input', function(){
            var values = inputs.map(function(i, el){
                var v = +$(el).val();
                return isNaN(v) ? 0 : v;
            }).get();
            slider.slider('values', values);
        });
    }

    if($('.i5_slider').length)
    {
        var inputs,
            slider = $('.i5_slider').slider({
                // range: true,
                min: 100,
                max: 20000,
                // values: [0, 50000],
                slide: function(event, ui) {


                    inputs.eq(ui.handleIndex).val(ui.value);

                    if($('.sum_cc').length)
                    {
                        $('.sum_cc').html(ui.value*$('input[name=vznos]').val()/100+' RGM')
                    }

                }
            });
        $( "input[name=sum]" ).on( "input", function() {
            slider.slider( "value", $(this).val() );

            if($('.sum_cc').length)
            {
                $('.sum_cc').html($(this).val()*$('input[name=vznos]').val()/100+' RGM')
            }
        });
        inputs = $('.i2s_input').on('.i2s_input', function(){
            var values = inputs.map(function(i, el){
                var v = +$(el).val();
                return isNaN(v) ? 0 : v;
            }).get();
            slider.slider('values', values);
        });
    }

    if($('#total').length)
    {
        var sum=0;
        $('.sum_changed').each(function () {
            if(parseFloat($(this).val()))
                sum+=parseFloat($(this).val());
        })
        $('#total').html(sum)
    }
    $('.sum_changed').on('input',function () {
        var sum=0;
        $('.sum_changed').each(function () {
            if(parseFloat($(this).val()))
                sum+=parseFloat($(this).val());
        })
        $('#total').html(sum)
    })

    if($("#datepicker").length)
    {
        $(function() {
            $("#datepicker").datepicker({dateFormat: "dd mm yy"});;
        });
    }

    $('.confirm_stop_invest').click(function (e) {
        e.preventDefault();
        var p=$(this).attr('href');
        console.log(p);
        if(confirm('Вы уверены что хотите закрыть пакет?'))
            window.location=p;
        return false;
    })

    $('.confirm_form').submit(function () {
        return confirm('Ты уверен что хочешь открыть раунд? ');
    })

    $('.confirm_form2').submit(function () {
        return confirm('Ты уверен что хочешь активировать? ');
    })

    $('.confirm_form3').submit(function () {
        return confirm('Ты уверен что хочешь перевести? ');
    })

    $('.tab_div').click(function () {
        $('.tab_div.selected').removeClass('selected');
        $(this).addClass('selected')
        $('.account_transactions .a_table').css('display','none');
        $('.account_transactions .a_table'+$(this).data('tab_div')).css('display','block');
    })

    $('.from_t2,.to_t1').click(function () {
        $('.ggg.active').removeClass('active');
        $('.from_t1').addClass('active')
        $('.to_t2').addClass('active')
        $('#type_from').val('rgm')
    })
    $('.from_t1,.to_t2').click(function () {
        $('.ggg.active').removeClass('active');
        $('.from_t2').addClass('active')
        $('.to_t1').addClass('active')
        $('#type_from').val('lgm')
    })


});


//Coutry autocomplete
$( function() {
    $.widget( "custom.combobox", {
        _create: function() {
            this.wrapper = $( "<span>" )
                .addClass( "custom-combobox" )
                .insertAfter( this.element );

            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },

        _createAutocomplete: function() {
            var selected = this.element.children( ":selected" ),
                value = selected.val() ? selected.text() : "";

            this.input = $( "<input>" )
                .appendTo( this.wrapper )
                .val( value )
                .attr( "title", "" )
                .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: $.proxy( this, "_source" )
                })
                .tooltip({
                    classes: {
                        "ui-tooltip": "ui-state-highlight"
                    }
                });

            this._on( this.input, {
                autocompleteselect: function( event, ui ) {
                    ui.item.option.selected = true;
                    this._trigger( "select", event, {
                        item: ui.item.option
                    });
                },

                autocompletechange: "_removeIfInvalid"
            });
        },

        _createShowAllButton: function() {
            var input = this.input,
                wasOpen = false;

            $( "<a>" )
                .attr( "tabIndex", -1 )
                .tooltip()
                .appendTo( this.wrapper )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })
                .removeClass( "ui-corner-all" )
                .addClass( "custom-combobox-toggle ui-corner-right" )
                .on( "mousedown", function() {
                    wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                })
                .on( "click", function() {
                    input.trigger( "focus" );

                    // Close if already visible
                    if ( wasOpen ) {
                        return;
                    }

                    // Pass empty string as value to search for, displaying all results
                    input.autocomplete( "search", "" );
                });
        },

        _source: function( request, response ) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
            response( this.element.children( "option" ).map(function() {
                var text = $( this ).text();
                if ( this.value && ( !request.term || matcher.test(text) ) )
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }) );
        },

        _removeIfInvalid: function( event, ui ) {

            // Selected an item, nothing to do
            if ( ui.item ) {
                return;
            }

            // Search for a match (case-insensitive)
            var value = this.input.val(),
                valueLowerCase = value.toLowerCase(),
                valid = false;
            this.element.children( "option" ).each(function() {
                if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                    this.selected = valid = true;
                    return false;
                }
            });

            // Found a match, nothing to do
            if ( valid ) {
                return;
            }

            // Remove invalid value
            this.input
                .val( "" )
                .attr( "title", value + " - Нет такой страны" )
                .tooltip( "open" );
            this.element.val( "" );
            this._delay(function() {
                this.input.tooltip( "close" ).attr( "title", "" );
            }, 2500 );
            this.input.autocomplete( "instance" ).term = "";
        },

        _destroy: function() {
            this.wrapper.remove();
            this.element.show();
        }
    });

    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
        $( "#combobox" ).toggle();
    });

   /* $('select#car_brand').change(function () {
        var v=$(this).val();
        $.ajax(
            {
                'type': 'GET',
                'beforeSend': function (e, u) {

                },
                'url': '/program/models?brand=' + v ,
                'cache': false,
                'data': '',
                'success': function (html) {
                    $('#car_model').html(html);
                    $('.selectbox').remove();
                    rebuildSelect();
                }
            });
    })*/
    $('.check_min_sum').submit(function (e) {
        if($(this).find('input[name=sum]').val()<$(this).data('min'))
        {
            e.preventDefault();
            alert('Минимальная сумма '+$(this).data('min')+' RGM')
            return false;
        }
        else if($(this).find('input[name=sum]').val()>$(this).data('max'))
        {
            e.preventDefault();
            alert('Максимальная сумма '+$(this).data('max2')+' RGM')
            return false;
        }

    })

    $('.faq_item a').click(function () {
        if ($(this).closest('.faq_item').hasClass('active')) {
            $(this).closest('.faq_item').removeClass('active')
            $(this).closest('.faq_item').find('.answer').slideUp();
        } else {
            $(this).closest('.faq_item').addClass('active')
            $(this).closest('.faq_item').find('.answer').slideDown();
        }
    })
} );

function rebuildSelect() {
    $('select.selectBlock').each(function() {

        var option = $(this).find('option');
        var optionSelected = $(this).find('option:selected');
        var dropdown = '';
        var selectText = $(this).find('option:first').text();
        if (optionSelected.length) selectText = optionSelected.text();

        for (i = 0; i < option.length; i++) {
            var selected = '';
            var disabled = ' class="disabled"';
            if ( option.eq(i).is(':selected') ) selected = ' class="selected sel"';
            if ( option.eq(i).is(':disabled') ) selected = disabled;
            dropdown += '<li' + selected + '>'+ option.eq(i).text() +'</li>';
        }

        $(this).before(
            '<span class="selectbox" style="display: inline-block; position: relative">'+
            '<span class="select" style="float: left; position: relative; z-index: 0"><span class="text">' + selectText + '</span>'+
            '<b class="trigger"></b>'+
            '</span>'+
            '<ul class="dropdown" style="position: absolute; z-index: 1; overflow: auto; overflow-x: hidden; list-style: none">' + dropdown + '</ul>'+
            '</span>'
        ).css({position: 'absolute', left: -9999});

        var ul = $(this).prev().find('ul');
        var selectHeight = $(this).prev().outerHeight();
        if ( ul.css('left') == 'auto' ) ul.css({left: 0});
        if ( ul.css('top') == 'auto' ) ul.css({top: selectHeight});
        var liHeight = ul.find('li').outerHeight();
        var position = ul.css('top');
        ul.hide();

        $(this).prev().find('span.select').click(function() {

            var topOffset = $(this).parent().offset().top;
            var bottomOffset = $(window).height() - selectHeight - (topOffset - $(window).scrollTop());
            if (bottomOffset < 0 || bottomOffset < liHeight * 6)	{
                ul.height('auto').css({top: 'auto', bottom: position});
                if (ul.outerHeight() > topOffset - $(window).scrollTop() - 20 ) {
                    ul.height(Math.floor((topOffset - $(window).scrollTop() - 20) / liHeight) * liHeight);
                }
            } else if (bottomOffset > liHeight * 6) {
                ul.height('auto').css({bottom: 'auto', top: position});
                if (ul.outerHeight() > bottomOffset - 20 ) {
                    ul.height(Math.floor((bottomOffset - 20) / liHeight) * liHeight);
                }
            }

            $('span.selectbox').css({zIndex: 1}).removeClass('focused');
            if ( $(this).next('ul').is(':hidden') ) {
                $('ul.dropdown:visible').hide();
                $(this).next('ul').show();
            } else {
                $(this).next('ul').hide();
            }
            $(this).parent().css({zIndex: 2});
            return false;
        });

        $(this).prev().find('li:not(.disabled)').hover(function() {
            $(this).siblings().removeClass('selected');
        })
            .click(function() {
                $(this).siblings().removeClass('selected sel').end()
                    .addClass('selected sel').parent().hide()
                    .prev('span.select').find('span.text').text($(this).text())
                ;
                option.removeAttr('selected').eq($(this).index()).attr({selected: 'selected'});
                $(this).parents('span.selectbox').next().change();
            });

        $(this).focus(function() {
            $('span.selectbox').removeClass('focused');
            $(this).prev().addClass('focused');
        })
            .keyup(function() {
                $(this).prev().find('span.text').text($(this).find('option:selected').text()).end()
                    .find('li').removeClass('selected sel').eq($(this).find('option:selected').index()).addClass('selected sel')
                ;
            });

    });


}


