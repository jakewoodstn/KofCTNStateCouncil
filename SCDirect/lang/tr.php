<?php

########################################################################

# Upload-Point 1.62 Beta - Simple Upload System

# Copyright (C)2005-2009 Todd Strattman

# strattman@gmail.com

# http://covertheweb.com/upload-point/

# License: LGPL

#

# Turkish translation by:

# Aquaria

# http://www.gencgiyen.com

########################################################################



// Header.php

$l_head3 = "Se�enekler";

$l_head5 = "Dosya Y�kleme";

$l_head6 = "PHP Bilgisi";

$l_head7 = "�zel php.ini";



// Options.php

$l_opt8 = "L�tfen arkan�za yaslan�n ve <b>Upload-Point</b> 'i �zelle�tirmenin rahatl���n� ya�ay�n.";

$l_opt10 = "Bir dahaki ziyaretinizde t�m ayarlar�n�z otomatik olarak hat�rlanacakt�r.";

$l_opt11 = "Site Ad� ve Sayfa Ad� K�sm�:";

$l_opt18 = "Parola Korumas�";

$l_opt19 = "Asa��daki ayar ile Parola Korumas�n� Belirleyebilirsiniz.";

$l_opt22 = "<b>Ayarlar</b> (options.php) dosyas� i�in parola";

$l_opt24 = "<b>Y�kleme</b> (index.php) dosyas� i�in parola";

$l_opt25 = "Dosya Y�kleme";

$l_opt26 = "\"Dosya Y�kleme\" sistemini kullanma/kullanmama se�ene�i mevcut. \"Dosya Y�kleme\" klas�r� yoksa otomatik olarak yarat�l�r.";

$l_opt26a = "Dosya Y�kleme Klas�r�nde Index Yarat";

$l_opt26b = "Bu se�enek ikisinden birini yapacak: 1) basit tarzda bir listeleme olu�turularak dosyalar�n�z sunucuda listelenecek ya da 2) g�r�nmez klas�r ayar� ile dosyalar�n bulundu�u klas�re eri�imde anasayfaya y�nlendirilme yap�lacak E�er �nceden bir Index Dosyas� var ise �zerine yaz�m yap�lmayacak. Bu nedenle her defas�nda man�el olarak silmelisiniz.";

$l_opt26c = "G�r�nebilir / G�r�nmez Index Dosyas�";

$l_opt26d = "Delete the file upload directory index.";

$l_opt26e = "D�KKAT!!! Bu varolan index dosyas�n� y�kleme klas�r�nden silecektir!";

$l_opt26f = "Her sayfada ka� dosya listelensin?";

$l_opt26g = "Bu Se�enek A��k ise hi�bir kullan�c� listenizi g�remez.";

$l_opt26h = "Dosya Y�kleme :: Index Dosyalar�";

$l_opt26i = "Dosya Y�kleme :: Kullan�c� K�s�tlamas�";

$l_opt26j = "Yeniden Adland�rma Fonksiyonu.";

$l_opt26k = "Dosya Silme Fonksiyonu.";

$l_opt28 = "Alan ad�n�z�n i�indeki klas�rd�r. Klas�r otomatik olarak olu�turulur. �rne�in, \"http://ALANADIN.com/deneme/dosyalar/\", klas�r�n� kullaniyorsan�z: \"deneme/dosyalar\" yazmaniz yeterli olacaktir.";

$l_opt28a = " Bu klas�r otomatik olarak olu�turulacak. �rne�in, E�er bu adresi kullan�yorsan�z \"http://ALANADIN.com/deneme/dosyalar/\", dosya y�kleme klas�r� �u �ekilde e�itlenecek: \"deneme/dosyalar\".";

$l_opt29 = "Yoksay�lmas�n� istedi�iniz dosyalar (\".htaccess\" varsay�lan olarak yoksayabilir)";

$l_opt33 = "�zel Dosya Y�kleme Boyutu Ayarla</b> (php.ini)";

$l_opt33a = "Dosya Y�kleme :: PHP Y�kleme Boyutu";

$l_opt34 = "�ogu sunucu �zel <b>php.ini</b> olusturma iznine sahiptir.. Bu kullan��l� ve kullan�c� i�in yeniden d�zenlenebilir bir se�enektir.. �zel <b>php.ini</b> �unu takip eden b�l�mlere ayr�l�r:<br /><b>file_uploads</b> = On<br /><b>post_max_size</b> = *M<br /><b>upload_max_filesize</b> = *M<br /><b>register_globals</b> = On/Off<br /><b>error_log = error_log</b><br /><b>error_reporting</b> = 2039<br /><b>log_errors</b> = On<br />Bu kar��la�t�rma kesinlikle �nerilir <b>\"PHP Bilgisi\"</b> orijinal sonu�lar�yla <b>\"PHP Bilgisi\"</b> �zel sonu�lar� kar��la�t�r�n. php.ini.$p2$p Not!!! Bu t�m sunucularda �al��mayabilir!!!";

