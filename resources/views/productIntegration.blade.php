<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ürün Entegrasyonu | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
         <meta id="yildirimDev" socketUrl="{{ env('YILDIRIMDEV_Socket_URL') }}" serverId="{{ env('YILDIRIMDEV_ServerId') }}" serverToken="{{ env('YILDIRIMDEV_ServerToken') }}" version="v1.0.0">

        <!-- Head -->
        @include('include.head')        
        
        
      
        
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
                     <div id="user_info" data_companyToken="{{$companyToken}}"  data_categoryToken="{{$categoryToken}}"   data_categoryTitle="{{$categoryTitle}}" style="display:none;" >Kullanıcı Bilgileri</div>

                 
                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">

                                <div class="col-lg-12">

                                
                                    <!-- Dosya Yükleme ----->
                                    <div style="display:flex;gap:10px;flex-direction: column;padding: 14px;margin-bottom: 20px;" >
                                               
                                        <!-- Form ----->
                                        <form action="{{ route('file.upload.control') }}" method="POST" id="uploadForm_general" enctype="multipart/form-data">
                                            <div style="display: flex; flex-direction: column; gap: 15px;">
                                                <input type="file" name="file" id="fileInput" style="display: flex; color: steelblue; margin-left: 10px; ">
                                                <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: 300px;border-radius: 6px;display: flex;justify-content: center;">
                                                   <div style=" display: flex; align-items: center; padding: 5px; flex-direction: row; " >
                                                     <i class="c-alert__icon fa fa-cloud-upload" style="font-size: 24px;margin-top: -6px;" ></i> 
                                                    <p style="color: blanchedalmond;font-size: 14px;font-weight: bold;margin: auto;" > Dosya Yükle </p>
                                                   </div>
                                                </button>
                                            </div>
                                        </form>
                                         <!-- Form  Son ----->
                                         
                                        <div  style=" display: none; gap: 10px; " >
                                            <p> Dosya Yeri => </p>
                                            <p id="file_url_view_fileupload"> file_url </p>
                                        </div>

                                        <div class="progress">
                                            <div class="progress-bar" id="progressBarUser" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                        </div>
                                        <div id="uploadStatus"></div>
                                        
                                    </div>
                                    <!-- Dosya Yükleme Son ---->
                                    
                                    <button class="c-btn c-btn--success c-btn--fullwidth" id="btn_product_integration" >Xml Verileri Al</button> 
                                    
                                    <div class="progress" style="margin-top:10px;">
                                        <div class="progress-bar" id="progressBarIntegration" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: brown;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                    </div>
                                    <div style="display: flex;justify-content: center; margin-top: 10px;" > <p id="progressBarIntegrationVal" style="display:none";  >0/0</p></div>
                                    
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
        
        <!--- Product --> 
       <script src="{{asset('/web')}}/js/product.js"></script>
       
         @include('include.footer')
       
    </footer>
    
</html>