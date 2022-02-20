<?php
/*
**********************************
**** Variabel API Telegram ******
**********************************
*/
/* Token API Telegram. buat di @BotFather */
/* Nama Bot : RsstelegramForUpworkBot */
/* Link : t.me/RsstelegramForUpworkBot */
$token = '1826066081:AAFQM3UG973Ufa1J22PKNs0cmIzSgBTuADU';
/* Nama channel */
$chat = '@YourTelegramPublicChannel';
/* RSS Feed */
$rss = 'https://www.upwork.com/ab/feed/jobs/rss?q=laravel+api&sort=recency&paging=0%3B10&api_params=1&securityToken=aba9cbbfce7d30a4fcd4816297a2514c0e693b730686ebbb39e1b18645bdefb8b0884f90f4e37bd1b2d974aa4a0ba5e9b1f6f207a32fad1bcecb47651256f674&userUid=753956258459901952&orgUid=753956258464096257';
/* File log */
$log_file = 'channel_bot.log';
/* File  PID */
$pid_file = 'bot.pid';
/* waktu sleep */
$attesa = 60; // untuk free paket dan premium
/* Tunda publikasi berita, dalam hitungan detik. 0 untuk menonaktifkan */
$ritardo = 300;
$firstMessage = "Bot Started..\nBot RSSTelegram akan berakhir sampai dengan %s.\nUpgrade paket anda untuk mendapatkan masa berlaku lebih lama";
$botError = 'Bot tidak dapat menghubungi RSS Feed. Sambungan gagal:';
$max_age_articoli = time() - 1200;
if ($last_send == false) {
    $last_send = $max_age_articoli;
}
$ora_attuale = time();
$articoli = @simplexml_load_file($rss);
foreach ($articoli->channel as $item) {
    $xmlArray[] = $item;
}
$xmlArray = array_reverse($xmlArray);
foreach ($xmlArray as $item) {
    print_r($item->description);
    print_r($item->link);
}
?>
