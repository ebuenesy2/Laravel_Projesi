<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sifre Güncelleme</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Head -->
        @include('include.head')        
      
        
    </head>
       <body class="o-page o-page--center" style="background-color: #eff3f6; ">
        <div class="o-page__card">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-text-center u-pt-large">
                    <span class="c-card__icon">
                        <i class="fa fa-key"></i>
                    </span>
                    <div class="row u-justify-center">
                        <div class="col-9">
                            <h1 class="u-h3 u-mb-zero">Yeni Parola Belirle</h1>
                            
                            @if(session('status') == "succes")
                            <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="margin-top: 30px; "> {{session('msg')}}  </div>
                            @elseif(session('status') == "error")
                            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert"  style="margin-top: 30px; "> {{session('msg')}}  </div>
                            @endif
                    
                        </div>
                    </div>
                </header>
                
                 <form action="{{route('account.reset.password.control')}}" method="post" class="c-card__body" >
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <input name="userToken" type="hidden" value="{{ app('request')->input('confirmation_code') }}"/>
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="pass">Yeni Parola</label>
                        <input class="c-input" type="password" name="pass" id="pass" placeholder="Yeni Parola"> 
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="repass">Yeni Parola Tekrar</label>
                        <input class="c-input" type="password" name="repass" id="repass" placeholder="Yeni Parola Tekrar"> 
                    </div>

                    <button class="c-btn c-btn--info c-btn--fullwidth" type="submit" id="resetPassword" >Parolamı Değiştir</button>
                </form>
            </div>

             <div class="o-line">
                <a style="text-decoration:none" class="u-text-mute u-text-small" href="register">Henüz hesabınız yok mu? Üye Olunuz</a>
                <a style="text-decoration:none" class="u-text-mute u-text-small" href="login">Hesabınız var mı? Giriş Yapınız</a>
            </div>
        </div>

       
    </body>
</html>