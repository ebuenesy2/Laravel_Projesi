    <!doctype html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Hesap Ayarları | Yıldırımdev</title>
        <meta name="description" content="Dashboard UI Kit">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta id="yildirimDev" userToken="{{$token}}" companyToken="{{$companyToken}}" bankToken="{{isset($bankAccountToken[0]) ? $bankAccountToken[0] : null  }}"  >
    
        <!-- Head -->
        @include('include.head')
                
        
    </head>
    <body class="o-page" style="background-color: #eff3f6; ">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a style="text-decoration:none" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @include('include.sidebar')

      @include('include.header')
           
                                                                      
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
                            <div class="col-12">
                                <div class="c-tabs">
                                
                                    <ul class="c-tabs__list c-tabs__list--splitted nav nav-tabs" id="myTab" role="tablist">
                                        <li class="c-tabs__item"><a style="text-decoration:none" class="c-tabs__link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Kullanıcı Bilgileri</a></li>
                                        <li class="c-tabs__item"><a style="text-decoration:none" class="c-tabs__link" id="nav-pass-tab" data-toggle="tab" href="#nav-pass" role="tab" aria-controls="nav-home" aria-selected="true">Şifre Güncelle</a></li>
                                        <li class="c-tabs__item"><a style="text-decoration:none" class="c-tabs__link" id="nav-company-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-profile" aria-selected="false">Firma Bilgileri</a></li>
                                        <li class="c-tabs__item"><a style="text-decoration:none" class="c-tabs__link" id="nav-documents-tab" data-toggle="tab" href="#nav-documents" role="tab" aria-controls="nav-documents" aria-selected="false">Şirket Evrakları</a></li> 
                                        <li class="c-tabs__item"><a style="text-decoration:none" class="c-tabs__link" id="nav-bank-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-bank" aria-selected="false">Banka Bilgileri</a></li>
                                    </ul>
        
                                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                                        <div class="c-tabs__pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="row">
                                                <div class="col-lg-2 u-text-center">
                                                    <div class="c-avatar c-avatar--xlarge u-inline-block">
                                                        <img class="c-avatar__img modal_info"  id="avatar_img"  src="{{$userImageUrl}}" alt="Avatar" style="object-fit: contain;"  data-toggle="modal" data-target="#modalImage">
                                                    </div>

                                                   <!-- Button trigger modal -->
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Profil Düzenleme
                                                   </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Profil Resmi Düzenleme</h5>
                                                                <button type="button" class="close  btn btn-danger" data-dismiss="modal" aria-label="Close">
                                                                     <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                                <div class="c-field u-mb-xsmall">
                                                                    <div style="display: flex;gap:5px;justify-content: center;margin-top: 20px;margin-bottom: 20px;">
                                                                        <!-- Dosya Yükleme ----->
                                                                        <form action="{{ route('user.file.upload.control') }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                                                                            <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                                <input type="hidden" name="userToken" value="{{$token}}" >
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
                                                                        <div class="progress-bar" id="progressBarUser" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: #fff;border-radius: 6px;"></div>
                                                                    </div>
                                                                    <div id="uploadStatus"></div>
                                                                </div>
                                                           
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Modal -->
                                                    
                                                </div>
                                           
                                                <div class="col-lg-5">
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="firstName">Adınız (*) </label> 
                                                        <input class="c-input" type="text" id="firstName" placeholder="Adınız" value="{{$name}}" > 
                                                    </div>
        
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="lastName">Soyadınız (*) </label> 
                                                        <input class="c-input" type="text" id="lastName" placeholder="Soyadınız" value="{{$surname}}" > 
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="email" >E-mail Addresiniz (*)</label>
                                                        <input class="c-input" id="email" type="email" value="{{$email}}" placeholder="example@example.com" disabled>
                                                    </div>        
                                                   
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="gsm">Mobil Telefon Numaranız (*)</label>
                                                        <input class="c-input" type="text" id="gsm"  value="{{$gsm}}" placeholder="+95051 *** ****">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-5">

                                                     <label class="c-field__label" for="lastName">Doğum Tarihi (*)</label> 
                                                        <div style="display: flex; margin-bottom: 15px; " >
                                                            <label class="c-field__label u-hidden-visually" for="datepicker1dateofBirth">Disabled Input</label>
                                                            <input  class="c-input" id="dateofBirth" name="dateofBirth" type="date"  data-date-format="DD/MM/YYYY" value="{{isset($dateofBirth) ? $dateofBirth : '1980-05-05' }}" >
                                                        </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="country">Ülke (*) </label>
                                                        <input class="c-input" id="country" type="text" value="{{$country}}" placeholder="Ülke">
                                                    </div>
        
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="city">Şehir (*) </label>
                                                        <input class="c-input" id="city" type="text" value="{{$city}}" placeholder="Şehir">
                                                    </div>  
                                                   
                                                </div>
                                                
                                                <a style="padding: 10px;">(*) işaretli alanların doldurulması zorunludur.</a>
                                                <button class="c-btn c-btn--info c-btn--fullwidth"  id="user_update" >Profil Bilgisi Güncelle</button>
                                            </div>
                                        </div>

                                         <div class="c-tabs__pane" id="nav-pass" role="tabpanel" aria-labelledby="nav-pass-tab">
                                            <div class="row" style="display: flex; justify-content: center; " >
                                                <div class="col-lg-6">
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="old_pass">Eski Parola</label> 
                                                        <input class="c-input" type="password" id="old_pass" placeholder="Eski Parola"> 
                                                    </div>
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="new_pass">Yeni Parola</label> 
                                                        <input class="c-input" type="password" id="new_pass" placeholder="Yeni Parola"> 
                                                    </div>
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="re_pass">Yeni Parola Tekrar</label> 
                                                        <input class="c-input" type="password" id="re_pass" placeholder="Yeni Parola Tekrar"> 
                                                    </div>

                                                    <button class="col-12 c-btn c-btn--info cßbtn--fullwidth"  id="pass_update" >Şifre Güncelle</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="c-tabs__pane" id="nav-company" role="tabpanel" aria-labelledby="nav-company-tab">
                                            <div class="row">
                                              
                                                <div class="col-lg-6">
                                                                                                    
                                                    <div class="c-field u-mb-small" data-select2-id="4">
                                                        <label class="c-field__label" for="CategoryListChange">Firma Kategorisi (*)</label>
                                                          <select id="CategoryListChange" class="form-select" style="height: 40px; border: 1px solid #dfe3e9; border-radius: 8px; font-size: .875rem; font-weight: 500; outline: 0; width: 100%; padding-left: .9375rem; ">
                                                            <option value="0"  selected="false" >Kategori Seçiniz</option>
                                                            @for ($i = 0; $i < count($category); $i++)
                                                             <option value="{{$category[$i]['id']}}" data-token="{{$category[$i]['token']}}" {{ isset($company['categoryToken']) && $category[$i]['token'] == $company['categoryToken'] ? 'selected' : '' }} >{{$category[$i]['categoryTitle']}}</option>
                                                            @endfor
                                                          </select>
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="titleofcompany">Firma Ünvanı (*)</label> 
                                                        <input class="c-input" type="text" id="titleofcompany" value="{{ isset($company['titleofcompany']) ? $company['titleofcompany'] : ''}}" placeholder="Firma Ünvanı" val=""> 
                                                    </div>
        
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="taxAdministration">Vergi Dairesi (*)</label> 
                                                        <input class="c-input" type="text" id="taxAdministration" value="{{ isset($company['taxAdministration']) ? $company['taxAdministration'] : '' }}" placeholder="Vergi Dairesi"> 
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="taxNo">Vergi Numarası (*)</label> 
                                                        <input class="c-input" type="text" id="taxNo"  value="{{ isset($company['taxNo']) ? $company['taxNo'] : '' }}" placeholder="Vergi Numarası"> 
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="mersisNo">Mersis Numarası (*)</label> 
                                                        <input class="c-input" type="text" id="mersisNo" value="{{  isset($company['mersisNo']) ? $company['mersisNo'] : '' }}" placeholder="Mersis Numarası"> 
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="phoneNumber">Sabit Telefon Numarası (*)</label> 
                                                        <input class="c-input"  type="tel" id="phoneNumber" value="{{ isset($company['phoneNumber']) ? $company['phoneNumber'] : '' }}" placeholder="+90312 2** ****">
                                                   </div>
                                            
                                                    
                                                </div>
        
                                                <div class="col-lg-6">
                                                    
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="emailAddress">E-Mail Adresi (*)</label> 
                                                        <input class="c-input" type="text" id="emailAddress" value="{{ isset($company['emailAddress']) ? $company['emailAddress'] : '' }}" placeholder="example@email.com"> 
                                                    </div>
        
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="companyAddress">Firma Adresi (*)</label>
                                                        <textarea class="c-input" id="companyAddress">{{ isset($company['companyAddress']) ? $company['companyAddress'] : ''}}</textarea>
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="billingAddress">Fatura Adresi (*)</label>
                                                        <textarea class="c-input" id="billingAddress">{{ isset($company['billingAddress']) ? $company['billingAddress'] : ''}}</textarea>
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="webAddress">Web Site Adresi (*)</label> 
                                                        <input class="c-input" type="text" id="webAddress" value="{{ isset($company['webAddress']) ? $company['webAddress'] : '' }}" > 
                                                    </div>
                                                    
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="paymentDate">Ödeme Periyodu ( gün )</label> 
                                                        <input class="c-input" type="text" id="paymentDate" value="{{ isset($company['paymentDate']) ? $company['paymentDate'] : '' }}" disabled > 
                                                    </div>
                                                </div>
                                                
                                                
                                                <a style="padding: 10px;">(*) işaretli alanların doldurulması zorunludur.</a>

                                                <button class="c-btn c-btn--success c-btn--fullwidth"  id="company_add" style="{{$companyToken != null ? 'display:none;': 'display:block;' }}" > Firma Bilgisi Oluştur </button>
                                                <button class="c-btn c-btn--info c-btn--fullwidth"  id="company_update" style="{{$companyToken == null ? 'display:none;': 'display:block;' }}" > Firma Bilgisi Güncelle </button>

                                            </div>
                                        </div>
                                      
                                        <div class="c-tabs__pane" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                                            <div class="row">

                                                <div class="col-12" id="error_company_doc" style="{{$companyToken != null ? 'display:none;': 'display: flex;justify-content: center;padding: 10px;flex-direction: column;align-items: center;gap: 15px;' }}"  >
                                                   <img width="100" src="{{asset('/img')}}/icon/sad.png"/>
                                                   <p>Şuan firma bilgileriniz yoktur.</p>
                                                </div>
                                                
                                                <div class="col-lg-6" id="company_doc1" style="{{$companyToken == null ? 'display:none;': 'display:block;' }}" >
                                                    <div class="row">
                                                        <div class="col-12">
                                                             <div class="c-field u-mb-xsmall">
                                                                <div style="display: flex;gap:5px;width: max-content;height: max-content;align-items: center;padding: 10px;">
                                                                    <!-- Dosya Yükleme ----->
                                                                    <form action="{{ route('personalIdentityPhoto.file.upload.control') }}" method="POST" id="personalIdentityPhotoUploadForm" enctype="multipart/form-data">
                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                                                                            </div>
                                                                            <input type="hidden" name="userToken" value="{{$token}}" >
                                                                            <input type="hidden" name="companyToken" value="{{$companyToken}}" >
                                                                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;">
                                                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                                                <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Şirket "Sahibi Kimlik Fotokopisi" Yükleyiniz</p>
                                                                            </button>
                                                                        </div>
                                                                            
                                                                    </form>
                                                                    <!-- Dosya Yükleme Son ----->
                                                                </div>

                                                                 <div class="progress">
                                                                    <div class="progress-bar" id="progressbarKimlikFotokopisi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                                                </div>
                                                                
                                                                <div id="uploadStatusKimlikFotokopisi_AlertStatus_before">
                                                                    @if(isset($company['personalIdentityPhotoFileCheck']))
                                                                        @if( $company['personalIdentityPhotoFileCheck'] == "token5" )
                                                                            <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>
                                                                        @elseif( $company['personalIdentityPhotoFileCheck'] == "token6" )
                                                                            <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>
                                                                        @elseif( $company['personalIdentityPhotoFileCheck'] == "token7" )
                                                                            <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>
                                                                        @endif
                                                                    @else
                                                                    <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız!</div>
                                                                    @endif
                                                                </div>
                                                                
                                                                <div id="uploadStatusKimlikFotokopisi_AlertStatus"></div>
                                                                
                                                                
                                                             
                                                            </div>    
                                                        </div>
                                                      
                                                     </div>

                                                     <div class="row">
                                                        <div class="col-12">
                                                            <div class="c-field u-mb-xsmall">
                                                                <div style="display: flex;gap:5px;width: max-content;height: max-content;align-items: center;padding: 10px;">
                                                                    <!-- Dosya Yükleme ----->
                                                                    <form action="{{ route('taxSheet.file.upload.control') }}" method="POST" id="taxSheetFileUploadControl" enctype="multipart/form-data">
                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                                                                            </div>
                                                                            <input type="hidden" name="userToken" value="{{$token}}" >
                                                                            <input type="hidden" name="companyToken" value="{{$companyToken}}" >
                                                                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;">
                                                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                                                <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Şirket "Şirket Vergi Levhası" Yükleyiniz</p>
                                                                            </button>
                                                                        </div>
                                                                            
                                                                    </form>
                                                                    <!-- Dosya Yükleme Son ----->
                                                                </div>

                                                                 <div class="progress">
                                                                    <div class="progress-bar" id="progressbarVergiLevhası" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                                                </div>
                                                                                                                                
                                                                <div id="uploadStatusVergiLevhası_AlertStatus_before">
                                                                    @if(isset($company['taxSheetCheck']))
                                                                        @if( $company['taxSheetCheck'] == "token5" )
                                                                            <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>
                                                                        @elseif( $company['taxSheetCheck'] == "token6")
                                                                            <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>
                                                                        @elseif( $company['taxSheetCheck'] == "token7")
                                                                            <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>
                                                                        @endif
                                                                    @else
                                                                    <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız!</div>
                                                                    @endif
                                                                </div>
                                                                
                                                                 <div id="uploadStatusVergiLevhası_AlertStatus"></div>
                                                                
                                                             
                                                            </div>    
                                                        </div>
                                                        
                                                     </div>

                                                     <div class="row">
                                                        <div class="col-12">
                                                           
                                                            <div class="c-field u-mb-xsmall">
                                                                <div style="display: flex;gap:5px;width: max-content;height: max-content;align-items: center;padding: 10px;">
                                                                    <!-- Dosya Yükleme ----->
                                                                    <form action="{{ route('tradeRegistryGazette.file.upload.control') }}" method="POST" id="tradeRegistryGazetteFileUploadControl" enctype="multipart/form-data">
                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                                                                            </div>
                                                                            <input type="hidden" name="userToken" value="{{$token}}" >
                                                                            <input type="hidden" name="companyToken" value="{{$companyToken}}" >
                                                                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;">
                                                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                                                <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Şirket "Sicil Gazetesi" Yükleyiniz</p>
                                                                            </button>
                                                                        </div>
                                                                            
                                                                    </form>
                                                                    <!-- Dosya Yükleme Son ----->
                                                                </div>

                                                                 <div class="progress">
                                                                    <div class="progress-bar" id="progressbarSicilGazetesi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                                                </div>
                                                                
                                                                <div id="uploadStatusSicilGazetesi_AlertStatus_before" >
                                                                    @if(isset($company['tradeRegistryGazetteCheck']))
                                                                        @if( $company['tradeRegistryGazetteCheck'] == "token5" )
                                                                            <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>
                                                                        @elseif( $company['tradeRegistryGazetteCheck'] == "token6" )
                                                                            <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>
                                                                        @elseif( $company['tradeRegistryGazetteCheck'] == "token7" )
                                                                            <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>
                                                                        @endif
                                                                    @else
                                                                    <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız!</div>
                                                                    @endif
                                                                </div>
                                                                
                                                                <div id="uploadStatusSicilGazetesi_AlertStatus"></div>
                                                             
                                                            </div>  
                                                        </div>
                                                      
                                                     </div>
                                                </div>
        
                                                <div class="col-lg-6" id="company_doc2" style="{{$companyToken == null ? 'display:none;': 'display:block;' }}" >
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="c-field u-mb-xsmall">
                                                                <div style="display: flex;gap:5px;width: max-content;height: max-content;align-items: center;padding: 10px;">
                                                                  <!-- Dosya Yükleme ----->
                                                                    <form action="{{ route('circularOfSignature.file.upload.control') }}" method="POST" id="circularOfSignatureFileUploadControl" enctype="multipart/form-data">
                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                                                                            </div>
                                                                            <input type="hidden" name="userToken" value="{{$token}}" >
                                                                            <input type="hidden" name="companyToken" value="{{$companyToken}}" >
                                                                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;">
                                                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                                                <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Şirket "İmza Sirküleri" Yükleyiniz</p>
                                                                            </button>
                                                                        </div>
                                                                            
                                                                    </form>
                                                                    <!-- Dosya Yükleme Son ----->
                                                                </div>

                                                                 <div class="progress">
                                                                    <div class="progress-bar" id="progressbarİmzaSirküsü" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                                                </div>
                                                                                                                               
                                                                <div  id="uploadStatusİmzaSirküsü_AlertStatus_before">
                                                                    @if(isset($company['circularOfSignatureFileCheck']))
                                                                        @if( $company['circularOfSignatureFileCheck'] == "token5" )
                                                                            <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>
                                                                        @elseif( $company['circularOfSignatureFileCheck'] == "token6" )
                                                                            <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>
                                                                        @elseif( $company['circularOfSignatureFileCheck'] == "token7" )
                                                                            <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>
                                                                        @endif
                                                                    @else
                                                                    <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız!</div>
                                                                    @endif
                                                                </div>
                                                                
                                                                <div id="uploadStatusİmzaSirküsü_AlertStatus"></div>
                                                             
                                                            </div>
                                                        </div>
                                                     
                                                     </div>

                                                     <div class="row">
                                                        <div class="col-12">
                                                            <div class="c-field u-mb-xsmall">
                                                                <div style="display: flex;gap:5px;width: max-content;height: max-content;align-items: center;padding: 10px;">
                                                                    <!-- Dosya Yükleme ----->
                                                                    <form action="{{ route('circularOfSignature.file.upload.control') }}" method="POST" id="chamberOfCommerceRegistrationFileUploadControl" enctype="multipart/form-data">
                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                                                                            </div>
                                                                            <input type="hidden" name="userToken" value="{{$token}}" >
                                                                            <input type="hidden" name="companyToken" value="{{$companyToken}}" >
                                                                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;">
                                                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                                                <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Şirket "Oda Ticaret Kaydı" Yükleyiniz</p>
                                                                            </button>
                                                                        </div>
                                                                            
                                                                    </form>
                                                                    <!-- Dosya Yükleme Son ----->
                                                                </div>

                                                                 <div class="progress">
                                                                    <div class="progress-bar" id="progressbarTicaretOdasıKaydı" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                                                </div>
                                                                
                                                                 <div id="uploadStatusTicaretOdasıKaydı_AlertStatus_before" >
                                                                    @if(isset($company['chamberOfCommerceRegistrationCheck']))
                                                                        @if( $company['chamberOfCommerceRegistrationCheck'] == "token5" )
                                                                            <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>
                                                                        @elseif( $company['chamberOfCommerceRegistrationCheck'] == "token6" )
                                                                            <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>
                                                                        @elseif( $company['chamberOfCommerceRegistrationCheck'] == "token7" )
                                                                            <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>
                                                                        @endif
                                                                    @else
                                                                    <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız!</div>
                                                                    @endif
                                                                 </div>
                                                                
                                                                <div id="uploadStatusTicaretOdasıKaydı_AlertStatus"></div>
                                                                
                                                            </div>
                                                        </div>
                                                       
                                                     </div>

                                                     <div class="row">
                                                        <div class="col-12">
                                                            <div class="c-field u-mb-xsmall">
                                                                <div style="display: flex;gap:5px;width: max-content;height: max-content;align-items: center;padding: 10px;">
                                                                  <!-- Dosya Yükleme ----->
                                                                    <form action="{{ route('circularOfSignature.file.upload.control') }}" method="POST" id="serviceContractFileUploadControl" enctype="multipart/form-data">
                                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                                        <div style="display: flex;flex-direction: column; gap: 15px;">
                                                                            <div class="custom-file">
                                                                                <input class="custom-file-input" type="file" name="file"  id="gerber_file_id" >
                                                                            </div>
                                                                            <input type="hidden" name="userToken" value="{{$token}}" >
                                                                            <input type="hidden" name="companyToken" value="{{$companyToken}}" >
                                                                            <button type="submit" name="submit" class="btn btn-success" style="background-image: linear-gradient(#04519b, #033c73 60%, #02325f);color: #ffffff;border-bottom: 1px solid #022241;padding: 12px;width: max-content;border-radius: 6px;display: flex;justify-content: center;">
                                                                                <i class="c-alert__icon fa fa-cloud-upload" style="margin-top: -8px; font-size: 24px;"></i> 
                                                                                <p style=" color: blanchedalmond; font-size: 14px; font-weight: bold; " > Şirket "Hizmet Sözlesmesi" Yükleyiniz</p>
                                                                            </button>
                                                                        </div>
                                                                            
                                                                    </form>
                                                                    <!-- Dosya Yükleme Son ----->
                                                                </div>

                                                                 <div class="progress">
                                                                    <div class="progress-bar" id="progressbarHizmetSözlesmesi" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;background-color: teal;color: rgb(255, 255, 255);border-radius: 6px;display: flex;justify-content: center;"></div>
                                                                </div>
                                                                
                                                                <div id="uploadStatusHizmetSözlesmesi_AlertStatus_before">
                                                                    @if(isset($company['serviceContractCheck']))
                                                                        @if( $company['serviceContractCheck'] == "token5" )
                                                                            <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>
                                                                        @elseif( $company['serviceContractCheck'] == "token6" )
                                                                            <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>
                                                                        @elseif( $company['serviceContractCheck'] == "token7" )
                                                                            <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>
                                                                        @endif
                                                                    @else
                                                                    <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız!</div>
                                                                    @endif
                                                                </div>
                                                                
                                                                <div id="uploadStatusHizmetSözlesmesi_AlertStatus"></div>
                                                             
                                                            </div>
                                                           </div>
                                                          
                                                        <div class="col-12" style="margin-top: 20px;">
                                                            <p></p>
                                                            <a style="text-decoration:none;display: flex;gap:10px;flex-direction: inherit;align-items: center;" id="hizmetSözlesiFileDowloand" href="{{asset('/doc')}}/hizmet_sozlesmesi.doc" download="hizmet_sözleşmesi.doc"   >
                                                                 <i class="fa fa-download" aria-hidden="true"></i>
                                                                 <p style="margin-top: auto; margin-bottom: auto; display: flex; align-items: center; vertical-align: middle; " >Buradan "Hizmet Sözleşmesi'ni" indirebilirsiniz!</p>
                                                            </a>
                                                       </div>
                                                       
                                                        
                                                     </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="c-tabs__pane" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
                                            <div class="row">

                                                <div class="col-lg-6">
                                                   <div class="c-field u-mb-small" data-select2-id="4">
                                                        <label class="c-field__label" for="select2">Banka Adı</label>
                                                          <select id="BankListChange" class="form-select" style="height: 40px; border: 1px solid #dfe3e9; border-radius: 8px; font-size: .875rem; font-weight: 500; outline: 0; width: 100%; padding-left: .9375rem; ">
                                                            <option value="0"  selected="">Banka Seçiniz</option>
                                                            @for ($i = 0; $i < count($bank); $i++)
                                                             @if($bank[$i]['isActive'] == '1')
                                                              <option value="{{$bank[$i]['id']}}" data-token="{{$bank[$i]['token']}}" {{ isset($bankAccount['bankToken']) && $bank[$i]['token'] == $bankAccount['bankToken'] ? 'selected' : '' }} >{{$bank[$i]['bankTitle']}}</option>
                                                             @endif
                                                            @endfor
                                                          </select>
                                                    </div>
                                                    
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="bankAccountTitle">Hesap Adı</label> 
                                                        <input class="c-input" type="text" id="bankAccountTitle" value="{{ isset($bankAccount['bankAccountTitle']) ? $bankAccount['bankAccountTitle'] : '' }}" placeholder="Hesap Adı"> 
                                                    </div>
                                                    
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="branch">Banka Şubesi</label> 
                                                        <input class="c-input" type="text" id="branch" value="{{ isset($bankAccount['branch']) ? $bankAccount['branch'] : '' }}" placeholder="Banka Şubesi"> 
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="nameSurname">Hesap Sahibi</label> 
                                                        <input class="c-input" type="text" id="nameSurname" value="{{ isset($bankAccount['nameSurname']) ? $bankAccount['nameSurname'] : '' }}" placeholder="Hesap Sahibi"> 
                                                    </div>
                                            
                                                </div>
        
                                                <div class="col-lg-6">
                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="accountNumber">Hesap No</label> 
                                                        <input class="c-input" type="text" id="accountNumber" value="{{ isset($bankAccount['accountNumber']) ? $bankAccount['accountNumber'] : '' }}" placeholder="Hesap No"> 
                                                    </div>

                                                    <div class="c-field u-mb-small">
                                                        <label class="c-field__label" for="ibanNo">Iban No</label> 
                                                        <input class="c-input" type="text" id="ibanNo" value="{{ isset($bankAccount['ibanNo']) ? $bankAccount['ibanNo'] : '' }}" placeholder="Iban No"> 
                                                    </div>


                                                </div>

                                                <button class="c-btn c-btn--success c-btn--fullwidth"  id="bank_add" style="{{count($bankAccountToken) == 0 ? 'display:block;': 'display:none;' }}" > Banka Bilgisi Oluştur </button>
                                                <button class="c-btn c-btn--info c-btn--fullwidth"  id="bank_update" style="{{count($bankAccountToken) == 0 ? 'display:none;': 'display:block;' }}"> Banka Bilgisi Güncelle </button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
        
                            </div><!-- // .col-12 -->
                        </div>
        
                    
                    </div><!-- // .container -->
        </main>
    </body>
    
    <footer>
        <script src="{{asset('/js')}}/main.min.js"></script>
        <script src="{{asset('/web')}}/js/account_setting.js"></script>
        
        @include('include.footer')
    </footer>
    
</html>