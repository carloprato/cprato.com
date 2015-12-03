<!DOCTYPE html>
<html lang="{{lang}}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, user-scalable=no" name="viewport">
    <meta name="description" content="Be Positive Self Help, Malta. Find updates from our association and interact with the community!">
    <meta name="author" content="Carlo Prato - www.cprato.com">
    <meta name="keywords" content="bipolar disease, bipolar Malta, bipolar disorder, self help group Malta">
    <title>{{page_title}} - Be Positive Self Help, Malta</title>
    <link rel="icon" href="/data/res/images/favicon.ico" type="image/x-icon" />
    <link href="/res/css/stylesheet.css" rel="stylesheet">
    <link href="/data/res/css/stylesheet.css" rel="stylesheet">

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
    
    <style>

        nav {
        border-right: none;
        width: 100%;
        }
        
        nav ul {
        margin: 0;
        padding: 0;
        }
        
        nav ul li {
        list-style: none;
        text-align: center;

        }
        
        nav ul li:first-child {
        border-left: none;
        }
        
        nav ul li a {
        display: block;
        text-decoration: none;
        padding: 5px 0;
        font-size:20px;
        font-family: 'Noto Serif';
        color: #22620e;
        height:24px;
        z-index: 12;
        text-align:center;
        text-weigh:bold;        
        }
        
        nav ul li a:hover {
            text-shadow: 0 1.33px 5px #dfdfdf;
            border-radius: 8px 8px 0 0;
            box-shadow: inset 0 0 5px 0 #000;
            text-decoration:none;
            background-color: rgba(150, 150, 150 .9)
        }
        nav {
        display: table;
        table-layout: fixed;
        }
        
        ul {
        display: flex;
        flex-direction: row;
        }
        
        ul li {
            flex-grow: 1;
        }
        
        .mobile_menu {
            
            display: none;
        }
        @media (max-width: 639px) {

        nav ul li a {
            
            font-size:16px;
            height:20px;
        }
        nav ul li a:hover {

            border-radius: 8px;

        }
                
        ul {
            display: block;
        }
        
        nav {
            font-size: .8em;
        }
        
        nav ul li {
            display: block;
        }
        
        .dropdown {
            
            display:none;
        }
         ul li:hover ul.dropdown {
             
             display:block;
         }
         
         .mobile_menu {
             
            display:block;            
         }
        }         
    </style>    
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
        })(window, document, 'script', '//res/js/analytics.js', 'ga');

        ga('create', 'UA-60272920-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script type="text/javascript" src="/data/res/js/tinymce/tinymce.min.js" ></script >  
<script type="text/javascript">
tinyMCE.init({
        theme : "modern",
        mode : "specific_textareas",
        editor_selector : "rich_editor",
        plugins : 'link image media code table smileys',
        toolbar: "insertfile undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media smileys",
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
        auto_convert_smileys: true,
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 26pt 36pt",
        content_css: "/data/res/css/tinymce.css"
});
</script>
    <script async>
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