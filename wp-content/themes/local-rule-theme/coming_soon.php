<?php

/**
 * Template Name: Coming Soon!
 */
header("Location: https://local-rule.com");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PW27QD9');</script>
    <!-- End Google Tag Manager -->

    <!-- Google Analytics -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-217420692', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->


    <meta charset="UTF-8">
    <title>Local Rule - Coming Soon</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo get_template_directory_uri() . "/coming-soon/css/fonts.css";?>" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="icon" href="<?php echo get_template_directory_uri() . "/coming-soon/img/favicon.svg";?>" sizes="32x32">
    <link rel="icon" href="<?php echo get_template_directory_uri() . "/coming-soon/img/favicon.svg";?>" sizes="192x192">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() . "/coming-soon/img/favicon.svg";?>">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() . "/coming-soon/img/favicon.svg";?>">

    <style>

        *{
            font-family: "Whyte", sans-serif;
        }

        body{
            background-image: url("<?php echo get_template_directory_uri() . "/coming-soon/img/bg-new.png";?>");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #A8BCC3;
            min-height: 100vh;
            font-family: "Whyte", sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .container{
            max-width: 1210px;
            margin: 0 auto;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 65px 30px;
            color: #ffffff;
            /*min-height: 100vh;*/
        }

        .container > div{
            max-width: 614px;
        }

        .logo{
            max-width: 175px;
            margin: 0px 0px 70px 0px ;
        }

        h1{
            margin: 0 0 21px 0;
            font-weight: 500;
            font-size: 48px;
            line-height: 53px;
            text-transform: uppercase;
            letter-spacing: 15px;
        }

        p{
            font-size: 16px;
            line-height: 25px;
            max-width: 597px;
            margin: 0 auto 62px auto;
            font-weight: 300;
        }

        p span{
            opacity: .8;
        }

        p strong{
            opacity: 1;
        }

        ul.socials{
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 100px;
            margin: 0 auto 27px auto;
            list-style: none;
            padding: 0;
            display: none;
        }

        footer p{
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 0;
        }

        form input[type=text], form input[type=email]{
            width: 100%;
            padding:12px 20px 12px 20px;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            border-radius: 100px;
            border: 2px solid transparent;
            background-color: rgba(204,212,196,.15);
            box-sizing: border-box;
            font-weight: 300;
            font-size: 18px;
            line-height: 26px;
            color: #ffffff;

            transition: all .3s ease-in-out;
        }


        .nameContainer{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nameContainer input{
            margin-bottom: 10px;
            width: 50% !important;
        }

        .emailContainer{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            position: relative;
        }

        .nameContainer input:first-child{
            margin-right: 5px;
        }
        .nameContainer input:last-child{
            margin-left: 5px;
        }


        form input[type=email]{
            padding-right: 160px;
        }


        form input[type=text]:focus-visible, form input[type=email]:focus-visible{
           outline: none;
            border-color: #507463;
        }

        #mc_embed_signup{
            margin-bottom: 40px;
        }

        form #mc-embedded-subscribe{
            position: absolute;
            padding: 10px 30px 9px 30px;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            background: #1C4236;
            border-radius: 50px;
            color: #ffffff;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            border: 0;
            line-height: 26px;
            font-weight: 300;
            font-size: 18px;
            min-width: 138px;
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
            transition: background-color .3s ease-in-out;
        }

        form #mc-embedded-subscribe:hover {
            background-color: #194e35;
        }

        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #ffffff !important;
            opacity: 1; /* Firefox */
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #ffffff;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: #ffffff;
        }

        @media screen and (min-height: 750px){
            .container{
                justify-content: space-between;
            }

            .container > div{
                position: relative;
                top: 50%;
                transform: translateY(-50%);
                -webkit-transform: translateY(-50%);
                -moz-transform: translateY(-50%);
                -o-transform: translateY(-50%);
            }
        }

        @media screen and (max-height: 876px){
            .container{
                padding: 30px;
            }
        }

        @media screen and (max-width: 750px) {
            .container {
                justify-content: space-between;
            }

            .container > div {
                height: 100%;
            }

            .logo {
                max-width: 131px;
                margin-bottom: 81px;
            }

            h1 {
                font-size: 34px;
                line-height: 37px;
                margin-bottom: 19px;
            }

            p {
                font-size: 16px;
                line-height: 25px;
                margin-bottom: 45px;
            }

            form input[type=text], form input[type=email] {
                padding: 14px 20px 16px 20px;
                font-size: 14px;
                line-height: 20px;
            }
            form #mc-embedded-subscribe {
                padding: 10px 30px 10px 30px;
            }
            #mc_embed_signup{
                margin-bottom: 30px;
            }
        }

    </style>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '255624056716521');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=255624056716521&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PW27QD9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="container">

    <div>
        <img src="<?php echo get_template_directory_uri() . "/coming-soon/img/logo.svg";?>" class="logo"/>

        <h1>Under Maintenance</h1>
        <p><span>We are tweaks away from the launch of the Local Rule site and online store - with a new generation of golf apparel.
            <br><br>
            Sign up, get our pre-launch notifications, and be ready when drops and collections hit the site.</span>
            <br><br>
            <strong>Thank you. We love the support!</strong></p>

        <!-- Begin Mailchimp Signup Form -->
        <div id="mc_embed_signup">
            <form method="post" action="https://localrule.us5.list-manage.com/subscribe/post?u=46bb4febebcc4acf2962eb8cd&amp;id=4f78568867" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

                    <div class="nameContainer">
                        <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First name*">
                        <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last name*">
                    </div>

                    <div class="emailContainer">
                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email address*">
                        <input type="submit" value="Sign up" name="subscribe" id="mc-embedded-subscribe">
                    </div>

                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_46bb4febebcc4acf2962eb8cd_4f78568867" tabindex="-1" value="">
                    <input type="hidden" value="1" name="group[382733][1]">
                </div>
            </form>
        </div>

        <!--End mc_embed_signup-->


    </div>

    <footer>

        <ul class="socials">
            <li><a href="#"><img src="<?php echo get_template_directory_uri() . "/coming-soon/img/instagram.svg";?>" alt="instagram"/></a></li>
            <!--            <li><a href="#"><img src="<?php echo get_template_directory_uri() . "/coming-soon/img/twitter.svg";?>" alt="twitter"/></a></li>-->
            <li><a href="#"><img src="<?php echo get_template_directory_uri() . "/coming-soon/img/facebook.svg";?>" alt="facebook"/></a></li>
        </ul>

        <p>Copyright &copy; 2022 LocalRule. All Rights Reserved. We Appreciate You!</p>
    </footer>


</div>



<script type='text/javascript' src='<?php echo get_template_directory_uri() . "/coming-soon/js/mc-validate.js";?>'></script>
<script type='text/javascript'>
    (function($) {
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0]='EMAIL';
        ftypes[0]='email';
        fnames[1]='FNAME';
        ftypes[1]='text';
        fnames[2]='LNAME'
        ;ftypes[2]='text';
        fnames[3]='ADDRESS';
        ftypes[3]='address';
        fnames[4]='PHONE';
        ftypes[4]='phone';
        fnames[5]='BIRTHDAY';
        ftypes[5]='birthday';
    }(jQuery));
    var $mcj = jQuery.noConflict(true);</script>


</body>
</html>
