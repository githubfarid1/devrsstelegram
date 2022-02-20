<?php
/*
**********************************
* Bot Telegram - Kirim Pesan **
**********************************
*/
require_once('bot_config.php');
/* Variabel statis. Peringatan: Hanya ubah variabel di bot_config.php */
$max_age_articoli = time() - 1200;
/* setel tanggal mulai terakhir ke FALSE. Pada awal pertama, pertimbangkan parameter max_age_articles */
$last_send = false;
$last_send_title = "";
$dir = dirname(__FILE__);

/* tulis log bahwa bot dimulai */
$time = date("m-d-y H:i", time());
$log_text = "[$time] Bot Dimulai. URL Feed: $rss".PHP_EOL;
file_put_contents($dir . "/" . $log_file, $log_text, FILE_APPEND | LOCK_EX);
echo $log_text;
/* simpan PID saat ini dalam file agar bisa tau nomor prosesnya */
$pid = getmypid();
file_put_contents($dir . "/" . $pid_file, $pid);
/* put first message here */
telegram_send_chat_message($token, $chat, $firstMessage, $log_file, false);

/* Berfungsi untuk mengirim pesan ke telegram */
function telegram_send_chat_message($token, $chat, $messaggio, $log_file, $is_count=true) {
	/* ambil waktu saat ini untuk  file log */
	$dir = dirname(__FILE__);
	$time = time();
	/* inisialisasi variabel URL */
	$url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat";
	/* Variabel URL yang dikenakan dengan pesan yang akan dikirim */
	$send_text=urlencode($messaggio);
	$url = $url . "&text=$send_text";
	//mulai sesi curl
	$ch = curl_init();
	$optArray = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true
	);
	curl_setopt_array($ch, $optArray);
	$result = curl_exec($ch);
	/* Jika terjadi kesalahan, simpan di log */
	if ($result == FALSE) {
		$time = date("m-d-y H:i", time());
		$log_text = "[$time] Mengirim pesan gagal: $messaggio".PHP_EOL;
		file_put_contents($dir . "/" . $log_file, $log_text, FILE_APPEND | LOCK_EX);
	} else {
        if (!file_exists(__DIR__ . '/messages/')) {
            mkdir(__DIR__ . '/messages/');
            //exec("chmod 777 -R " . __DIR__ . '/messages/');
        }
        if ($is_count) {
            tempnam(__DIR__ . '/messages/', '');
        }
    }
	curl_close($ch);
}

/* start bot */
while (true) {
	/*Jika $last_send belum diberi parameter, itu berarti bot baru saja dimulai. Jadi saya mengaturnya sama dengan $max_age_articoli, yang merupakan waktu saat ini - 20 menit. Ini kemudian akan memposting semua berita yang lebih lama dari 20 menit secara retroaktif
	*/
	if ($last_send == false) {
		$last_send = $max_age_articoli;
	}
	$ora_attuale = time();
	$articoli = @simplexml_load_file($rss);
	/* Jika gagal mendownload feed, posting pesan error di log */
	if ($articoli === false) {
		$time = date("m-d-y H:i", $ora_attuale);
		$log_text = "[$time]  $botError $rss.".PHP_EOL;
		file_put_contents($dir . "/" . $log_file, $log_text, FILE_APPEND | LOCK_EX);
		/* Saya hanya melanjutkan jika $articoli tidak salah, ini berarti simplexml dapat memuat umpan dan saya dapat melanjutkan untuk memproses berita */
	} else {
		/* Saya membalik urutan berita, dari turun menjadi naik */
		$xmlArray = array();
		foreach ($articoli->channel->item as $item) {
			$xmlArray[] = $item;
		}
		$xmlArray = array_reverse($xmlArray);

		/* Mulai dari siklus pengiriman berita */
		foreach ($xmlArray as $item) {
			/* ekstrak  waktu artikel */
			$timestamp_articolo = strtotime($item->pubDate);
			/* hitung perbedaan antara s waktu saat ini dan  waktu artikel */
			$diff_timestamp = time() - $timestamp_articolo;

			/* Periksa apakah berita tersebut lebih baru dari yang terakhir diterbitkan */
			/* Meskipun seharusnya * tidak * tetapi karena alasan yang tidak diketahui, saya menambahkan kontrol yang seharusnya menghindari publikasi cerita yang sama dua kali */
			/* Saya tidak menerbitkan artikel dengan senioritas kurang dari 5 menit (300 detik) */
			if ($timestamp_articolo > $last_send AND $diff_timestamp > $ritardo AND $last_send_title != $item->title) {
				$messaggio = ucfirst($item->category) . " - " . $item->title . PHP_EOL;
				$messaggio .= $item->link . PHP_EOL;
				telegram_send_chat_message($token, $chat, $messaggio, $log_file);
				$last_send = $timestamp_articolo;
				$last_send_title = $item->title;
			}
		}
	}
	sleep($attesa);
}
?>
