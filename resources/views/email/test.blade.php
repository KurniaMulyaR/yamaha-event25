<!DOCTYPE html>
<html>
<head>
    <title>Yamaha</title>
</head>
<body>
    <h1>Salam Semakin di Depan,</h1>
    <p>Terima kasih Bapak/Ibu {{ $data['name'] }} atas pembayaran booking melalui website Maxi25.com.
Data pemesanan Anda telah kami terima dengan baik.

Berikut adalah akun yang Anda gunakan untuk melakukan tracking order:</p>
<p>E-Mail : {{$data['email']}}</p>
<p>Password : {{$data['password']}}</p>

<p>Selanjutnya, Dealer {{ $data['delear']}} akan segera menghubungi Anda untuk proses pelunasan serta memberikan informasi lebih lanjut terkait pembelian sepeda motor Yamaha tipe {{ $data['tipe']}}.

Apabila Bapak/Ibu membutuhkan bantuan atau memiliki pertanyaan, silakan menghubungi kami melalui layanan pelanggan Maxi25.com.

Terima kasih atas kepercayaan Anda kepada Yamaha.

Hormat kami,
Tim Maxi25.com
Website: https://www.maxi25.com
</body>
</html>