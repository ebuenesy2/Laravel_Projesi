<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sipariş Listesi | Yıldırımdev</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta id="yildirimDev" socketUrl="{{ env('YILDIRIMDEV_Socket_URL') }}" serverId="{{ env('YILDIRIMDEV_ServerId') }}" serverToken="{{ env('YILDIRIMDEV_ServerToken') }}" version="v1.0.0">

        <!-- Head -->
        @include('include.head')
        
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

         
          @include('include.header')

            
            <!-- Modal Cargo Edit  -->
            <div class="c-modal modal fade" id="cargoEdit" tabindex="-1" role="dialog" aria-labelledby="modaldetail"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <!--- Header --->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kargo Takip Paneli</h5>
                            <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--- Header Son--->
                        
                        <!--- Body --->
                        <form class="c-card__body" method="post" action="javascript:void(0)">

                            <div id="cargoInfo" token="token" style="display:none;" >Cargo</div>
                                
                            <div class="c-field u-mb-small" data-select2-id="4">
                                <label class="c-field__label" for="cargoCompanyListChange">Kargo Firması </label>
                                    <select id="cargoCompanyListChange" class="form-select" style=" height: 40px; border: 1px solid #dfe3e9; border-radius: 8px; font-size: .875rem; font-weight: 500; outline: 0; width: 100%; padding-left: .9375rem; ">
                                    <option value="0"  selected="false" >Firma Seçiniz</option>
                                    
                                    @for ($i = 0; $i < count($CargoCompany); $i++)
                                        <option value="{{$CargoCompany[$i]['id']}}" data-token="{{$CargoCompany[$i]['token']}}"  >{{$CargoCompany[$i]['cargoCompanyTitle']}}</option>
                                    @endfor
                                    </select>
                            </div>

                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="cargoTrackingCode">Kargo Takip Numarası</label>
                                <input class="c-input" type="text" id="cargoTrackingCode" placeholder="Kargo Takip Numarası" />
                            </div>

                            <button class="c-btn c-btn--info c-btn--fullwidth" id="cargo_update" data_token="data_token" data_companyToken="data_companyToken" > Güncelle </button>
                        </form>
                        <!--- Body Son --->
                      
                    </div>
                </div>
            </div>
            <!-- Modal Cargo Edit  son -->
            
            <!--- Modallar --->
            @foreach ($apiDB as $data)
            
            <!-- Modal Product Edit  -->  
            <div class="c-modal modal fade" id="productEdit_{{$data['token']}}_{{$data['companyToken']}}" tabindex="-1" role="dialog" aria-labelledby="modaldetail"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content" style="width: max-content;">
                    
                        <!--- Sipariş Bilgisi --->
                        <p id="orderGroupInfo"  data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" style="display:none;"  >Order Bilgisi</p>
                    
                        <!--- Header --->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ürün Onay Paneli</h5>
                            <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--- Header Son--->
                        
                        <!--- Body --->
                        <table class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Ürün Resim</th>
                                    <th class="c-table__cell c-table__cell--head">Ürün Adı</th>
                                    <th class="c-table__cell c-table__cell--head">Adet</th>
                                    <th class="c-table__cell c-table__cell--head">Tutar</th>
                                    <th class="c-table__cell c-table__cell--head">Onay</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach ($data['dataItems'] as $dataDataItems)
                                    <tr class="c-table__row">
                                        <td class="c-table__cell c-table__cell--img o-media">
                                            <div class="o-media__img u-mr-xsmall"><img src="{{$dataDataItems['productImgUrl']}}" style="width:56px;" alt="Confide's App Icon"></div>
                                        </td>
                                        <td class="c-table__cell" id="productInfo" data_productid="{{$dataDataItems['productId']}}" data_producttoken="{{$dataDataItems['productToken']}}" >{{$dataDataItems['productName']}}</td>
                                        <td class="c-table__cell">{{$dataDataItems['productPieces']}}</td>
                                        <td class="c-table__cell">{{$dataDataItems['productTotalPrice']}} {{$dataDataItems['productPriceType']}} </td>
                                        <td class="c-table__cell"> 
                                        <div class="c-switch {{$dataDataItems['statusToken'] =='token6' ? 'is-active' : ''}}"><input class="c-switch__input" id="productCheck" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" data_producttoken="{{$dataDataItems['productToken']}}" type="checkbox" checked="{{$dataDataItems['statusToken'] =='token6' ? 'checked' : ''}}"></div>
                                        </td>
                                    </tr>
                                @endforeach  
                                    
                              
                            </tbody>
                        </table><!-- // .c-table -->
                        <!--- Body Son --->
                        
                        <!--- Footer --->
                        <div class="modal-footer">
                            <button type="button" id="productUpload" data_token="{{$data['token']}}" data_myOrderId="{{$data['myOrderId']}}" data_companyToken="{{$data['companyToken']}}" class="btn btn-primary">Güncelle</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        </div>
                        <!--- Footer Son --->
                    </div>
                </div>
            </div>
            <!-- Modal Product Edit  son -->
            
                        
            <!-- Modal Product View  -->  
            <div class="c-modal modal fade" id="productView_{{$data['token']}}_{{$data['companyToken']}}" tabindex="-1" role="dialog" aria-labelledby="modaldetail"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <!--- Header --->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sipariş Detayı</h5>
                            <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--- Header Son--->
                        
                        <!--- Body --->
                        <table class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                    <tr class="c-table__row">
                                        <th class="c-table__cell c-table__cell--head">Ürün Resim</th>
                                        <th class="c-table__cell c-table__cell--head">Ürün Adı</th>
                                        <th class="c-table__cell c-table__cell--head">Adet</th>
                                        <th class="c-table__cell c-table__cell--head">Tutar</th>
                                    </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['dataItems'] as $dataDataItems)
                                  @if($dataDataItems['isActive'])
                                    <tr class="c-table__row">
                                        <td class="c-table__cell c-table__cell--img o-media">
                                            <div class="o-media__img u-mr-xsmall"><img src="{{$dataDataItems['productImgUrl']}}" style="width:56px;" alt="Confide's App Icon"></div>
                                        </td>
                                        <td class="c-table__cell" id="productInfo" data_productid="{{$dataDataItems['productId']}}" data_producttoken="{{$dataDataItems['productToken']}}" >{{$dataDataItems['productName']}}</td>
                                        <td class="c-table__cell">{{$dataDataItems['productPieces']}}</td>
                                        <td class="c-table__cell">{{$dataDataItems['productTotalPrice']}} {{$dataDataItems['productPriceType']}}</td>
                                    </tr>
                                    @endif
                                @endforeach  
                                <tr class="c-table__row">
                                    <td class="c-table__cell c-table__cell--img o-media"></td>
                                    <td class="c-table__cell" style="text-align: right;">Toplam Ürün Adeti</td>
                                    <td class="c-table__cell">:</td>
                                    <td class="c-table__cell">{{$data['total']['totalActivePieces']}}</td>
                                </tr>
                                <tr class="c-table__row">
                                    <td class="c-table__cell c-table__cell--img o-media"></td>
                                    <td class="c-table__cell" style="text-align: right;">Genel Toplam</td>
                                    <td class="c-table__cell">:</td>
                                    <td class="c-table__cell">{{$data['total']['totalActivePrice']}} {{$data['total']['productPriceType']}}</td>
                                </tr>
                            </tbody>
                        </table><!-- // .c-table -->
                        <!--- Body Son --->
                      
                    </div>
                </div>
            </div>
            <!-- Modal Product View  son --> 
            
            @endforeach
            <!--- Modallar Son --->
           

          <div class="container">
            <div class="row u-mb-large">
                <div class="col-md-12">
                    <div class="c-table-responsive">
                        <div
                            style="display: flex; justify-content: space-between; position: relative; padding: 25px 30px; border: 1px solid #e6eaee; border-bottom: 0; border-radius: 4px 4px 0 0; background-color: #fff;color: #354052; font-size: 24px; text-align: left; ">
                            <div style="display:flex; gap:10px;" >
                                <p style="font-size: 19px; font-weight: bold; margin-top: auto; margin-bottom: auto; ">Sipariş Listesi |  </p>
                                <p style="margin:auto;">{{$apiDBCount}}</p>
                            </div>
                                                       
                        </div>         
                        
                       
                         <!-- Table -->
                        <table id="myTable" class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head" style="display:none;">#</th>
                                    <th class="c-table__cell c-table__cell--head">Sipariş ID</th>
                                    <th class="c-table__cell c-table__cell--head" style="display:{{$userRoleToken == 'token' ? 'block' : 'none'}}">Tedarikçi</th>
                                    <th class="c-table__cell c-table__cell--head" style="width: 50%;" >Sipariş Tarihi</th>
                                    <th class="c-table__cell c-table__cell--head" style="width: 50%;">Süreç</th>
                                    <th class="c-table__cell c-table__cell--head">İşlemler</th>
                                    <th class="c-table__cell c-table__cell--head">Kargo Durumu</th>
                                    <th class="c-table__cell c-table__cell--head">Kargo</th>
                                </tr>
                            </thead>
                            
                            <tbody >
                                @foreach ($apiDB as $data)
                                   <tr class="c-table__row">
                                    
                                         <!---- Seç --->
                                        <td class="c-table__cell" style="display:none;"><input type="checkbox" id="{{$data['myOrderId']}}" name="chk_product" data-id="{{$data['myOrderId']}}" > </td>
                                         
                                     
                                        
                                        <!---- Bilgileri --->
                                        <td class="c-table__cell"> #{{$data["myOrderId"]}} </td>
                                        <td class="c-table__cell" style="display:{{$userRoleToken == 'token' ? 'block' : 'none'}}" > {{$data["companyTitle"]}}</td>
                                        <td class="c-table__cell"> {{\Carbon\Carbon::parse($data["created_at"])->isoFormat('Do MMMM YYYY, HH:mm:ss')}}</td>
                                       
                                        
                                        <!---- Süreç --->
                                        <td class="c-table__cell"><span class="c-badge c-badge--{{$data['status']['status']}}">{{$data['status']['statusDescriptionTR']}}</span></td>
                                        <!---- Süreç Son  --->
                                        
                                        <!---- İşlemler --->
                                        <td class="c-table__cell"> 
                                            <ul class="u-flex u-justify-between" style="margin:auto;padding: 0 !important;gap: 10px;"> 
                                              <li class="u-text-large" style="margin: auto;" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#productEdit_{{$data['token']}}_{{$data['companyToken']}}" ><i data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" data_status="{{$data['status']['statusToken']}}"  class="fa fa-pencil-square-o" style="color:#b7b7b7; font-size: 27px; padding-right: 5px;"></i></a></li>
                                              <li class="u-text-large" style="margin: auto;" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#productView_{{$data['token']}}_{{$data['companyToken']}}" ><i data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" class="fa fa-ellipsis-h" style="color:#b7b7b7; font-size: 27px; padding-right: 5px;"></i></a></li>
                                            </ul>
                                        </td>
                                        <!---- İşlemler Son --->
                                        
                                        <!---- Active --->
                                        <td class="c-table__cell"> 
                                            @if($data["cargo"]["cargoStatusToken"] == "token5") 
                                            <a style="text-decoration:none;display: flex;justify-content: center;" class="u-text-mute" ><i class="fa fa-paper-plane" style="color: #666;font-size: 30px;" id="listItemActive" data_id="{{$data['myOrderId']}}"  data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" data_cargoToken="{{$data['cargo']['cargoStatusToken']}}" ></i></a>
                                            @elseif($data["cargo"]["cargoStatusToken"] == "token14") 
                                            <a style="text-decoration:none;display: flex;justify-content: center;" class="u-text-mute"><i class="fa fa-spinner"   style="color: #ed1c24;font-size: 30px;"  data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" data_cargoToken="{{$data['cargo']['cargoStatusToken']}}" ></i></a>
                                            @elseif($data["cargo"]["cargoStatusToken"] == "token15") 
                                            <a style="text-decoration:none;display: flex;justify-content: center;" class="u-text-mute"><i class="fa fa-check-circle"   style="color: green;font-size: 30px;"  data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" data_cargoToken="{{$data['cargo']['cargoStatusToken']}}" ></i></a>
                                            @endif
                                        </td>
                                        <!---- Active Son --->
                                        
                                        <!---- Kargo --->
                                        <td class="c-table__cell"> 
                                            <ul class="u-flex u-justify-between" style="margin:auto;padding: 0 !important;gap: 10px;">
                                             
                                              <li class="u-text-large" style="margin: auto;" > 
                                              
                                               @if($data["cargo"]["cargoStatusToken"] == "token5")
                                               <a ><i data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" class="fa fa-archive" style="color:#b7b7b7; font-size: 27px; padding-right: 5px;"></i></a>
                                               @elseif( $data["cargo"]["cargoStatusToken"] == "token14" || $data["cargo"]["cargoStatusToken"] == "token15" )
                                               <a href="/cargo/export/{{$data['myOrderId']}}/{{$data['companyId']}}" ><i data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" class="fa fa-archive" style="color:green; font-size: 27px; padding-right: 5px;"></i></a>
                                               @endif
                                            </li>
                                            
                                            
                                            <li class="u-text-large" style="margin: auto;" >
                                              @if($data["cargo"]["cargoStatusToken"] == "token5")
                                              <a class="u-text-mute"   ><i data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}"   class="fa fa-truck u-mr-xsmall" style="{{ $data['cargo']['cargoCompanyToken'] ? 'color:green;' : 'color:#b7b7b7;'  }}   font-size: 27px; padding-right: 5px;"></i></a>
                                               @elseif( $data["cargo"]["cargoStatusToken"] == "token14" || $data["cargo"]["cargoStatusToken"] == "token15" )
                                              <a class="u-text-mute modal_info" data-toggle="modal" data-target="#cargoEdit"  ><i data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}" data_cargoCompanyToken="{{$data['cargo']['cargoCompanyToken'] ? $data['cargo']['cargoCompanyToken'] : 'null' }}" data_cargoCompanyId="{{$data['cargo']['cargoCompanyId'] ? $data['cargo']['cargoCompanyId'] : 'null' }}" data_cargoTrackingCode="{{$data['cargo']['cargoTrackingCode'] ? $data['cargo']['cargoTrackingCode'] : 'null'}}" class="fa fa-truck u-mr-xsmall" style="{{ $data['cargo']['cargoCompanyToken'] ? 'color:green;' : 'color:darkblue;'  }}   font-size: 27px; padding-right: 5px;"></i></a>
                                               @endif
                                            </li>
                                             
                                            </ul>
                                        </td>
                                        <!---- Kargo Son --->
                                       
                                    </tr>
                                    
                                              
                                  
                                    
                                @endforeach
                            </tbody>
                        </table>
                         <!-- Table Son -->
                         
                    </div>
                    
                
                    <div style="display: {{$apiDBRowCount == 0 ? 'flex' : 'none'}};flex-direction: column;gap: 10px;padding: 20px;justify-content: center;align-items: center;">
                        <img width="100" src="{{asset('/img')}}/icon/sad.png"/>
                        <p>Şuan listenizde hiçbir veri yoktur.</p>
                    </div>
                            
                    
                    <table style="border: 1px solid #e6eaee;display: flex;padding: 9px;background: #f5f8fa; margin-top:10px;" >
                       <tbody style="display: flex;gap: 30px;" >
                            <tr style="display: none;gap: 10px;" >
                                <th style="margin: auto;"><input type="checkbox"  name="showAllRows" id="showAllRows_check" value="all"></th>
                                <th style="margin: auto;">Tümünü Seç</th>
                            </tr>
                            <tr style="display: flex;gap: 10px;" >
                                <th style="margin: auto;" >Satır Sayısı</th>
                                <th>   
                                    <select id="row_count" class="form-select" style="height: 40px;border: 1px solid #dfe3e9;border-radius: 3px;font-size: .875rem;font-weight: 500;outline: 0;width: 100%;padding-left: .9375rem; margin: auto;">
                                        <option value="10" {{$parameter_rowcount == '10' ? 'selected' :'' }} >10</option>
                                        <option value="20" {{$parameter_rowcount == '20' ? 'selected' :'' }} >20</option>
                                        <option value="30" {{$parameter_rowcount == '30' ? 'selected' :'' }} >30</option>
                                        <option value="50" {{$parameter_rowcount == '50' ? 'selected' :'' }}  >50</option>
                                        <option value="100" {{$parameter_rowcount == '100' ? 'selected' :'' }} >100</option>
                                        <option value="auto" {{$parameter_rowcount == 'auto' ? 'selected' :'' }}  >auto</option>
                                    </select>
                                </th>
                            </tr>
                          
                            
                             <tr style="display: flex;gap: 10px;" >
                                <th style="margin: auto;" ><a  href="?page={{$parameter_page-1 <= 1 ? 1 : $parameter_page-1 }}&rowcount={{$parameter_rowcount}}"><button><</button></a></th>
                                
                                 @for ($i =0; $i <$apiDBRowCount; $i++)
                                   <th style="margin: auto;" ><a href="?page={{$i+1}}&rowcount={{$parameter_rowcount}}"><button style="background-color: {{ $parameter_page == $i+1 ? '#344564;' : 'RGBA(107, 119, 140, 0.2);' }} color: {{ $parameter_page == $i+1 ? 'white;' : 'black;' }}; border-radius: 7px;" >{{$i+1}}</button></a></th>
                                  @endfor
                                  
                                <th style="margin: auto;" ><a href="?page={{$parameter_page+1 >= $apiDBRowCount ? $apiDBRowCount : $parameter_page+1 }}&rowcount={{$parameter_rowcount}}" ><button>></button></a></th>
                            </tr>
                            
                       </tbody>
                    </table>
                   
                </div>
            </div>


        </div>
            
        </main><!-- // .o-page__content -->
    </body>
    
    <footer>
        
        <!--- main --> 
        <script src="{{asset('/js')}}/main.min.js"></script>
        
        <!--- Js --> 
       <script src="{{asset('/web')}}/js/order.js"></script>
       
       
         @include('include.footer')
       
    </footer>
    
</html>