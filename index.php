<?php

require('autoload.php');

if(!isset($_SESSION['hafta'])) $_SESSION['hafta'] = 1;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Championship</title>
    <script src="assets/js/jquery.min.js"></script>
    <script>

        function action(handler, respond){
            jQuery(respond).html('<div class="notice">İşlem yapılıyor...</div>');
            jQuery.post(handler, function(msg) {
                jQuery(respond).html(msg);
            });
            return false;
        }

    </script>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <div id="wrapper">

        <div id="nav">
            <ul>
                <li><a onclick="action('action/ligbaslat.php','#main');">Ligi Başlat</a></li>
                <li><a onclick="action('action/fikstur.php','#main');">Fikstürü Göster</a></li>
                <li><a onclick="action('action/puandurumu.php','#main');">Puan Durumu</a></li>
                <li><a onclick="action('action/bihaftaoynat.php','#main');">1 Hafta İlerle</a></li>
                <li><a onclick="action('action/hepsinioynat.php','#main');">Tümünü Oynat</a></li>
            </ul>
        </div>
        <div id="main">
            <div class="notice">Başarıyla başlatılmıştır</div>
        </div>
    </div>
</body>
</html>