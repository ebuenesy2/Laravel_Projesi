<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Destek Detayı  (#{{$id}}) | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />


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
               
                 <div class="col-12">

                    <div class="c-toolbar u-justify-between u-mb-medium">
                        <nav class="c-counter-nav">
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link" href="/supportrequest/list" >
                                    <span class="c-counter-nav__counter">-</span>Destek Taleplerim
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link is-active">
                                    <span class="c-counter-nav__counter">-</span>Destek Detay (#{{$id}})
                                </a>
                            </div>
                        </nav>
                        
                        <div>
                            @if($support_active == "1") 
                            <i class="fa fa-eye" style="color: #1bb934;font-size: 30px;" id="listItemActive" data_id="{{$support_id}}"  data_token="{{$support_token}}"  data_active="true" ></i>
                            @elseif($support_active == "0") 
                              <i class="fa fa-eye-slash"   style="color: #ed1c24;font-size: 30px;" ></i>
                            @endif
                        </div>
                    </div>

                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            
                          @for ($i = 0; $i < count($apiDB); $i++)
                            <div class="row">
                                  <div class="c-field u-mb-small">
                                      <label class="c-field__label" for="aciklama"  style="color: {{$userToken == $apiDB[$i]['created_byToken'] ? 'red' : 'black' }} ;" >{{ $userToken == $apiDB[$i]["created_byToken"] ?  "(Ben)" :  $apiDB[$i]["created_Role"]}}  #{{\Carbon\Carbon::parse($apiDB[$i]["created_at"])->diffForHumans()}}</label>
                                      <textarea class="c-input" id="textarea2" style="background-color: #f7f7f7;" spellcheck="false" disabled>{{$apiDB[$i]["description"]}}</textarea>
                                      
                                      @if($apiDB[$i]["isFile"]) 
                                           <a style="text-decoration:none; padding:10px;" id="personalIdentityPhotoFileUrl" href="{{$apiDB[$i]['fileUrl']}}" target="_blank" download="{{$apiDB[$i]['fileUrl']}}" >
                                                <i class="fa fa-download" style="color:#1bb934; font-size: 30px;  margin-top:10px;" aria-hidden="false" ></i>
                                            </a>
                                       @endif
                                  </div>
                            </div>
                          @endfor
                          
                        </div>
                    </div>

                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                       
                        <hr/>
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="c-field u-mb-small">
                                    <label class="c-field__label" for="description">Yanıtınız</label>
                                    <textarea id="description" class="c-input" rows="10" maxlength="250" {{$support_active == "0" ? 'disabled' : ''}}></textarea>
                                      <div id="description_writing" style=" display: none; gap: 10px; align-items: center; justify-content: end;" ><i class="fa fa-commenting-o" aria-hidden="true"></i><p style="margin-top: auto;  margin-bottom: auto;" >yaziyor</p></div>
                                </div>
                                   
                                <div class="c-field u-mb-small">
                                                                
                                    <!-- Dosya Yükleme ----->
                                    <form action="{{ route('file.upload.control') }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <div style="display: none;" id="file_path" ></div>
                                        <div style="display: none;" id="file_url" ></div>
                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                            <div class="custom-file" style="display: flex;gap: 10px;" >
                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" {{$support_active == "0" ? 'disabled' : ''}} >
                                                <a id="fileUploadClose" style="display: none;" > <i class="fa fa-close"   style="color: #ed1c24;font-size: 30px;" ></i></a>
                                            </div>
                                            
                                            <button type="submit"  id="fileUploadButton" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;align-items: center;" disabled >
                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                <p style="color: blanchedalmond;font-size: 14px;font-weight: bold;margin-top: 12px;"  > Dosya Ekle </p>
                                            </button>
                                        </div>
                                            
                                    </form>
                                    
                                    <div class="progress" style="margin-top: 20px;">
                                        <div class="progress-bar" id="progressBarUser" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                    </div>
                                            
                                    <!-- Dosya Yükleme Son ----->
                                
                                </div>
                                
                                  <button id="supportrequest_answer" style="text-decoration:none" class="c-btn c-btn--success c-btn--fullwidth" {{$support_active == "0" ? 'disabled' : ''}}  >YANITLA</button>
                                </div>
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
        
         <!--- Js --> 
        <script src="{{asset('/web')}}/js/supportrequest.js"></script>
     
       
         @include('include.footer')
       
    </footer>
    
</html>