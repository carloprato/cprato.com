<!DOCTYPE html>
<html lang="{{lang}}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, user-scalable=no" name="viewport">
    <meta name="description" content="My personal website. Find information about me, contact me or read my blog!">
    <meta name="author" content="Carlo Prato">
    <meta name="keywords" content="Carlo Prato, Carlo Prato Malta, Carlo Prato Mosta, Webdesign Malta">
    <title>Carlo Prato</title>
    <link rel="icon" href="/data/res/images/favicon.ico" type="image/x-icon" />
    <link href="{{SITE_ROOT}}/res/css/stylesheet.css" rel="stylesheet">
    <link href="{{SITE_ROOT}}/data/res/css/stylesheet.css" rel="stylesheet">
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
        })(window, document, 'script', '//data/res/js/analytics.js', 'ga');

        ga('create', 'UA-60272920-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script type="text/javascript" src="/data/res/js/tinymce/tinymce.min.js" ></script >  
    <script  type="text/javascript">
    tinyMCE.init({
            theme : "modern",
            mode : "specific_textareas",
            editor_selector : "rich_editor",
            plugins : 'link image code table smileys',
            toolbar: "insertfile undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image smileys",
            menu : { // this is the complete default configuration
                edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
                insert : {title : 'Insert', items : 'link media | template hr'},
                view   : {title : 'View'  , items : 'visualaid'},
                format : {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
                table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
                tools  : {title : 'Tools' , items : 'spellchecker code'}
            },
            force_br_newlines : false,
            force_p_newlines : false,
            forced_root_block : '',
            auto_convert_smileys: true
    
    });
    </script>
    <script>
      logInWithFacebook = function() {
        FB.login(function(response) {
          if (response.authResponse) {
            window.location.replace("{{SITE_ROOT}}/{{lang}}/auth/facebook");
          } else {
            
          }
        },  {scope: 'email'});
        return false;
      };
      window.fbAsyncInit = function() {
        FB.init({
          appId: '1612484382341510',
          cookie: true,
          version: 'v2.2'
        });
      };
    
      (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
</head>