<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ürün Önizleme | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Head -->
        @include('include.head')
        
                
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

         
          @include('include.header')

             <div class="container" style="margin-bottom: 50px;">
            <div class="container">
                <div class="col-12">

                    <div class="c-toolbar u-justify-between u-mb-medium">
                        <a style="text-decoration:none" href="/product/list"><span class="c-badge c-badge--info">Ürün Listesi</span></a>
                        
                        <h3>Ürün Önizleme</h3>

                        <span class="c-badge c-badge--warning" ><a href="/product/edit/{{$apiDB['id']}}" style="display: flex;align-items: center;gap: 10px;color: aliceblue; text-decoration:none;">Düzenle</a></span>
                    </div>
                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="c-field u-mb-small">
                                        <img id="productViewImage" style="width: 100%; height: 450px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px;"
                                            src="{{$apiDB['productImageUrl']}}" alt="" >
                                    </div>

                                    <div class="c-feed__gallery" style="display: flex;flex-direction: row; ">

                                        @if($apiDB['productOtherImageUrl1'])
                                        <div class="c-feed__gallery-item">
                                            <img class="product_preview" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left;  cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl1']}}" />
                                        </div>
                                        @endif
                                        
                                        @if($apiDB['productOtherImageUrl2'])
                                        <div class="c-feed__gallery-item">
                                            <img  class="product_preview" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl2']}}" />
                                        </div>
                                        @endif
                                        
                                        @if($apiDB['productOtherImageUrl3'])
                                        <div class="c-feed__gallery-item">
                                            <img class="product_preview"  style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl3']}}" />
                                        </div>
                                        @endif


                                        @if($apiDB['productOtherImageUrl4'])
                                        <div class="c-feed__gallery-item">
                                            <img class="product_preview" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl4']}}" />
                                        </div>
                                        @endif
                                        
                                        @if($apiDB['productOtherImageUrl5'])
                                        <div class="c-feed__gallery-item">
                                            <img class="product_preview" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl5']}}" />
                                        </div>
                                        @endif
                                        
                                        @if($apiDB['productOtherImageUrl6'])
                                        <div class="c-feed__gallery-item">
                                            <img class="product_preview" style="width: 100px;height: 100px;object-fit: cover;border: 1px solid #d1cece;border-radius: 5px; float: left; cursor: pointer;"
                                                src="{{$apiDB['productOtherImageUrl6']}}" />
                                        </div>
                                        @endif


                                    </div>

                                </div>
                                <div class="col-lg-6">

                                    <table class="table border">
                                        <tbody class="border">
                                            <tr>
                                                <td>Ürün Adı</td>
                                                <td>:</td>
                                                <td>{{$apiDB["productName"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kategori</td>
                                                <td>:</td>
                                                <td>{{$apiDB["categoryTitle"]}}</td>
                                            <tr>
                                                <td>Marka</td>
                                                <td>:</td>
                                                <td>{{$apiDB["brandTitle"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Ürün Kodu</td>
                                                <td>:</td>
                                                <td>{{$apiDB["productCode"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Stok Birimi</td>
                                                <td>:</td>
                                                <td>{{$apiDB["productStockTitle"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td>:</td>
                                                <td>{{$apiDB["productStock"]}}</td>
                                            </tr>
                                            <tr>
                                                <td>Satış Fiyatı</td>
                                                <td>:</td>
                                                <td>{{$apiDB["productPrice"]}} {{$apiDB["productPriceType"]}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>



                                <div class="c-field u-mb-small"
                                    style="margin-top: 10px;padding: 10px;">

                                    <label class="c-field__label" for="description">Açıklama</label>
                                    <hr>
                                   {!!$apiDB["description"]!!}

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
            
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