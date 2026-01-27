@component('mail::message')
# Reset Password

Kami menerima permintaan reset password untuk akun Anda.

@component('mail::button', ['url' => $actionUrl, 'color' => 'red'])
Reset Password
@endcomponent

Link ini hanya berlaku selama 60 menit.

Jika Anda tidak merasa meminta reset password, abaikan email ini.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
