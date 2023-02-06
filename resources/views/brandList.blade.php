<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Marka Ayarları | Bex360</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Head -->
        @include('include.head')
        
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

         
          @include('include.header')
          
            <!-- Modal Ekle -->
            <div class="c-modal modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModal3"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="c-card u-p-medium">

                            <form class="c-card__body" method="post" action="javascript:void(0)">
                                <div class="c-field u-mb-small">
                                    <label class="c-field__label" for="brand_name">Marka Adı</label>
                                    <input class="c-input" type="text" id="brand_name"  placeholder="Marka Adı" />
                                </div>

                                <button class="c-btn c-btn--info c-btn--fullwidth" id="brand_add"> Yeni Ekle </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Ekle Son-->

             <!-- Modal Güncelle -->
            <div class="c-modal modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModal4"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="c-card u-p-medium">

                            <form class="c-card__body" method="post" action="javascript:void(0)">
                                <div class="c-field u-mb-small">
                                    <label class="c-field__label" for="brand_name_update">Marka Adı</label>
                                    <input class="c-input" type="text" id="brand_name_update" data_token="data_token" placeholder="Marka Adı" />
                                </div>

                                <button class="c-btn c-btn--info c-btn--fullwidth" id="brand_update" > Güncelle </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Güncelle Son-->

          <div class="container">
            <div class="row u-mb-large">
                <div class="col-md-12">
                    <div class="c-table-responsive">
                        <div
                            style="display: flex; justify-content: space-between; position: relative; padding: 25px 30px; border: 1px solid #e6eaee; border-bottom: 0; border-radius: 4px 4px 0 0; background-color: #fff;color: #354052; font-size: 24px; text-align: left; ">
                            <div style="display:flex; gap:10px;" >
                                <p style="font-size: 19px; font-weight: bold; margin-top: auto; margin-bottom: auto; ">Marka Listesi |  </p>
                                <p style="margin:auto;">{{$apiDBCount}}</p>
                            </div>

                           <button type="button" class="c-btn c-btn--success" data-toggle="modal" data-target="#myModal3"> Yeni Ekle </button>
                        </div>
                   

                         <!-- Table -->
                        <table id="myTable" class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head" style="display:none;">#</th>                                   
                                    <th class="c-table__cell c-table__cell--head" style="width: 80%;"  >Marka Adı</th>
                                    <th class="c-table__cell c-table__cell--head">Active</th>
                                    <th class="c-table__cell c-table__cell--head">Durum</th>
                                    <th class="c-table__cell c-table__cell--head">İşlemler</th>
                                </tr>
                            </thead>
                            
                          
                            <tbody >
                                @foreach ($apiDB as $data)
                                   <tr class="c-table__row">
                                    
                                         <!---- Seç --->
                                        <td class="c-table__cell" style="display:none;"><input type="checkbox" id="{{$data['id']}}" name="chk_product" data-id="{{$data['id']}}" > </td>
                                         

                                        <!---- Bilgileri --->
                                        <td class="c-table__cell"> {{$data["brandTitle"]}} </td>
                                       
                                        <!---- Active --->
                                        <td class="c-table__cell"> 
                                            @if($data["isActive"] == "1") 
                                            <a class="u-text-mute" ><i class="fa fa-check-circle" style="color: #1bb934;font-size: 30px;" id="listItemActive" data_id="{{$data['id']}}"  data_token="{{$data['token']}}"  data_active="true" ></i></a>
                                            @elseif($data["isActive"] == "0") 
                                            <a class="u-text-mute"><i class="fa fa-times-circle"   style="color: #ed1c24;font-size: 30px;" id="listItemActive" data_id="{{$data['id']}}" data_token="{{$data['token']}}" data_active="false" ></i></a>
                                            @endif
                                        </td>
                                        <!---- Active Son --->
                                        
                                        
                                         <!---- Durum --->
                                        @if($data["isUpdated"] == "0"  && $data["isActive"] == "1") 
                                        <td class="c-table__cell"><span class="c-badge c-badge--success">Aktif</span></td>
                                        @elseif($data["isDeleted"] == "0" && $data["isActive"] == "0")
                                        <td class="c-table__cell"><span class="c-badge c-badge--danger">Pasif</span></td>
                                        @elseif($data["isDeleted"] == "1" && $data["isActive"] == "0")
                                        <td class="c-table__cell"><span class="c-badge c-badge--secondary">Silindi</span></td>
                                        @elseif($data["isUpdated"] == "1"  && $data["isActive"] == "1")
                                        <td class="c-table__cell"><span class="c-badge c-badge--warning">Güncellendi</span></td>
                                        @endif
                                        <!---- Durum Son  --->
                                        
                                        
                                        <!---- Action --->
                                        <td class="c-table__cell"> 
                                            <ul class="u-flex u-justify-between" style="gap: 10px; margin:auto;"> 
                                              <li class="u-text-large" ><a class="u-text-mute" ><i class="fa fa-trash" style="color: #ed1c24;; font-size: 30px;" id="listItemDelete" data_id="{{$data['id']}}" ></i></a></li>
                                              <li class="u-text-large" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#myModal4" ><i data_id="{{$data['id']}}" data_token="{{$data['token']}}" data_name="{{$data['brandTitle']}}" class="fa fa-pencil-square" style="color: gray; font-size: 30px;"></i></a></li>
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
       <script src="{{asset('/web')}}/js/brand.js"></script>
       
       
         @include('include.footer')
       
    </footer>
    
</html>