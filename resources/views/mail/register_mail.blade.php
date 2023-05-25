Hi{{$user->name}}, <br>
Silahkan Aktivasi Email Anda Dengan Link Dibawah Ini <br>
@php
    $link = route(register.verify);
    $link .= '?email = ';
    $link .= $user->email;
    $link .= '&otp = ';
    $link .= $userVerification->otp;
@endphp
<a target="_blank" href="{{$link}}">Verivikasi Email</a> <br>
        Link akan Expired pada {{$userVerification->expired}}
