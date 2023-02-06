<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Firma Bilgileri Eksik | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Head -->
        @include('include.head')
        
        <!--------- Css  --> 
        <link rel="stylesheet" type="text/css" href="{{asset('admin')}}/css/web/0_const.css" />
        
        
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

         
          @include('include.header')

            <div class="container" style="display: flex;justify-content: center;">                         
                <div class="c-card u-mb-xsmall">
                    <header class="c-card__header u-text-center u-pt-large">
                        <a class="c-card__icon">
                        <img  src="{{asset('/img')}}/logo/logo.svg" alt="Logo">
                        </a>
                        <div class="row u-justify-center">
                            <div class="col-3" style="display: flex;flex-direction: column;width: 500px;" >
                                <h1 class="u-h3">UYARI</h1>
                                <p class="u-h6 u-text-mute">
                                    Lütfen <b>Kullanıcı Profili</b> bölümünden 
                                </p>
                                <p><b>Kategori</b> ve <b>Firma Bilgileri</b> nizi giriniz.</p>
                            </div>
                        </div>
                    </header>
                    
                    <form class="c-card__body">
                    <a href="/account_settings"> <button class="c-btn c-btn--info c-btn--fullwidth" type="button"  > Bilgileri Giriniz </button></a>
                    </form>
                </div>
            </div><!-- // .container -->
            
        </main><!-- // .o-page__content -->
    </body>
    
    <footer>
        
        <!--- main --> 
        <script src="{{asset('/js')}}/main.min.js"></script>
        
        <!--- JS --> 
       <!-- <script src="{{asset('/web')}}/js/0_const.js"></script> -->
       
         @include('include.footer')
       
    </footer>
    
</html>