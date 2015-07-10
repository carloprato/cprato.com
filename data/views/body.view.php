<body>
    <div class='header_container'>
        <div class="row ">
            <div class='col_8'>
            </div>
            <div class='col_6' style='color:#DFDFDF'>
                {if:user}
                    Hello, <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/user/profile/'>{{user}}</a>! <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/auth/logout'>Logout</a>
                {elseif}
                    <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/auth'>Login</a> - <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/auth/register'>Register</a>
                {endif}
                <a href='/en/{{p}}'><img alt='English version of the website' width='48' height='48' style='width:48px;height:48px;' src='{{SITE_ROOT}}/data/res/flags/en.png' /></a>
                <a href='/it/{{p}}'><img alt='Versione italiana del sito web' width='48' height='48' style='width:48px;height:48px;' src='{{SITE_ROOT}}/data/res/flags/it.png' /></a>
                <a href='/mt/{{p}}'><img alt='Verzjoni tal-website bil-Malti' width='48' height='48' style='width:48px;height:48px;' src='{{SITE_ROOT}}/data/res/flags/mt.png' /></a>
            </div>
        </div>
        <div class="row ">
            <div class='logo'>
                <a href='/{{lang}}/home'>
                    <div class='title'>
                        carlo prato
                    </div>
                </a>
            </div>
            <div class='nav'>
                <div class='col_3'>
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/home'>
                        {{translate:Home}}
                    </a>
                </div>
                <div class='col_3' style='padding-left:5px;' >
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/blog'>
                        Blog
                    </a>
                </div>
                <div class='col_3' style='padding-left:5px;' >
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/forum'>
                        Forum
                    </a>
                </div>
                <div class='col_3'  style='padding-left:10px;'>
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/about'>
                        {{translate:About}}
                    </a>
                </div>
            </div>
            <div class='fill'></div>
        </div>
    </div>