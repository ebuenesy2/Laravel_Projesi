<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cari Hesap Listesi | Yıldırımdev</title>
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

            
            
            <!-- Modal Fatura -->
            <div class="modal fade" id="faturaModal" tabindex="-1" role="dialog" aria-labelledby="dekontModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fatura Yükle</h5>
                        <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="c-field u-mb-xsmall">
                            <div style="display: flex;gap:5px;justify-content: center;margin-top: 20px;margin-bottom: 20px;">
                                <!-- Dosya Yükleme ----->
                                <form method="POST" id="uploadFormFatura" enctype="multipart/form-data">
                                    <div style="display: flex;flex-direction: column; gap: 15px;">
                                        <input type="hidden" name="apiToken" id="apiTokenFatura" value="" >
                                        <input type="hidden" name="companyToken" id="companyTokenFatura" value="" >
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
           
            
            <!-- Modal Dekont -->
            <div class="modal fade" id="dekontModal" tabindex="-1" role="dialog" aria-labelledby="dekontModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dekont Yükle</h5>
                        <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="c-field u-mb-xsmall">
                            <div style="display: flex;gap:5px;justify-content: center;margin-top: 20px;margin-bottom: 20px;">
                                <!-- Dosya Yükleme ----->
                                <form method="POST" id="uploadFormDekont" enctype="multipart/form-data">
                                    <div style="display: flex;flex-direction: column; gap: 15px;">
                                        <input type="hidden" name="apiToken" id="apiTokenDekont" value="" >
                                        <input type="hidden" name="companyToken" id="companyTokenDekont" value="" >
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
                                <div class="progress-bar" id="progressBarDekont" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: #fff;border-radius: 6px;"></div>
                            </div>
                            <div id="uploadStatus"></div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- Modal Dekont Son -->
            
            

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
                    <h4 class="c-state__number">{{$paymentAwaiting}} TL</h4>
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
                    <h4 class="c-state__number">{{$apiDBCount}}</h4>
                    <p class="c-state__status">toplam sipariş sayınız</p>
                    <span class="c-state__indicator">
                        <i class="fa fa-arrow-circle-o-up"></i>
                    </span>
                    </div>
                    <!-- // c-state -->
                </div>
            </div>
          
            <div class="row u-mb-large">
                <div class="col-md-12">
                    <div class="c-table-responsive">
                        <div
                            style="display: flex; justify-content: space-between; position: relative; padding: 25px 30px; border: 1px solid #e6eaee; border-bottom: 0; border-radius: 4px 4px 0 0; background-color: #fff;color: #354052; font-size: 24px; text-align: left; ">
                            <div style="display:flex; gap:10px;" >
                                <p style="font-size: 19px; font-weight: bold; margin-top: auto; margin-bottom: auto; "> Cari Hesap Listesi |  </p>
                                <p style="margin:auto;">{{$apiDBCount}}</p>
                            </div>
                                                       
                        </div>                   

                         <!-- Table -->
                        <table id="myTable" class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head" style="display:none;">#</th>
                                    <th class="c-table__cell c-table__cell--head">Sipariş ID</th>
                                    <th class="c-table__cell c-table__cell--head" style="display:{{$userRoleToken == 'token' ? 'flex' : 'none'}}; width: 80%;" >Firma Bilgisi</th>
                                    <th class="c-table__cell c-table__cell--head" style="width: 80%;" >Hakedilen Tutar</th>
                                    <th class="c-table__cell c-table__cell--head">Ödeme Tarihi</th>
                                    <th class="c-table__cell c-table__cell--head">Süreç</th>
                                    <th class="c-table__cell c-table__cell--head">Fatura</th>
                                    <th class="c-table__cell c-table__cell--head">Dekont</th>
                                    <th class="c-table__cell c-table__cell--head">İşlemler</th>
                                  
                                  
                                </tr>
                            </thead>
                            
                            <tbody >
                                @foreach ($apiDB as $data)
                                   <tr class="c-table__row">
                                    
                                         <!---- Seç --->
                                        <td class="c-table__cell" style="display:none;"><input type="checkbox" id="{{$data['myOrderId']}}" name="chk_product" data-id="{{$data['myOrderId']}}" > </td>
                                         
                                     
                                        
                                        <!---- Bilgileri --->
                                        <td class="c-table__cell"> #{{$data["myOrderId"]}} </td>
                                        <td class="c-table__cell" style="display:{{$userRoleToken == 'token' ? 'block' : 'none'}}" > {{$data['companyTitle']}}</td>
                                        <td class="c-table__cell"> {{$data['total']['totalActivePrice']}}</td>
                                        <td class="c-table__cell"> {{$data["total"]["paymentDate"] ?  \Carbon\Carbon::parse($data["total"]["paymentDate"])->isoFormat('Do MMMM YYYY') : ''}}</td>
                                        
                                        <!---- Süreç --->
                                        <td class="c-table__cell"><span class="c-badge c-badge--{{$data['total']['paymentStatus']}}">{{$data['total']['paymentStatusDescriptionTR']}}</span></td>
                                        <!---- Süreç Son  --->
                                        
                                        <!---- Document - Fatura --->
                                        <td class="c-table__cell"> 
                                            <i id="invoiceFileUrlHidden"  class="fa fa-download" style="color:#b7b7b7; font-size: 30px; {{$data['documentInvoiceFile']['statusToken'] == 'token5' ? 'display:block;' : 'display:none;'}}" aria-hidden="false"></i>
                                            <a id="invoiceFileUrl" style="text-decoration:none; {{$data['documentInvoiceFile']['statusToken'] == 'token5' ? 'display:none;' : 'display:block;'}}" href="{{$data['documentInvoiceFile']['fileUrl']}}" title="{{$data['documentInvoiceFile']['fileUrl']}}"><i class="fa fa-download" style="color:coral; font-size: 30px;" aria-hidden="false"></i></a>
                                        </td>
                                        <!---- Document - Fatura - Son --->
                                        
                                        <!---- Document - Dekont --->
                                        <td class="c-table__cell">
                                            <i id="receiptFileUrlHidden" class="fa fa-download" style="color:#b7b7b7; font-size: 30px; {{$data['documentReceiptFile']['statusToken'] == 'token5' ? 'display:block;' : 'display:none;'}}" aria-hidden="false"></i>
                                            <a id="receiptFileUrl" style="text-decoration:none; {{$data['documentReceiptFile']['statusToken'] == 'token5' ? 'display:none;' : 'display:block;'}}" href="{{$data['documentReceiptFile']['fileUrl']}}" title="{{$data['documentReceiptFile']['fileUrl']}}"><i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false"></i></a>
                                        </td>
                                        <!---- Document - Dekont - Son --->
                                        
                                        <!---- Action --->
                                        <td class="c-table__cell"> 
                                            <ul class="u-flex u-justify-between" style="gap: 10px; margin:auto;"> 
                                              <li class="u-text-large" style="display:{{$userRoleToken == 'token' ? 'none' : 'block'}}" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#faturaModal" ><i class="fa fa-upload" data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}"   style="color: coral; font-size: 30px;"></i></a></li>
                                              <li class="u-text-large" style="display:{{$userRoleToken == 'token' ? 'block' : 'none'}}" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#dekontModal" ><i class="fa fa-upload" data_id="{{$data['myOrderId']}}" data_token="{{$data['token']}}" data_companyToken="{{$data['companyToken']}}"   style="color: green; font-size: 30px;"></i></a></li>
                                            </ul>
                                        </td>
                                        <!---- Action Son --->
                                        
                                    
                                      
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