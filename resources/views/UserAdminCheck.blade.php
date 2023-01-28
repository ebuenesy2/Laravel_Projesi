<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Hesabınızı Onaylayınız</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Head -->
        @include('include.head')        
      
        
    </head>
    <body class="o-page o-page--center" style="background-color: #eff3f6; ">
        <div class="o-page__card">
            <div class="c-card u-mb-small">
                <header class="c-card__header u-text-center u-pt-large">
                    <span class="c-card__icon">
                        <i class="fa fa-check-circle-o"></i>
                    </span>
                    <h1 class="u-mb-zero">Hesap  Doğrulama </h1>
                    
                    @if(session('status') == "succes")
                     <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="margin-top: 30px; "> {{session('msg')}}  </div>
                    @elseif(session('status') == "error")
                     <div class="alert alert-danger alert-dismissible fade show w-100" role="alert"  style="margin-top: 30px; "> {{session('msg')}}  </div>
                    @endif
                                       
                    <div class="c-alert c-alert--success alert fade show" id="alertMessage" style="display:none" >
                        <i class="c-alert__icon fa fa-exclamation-circle"></i> <p id="returnMessage" style="color: white; font-size: 15px; ">Mesaj</p>
                        <button class="c-close" data-dismiss="alert" type="button">×</button>
                    </div>

                </header>

                    <div class="c-card__body">
                        <h2 class="u-h5 u-text-center u-mb-medium">
                        Hesabınızı doğrulamak için </br>
                        Email hesabınza gelen linke tıklayınız.
                        </h2>
                                        
                        <form action="{{route('user_admin_check.control')}}" method="post" class="c-card__body" >
                          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                          <input name="userToken" type="hidden" value="{{ app('request')->input('userToken') }}"/>
                          <button class="c-btn c-btn--success c-btn--fullwidth"  id="admin_check_send"  > Tekrar Email Onaylama Linki Gönder</button>
                        </form>
                       
                    </div>
            </div>
             <div class="o-line">
                <a style="text-decoration:none" class="u-text-mute u-text-small" href="/login"> Üye iseniz, giriş yapınız </a>
                <a style="text-decoration:none" class="u-text-mute u-text-small" href="/register"> Üye değilseniz. Üye olunuz </a>
            </div>
            
        </div>
    </body>
</html>