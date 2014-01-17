</div>

<footer class="padded clearfix">
    <ul class="clearfix">
        <li><a href="mailto:kyle@kyleconrad.com">Email</a></li>
        <li><a href="http://www.twitter.com/kyle_conrad" target="_blank">Twitter</a></li>
        <li><a href="http://blog.kyleconrad.com" target="_blank">Tumblr</a></li>
        <li><a href="http://instagram.com/kyle_conrad" target="_blank">Instagram</a></li>
    </ul>
</footer>

<script type="text/javascript">
    jQuery(function($) {
        if (navigator.userAgent.match(/mobile/i)) {
            $('body').addClass('mobile');
        }
        else {
            $('body').addClass('desktop');
        }

        $('body').djax('.ajax', ['#']);

        FastClick.attach(document.body);

        loadPage();

        $(document).scroll(function(){
            if ($(window).scrollTop() >= ($('nav').outerHeight()-55)) {
                $('#nav-container').addClass('fixed');
            }
            else {
                $('#nav-container').removeClass('fixed');
            }
        });
        $('#menu-button').click(function(){
            $('#sub-nav, #menu-button').toggleClass('active');
            return false;
        });
        $('#sub-nav a').click(function(){
            $('#sub-nav, #menu-button').removeClass('active');
        });

        NProgress.configure({
            showSpinner: false
        });

        $(window).bind('djaxClick', function(e, data) {
            $('#nav-container, #menu-button').removeClass('active');
            NProgress.start();
            $('#container').addClass('hidden');
            $.scrollTo('nav', {duration:400, axis:'y'});
        });
        $(window).bind('djaxLoad', function(e, data) {
            _gaq.push(['_trackPageview']);
            $('#nav-container, #menu-button').removeClass('active');
            NProgress.done();
            loadPage();
            setTimeout(function() {
                $('#container').removeClass('hidden');
                NProgress.remove();
            }, 200);
        });

        function loadPage() {
            $('img').lazyload({
                effect: "fadeIn",
                skip_invisible: false,
                threshold: 350
            });
            $('div, section').fitVids();

            $('#main-nav').removeClass('page').removeClass('post');
            $('.page-title, .post-title').empty();

            if ($('article').hasClass('single-post')) {
                $('#main-nav').addClass('post');
            }
            else if ($('article').hasClass('single-page')) {
                $('#main-nav').addClass('page');
            }

            $('.post-listing').each(function(){
                var frontpostcolor = $(this).attr('data-post-color');

                $(this).find('h2').css('color',frontpostcolor).css('border-color',frontpostcolor);
            });

            if (navigator.userAgent.match(/mobile/i)) {
                $('.post-listing').prepend('<div class="mobile-block" class="needsclick"></div>');
                $('.mobile-block').click(function(){
                    $('.post-listing').removeClass('hover');
                    $(this).parent('.post-listing').addClass('hover');
                });
            }

            var postcolor = $('article').attr('data-post-color');
            var posttitle = $('article').attr('data-post-title');

            $('.single-post').each(function(){
                $(this).find('h2, .info-box a, .post-year').css('color',postcolor);
                $(this).find('.info-box, .info-box a').css('border-color',postcolor);
                $(this).find('hr').css('background',postcolor);
                $('nav .post-title').css('color',postcolor);

                $(this).find('.info-box a').hover(
                    function () {
                        $(this).css('background',postcolor).css('color','white').css('-webkit-font-smoothing','antialiased');
                    },
                    function () {
                        $(this).css('background','none').css('color',postcolor).css('-webkit-font-smoothing','subpixel-antialiased');
                    }
                );

                $('nav .post-title').html('' + posttitle + '');
            });

            $('.single-page').each(function(){
                $(this).find('h2, .info-box a').css('color',postcolor);
                $(this).find('.info-box').css('border-color',postcolor);
                $(this).find('hr').css('background',postcolor);
                $('nav .page-title').css('color',postcolor);

                $(this).find('.info-box a').hover(
                    function () {
                        $(this).css('background',postcolor).css('color','white').css('-webkit-font-smoothing','antialiased');
                    },
                    function () {
                        $(this).css('background','none').css('color',postcolor).css('-webkit-font-smoothing','subpixel-antialiased');
                    }
                );

                $('nav .page-title').html('' + posttitle + '');
            });

            $('.post-navigation a').each(function(){
                var postcolor = $(this).attr('data-post-color');

                $(this).hover(
                    function () {
                        $(this).css('background',postcolor);
                    },
                    function () {
                        $(this).css('background','none');
                    }
                );
            });
        }
    });
</script>

<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php bloginfo("template_url"); ?>/JS/css3-mediaqueries.js"></script>
<![endif]-->

</body>
</html>