<!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Firma Listesi | Bex360</title>
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
                    
                     <div id="companyToken" data_token=""  style="display:none;" > Token  </div>
                      
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Firma Evrak Listesi</h5>
                        <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="c-field u-mb-xsmall">
                      <table class="c-table">
                        <thead class="c-table__head c-table__head--slim">
                          <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Evrak Türü</th>
                            <td class="c-table__cell">İndir</td>
                            <th class="c-table__cell c-table__cell--head">Onay</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="c-table__row">
                            <td class="c-table__cell">Kimlik Fotokopisi</td>
                            <td class="c-table__cell">
                              <a style="text-decoration:none" id="personalIdentityPhotoFileUrl" href="" target="_blank" download="kimlik_fotokopi.pdf" >
                                <i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false" ></i>
                              </a>
                              <i id="personalIdentityPhotoFileUrlVisiblity" class="fa fa-download" style="color:#868686; font-size: 30px; display:none;"></i>
                            </td>
                            <td   class="c-table__cell">
                              <div id="personalIdentityPhotoFileUrlSwitchClass" class="c-switch">
                                <input class="c-switch__input" id="personalIdentityPhotoFileUrlSwitch" type="checkbox" >
                              </div>
                            </td>
                          </tr>
                          <tr class="c-table__row">
                            <td class="c-table__cell">Vergi Levhası</td>
                            <td class="c-table__cell">
                            <a style="text-decoration:none" id="taxSheetFileUrl" href="" target="_blank" download="vergi_levhası.pdf" >
                                <i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false"  ></i>
                            </a>
                            <i id="taxSheetFileUrlVisiblity" class="fa fa-download" style="color:#868686; font-size: 30px; display:none;"></i>
                          </td>
                            <td class="c-table__cell">
                              <div id="taxSheetFileUrlSwitchClass"  class="c-switch">
                                <input class="c-switch__input" id="taxSheetFileUrlSwitch" type="checkbox">
                              </div>
                            </td>
                          </tr>                       
                          <tr class="c-table__row">
                            <td class="c-table__cell">Ticaret Sicil Gazetesi</td>
                            <td class="c-table__cell">
                              <a style="text-decoration:none" id="tradeRegistryGazetteFileUrl" href="" target="_blank" download="ticaret_sicil_gazetesi.pdf" >
                                  <i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false" ></i>
                              </a>
                              <i id="tradeRegistryGazetteFileUrlVisiblity" class="fa fa-download" style="color:#868686; font-size: 30px; display:none;"></i>
                            </td>
                            <td class="c-table__cell">
                              <div id="tradeRegistryGazetteFileUrlSwitchClass" class="c-switch">
                                <input class="c-switch__input" id="tradeRegistryGazetteFileUrlSwitch" type="checkbox">
                              </div>
                            </td>
                          </tr>
                             <tr class="c-table__row">
                            <td class="c-table__cell">İmza Sirküsü</td>
                            <td class="c-table__cell">
                              <a style="text-decoration:none" id="circularOfSignatureFileUrl" href="" target="_blank" download="imza_sirküsü.pdf" >
                                  <i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false" ></i>
                              </a>
                               <i id="circularOfSignatureFileUrlVisiblity" class="fa fa-download" style="color:#868686; font-size: 30px; display:none;"></i>
                            </td>
                            <td class="c-table__cell">
                              <div  id="circularOfSignatureFileUrlSwitchClass" class="c-switch">
                                <input class="c-switch__input" id="circularOfSignatureFileUrlSwitch" type="checkbox" >
                              </div>
                            </td>
                          </tr>
                          <tr class="c-table__row">
                            <td class="c-table__cell">Oda Sicil Kaydı</td>
                            <td class="c-table__cell">
                              <a style="text-decoration:none" id="chamberOfCommerceRegistrationFileUrl" href="" target="_blank" download="oda_sicil_kaydı.pdf" >
                                  <i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false" ></i>
                              </a>
                              <i id="chamberOfCommerceRegistrationFileUrlVisiblity" class="fa fa-download" style="color:#868686; font-size: 30px; display:none;"></i>
                            </td>
                            <td class="c-table__cell">
                              <div id="chamberOfCommerceRegistrationFileUrlSwitchClass" class="c-switch">
                                <input class="c-switch__input" id="chamberOfCommerceRegistrationFileUrlSwitch" type="checkbox">
                              </div>
                            </td>
                          </tr>
                          <tr class="c-table__row">
                            <td class="c-table__cell">Hizmet Sözleşmesi</td>
                            <td class="c-table__cell">
                              <a style="text-decoration:none" id="serviceContractFileUrl" href="" target="_blank" download="hizmetSözlemesi.pdf" >
                                  <i class="fa fa-download" style="color:#1bb934; font-size: 30px;" aria-hidden="false" ></i>
                              </a>
                              <i id="serviceContractFileUrlVisiblity" class="fa fa-download" style="color:#868686; font-size: 30px; display:none;"></i>
                            </td>
                            <td class="c-table__cell">
                              <div id="serviceContractFileUrlSwitchClass" class="c-switch">
                                <input class="c-switch__input" id="serviceContractFileUrlSwitch" type="checkbox" >
                              </div>
                            </td>
                          </tr>
                      

                        </tbody>
                      </table><!-- // .c-table -->
                    </div>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" id="companyUpdate"> Kaydet </button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">KAPAT</button>
                    </div>
                        
                
                    </div>
                </div>
            </div>
            <!-- Modal Onay Son -->
            
            <!-- Modal Bilgi -->
            <div class="c-modal modal fade" id="modaldetail" tabindex="-1" role="dialog" aria-labelledby="modaldetail"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content" style="width: max-content;">
                    
                     <div id="companyToken" data_token=""  style="display:none;" > Token  </div>
                      
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Firma Bilgileri</h5>
                        <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="c-field u-mb-xsmall">
                        <table class="c-table">
                            <tbody>
                                <tr class="c-table__row">
                                  <td class="c-table__cell">Firma ID</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="companyid">#1000</td>
                                </tr>
                                <tr class="c-table__row">
                                  <td class="c-table__cell">Firma Adı</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="titleofcompany">ABC Deneme A.Ş. </td>
                                </tr>
                                <tr class="c-table__row">
                                  <td class="c-table__cell">Firma Adresi</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="companyAddress">Çukurambar Mah. Mevlana Bulvarı Kale Ofis No: 150/ 121 Çankaya / ANKARA
                                </td>
                                </tr>
                                <tr class="c-table__row">
                                  <td class="c-table__cell">Telefon</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="phoneNumber">0312 330 3030</td>
                                </tr>
                                <tr class="c-table__row">
                                  <td class="c-table__cell">Email</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="emailAddress">deneme@abc.com</td>
                                </tr>
                                  <tr class="c-table__row">
                                    <td class="c-table__cell">Web</td>
                                    <td class="c-table__cell">:</td>
                                    <td class="c-table__cell" id="webAddress">www.deneme.com</td>
                                </tr>
                                <tr class="c-table__row">
                                  <td class="c-table__cell">Vergi Daire / No</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="taxAdministration_no">Başkent / 0932487234</td>
                                </tr>
                                  <tr class="c-table__row">
                                  <td class="c-table__cell">Mersis</td>
                                  <td class="c-table__cell">:</td>
                                  <td class="c-table__cell" id="mersisNo">4556 3453 3453</td>
                                </tr>
                            </tbody>
                          </table><!-- // .c-table -->
                      </div>
                    
                    </div>
                </div>
            </div>
             <!-- Modal Bilgi Son -->
            
            <!-- Modal Bank -->
            <div class="c-modal modal fade" id="modalBank" tabindex="-1" role="dialog" aria-labelledby="modalBank"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                   <div class="modal-content" style="width: max-content;">
                    
                     <div id="companyToken" data_token=""  style="display:none;" > Token  </div>
                      
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Banka Bilgileri</h5>
                          <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      
                      <div class="c-field u-mb-xsmall" id="bankModalSuccess" style="display:block;">
                       <table class="c-table">
                          <tbody>
                            <tr class="c-table__row">
                              <td class="c-table__cell">Banka Adı</td>
                              <td class="c-table__cell">:</td>
                              <td class="c-table__cell" id="bankTitle">İş Bankası</td>
                            </tr>
                            <tr class="c-table__row">
                              <td class="c-table__cell">Hesap Adı</td>
                              <td class="c-table__cell">:</td>
                              <td class="c-table__cell" id="bankAccountTitle" >Deneme Firması</td>
                            </tr>
                            <tr class="c-table__row">
                              <td class="c-table__cell">Şube</td>
                              <td class="c-table__cell">:</td>
                              <td class="c-table__cell" id="branch" >Ankara Kızılay</td>
                            </tr>
                            <tr class="c-table__row">
                              <td class="c-table__cell">Hesap Sahibi</td>
                              <td class="c-table__cell">:</td>
                              <td class="c-table__cell" id="nameSurname" >Ahmet Mehmetoğlu</td>
                            </tr>
                            <tr class="c-table__row">
                              <td class="c-table__cell">Hesap No</td>
                              <td class="c-table__cell">:</td>
                              <td class="c-table__cell" id="accountNumber" >25833 0223325656</td>
                            </tr>
                            <tr class="c-table__row">
                              <td class="c-table__cell">IBAN</td>
                              <td class="c-table__cell">:</td>
                              <td class="c-table__cell" id="ibanNo" >TR23 0000 0000 0000 0000 0000 00</td>
                            </tr>


                          </tbody>
                        </table><!-- // .c-table -->
                      </div>
                      
                                            
                      <div class="c-field u-mb-xsmall"  id="bankModalError" style="display: block;width: max-content;padding: 20px;">
                          <div class="card" style="text-align: center; padding: 50px;">
                      
                         <div style="display: flex; flex-direction: column; gap: 21px; align-items: center; " >
                            <img width="100" src="{{asset('/img')}}/icon/sad.png"/>
                                <p>Şuan banka bilgileri yoktur.</p>
                          </div>
                      
                      </div>
                        
                      </div>
                      
                    </div>
                </div>
            </div>
            <!-- Modal Bank Son -->
            
                                                                     
            <!-- Modal Header - Body Footer -->
            <div class="c-modal modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="modaldetail"
                aria-hidden="true" style="display: none">
                <div class="c-modal__dialog modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <!--- Header --->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ödeme Günü Düzenleme</h5>
                            <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!--- Header Son--->
                        
                        <!--- Body --->
                        <div style="padding: 10px;display: flex;flex-direction: column;" >
                            <div class="c-field u-mb-small" style="display: none; gap: 10px;">
                                <p>Kullanıcı Id:</p>
                                <p id="company_idRole" data_token="" >000</p>
                            </div>
                            <div class="c-field u-mb-small">
                                <label class="c-field__label" for="editPaymentDate">Anlaşma Gün Sayısı</label>
                                <input class="c-input" type="text" id="editPaymentDate" placeholder="Kaç gün sonra ödeme yapılacak giriniz">
                            </div>
                        </div>
                        <!--- Body Son --->
                        
                        <!--- Footer --->
                        <div class="modal-footer">
                            <button type="button" id="editPaymentDateUpdate" class="btn btn-primary">Güncelle</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                        </div>
                        <!--- Footer Son --->
                    </div>
                </div>
            </div>
            <!-- Modal Header - Body Footer Son -->
       

          <div class="container">
            <div class="row u-mb-large">
                <div class="col-md-12">
                    <div class="c-table-responsive">
                        <div
                            style="display: flex; justify-content: space-between; position: relative; padding: 25px 30px; border: 1px solid #e6eaee; border-bottom: 0; border-radius: 4px 4px 0 0; background-color: #fff;color: #354052; font-size: 24px; text-align: left; ">
                            <div style="display:flex; gap:10px;" >
                                <p style="font-size: 19px; font-weight: bold; margin-top: auto; margin-bottom: auto; ">Firma Listesi |  </p>
                                <p style="margin:auto;">{{$apiDBCount}}</p>
                            </div>
                           
                        </div>
                   

                         <!-- Table -->
                        <table id="myTable" class="c-table">
                            <thead class="c-table__head c-table__head--slim">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head" style="display: none;">#</th>
                                    <th class="c-table__cell c-table__cell--head" style="display:none;" >Profil Resmi</th>
                                    
                                    <th class="c-table__cell c-table__cell--head" >Firma ID</th>
                                    <th class="c-table__cell c-table__cell--head"  style="width: 50%;" >Firma Adı</th>
                                    <th class="c-table__cell c-table__cell--head">Satış Kategorisi </th>
                                    <th class="c-table__cell c-table__cell--head">Kullanıcı</th>
                                    <th class="c-table__cell c-table__cell--head" style="display: flex;justify-content: center;">Üyelik Tarihi</th>
                                    
                                    <th class="c-table__cell c-table__cell--head" style="display: none;">Active</th>
                                    <th class="c-table__cell c-table__cell--head">Durum</th>
                                    <th class="c-table__cell c-table__cell--head">İşlemler</th>
                                </tr>
                            </thead>
                            
                          
                            <tbody >
                                @foreach ($apiDB as $data)
                                   <tr class="c-table__row">
                                    
                                         <!---- Seç --->
                                        <td class="c-table__cell" style="display: none;"><input type="checkbox" id="{{$data['id']}}" name="chk_product" data-id="{{$data['id']}}" > </td>
                                         
                                        <!---- Resim --->
                                        <td class="c-table__cell" style="display:none;" > <img src="" alt="" style="object-fit: cover;width: 100px;height: 100px;border-radius: 23px;border: 1px solid;"></td>
                                        
                                        <!---- Bilgileri --->
                                        <td class="c-table__cell">#{{$data["id"]}} </td>
                                        <td class="c-table__cell">{{$data["titleofcompany"]}} </td>
                                        <td class="c-table__cell">{{$data["categoryTitle"]}}</td>
                                        <td class="c-table__cell">{{$data["created_by"]}}</td>
                                        <td class="c-table__cell"> {{\Carbon\Carbon::parse($data["created_at"])->diffForHumans()}}</td>
                                        
                                        
                                        
                                        <!---- Active --->
                                        <td class="c-table__cell" style="display: none;"> 
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
                                              <li class="u-text-large" ><a style="text-decoration:none" class="u-text-mute modal_doc"  data-toggle="modal" data-target="#myModal3" ><i data-id="{{$data['id']}}" data_token="{{$data['token']}}" 
                                              data_personalIdentityPhotoFileUrl="{{$data['personalIdentityPhotoFileUrl']}}" data_personalIdentityPhotoFileCheck="{{$data['personalIdentityPhotoFileCheck']}}" 
                                              data_taxSheetFileUrl="{{$data['taxSheetFileUrl']}}" data_taxSheetCheck="{{$data['taxSheetCheck']}}" 
                                              data_circularOfSignatureFileUrl="{{$data['circularOfSignatureFileUrl']}}"  data_circularOfSignatureFileCheck="{{$data['circularOfSignatureFileCheck']}}"
                                             
                                              data_tradeRegistryGazetteFileUrl="{{$data['tradeRegistryGazetteFileUrl']}}" data_tradeRegistryGazetteCheck="{{$data['tradeRegistryGazetteCheck']}}"
                                              data_chamberOfCommerceRegistrationFileUrl="{{$data['chamberOfCommerceRegistrationFileUrl']}}" data_chamberOfCommerceRegistrationCheck="{{$data['chamberOfCommerceRegistrationCheck']}}" 
                                              data_serviceContractFileUrl="{{$data['serviceContractFileUrl']}}" data_serviceContractCheck="{{$data['serviceContractCheck']}}" 
                                              title="Onay Ekranı" class="fa  fa-file-text-o" style="color:#b7b7b7; font-size: 30px;"></i></a> </li>
                                              <li class="u-text-large" ><a style="text-decoration:none" class="u-text-mute modal_info" data-toggle="modal" data-target="#modaldetail" ><i data_id="{{$data['id']}}" data_titleofcompany="{{$data['titleofcompany']}}" data_companyAddress="{{$data['companyAddress']}}" data_phoneNumber="{{$data['phoneNumber']}}" data_emailAddress="{{$data['emailAddress']}}"  data_webAddress="{{$data['webAddress']}}"  data_taxAdministration="{{$data['taxAdministration']}}"  data_taxNo="{{$data['taxNo']}}"  data_mersisNo="{{$data['mersisNo']}}"  title="Bilgiler" class="fa fa-info-circle" style=" font-size: 30px;"></i></a></li>
                                              <li class="u-text-large" ><a style="text-decoration:none" class="u-text-mute modal_bank" data-toggle="modal" data-target="#modalBank" ><i title="Banka Bilgileri" class="fa fa-university" style=" font-size: 30px; color:{{ $data['bankAccount']['status'] ? 'orange' : 'grey'}} ;" data_id="{{$data['id']}}" 
                                                data_bankStatus="{{$data['bankAccount']['status'] }}"
                                                data_bankTitle="{{$data['bankAccount']['bankTitle'] }}" 
                                                data_bankAccountTitle="{{$data['bankAccount']['bankAccountTitle'] }}" 
                                                data_branch="{{$data['bankAccount']['branch'] }}" 
                                                
                                                data_nameSurname="{{$data['bankAccount']['nameSurname'] }}" 
                                                data_accountNumber="{{$data['bankAccount']['accountNumber'] }}" 
                                                data_ibanNo="{{$data['bankAccount']['ibanNo'] }}" 
                                              ></i></a></li>
                                               <li class="u-text-large" style="margin: auto;" > <a class="u-text-mute modal_info" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-calendar" data_id="{{$data['id']}}" data_token="{{$data['token']}}"  data_paymentDate="{{$data['paymentDate']}}"   style="color: green; font-size: 30px;"></i></a></li>
                                              <li class="u-text-large" style="display: none;" > <a style="text-decoration:none" class="u-text-mute" href="#"  ><i class="fa fa-pencil-square" style="color: gray; font-size: 30px;"></i></a></li>
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
       <script src="{{asset('/web')}}/js/company.js"></script>
       
        @include('include.footer')
       
    </footer>
    
</html>