<!doctype html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Hesabınız Askıya Alındı | Yıldırımdev</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">
      
        
        <!-- Head -->
        @include('include.head')
        
    </head>
    <body class="o-page o-page--center" style="background-color: #eff3f6; ">
        <div class="o-page__card">
            <div class="c-card u-mb-xsmall">
                <header class="c-card__header u-text-center u-pt-large">
                    <a class="c-card__icon" href="#!">
                       <img src="{{asset('/img')}}/logo/logo.svg" alt="Dashboard UI Kit">
                    </a>
                    <div class="row u-justify-center">
                        <div class="col-9">
                            <h1 class="u-h3">UYARI</h1>
                            <p class="u-h6 u-text-mute">
                                Hesabınız askıya alınmıştır; <br>Lütfen askıya alınış nedeni ve artık yapılması gerekenleri öğrenmek için bizimle iritbata geçiniz.
                            </p>
                        </div>
                    </div>
                </header>
                
                <form class="c-card__body">
                   <a href="/login"> <button class="c-btn c-btn--info c-btn--fullwidth" type="button"  >Giriş Ekranı</button></a>
                </form>
            </div>
        </div>
    </body>

     <footer>

        <!-- Script --> 
        <script src="public/js/main.min.js"></script>
        <script src="public/js/web/forgotPassword.js"></script>

        <!---- Sweetalert2 Js -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
        <div id="footer" ></div>
    </footer>

</html>