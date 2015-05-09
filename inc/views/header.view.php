<?php
/* Disabling Wordpress
define( 'WP_USE_THEMES', false); require( './blog/wp-blog-header.php'); 
*/
?>
<!DOCTYPE html>
<html lang="<?php echo $language->current_language(); ?>">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, user-scalable=no" name="viewport">
    <meta name="description" content="My personal website. Find information about me, contact me or read my blog!">
    <meta name="author" content="Carlo Prato">
    <meta name="keywords" content="Carlo Prato, Carlo Prato Malta, Carlo Prato Mosta, Webdesign Malta">
    <title>Carlo Prato</title>
    <link rel="icon" href="/res/images/favicon.ico" type="image/x-icon" />
    <link href="<?php echo SITE_ROOT; ?>/res/css/stylesheet.css" rel="stylesheet">
    <style type='text/css'>    
        .col_12,
        .col_9,
        .col_8,
        .col_6,
        .col_4,
        .col_3,
        .col_2,
        .col_1 {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 0;
            margin-right: 0;
            text-align: left;
            display: table-cell;
            vertical-align: central;
        }
    </style>
    <script type="text/javascript">
        WebFontConfig = {
            google: {
                families: ['Noto+Serif::latin']
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.cprato.com/res/js/analytics.js', 'ga');

        ga('create', 'UA-60272920-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>