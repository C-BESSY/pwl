Hi {{ $user->name }} <br>
Silahkan aktivasi email anda dengan klik link dibawah ini <br>
@php
    $link = route('fp.new.form');
    $link .= '?email=';
    $link .= $user->email; 
    $link .= '&token=';
    $link .= $resetPassword->token;
@endphp
Klik Link Dibawah Ini Untuk Melakukan Reset Password <br>
<a target="_blank" href="{{ $link }}">Reset Password</a>
<br>
Link akan expired pada {{ $resetPassword->expired }}