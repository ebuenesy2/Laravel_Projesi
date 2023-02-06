<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Hesap Doğrulama | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="yildirimDev" userToken="{{session('token')}}"  >

        <!-- Head -->
        @include('include.head')        
      
        
    </head>
      <body class="o-page o-page--center">
        <div class="o-page__card">
            <div class="c-card u-mb-small">
                <header class="c-card__header u-text-center u-pt-large">
                    <span class="c-card__icon">
                        <i class="fa fa-check-circle-o"></i>
                    </span>
                    <h1 class="u-mb-zero">Hesap  Doğrulama </h1>
                                       
                    <div class="c-alert c-alert--success alert fade show" id="alertMessage" style="display:none" >
                        <i class="c-alert__icon fa fa-exclamation-circle"></i> <p id="returnMessage" style="color: white; font-size: 15px; ">Mesaj</p>
                        <button class="c-close" data-dismiss="alert" type="button">×</button>
                    </div>

                </header>

                    <div style="display: none ;" >  

                         <div class="c-card__body">
                                <h2 class="u-h5 u-text-center u-mb-medium">
                                Hesabınızı doğrulamak için </br>
                                Email hesabınza gelen linke
                                </h2>

                                
                            <form class="c-card__body">
                                <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Tekrar Email Onaylama Linki Gönder</button>
                            </form>
                         </div>

                    </div>

                    
                    <div style="display: block ;" >  

                         <div class="c-card__body">
                                <h2 class="u-h5 u-text-center u-mb-medium">
                                 Hesabınız doğrulandı </br>
                                 Hesabınıza giriş yapabilirsiniz.
                                </h2> 
                                
                                <a style="text-decoration:none" class="u-text-mute u-text-small" href="login">
                                   <button class="c-btn c-btn--success c-btn--fullwidth" type="button" >Siteye Giriş Yap</button>
                                </a>
                         </div>

                    </div>

            </div>

        
         
            
        </div>

    </body>

    <footer>
        <script src="{{asset('/js')}}/main.min.js"></script>
        
        @include('include.footer')
    </footer>>
</html>