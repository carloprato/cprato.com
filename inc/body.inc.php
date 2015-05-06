<body>
    <div class='header_container'>
        <div class="row ">
            <div class='col_8'>

            </div>
            <div class='col_4'>
                <a href='/en/<?=$_GET["p"]; ?>'><img alt='English version of the website' width='48' height='48' style='width:48px;height:48px;' src='<?php echo SITE_ROOT; ?>/res/flags/en.png' /></a>
                <a href='/it/<?=$_GET["p"]; ?>'><img alt='Versione italiana del sito web' width='48' height='48' style='width:48px;height:48px;' src='<?php echo SITE_ROOT; ?>/res/flags/it.png' /></a>
                <a href='/mt/<?=$_GET["p"]; ?>'><img alt='Verzjoni tal-website bil-Malti' width='48' height='48' style='width:48px;height:48px;' src='<?php echo SITE_ROOT; ?>/res/flags/mt.png' /></a>

            </div>
        </div>
        <div class="row ">
            <div class='logo'>
                <a href='/<?php echo $_GET["lang"]; ?>/home'>
                    <div class='title'>
                        carlo prato
                    </div>
                </a>
            </div>

            <div class='nav'>

                <div class='col_4' style='margin-left:20px;'>
                    <a class='menu_item' style='' href='<?php echo SITE_ROOT; ?>/<?php echo $_GET['lang']; ?>/home'>Home</a>
                </div>

                <div class='col_4' style='padding-left:10px'>
                    <a class='menu_item' href='/blog/'>Blog</a>
                </div>

                <div class='col_4' style='padding-left:10px;'>

                    <a class='menu_item' href='<?php echo SITE_ROOT; ?>/<?php echo $_GET['lang']; ?>/about'>
                        <?php echo $l['About']; ?>
                    </a>
                </div>

            </div>
            <div class='fill'></div>

        </div>

    </div>
