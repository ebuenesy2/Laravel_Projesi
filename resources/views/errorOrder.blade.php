<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dashboard | Bex360</title>
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

            <div class="container">
      <div class="row">
          
        <div class="col-sm-6 col-lg-3">
          <div class="c-state ">
            <h3 class="c-state__title">TOPLAM ÖDEME</h3>
            <h4 class="c-state__number">?? TL</h4>
            <p class="c-state__status">Bu zamana kadar kazancınız</p>
            <span class="c-state__indicator">
              <i class="fa fa-arrow-circle-o-up"></i>
            </span>
          </div>
          <!-- // c-state -->
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="c-state c-state--success">
            <h3 class="c-state__title">TOPLAM ÖDENEN</h3>
            <h4 class="c-state__number">?? TL</h4>
            <p class="c-state__status">Bu zamana kadar ödenmiş</p>
            <span class="c-state__indicator"> 
              <i class="fa fa-arrow-circle-o-down"></i>
            </span>
          </div>
          <!-- // c-state -->
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="c-state c-state--warning">
            <h3 class="c-state__title">BEKLENEN ÖDEME</h3>
            <h4 class="c-state__number"> ???  TL</h4>
            <p class="c-state__status">Vadesini bekleyen ödemeniz</p>
            <span class="c-state__indicator">
              <i class="fa fa-arrow-circle-o-down"></i>
            </span>
          </div>
          <!-- // c-state -->
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="c-state c-state--danger">
            <h3 class="c-state__title">TOPLAM SİPARİŞ SAYISI</h3>
            <h4 class="c-state__number">xx</h4>
            <p class="c-state__status">toplam sipariş sayınız</p>
            <span class="c-state__indicator">
              <i class="fa fa-arrow-circle-o-up"></i>
            </span>
          </div>
          <!-- // c-state -->
        </div>
      </div>

      <div class="row u-mb-large">
        <div class="col-sm-12">
          <div class="c-table-responsive@desktop">
           
            <div class="row">
              <div class="col-lg-6">
                  <div class="c-card c-card--responsive u-mb-medium">
                      <div class="c-card__header c-card__header--transparent o-line">
                          <h5 class="c-card__title">Tamamlanmış Ödemeler</h5>
                        
                      </div>

                      <div class="card" style="text-align: center; padding: 50px;">
                      
                          <div style="display: flex; flex-direction: column; gap: 21px; align-items: center; " >
                            <img width="100" src="{{asset('/img')}}/icon/sad.png"/>
                                <p>Şuan siparişiniz yoktur.</p>
                          </div>
                      
                      </div>
                      
                      
                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="c-card c-card--responsive u-mb-medium">
                      <div class="c-card__header c-card__header--transparent o-line">
                          <h5 class="c-card__title">Bekleyen Ödemeler</h5>
                         
                      </div>

                    <div class="card" style="text-align: center; padding: 50px;">
                         <div style="display: flex; flex-direction: column; gap: 21px; align-items: center; " >
                            <img width="100" src="{{asset('/img')}}/icon/sad.png"/>
                                <p>Şuan siparişiniz yoktur.</p>
                          </div>    
                    </div>
                      
                      
                  </div>
              </div>
          </div>

          </div>
        </div>
      </div>
      <!-- // .row -->
    </div>
            
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