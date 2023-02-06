<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dosya Yükleme | Bex360</title>
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
          
                    
            <!-- Modal Fatura -->
            <div class="modal fade" id="faturaModal" tabindex="-1" role="dialog" aria-labelledby="faturaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Dosya Yükle</h5>
                        <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="c-field u-mb-xsmall">
                            <div style="display: flex;gap:5px;justify-content: center;margin-top: 20px;margin-bottom: 20px;">
                                <!-- Dosya Yükleme ----->
                                <form method="POST" id="uploadFormFatura" enctype="multipart/form-data">
                                    <div style="display: flex;flex-direction: column; gap: 15px;">
                                        <input type="hidden" name="apiToken" id="apiToken" value="" >
                                        <input type="file" name="file" id="fileInput" style="display: flex; color: steelblue; margin-left: 10px; ">
                                        <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: 300px;border-radius: 6px;display: flex;justify-content: center;">
                                            <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                            <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Dosya Yükle </p>
                                        </button>
                                    </div>
                                </form>
                                <!-- Dosya Yükleme Son ---->
                            </div>

                            <div class="progress">
                                <div class="progress-bar" id="progressBarFatura" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: #fff;border-radius: 6px;"></div>
                            </div>
                            <div id="uploadStatus"></div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- Modal Fatura Son -->

            <div class="container-fluid">
               
                <h1> Dosya Yükleme </h1>
                 
                <div style="width: max-content; border: 1px solid; padding: 42px;" > 
                    
                                 
                    <!-- Dosya Yükleme ----->
                    <form action="{{ route('file.upload.control') }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <div id="file_path" ></div>
                        <div id="file_url" ></div>
                        <div style="display: flex;flex-direction: column; gap: 15px;">
                            <input type="hidden" name="apiToken" id="apiToken" value="" >
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;align-items: center;" >
                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                <p style="color: blanchedalmond;font-size: 14px;font-weight: bold;margin-top: 12px;" > Sabit Dosya Yükleme </p>
                            </button>
                        </div>
                            
                    </form>
                    
                    <div class="progress" style="margin-top: 20px;">
                        <div class="progress-bar" id="progressBarUser" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                    </div>
                                                                
                    <!-- Dosya Yükleme Son ----->
                
                </div>
               

            </div><!-- // .container -->
            
            <div class="container-fluid">
               
                <h1> Dosya Yükleme Modal  </h1>
                 
               <a class="u-text-mute modal_info" data-toggle="modal" data-target="#faturaModal" ><i class="fa fa-upload" style="color: coral; font-size: 30px;" data_id="data_id" data_token="data_token" ></i></a>
               

            </div><!-- // .container -->
            
        </main><!-- // .o-page__content -->
    </body>
    
    <footer>
        
        <!--- main --> 
        <script src="{{asset('/js')}}/main.min.js"></script>
        
        <!--- JS --> 
       <script src="{{asset('/web')}}/js/0_const_fileUpload.js"></script>
       
         @include('include.footer')
       
    </footer>
    
</html>