$l_opt35 = "\"php.ini\" olu�tur.";

$l_opt42 = "Basit Ayarlar";

$l_opt43 = "index.php y�nlendirme h�z�. 1000 = 1 saniye";

$l_opt44 = "options.php y�nlendirme h�z�. 1000 = 1 saniye";

$l_opt104 = "Sonras�n� De�i�tirmeyin (ne yapt���n�z� bilen biriyseniz de�i�tirebilirsiniz.)";

$l_opt105 = "<b>Header</b> alt/�st html kullan/kullanma";

$l_opt106 = "<b>Script Klas�r�</b> �rnegin, script yolunuz �urada: \"http://ALANADIN.com/deneme/yukle\", b�yleyse \"<b>Script Klas�r�</b> = deneme/yukle\" olacakt�r.";

$l_opt109 = "<b>Veri (data) Klas�r�</b> Parolan�n sakland��� ve �ifrelendi�i yerdir. Bunu de�i�tirmeniz �nerilmez. \"data\" klas�r� varsay�land�r.";

$l_opt110 = "<b>Script Yolu</b> Web klas�r�ndeki scriptin yoludur.";

$l_opt111 = "<b>Html Baslangic Tag�</b> Bu sadece upload point anasayfas� i�indir.";

$l_opt112 = "<b>Html biti� Tag�</b>";

$l_opt113 = "Ayarlamalar�n� Kaydeder";

$l_opt114 = "Ayarlar�n�z <b><i>ba�ar�yla</i></b> kaydedildi.";

$l_opt116 = "Language/Sprache/Lengua/Greek/Taal/Dil/Chinese";

$l_opt117 = "English";

$l_opt118 = "Deutsch";

$l_opt119 = "Espa&ntilde;ol";

$l_opt119a = "Nederlands";

$l_opt119b = "Chinese";

$l_opt119c = "T�rk�e";

$l_opt119d = "Greek";

$l_opt121 ="olu�turuldu ve izin kayd�";

$l_opt123 ="Bir problem var ve <b>$fileupload_dir_name</b> klas�r� olu�turulamad�.";

$l_opt128 = "s�f�rla";

$l_opt133 = "G�r�nt�lenebilir";

$l_opt134 = "G�r�nt�lenemez";



// Setup.php

$l_set17 = "Maksimum Y�kleme Dosyas� Boyutu. �rne�in: 55M";

$l_set18 = "Register Globals, A��k/Kapal�";

$l_set19 = "Olu�tur";

$l_set20 = "<b>PHP.INI</b> olu�turuldu!!!";

$l_set21 = "Otomatik olarak kapat�l�yor...";

$l_set22 = "<b>BIR PROBLEM VAR!!!</b> php.ini dosyas� olu�turulamad�!!!";



// Upload.php

$l_upload1 = "Dosya Y�kle";

$l_upload2 = "Dosyalar�m";

$l_upload3 = "Ad�";

$l_upload4 = "Boyutu";

$l_upload5 = "De�i�tirilme Tarihi";

$l_upload6 = "Yeniden Adland�r";

$l_upload7 = "Sil";

$l_upload8 = "Konum";

$l_upload11 = "y�klenecek dosya konumu bulunamad� ve olu�turma i�lemi ba�ar�s�zl�kla sonu�land�.";

$l_upload12 = "CHMOD 755 izni ger�ekle�tirilemedi.";

$l_upload13 = "Ba�ar�yla G�ncellendi.";

$l_upload14 = "Y�klemede bir problem var.";

$l_upload15 = "Otomatik olarak y�nlendiriliyorsunuz <a href=\"index.php\">Y�kleme-Sayfas�</a>";

$l_upload18 = "dosyas� <b>ba�ar�yla</b> silindi.";

$l_upload19 = "Yeniden adland�r�lamad�.";

$l_upload20 = "dosyas� <b>ba�ar�yla</b> adland�r�ld�";

// EDIT

$l_upload21 = "Uploading, please wait...";



// Global

$l_global5 = "�ptal";

$l_global7 = "A��k";

$l_global8 = "Kapal�";

$l_global10 = "Ba�ar�yla ��k�� Yap�ld�";

$l_global11 = "Y�nlendiriliyor...";

$l_global12 = "��k��";

$l_global13 = "Parola Girin";

$l_global14 = "Giri�";

$l_global17 = "Evet";

$l_global18 = "Hay�r";

?>