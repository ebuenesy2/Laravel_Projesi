<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ürün Ekleme | Yıldırımdev</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

                    <div class="c-toolbar u-justify-between u-mb-medium">
                        <nav class="c-counter-nav">
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link is-active" href="/product/add?temp_id={{ app('request')->input('temp_id') }}">
                                    <span class="c-counter-nav__counter">1</span>Ürün Bilgileri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link" >
                                    <span class="c-counter-nav__counter">2</span>Ürün Resimleri
                                </a>
                            </div>
                            <div class="c-counter-nav__item">
                                <a style="text-decoration:none" class="c-counter-nav__link" >
                                    <span class="c-counter-nav__counter">3</span>Önizleme
                                </a>
                            </div>
                           
                        </nav>

                        <a style="text-decoration:none"  id="product_add_step1" ><span class="c-badge c-badge--small c-badge--info">İleri</span></a>
                    </div>
                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">

                                <div class="col-lg-6">
                                   <div id="user_info" data_companyToken="{{$companyToken}}"  data_categoryToken="{{$categoryToken}}"   data_categoryTitle="{{$categoryTitle}}" style="display:none;" >Kullanıcı Bilgileri</div>
                                    
                                   <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="brandTitle">Marka Seç</label>
                                        <select id="brandTitle" class="form-select" style="height: 40px;border: 1px solid #dfe3e9;border-radius: 8px;font-size: .875rem;font-weight: 500;outline: 0;width: 100%;padding-left: .9375rem; margin-bottom: 10px;">
                                            <option value="0"  selected="false" >Marka Seçiniz</option>
                                             @for ($i = 0; $i < count($brandDB); $i++)
                                                <option value="{{$brandDB[$i]['id']}}" data-token="{{$brandDB[$i]['token']}}">{{$brandDB[$i]['brandTitle']}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                     <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productName">Ürün Adı</label>
                                        <input class="c-input" type="text" id="productName" placeholder="Ürün Adı">
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productCode">Ürün Kodu</label>
                                        <input class="c-input" type="text" id="productCode" placeholder="Ürün Kodu">
                                    </div>
                                   
                                </div>
                                
                                 <div class="col-lg-6">
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productStockTitle">Stok Türü</label>
                                        <select id="productStockTitle" class="form-select" style="height: 40px;border: 1px solid #dfe3e9;border-radius: 8px;font-size: .875rem;font-weight: 500;outline: 0;width: 100%;padding-left: .9375rem; margin-bottom: 10px;">
                                            <option value="0" data_title="Adet" >Adet</option>
                                            <option value="1" data_title="Kg" >Kg</option>
                                            <option value="2" data_title="Metro" >Metro</option>
                                        </select>
                                    </div>

                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productStock">Stok Sayısı</label>
                                        <input class="c-input" type="number" id="productStock" placeholder="Stok Sayısı">
                                    </div>

                                   <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productPriceType">Para Birimi</label>
                                        <select id="productPriceType" class="form-select" style="height: 40px;border: 1px solid #dfe3e9;border-radius: 8px;font-size: .875rem;font-weight: 500;outline: 0;width: 100%;padding-left: .9375rem; margin-bottom: 10px;">
                                            <option value="0" data_title="TL" >TL</option>
                                            <option value="1"  data_title="$" >$</option>
                                            <option value="2"  data_title="€" >€</option>
                                        </select>
                                    </div>
                                    
                                    <div class="c-field u-mb-small">
                                        <label class="c-field__label" for="productPrice">Satış Fiyatı</label>
                                        <input class="c-input" type="number" id="productPrice" placeholder="Satış Fiyatı">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <label class="c-field__label" for="description">Açıklama</label>
                                    <textarea id="description" class="c-input" rows="10" maxlength="255"></textarea>
                                    <p id="maxSonuc">Max: 255 karakter:!</p>
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