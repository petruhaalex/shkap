$(document).ready(function(){

// main slider

    if($("#owl-demo").length > 0){
        $("#owl-demo").owlCarousel({

            navigation : true,
            slideSpeed : 1000,
            paginationSpeed : 1000,
            singleItem:true
        });
    }

// custom selects

    if($('select').length > 0){
        $('.circle-select').selectbox({
//            onOpen: function () {
//                $('.sbToggleOpen').parent('.sbHolder').css('z-index','2')
//            },
//            onClose: function () {
//                $('.sbToggleOpen').parent('.sbHolder').css('z-index','1')
//            }
        });
    }

// custom scroll

    if($('.select-field').length > 0){
        $('.select-field .sbOptions').mCustomScrollbar({
            theme:"minimal-dark"
        });
    }

// custom scroll

    $('.sort .customSort span').click(function(){
        $(this).toggleClass('up')
    })

// columns with height

    function blockHeight(block){
        var startheight = 0
        block.find('li').each(function(){
            if($(this).height() > startheight){
                startheight = $(this).height()
            }
        })
        block.find('li').height(startheight)
    }
    blockHeight($('.likes > ul'))
    blockHeight($('.popular'))
    $('.oneSection').each(function(){
        var neededList = $(this).find('ul');
        blockHeight(neededList)
    })

// add slider to favorites

    if($('.popular').length > 0){
        $('.popular').carouFredSel({
            responsive: true,
            width: '100%',
            scroll: 2,
            items: {
                visible: {
                    min: 1,
                    max: 4
                }
            },
            prev: '.fred-prev',
            next: '.fred-next',
            auto: false
        });
    }

// resize to parent images

    $('.img-box img').resizeToParent({parent: '.img-box'});

// show-hide pics

    $('.messagePics > span').click(function(){
        $(this).parent('.messagePics').find('span').toggleClass('active')
        $(this).parent('.messagePics').find('ul').slideToggle(300)
    })

// input file

    var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;
    var inp = $('.your-comment .file input')
    var spn = $('.your-comment .file span')
    inp.change(function(){
        var file_name;
        if( file_api && inp[ 0 ].files[ 0 ] )
            file_name = inp[ 0 ].files[ 0 ].name;
        else
            file_name = inp.val().replace('Прикрепить фото');
        if( ! file_name.length )
            return;
        spn.text(file_name)
    }).change();

// show gallery

    $('li').click(function(){
        if($(this).parents('.showGallery').length > 0){
            var ELnubmer = $(this).parents('.showGallery').find('li').index($(this))
            var list = $(this).parents('.showGallery').clone();
            $('#gallery').show()
            $('#gallery .gallery-box').append(list)
            $("#gallery ul").PikaChoose({
                carousel:true,
                autoPlay:false,
                startOn:ELnubmer
            });
            $('#gallery').animate({'opacity':'1'},400)
            var scrollTOP = $(window).scrollTop();
            $('html,body').css('overflow','hidden')
            $(window).scroll(function(){
                $(window).scrollTop(scrollTOP)
            })
        }
    })
    $('#gallery span.close').click(function(){
        $('#gallery').animate({'opacity':'0'},300,function(){
            $('#gallery .gallery-box').html('')
            $('#gallery').hide()
            $('html,body').css('overflow','visible')
            $(window).unbind('scroll')
        })

    })

// show registration

    $('.user-enter').click(function(e){
        e.preventDefault();
        $('.reg-enter').show()
        $('#register').show()
        $('#register').animate({'opacity':'1'},400)
        var scrollTOP = $(window).scrollTop();
        $('html,body').css('overflow','hidden')
        $(window).scroll(function(){
            $(window).scrollTop(scrollTOP)
        })
    })
    $('.link-to-pass').click(function(e){
        e.preventDefault();
        $('#register .register-box').animate({opacity:0},'100',function(){
            $('#register .register-box form').hide()
            $('.reg-password').show()
            $('#register .register-box').animate({opacity:1},'300')
        })
    })
//    $('.user-registr').click(function(e){
//        e.preventDefault();
//        $('.reg-registr').show()
//        $('#register').show()
//        $('#register').animate({'opacity':'1'},400)
//        var scrollTOP = $(window).scrollTop();
//        $('html,body').css('overflow','hidden')
//        $(window).scroll(function(){
//            $(window).scrollTop(scrollTOP)
//        })
//    })
    $('#register span.close').click(function(){
        $('#register').animate({'opacity':'0'},300,function(){
            $('#register').hide()
            $('#register .register-box form').hide()
            $('html,body').css('overflow','visible')
            $(window).unbind('scroll')
        })

    })

// letter show

    $('.updownletter').click(function(){
        $('.freeletter').toggleClass('active')
        $('.freeletter section .hidden-box').slideToggle(500)
    })

// catalog menu

    $('.catalog-menu').click(function(){
        if($('.hidden_menu').hasClass('passive') == true){
            $('.catalog-menu').addClass('active')
            $('.hidden_menu .sidebar_menu').slideDown('300',function(){
                $('.attached .catalog-menu > span').addClass('closemenu')
            })
            $('.hidden_menu').removeClass('passive')
        }

        $('.closemenu').click(function(){
            $('.hidden_menu .sidebar_menu').slideUp(200, function(){
                $('.attached .catalog-menu > span').removeClass('closemenu')
                $('.hidden_menu').addClass('passive')
                $('.catalog-menu').removeClass('active')
            })
        })
    })
    $(document).click(function(e){
        var target = $(e.target)
        if(target.parents('.catalog-menu').length < 1){
            $('.hidden_menu .sidebar_menu').slideUp(100)
            $('.hidden_menu').addClass('passive')
            $('.catalog-menu').removeClass('active')
            $('.attached .catalog-menu > span').removeClass('closemenu')
        }
    })

// accordeon faq

    $('.faqBox section header').click(function(){
        if($(this).parent().hasClass('active')){
            $('.faqBox section').removeClass('active')
            $('.faqBox section article').slideUp(100)
        }
        else {
            $('.faqBox section').removeClass('active')
            $('.faqBox section article').slideUp(100)
            $(this).parent().addClass('active')
            $(this).siblings('article').slideDown(400)
        }

    })


// checks in basket

    function checks(){
        var checkCount = 0
        var checkboxCount = 0
        $('.chck-test').each(function(){
            checkboxCount++
            if($(this).find('input[type="checkbox"]').prop('checked') == true){
                checkCount++
            }
        })
        $('.deleteTable a span').text(checkCount)
        if(checkboxCount == checkCount){
            $('.chck-all').find('input[type="checkbox"]').attr('checked',true)
        }
        else {$('.chck-all').find('input[type="checkbox"]').attr('checked',false)}
    }
    $('.chck-all').find('input[type="checkbox"]').change(function(){
        if($(this).prop('checked')){
            $('.chck-test').each(function(){
                $(this).find('input[type="checkbox"]').attr('checked',true)
            })
        }
        else{
            $('.chck-test').each(function(){
                $(this).find('input[type="checkbox"]').attr('checked',false)
            })
        }
    })

    if($('.fullbasket').length > 0){
        checks()
        $('.tableCheking').find('input[type="checkbox"]').change(function(){
            checks()
        })
    }





})