<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Üye Sifre Unuttum</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Head -->
        @include('include.head')

        
    </head>
    <body class="o-page o-page--center" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a style="text-decoration:none" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div class="o-page__card">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-pt-large">
                    <a style="text-decoration:none" class="c-card__icon" href="#!">
                       <img src="{{asset('/img')}}/logo/logo.svg" alt="Dashboard UI Kit">
                    </a>
                    <h1 class="u-h3 u-text-center u-mb-zero" style="margin-bottom:15px"> Sifremi Unuttum </h1>
                 
                    @if(session('status') == "succes")
                     <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="margin-top: 30px; "> {{session('msg')}}  </div>
                    @elseif(session('status') == "error")
                     <div class="alert alert-danger alert-dismissible fade show w-100" role="alert"  style="margin-top: 30px; "> {{session('msg')}}  </div>
                    @endif
                                       
                </header>
                
                <form action="{{route('forgot_password.control')}}" method="post" class="c-card__body" >
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <div class="c-field u-mb-small">
                        <label class="c-field__label" for="email">Email</label> 
                        <input class="c-input" type="email" id="email" name="email"  placeholder="info@email.com"> 
                    </div>

                

                    <button class="c-btn c-btn--success c-btn--fullwidth" type="submit">Gönder</button>

                
                </form>
            </div>

            <div class="o-line">
                <a style="text-decoration:none" class="u-text-mute u-text-small" href="/login"> Üye iseniz, giriş yapınız. </a>
                <a style="text-decoration:none" class="u-text-mute u-text-small" href="/register"> Üye değilseniz. üye olunuz </a>
            </div>
        </div>

        <script src="{{asset('/js')}}/main.min.js"></script>
    </body>
</html>