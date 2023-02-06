<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Direk İletişim | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Head -->
        @include('include.head')
        
        <!--------- Css  --> 
        <link rel="stylesheet" type="text/css" href="{{asset('admin')}}/css/web/0_const.css" />
        
        
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a style="text-decoration:none;"  href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

         
          @include('include.header')

            <div class="container-fluid">
               
                 <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="u-mv-large u-text-center">
                            <h2 class="u-mb-xsmall">Aklına takılan ne varsa cevabı bir tık ötede.</h2>
                            <p class="u-text-mute u-h6">Aşağıdaki bilgilerden bize ulaş ve görüşmeye başla.
                            </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">
    
                            <img class="u-mb-small" src="{{asset('/img')}}/icon-intro1.svg" style="width: 140px; height: 140px;">
    
                            <h4 class="u-h6 u-text-bold u-mb-small">
                                Bizi hemen ara.
                            </h4>
                            <a style="text-decoration:none;"  class="c-btn c-btn--info" href="tel:+90 312 000 0000">+90 312 000 0000</a>
                           
                        </div>
                    </div>
    
                    <div class="col-sm-12 col-lg-3">
                        <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">
    
                            <img class="u-mb-small" src="{{asset('/img')}}/mail.png" style="width: 140px; height: 140px;">
    
                            <h4 class="u-h6 u-text-bold u-mb-small">
                              Bize mail gönder
                            </h4>
                            <a style="text-decoration:none;" class="c-btn c-btn--info" target="_blank" href="mailto:tedarikci@bex360.com">Mail Gönder</a>
                        </div>
                    </div>
    
                    <div class="col-sm-12 col-lg-3">
                        <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">
    
                            <img class="u-mb-small" src="{{asset('/img')}}/maps.png" style="width: 140px; height: 140px;">
    
                            <h4 class="u-h6 u-text-bold u-mb-small">
                               Bizi ziyaret et
                            </h4>
                            <a style="text-decoration:none;" class="c-btn c-btn--info" target="_blank" href="https://www.google.com/maps/place/Kale+Ofis/@39.898233,32.8141326,17.75z/data=!4m5!3m4!1s0x14d34f55e5b81b7d:0xa163dfdb5efb4101!8m2!3d39.8985391!4d32.813273">Adres Tarifi</a>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-lg-3">
                        <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards" style="height: 301px;">
    
                           <img class="u-mb-small" src="{{asset('/img')}}/icon-intro3.svg" style="width: 140px; height: 140px;">
    
                            <h4 class="u-h6 u-text-bold u-mb-small">
                                Bize destek talebinden yaz
                            </h4>
                            <a style="text-decoration:none;" class="c-btn c-btn--info" target="_blank" href="/supportrequest/list">Destek Talebi</a>
                        </div>
                    </div>
                </div>
    
           
            </div>
               

            </div><!-- // .container -->
            
        </main><!-- // .o-page__content -->
    </body>
    
    <footer>
        
        <!--- main --> 
        <script src="{{asset('/js')}}/main.min.js"></script>
        
        
       
         @include('include.footer')
       
    </footer>
    
</html>