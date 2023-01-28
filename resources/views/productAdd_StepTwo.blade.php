<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ürün Ekleme - 2 | Yıldırımdev</title>
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
                                <a style="text-decoration:none" class="c-counter-nav__link is-active" href="/product/add/step2?temp_id={{ app('request')->input('temp_id') }}">
                                    <span class="c-counter-nav__counter">2</span>Ürün Resimleri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link" href="/product/add/step3?temp_id={{ app('request')->input('temp_id') }}">
                                    <span class="c-counter-nav__counter">3</span>Önizleme
                                </a>
                            </div>
                          
                        </nav>

                        <div style="display:flex; gap:10px; ">
                            <a style="text-decoration:none" href="/product/add?temp_id={{ app('request')->input('temp_id') }}" ><span class="c-badge c-badge--small c-badge--warning">Geri</span></a>
                            <a style="text-decoration:none" id="product_add_step2" ><span class="c-badge c-badge--small c-badge--info">Önizlemeye Geç</span></a>
                        </div>
                       
                    </div>
                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                           <div class="row">

                                <div class="col-lg-6">

                                    <div class="c-field u-mb-small">
                                        <img style="width: 100%;height: 100%;object-fit: cover;border: 1px solid;border-radius: 5px;" id="product_main_img" src="{{asset('/assets/img/product')}}/0_400_400.jpg" alt="" srcset="">
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <!-- Dosya Yükleme ----->
                                        <div
                                            style="display:flex;gap:10px;flex-direction: column;padding: 14px;margin-bottom: 20px;">

                                            <!-- Form ----->
                                            <form action="{{ route('file.upload.control') }}" method="POST"
                                                id="uploadForm_mainProduct" enctype="multipart/form-data">
                                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                                    <input type="file" name="file" id="fileInput" style="display: flex; color: steelblue; margin-left: 10px; ">
                                                    <button type="submit" name="submit" class="btn btn-success"
                                                        style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;padding: 12px;width: 300px;border-radius: 6px;display: flex;justify-content: center; width:100%;">
                                                        <div
                                                            style=" display: flex; align-items: center; padding: 5px; flex-direction: row; ">
                                                            <i class="c-alert__icon fa fa-cloud-upload"
                                                                style="font-size: 24px;margin-top: -6px;"></i>
                                                            <p style="color: blanchedalmond;font-size: 14px;font-weight: bold;margin: auto;"> Dosya Yükle </p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- Form  Son ----->

                                            <div class="progress">
                                                <div class="progress-bar" id="progressBarUser_mainPicture" role="progressbar"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;">
                                                </div>
                                            </div>
                                            <div id="uploadStatus"></div>

                                        </div>
                                        <!-- Dosya Yükleme Son ---->
                                    </div>

                                </div>

                                <div class="col-lg-6">

                                    <div class="c-field u-mb-small">
                                        <!-- Dosya Yükleme ----->
                                        <div
                                            style="display:flex;gap:10px;flex-direction: column;padding: 14px;margin-bottom: 20px;">

                                            <!-- Form ----->
                                            <form  method="POST"
                                                id="uploadForm_multiProduct" enctype="multipart/form-data">
                                                <div style="display: flex; flex-direction: column; gap: 15px;">
                                                    <input type="file" name="files[]" style="display: flex; color: steelblue; margin-left: 10px; " multiple>

                                                    <button type="submit" name="submit" class="btn btn-success"
                                                        style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: 300px;border-radius: 6px;display: flex;justify-content: center; width:100%;">
                                                        <div
                                                            style=" display: flex; align-items: center; padding: 5px; flex-direction: row; ">
                                                            <i class="c-alert__icon fa fa-cloud-upload"
                                                                style="font-size: 24px;margin-top: -6px;"></i>
                                                            <p style="color: blanchedalmond;font-size: 14px;font-weight: bold;margin: auto;"> Çoklu Dosya Yükle </p>
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
                                            <!-- Form  Son ----->

                                            <div style=" display: none; gap: 10px; ">
                                                <p> Dosya Yeri => </p>
                                                <p id="file_url_view_fileupload" > file_url </p>
                                            </div>

                                            <div class="progress">
                                                <div class="progress-bar" id="progressBarMulti" role="progressbar"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                    style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;">
                                                </div>
                                            </div>
                                            <div id="uploadStatusMulti"></div>

                                        </div>
                                        <!-- Dosya Yükleme Son ---->
                                    </div>

                                    <!-- Ürün Resimleri ---->
                                    <div class="c-feed__gallery" style="display: flex;flex-direction: row; ">
                                            
                                         <p id="ProductCount" data_count ="0"  style ="display:none;" >ProductCount</p>
                                    
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="2"  style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="2" style="display:none; position: absolute;" ><i data_id="2" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img id="productImageView" data_id="2" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left;"
                                               src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="3" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="3" style="display:none; position: absolute;" ><i data_id="3" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img id="productImageView" data_id="3" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left;"
                                               src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>

                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="4" style="position: relative;display:none;" >
                                            <div id="productImageViewCancel" data_id="4" style="display:none; position: absolute;" ><i data_id="4" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img id="productImageView" data_id="4" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left;"
                                                src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="5" style="position: relative; display:none; " >
                                            <div id="productImageViewCancel" data_id="5" style="display:none; position: absolute;" ><i data_id="5" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img id="productImageView" data_id="5" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left;"
                                                src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>
                                        <div class="c-feed__gallery-item" id="productImageViewList" data_id="6" style="position: relative; display:none;" >
                                            <div id="productImageViewCancel" data_id="6" style="display:none; position: absolute;" ><i data_id="6" style="font-size: 23px;color: red;border: 1px solid black;border-radius: 20%;cursor: pointer;background-color: azure;" class="fa fa-times" aria-hidden="true"></i></div>
                                            <img id="productImageView" data_id="6" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid;border-radius: 5px; float: left;"
                                                src="{{asset('/assets/img/product')}}/0_400_400.jpg" />
                                        </div>


                                    </div>
                                    <!-- Ürün Resimleri Son ---->
                                    
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