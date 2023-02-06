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
            <h4 class="c-state__number">{{$totalPayment}} TL</h4>
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
            <h4 class="c-state__number">{{$paymentDone}} TL</h4>
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
            <h4 class="c-state__number">{{$paymentAwaiting}}  TL</h4>
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
            <h4 class="c-state__number">{{$totalOrder}}</h4>
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
                          <div class="c-card__meta">
                              <a href="/current/list">Cari Hesaplarım</a>
                          </div>
                      </div>

                      <table class="c-table u-border-zero">
                          <tbody>
                            
                            @for ($i = 0; $i < count($currentDB); $i++)
                                @if($currentDB[$i]["total"]["paymentStatusToken"] =="token17")
                            
                                    <tr class="c-table__row u-border-top-zero">
                                        <td class="c-table__cell">
                                            <div class="u-flex u-align-items-center">
                                                <span class="u-text-bold">#{{$currentDB[$i]["myOrderId"]}} - Sipariş	</span>
                                            </div>
                                        </td>
                                        <td class="c-table__cell"><span class="c-badge c-badge--success">Ödendi</span></td>
                                        <td class="c-table__cell u-text-right">
                                            <span class="u-text-bold">{{$currentDB[$i]["total"]["totalActivePrice"]}} TL</span>
                                        </td>
                                        <td class="c-table__cell u-text-right">
                                            <span class="u-text-mute">{{\Carbon\Carbon::parse($currentDB[$i]["created_at"])->diffForHumans()}}</span>
                                        </td>
                                    </tr>
                               
                                @endif
                            @endfor
                           
                          </tbody>
                      </table>
                      
                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="c-card c-card--responsive u-mb-medium">
                      <div class="c-card__header c-card__header--transparent o-line">
                          <h5 class="c-card__title">Bekleyen Ödemeler</h5>
                          <div class="c-card__meta">
                            <a href="/current/list">Cari Hesaplarım</a>
                        </div>
                      </div>

                    <table class="c-table u-border-zero">
                        <tbody>
                        
                        @for ($i = 0; $i < count($currentDB); $i++)
                            @if($currentDB[$i]["total"]["paymentStatusToken"] =="token16")
                        
                                <tr class="c-table__row u-border-top-zero">
                                    <td class="c-table__cell">
                                        <div class="u-flex u-align-items-center">
                                            <span class="u-text-bold">#{{$currentDB[$i]["myOrderId"]}} - Sipariş	</span>
                                        </div>
                                    </td>
                                    <td class="c-table__cell"><span class="c-badge c-badge--warning">Vade Bekliyor</span></td>
                                    <td class="c-table__cell u-text-right">
                                        <span class="u-text-bold">{{$currentDB[$i]["total"]["totalActivePrice"]}} TL</span>
                                    </td>
                                    <td class="c-table__cell u-text-right">
                                        <span class="u-text-mute">{{\Carbon\Carbon::parse($currentDB[$i]["created_at"])->diffForHumans()}}</span>
                                    </td>
                                </tr>
                            
                            @endif
                        @endfor
                        
                        </tbody>
                    </table>
                      
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