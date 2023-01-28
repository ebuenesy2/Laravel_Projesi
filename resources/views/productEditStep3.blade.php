<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ürün Düzenleme - 3 | Yıldırımdev</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta id="yildirimDev" socketUrl="{{ env('YILDIRIMDEV_Socket_URL') }}" serverId="{{ env('YILDIRIMDEV_ServerId') }}" serverToken="{{ env('YILDIRIMDEV_ServerToken') }}" version="v1.0.0">


        <!-- Head -->
        @include('include.head')        
      
        
        <!-- Sabit Css -->
        <link rel="stylesheet" href="{{asset('/web')}}/css/0_const.css">
        
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a style="text-decoration:none" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

         
          @include('include.header')

            <div class="container-fluid">
               
         <div class="container">
            <div class="container">
                <div class="col-12">
                    
                   <p id="product_info" data-temp_id="{{$apiDB['id']}}" style="display:none;" >Ürün bilgileri</p>

                    <div class="c-toolbar u-justify-between u-mb-medium">
                          <nav class="c-counter-nav">
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link " href="/product/edit/{{$apiDB['id']}}">
                                    <span class="c-counter-nav__counter">1</span>Ürün Bilgileri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link" href="/product/edit/{{$apiDB['id']}}/step2">
                                    <span class="c-counter-nav__counter">2</span>Ürün Resimleri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link is-active" href="/product/edit/{{$apiDB['id']}}/step3">
                                    <span class="c-counter-nav__counter">3</span>Önizleme
                                </a>
                            </div>
                           
                        </nav>

                    </div>
                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                              <div class="row">
                                <div class="col-lg-6">

                                    <div class="c-field u-mb-small">
                                        <img id="productViewImage" style="width: 100%;height: 100%;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px;" src="{{$apiDB['productImageUrl']}}" alt="" >
                                    </div>

                                  
                                    <!-- Ürün Resimleri ---->
                                    <div class="c-feed__gallery" style="display: flex;flex-direction: row; ">

                                      <div class="c-feed__gallery-item" id="productImageViewList" data_id="1"  style="display:{{$apiDB['productOtherImageUrl1'] != null ? 'flex' : 'none'  }}; position: relative; cursor: pointer; " >
                                            <div id="productImageViewCancel" data_id="1" style="display:{{$apiDB['productOtherImageUrl1'] != null ? 'flex' : 'none'  }}; position: absolute;" ><i data_id="1" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="1" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                               src="{{$apiDB['productOtherImageUrl1']}}" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="2" style="display:{{$apiDB['productOtherImageUrl2'] != null ? 'flex' : 'none'  }};  position: relative; cursor: pointer; " >
                                            <div id="productImageViewCancel" data_id="2" style="display:{{$apiDB['productOtherImageUrl2'] != null ? 'flex' : 'none'  }}; position: absolute;" ><i data_id="2" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img  class="product_preview" id="productImageView"  data_id="2" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                               src="{{$apiDB['productOtherImageUrl2']}}" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="3" style="display:{{$apiDB['productOtherImageUrl3'] != null ? 'flex' : 'none'  }}; position: relative; cursor: pointer; " >
                                            <div id="productImageViewCancel" data_id="3" style="display:{{$apiDB['productOtherImageUrl3'] != null ? 'flex' : 'none'  }}; position: absolute;" ><i data_id="3" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="3" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl3']}}" />
                                        </div>
                                            
                                        
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="4" style="display:{{$apiDB['productOtherImageUrl4'] != null ? 'flex' : 'none'  }}; position: relative; cursor: pointer; " >
                                            <div id="productImageViewCancel" data_id="4" style="display:{{$apiDB['productOtherImageUrl4'] != null ? 'flex' : 'none'  }}; position: absolute;" ><i data_id="4" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="4" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl4']}}" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="5" style="display:{{$apiDB['productOtherImageUrl5'] != null ? 'flex' : 'none'  }}; position: relative; cursor: pointer; " >
                                            <div id="productImageViewCancel" data_id="5" style="display:{{$apiDB['productOtherImageUrl5'] != null ? 'flex' : 'none'  }}; position: absolute;" ><i data_id="5" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="5" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl5']}}" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="6" style="display:{{$apiDB['productOtherImageUrl6'] != null ? 'flex' : 'none'  }}; position: relative; cursor: pointer; " >
                                            <div id="productImageViewCancel" data_id="6" style="display:{{$apiDB['productOtherImageUrl6'] != null ? 'flex' : 'none'  }}; position: absolute;" ><i data_id="6" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="6" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                 src="{{$apiDB['productOtherImageUrl6']}}" />
                                        </div>


                                    </div>
                                    <!-- Ürün Resimleri Son ---->

                                </div>
                                <div class="col-lg-6">

                                    <table class="table border">
                                        <tbody class="border">
                                            <tr>
                                                <td>Ürün Adı</td>
                                                <td>:</td>
                                                <td>{{$apiDB['productName']}}</td>
                                            </tr>
                                             <tr>
                                                <td>Ürün Kodu</td>
                                                <td>:</td>
                                                <td>{{$apiDB['productCode']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kategori</td>
                                                <td>:</td>
                                                <td>{{$apiDB['categoryTitle']}}</td>
                                            <tr>
                                                <td>Marka</td>
                                                <td>:</td>
                                               <td>{{$apiDB['brandTitle']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td>:</td>
                                                <td>{{$apiDB['productStock']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Stok Birimi</td>
                                                <td>:</td>
                                                <td>{{$apiDB['productStockTitle']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Satış Fiyatı</td>
                                                <td>:</td>
                                                <td>{{$apiDB['productPrice']}} {{$apiDB['productPriceType']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>



                                <div class="c-field u-mb-small"
                                    style="margin-top: 10px;padding: 10px;">

                                    <label class="c-field__label" for="description">Açıklama</label>
                                    <hr>
                                    <div style="margin-top: 10px;">
                                       {{$apiDB['productStockTitle']}}
                                    </div>
                                   

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- // .row -->
        </div>
        </div>
               

            </div><!-- // .container -->
            
        </main><!-- // .o-page__content -->
    </body>
    
     <footer>
        
        <!--- main --> 
        <script src="{{asset('/js')}}/main.min.js"></script>
        
        <!--- sabit --> 
       <script src="{{asset('/web')}}/js/product.js"></script>
       
         @include('include.footer')
       
    </footer>
    
</html>