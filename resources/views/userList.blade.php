<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Kullanıcı Listesi | Yıldırımdev</title>
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
          
            <!-- Modal Onay -->
            <div class="c-modal modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModal3"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                          <div class="c-table-responsive@desktop">
                              <div class="row">
                              <table class="c-table">
                                <thead class="c-table__head c-table__head--slim">
                                    <tr class="c-table__row">
                                        <th class="c-table__cell c-table__cell--head">İşlem</th>
                                        <td class="c-table__cell"></td>
                                        <th class="c-table__cell c-table__cell--head">Durum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="c-table__row">
                                    <td class="c-table__cell">Üye Email Onayı</td>
                                    <td class="c-table__cell">:</td>
                                    <td class="c-table__cell" id="email_checkStatus" ><span class="c-badge c-badge--success">ONAYLANDI</span></td>
                                    </tr>
                                </tbody>
                              </table><!-- // .c-table -->
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Onay Son -->

            <!-- Modal Bilgi -->
            <div class="c-modal modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModal4"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                          <div class="c-table-responsive@desktop">
                             <div class="row">
                                <table class="c-table">
                                    <tbody>
                                        <tr class="c-table__row">
                                                <td class="c-table__cell">Kullanıcı Id</td>
                                                <td class="c-table__cell">:</td>
                                                <td class="c-table__cell" id="user_id" >#121</td>
                                        </tr>
                                        <tr class="c-table__row">
                                                <td class="c-table__cell">Doğum Tarihi</td>
                                                <td class="c-table__cell">:</td>
                                                <td class="c-table__cell" id="dateofBirth" >15.05.1991</td>
                                        </tr>
                                        <tr class="c-table__row">
                                            <td class="c-table__cell">Ülke</td>
                                            <td class="c-table__cell">:</td>
                                            <td class="c-table__cell" id="country" >Türkiye</td>
                                        </tr>
                                        <tr class="c-table__row">
                                            <td class="c-table__cell">Şehir</td>
                                            <td class="c-table__cell">:</td>
                                            <td class="c-table__cell" id="city" >Ankara</td>
                                        </tr>
                                        <tr class="c-table__row">
                                            <td class="c-table__cell">Firma ID</td>
                                            <td class="c-table__cell">:</td>
                                            <td class="c-table__cell" id="companyId" >#1000</td>
                                        </tr>
                                        <tr class="c-table__row">
                                            <td class="c-table__cell">Firma Adı</td>
                                            <td class="c-table__cell">:</td>
                                            <td class="c-table__cell" id="companyTitle" >companyTitle</td>
                                        </tr>
                                        <tr class="c-table__row">
                                            <td class="c-table__cell">Ürün Satış Kategorisi</td>
                                            <td class="c-table__cell">:</td>
                                            <td class="c-table__cell" id="categoryTitle" >categoryTitle</td>
                                        </tr>          
                                    </tbody>
                                </table><!-- // .c-table -->
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Bilgi Son -->
            
                                                          
            <!-- Modal Header - Body Footer -->
            <div class="c-modal modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modaldetail"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <!--- Header --->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Yetki Düzenleme</h5>
                            <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--- Header Son--->
                        
                        <!--- Body --->
                        <div style="padding: 10px;display: flex;flex-direction: column;" >
                            <div class="c-field u-mb-small" style="display: none; gap: 10px;">
                                <p>Kullanıcı Id:</p>
                                <p id="user_idRole" data_token="" >000</p>
                            </div>
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="category">Kullanıcı Yetkisi</label>
                                <select id="apiRoleListChange" class="form-select" style="height: 40px;border: 1px solid #dfe3e9;border-radius: 8px;font-size: .875rem;font-weight: 500;outline: 0;width: 100%;padding-left: .9375rem; margin-bottom: 10px;">
                                            <option value="0">Seçiniz...</option>
                                            
                                             @foreach ($apiRoleDB as $data)
                                            <option value="{{$data['id']}}" data_token="{{$data['token']}}">{{$data["userRoleTitle"]}}</option>
                                             @endforeach
                                </select>
                            </div>
                        </div>
                        <!--- Body Son --->
                        
                        <!--- Footer --->
                        <div class="modal-footer">
                            <button type="button" id="userRoleUpload" class="btn btn-primary">Güncelle</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        </div>
                        <!--- Footer Son --->
                    </div>
                </div>
            </div>
            <!-- Modal Header - Body Footer Son -->
            
                                                                                  
            <!-- Modal  Resim -->
            <div class="c-modal modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="modalImage"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <!--- Header --->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Resim Önizleme </h5>
                            <button type="button" class="close  btn btn-danger" data-dismis="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--- Header Son--->
                        
                        <!--- Body --->
                         <div>
                            <img id="productViewImage" style="width: 1024px;margin-left: auto;margin-right: auto;display: flex;" src="" alt="">
                         </div>
                        <!--- Body Son --->
                        
                       
                    </div>
                </div>
            </div>
            <!-- Modal  Resim Son  -->

          <div class="container">
            <div class="row u-mb-large">
                <div class="col-md-12">
                    <div class="c-table-responsive">
                        <div
                            style="display: flex; justify-content: space-between; position: relative; padding: 25px 30px; border: 1px solid #e6eaee; border-bottom: 0; border-radius: 4px 4px 0 0; background-color: #fff;color: #354052; font-size: 24px; text-align: left; ">
                            <div style="display:flex; gap:10px;" >
                                <p style="font-size: 19px; font-weight: bold; margin-top: auto; margin-bottom: auto; ">Kullanıcı Listesi |  </p>
                                <p style="margin:auto;">{{$apiDBCount}}</p>
                            </div>
                           
                        </div>
                   

                         <!-- Table -->
                        <table id="myTable" class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head" style="display:none;">#</th>
                                    <th class="c-table__cell c-table__cell--head" style="display:block;" >Profil Resmi</th>
                                    
                                    <th class="c-table__cell c-table__cell--head" >Kullanıcı ID</th>
                                    <th class="c-table__cell c-table__cell--head" style="width: 50%;"  >Adı Soyadı</th>
                                    <th class="c-table__cell c-table__cell--head">Gsm </th>
                                    <th class="c-table__cell c-table__cell--head">Email</th>
                                    <th class="c-table__cell c-table__cell--head">Yetkisi</th>
                                    <th class="c-table__cell c-table__cell--head" style="display: flex;justify-content: center;">Üyelik Tarihi</th>
                                   
                                    
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
                                         
                                        <!---- Resim --->
                                        <td class="c-table__cell" style="display:block;" > <img src="{{$data['userImageUrl']}}" alt="" class="modal_info" data-toggle="modal" data-target="#modalImage" style="object-fit: cover;width: 100px;height: 100px;border-radius: 23px;border: 1px solid;"></td>
                                        
                                        <!---- Bilgileri --->
                                        <td class="c-table__cell">#{{$data["id"]}} </td>
                                        <td class="c-table__cell"> {{$data["name"]}} {{$data["surname"]}}</td>
                                        <td class="c-table__cell"> {{$data["gsm"]}}</td>
                                        <td class="c-table__cell"> {{$data["email"]}}</td>
                                        <td class="c-table__cell"> {{$data["userRoleTitle"]}}</td>
                                        <td class="c-table__cell"> {{\Carbon\Carbon::parse($data["created_at"])->diffForHumans()}}</td>
                                        
                                        
                                        
                                        <!---- Active --->
                                        <td class="c-table__cell"> 
                                            @if($data["isActive"] == "1") 
                                            <a style="text-decoration:none" class="u-text-mute" ><i class="fa fa-check-circle" style="color: #1bb934;font-size: 30px;" id="listItemActive" data_id="{{$data['id']}}"  data_token="{{$data['token']}}"  data_active="true" ></i></a>
                                            @elseif($data["isActive"] == "0") 
                                            <a style="text-decoration:none" class="u-text-mute"><i class="fa fa-times-circle"   style="color: #ed1c24;font-size: 30px;" id="listItemActive" data_id="{{$data['id']}}" data_token="{{$data['token']}}" data_active="false" ></i></a>
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
                                              <li class="u-text-large" ><a style="text-decoration:none" class="u-text-mute modal_doc" data-toggle="modal" data-target="#myModal3" ><i data-id="{{$data['id']}}" data_adminCheck="{{$data['adminCheck']}}"  title="Onay Ekranı" class="fa  fa-file-text-o" style="color:#b7b7b7; font-size: 30px;"></i></a> </li>
                                              <li class="u-text-large" ><a style="text-decoration:none"  class="u-text-mute modal_info" data-toggle="modal" data-target="#myModal4" ><i data_id="{{$data['id']}}" data_dateofBirth="{{$data['dateofBirth']}}" data_country="{{$data['country']}}" data_city="{{$data['city']}}" data_companyId="{{$data['companyId']}}" data_companyTitle="{{$data['companyTitle']}}" data_categoryTitle="{{$data['categoryTitle']}}"  title="Bilgiler" class="fa fa-info-circle" style=" font-size: 30px;"></i></a></li>
                                              <li class="u-text-large" style="margin: auto;" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-universal-access" data_id="{{$data['id']}}" data_token="{{$data['token']}}"  data_userRoleToken="{{$data['userRoleToken']}}"   style="color: green; font-size: 30px;"></i></a></li>
                                              <li class="u-text-large"  style="display:none;" > <a style="text-decoration:none" class="u-text-mute" href="#"  ><i class="fa fa-pencil-square" style="color: gray; font-size: 30px;"></i></a></li>
                                            </ul>
                                        </td>
                                        <!---- Action Son --->
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                         <!-- Table Son -->
                         
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
                                <th style="margin: auto;" ><a style="text-decoration:none"  href="?page={{$parameter_page-1 <= 1 ? 1 : $parameter_page-1 }}&rowcount={{$parameter_rowcount}}"><button><</button></a></th>
                                
                                 @for ($i =0; $i <$apiDBRowCount; $i++)
                                   <th style="margin: auto;" ><a style="text-decoration:none" href="?page={{$i+1}}&rowcount={{$parameter_rowcount}}"><button style="background-color: {{ $parameter_page == $i+1 ? '#344564;' : 'RGBA(107, 119, 140, 0.2);' }} color: {{ $parameter_page == $i+1 ? 'white;' : 'black;' }}; border-radius: 7px;" >{{$i+1}}</button></a></th>
                                  @endfor
                                  
                                <th style="margin: auto;" ><a style="text-decoration:none" href="?page={{$parameter_page+1 >= $apiDBRowCount ? $apiDBRowCount : $parameter_page+1 }}&rowcount={{$parameter_rowcount}}" ><button>></button></a></th>
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
       <script src="{{asset('/web')}}/js/user.js"></script>
       
        @include('include.footer')
       
    </footer>
    
</html>