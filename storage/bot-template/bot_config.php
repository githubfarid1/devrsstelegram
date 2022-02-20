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
$rss = 'https://www.upwork.com/your-rss';
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
?>
