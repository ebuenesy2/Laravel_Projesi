<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ürün Ekleme -3 | Yıldırımdev</title>
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
                    
                   <p id="product_info" data-temp_id="{{ app('request')->input('temp_id') }}" style="display:none;" >Ürün bilgileri</p>

                    <div class="c-toolbar u-justify-between u-mb-medium">
                        <nav class="c-counter-nav">

                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link" href="/product/add?temp_id={{ app('request')->input('temp_id') }}">
                                    <span class="c-counter-nav__counter">1</span>Ürün Bilgileri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link " href="/product/add/step2?temp_id={{ app('request')->input('temp_id') }}">
                                    <span class="c-counter-nav__counter">2</span>Ürün Resimleri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link is-active" href="/product/add/step3?temp_id={{ app('request')->input('temp_id') }}">
                                    <span class="c-counter-nav__counter">3</span>Önizleme
                                </a>
                            </div>
                          
                        </nav>

                       <div style="display:flex; gap:10px; ">
                             <a style="text-decoration:none" href="/product/add/step2?temp_id={{ app('request')->input('temp_id') }}" ><span class="c-badge c-badge--small c-badge--warning">Geri</span></a>
                             <a style="text-decoration:none" id="product_add_save" ><span class="c-badge c-badge--small c-badge--success">Oluştur</span></a>
                         </div>
                       
                    </div>
                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                              <div class="row">
                                <div class="col-lg-6">

                                    <div class="c-field u-mb-small">
                                        <img id="productViewImage" style="width: 100%;height: 100%;object-fit: cover;border: 1px solid;border-radius: 5px;"
                                            src="{{asset('/assets/img/product')}}/0_400_400.jpg" alt="" srcset="">
                                    </div>

                                    <!-- Ürün Resimleri ---->
                                    <div class="c-feed__gallery" style="display: flex;flex-direction: row; ">

                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="1" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="1"  style="display:none; position: absolute;" ><i data_id="1"  style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img  class="product_preview" id="productImageView"  data_id="1" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left; cursor: pointer;"
                                               src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="2"  style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="2" style="display:none; position: absolute;" ><i data_id="2" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="2" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left; cursor: pointer;"
                                               src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="3" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="3" style="display:none; position: absolute;" ><i data_id="3" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="3" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left; cursor: pointer;"
                                               src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>



                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="4" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="4" style="display:none; position: absolute;" ><i data_id="4" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="4" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="5" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="5" style="display:none; position: absolute;" ><i data_id="5" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="5" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="6" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="6" style="display:none; position: absolute;" ><i data_id="6" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img class="product_preview" id="productImageView"  data_id="6" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>

                                    </div>
                                    <!-- Ürün Resimleri Son ---->

                                </div>
                                <div class="col-lg-6">

                                    <table class="table border">
                                        <tbody class="border">
                                            <tr style="width:100%;display: flex;justify-content: space-between;">
                                                <td style="width:20%;" >Ürün Adı</td>
                                                <td style="width:10%;" >:</td>
                                               <td style="width:70%;"  id="preview_img_productName"></td>
                                            </tr>
                                             <tr style="display: flex;justify-content: space-between;">
                                               <td style="width:20%;" >Ürün Kodu</td>
                                               <td style="width:10%;">:</td>
                                                 <td style="width:70%;" id="preview_img_productCode"></td>
                                            </tr>
                                             <tr style="display: flex;justify-content: space-between;">
                                                <td style="width:20%;" >Kategori</td>
                                                <td style="width:10%;">:</td>
                                                 <td style="width:70%;" id="preview_img_categoryTitle"></td>
                                             <tr style="display: flex;justify-content: space-between;">
                                                <td style="width:20%;" >Marka</td>
                                               <td style="width:10%;">:</td>
                                                 <td style="width:70%;"id="preview_img_brandTitle"></td>
                                            </tr>
                                              <tr style="display: flex;justify-content: space-between;">
                                                <td style="width:20%;" >Stok</td>
                                               <td style="width:10%;">:</td>
                                                 <td style="width:70%;"id="preview_img_productStock" ></td>
                                            </tr>
                                             <tr style="display: flex;justify-content: space-between;">
                                                <td style="width:20%;" >Stok Birimi</td>
                                               <td style="width:10%;">:</td>
                                                 <td style="width:70%;" id="preview_img_productStockTitle" ></td>
                                            </tr>
                                             <tr style="display: flex;justify-content: space-between;">
                                                <td style="width:20%;" >Satış Fiyatı</td>
                                                <td style="width:10%;">:</td>
                                                 <td style="width:70%;" id="preview_img_productPrice_productPriceType" ></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>



                                <div class="c-field u-mb-small"
                                    style="margin-top: 10px;border: 1px solid;padding: 10px;">

                                    <label class="c-field__label" for="description">Açıklama</label>
                                    <hr>
                                    <div style="margin-top: 10px;" id="preview_description"></div>
                                    

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