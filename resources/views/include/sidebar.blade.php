        <div class="o-page__sidebar js-page-sidebar">
            <div class="c-sidebar">
                <a style="text-decoration:none" class="c-sidebar__brand" href="/">
                    <img class="c-sidebar__brand-img" src="{{asset('/assets')}}/img/company/bex360.jpg" alt="Logo"> 
                </a>

                
            
                <h4 class="c-sidebar__title"  style=" display: {{$userRoleToken == 'token' ?  'block' : 'none' }}" >Kullanıcı Kontrolu</h4>
                <ul class="c-sidebar__list" style=" display: {{$userRoleToken == 'token' ?  'block' : 'none' }}" >

                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Route::current()->getName() === 'user.list'  || Request::is('user/*') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/user/list">
                            <i class="fa fa-user u-mr-xsmall"></i>Kullanıcılar 
                        </a>
                    </li>
                    
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Route::current()->getName() === 'company.list'  || Request::is('company/*') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/company/list">
                            <i class="fa fa-building u-mr-xsmall"></i>Firmalar 
                        </a>
                    </li>
                </ul>
            
                
                <h4 class="c-sidebar__title">ÜRÜN</h4>
                <ul class="c-sidebar__list">

                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" style="text-decoration:none"  class="{{ Route::current()->getName() === 'product.list'  || Request::is('product/*') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/product/list">
                            <i class="fa fa-shopping-bag u-mr-xsmall"></i>Ürünlerim 
                        </a>
                    </li>

                    <li class="c-sidebar__item" style="margin-left: -30px; display: {{$userRoleToken == 'token' ?  'none' : 'block' }} ">
                        <a style="text-decoration:none;" class="{{ Route::current()->getName() === 'product.add'  ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/product/add">
                            <i class="fa fa-plus u-mr-xsmall"></i>Yeni Ürün 
                        </a>
                    </li>

                      <li class="c-sidebar__item" style="margin-left: -30px; display: {{$userRoleToken == 'token' ?  'none' : 'block' }}">
                        <a style="text-decoration:none" class="{{ Route::current()->getName() === 'product.integration' ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}"  href="/product/integration">
                            <i class="fa fa-file-excel-o u-mr-xsmall"></i>Entegrasyon 
                        </a>
                    </li>
                 
                </ul>

                <h4 class="c-sidebar__title">SİPARİŞ</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none"  class="{{ Request::is('orders/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/orders/list">
                            <i class="fa fa-shopping-basket u-mr-xsmall"></i>Siparişler 
                            <!-- <span class="c-badge c-badge--danger c-badge--xsmall u-ml-xsmall">1</span> -->
                        </a>
                    </li>
                      <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('cargo/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/cargo/list">
                            <i class="fa fa-archive u-mr-xsmall"></i>Kargolar
                        </a>
                    </li>
                    
                </ul>
                <h4 class="c-sidebar__title">FİNANS</h4>
                <ul class="c-sidebar__list">
                   

                      <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('current/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/current/list">
                            <i class="fa fa-clipboard u-mr-xsmall"></i>Cari Hesap
                        </a>
                    </li>
                </ul>
                  
                <h4 class="c-sidebar__title">BİZE ULAŞIN</h4>
                <ul class="c-sidebar__list">
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none"  class="{{ Request::is('supportrequest/*') || Request::is('supportrequest')  ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}"  href="/supportrequest/list">
                            <i class="fa fa-comment-o u-mr-xsmall"></i>Destek Talebi
                        </a>
                    </li>

                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('direct/contact') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}"  href="/direct/contact">
                            <i class="fa fa-phone-square u-mr-xsmall"></i> Direkt İletişim
                        </a>
                    </li>
                </ul>
                
             
                <h4 class="c-sidebar__title" style=" display: {{$userRoleToken == 'token' ?  'block' : 'none' }}" >AYARLAR</h4>
                <ul class="c-sidebar__list" style=" display: {{$userRoleToken == 'token' ?  'block' : 'none' }}">
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none"  class="{{ Request::is('bank/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}"  href="/bank/list">
                            <i class="fa fa-bank u-mr-xsmall"></i>Banka Ayarları
                        </a>
                    </li>

                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none"  class="{{ Request::is('brand/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/brand/list">
                            <i class="fa fa-bookmark-o u-mr-xsmall"></i> Marka Ayarları
                        </a>
                    </li>
                    
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none"  class="{{ Request::is('cargo/company/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/cargo/company/list">
                            <i class="fa fa-truck u-mr-xsmall"></i> Kargo Firma Ayarları
                        </a>
                    </li>        
                    
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none"  class="{{ Request::is('company/category/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/company/category/list">
                            <i class="fa fa-industry u-mr-xsmall"></i> Firma Kategorisi Ayarları
                        </a>
                    </li>        
                    
                    <li class="c-sidebar__item" style="margin-left: -30px; display:none; ">
                        <a style="text-decoration:none" class="c-sidebar__link" href="/direct_contact">
                            <i class="fa fa-key u-mr-xsmall"></i> İzin Ayarları
                        </a>
                    </li>
                </ul>
              
                <h4 class="c-sidebar__title" style=" display: {{$userRoleToken == 'token' ?  'none' : 'none' }}">Sabit</h4>
                <ul class="c-sidebar__list" style=" display: {{$userRoleToken == 'token' ?  'none' : 'none' }}">
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Route::current()->getName() === 'sabit'  ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}"  href="/sabit">
                            <i class="fa fa-link u-mr-xsmall"></i>Sabit
                        </a>
                    </li>

                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('sabit/list') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/sabit/list">
                            <i class="fa fa-table u-mr-xsmall"></i> Sabit Listesi
                        </a>
                    </li>
                    
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('sabit/fileUpload') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/sabit/fileUpload">
                            <i class="fa fa-table u-mr-xsmall"></i> Sabit Dosya Yükleme
                        </a>
                    </li>
                </ul>
               
                <h4 class="c-sidebar__title" style=" display: {{$userRoleToken == 'token' ?  'none' : 'none' }}" >Sayfalar</h4>
                <ul class="c-sidebar__list" style=" display: {{$userRoleToken == 'token' ?  'none' : 'none' }}" >
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('/error/404') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/error/404">
                            <i class="fa fa-table u-mr-xsmall"></i> 404 Hatası
                        </a>
                    </li>
                     <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('/error/404') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/error/500">
                            <i class="fa fa-table u-mr-xsmall"></i> 500 Hatası
                        </a>
                    </li>
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('/error/company/block') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/error/company/block">
                            <i class="fa fa-table u-mr-xsmall"></i> Firma Eksik
                        </a>
                    </li>
                    <li class="c-sidebar__item" style="margin-left: -30px;">
                        <a style="text-decoration:none" class="{{ Request::is('/account/block') ? 'c-sidebar__link is-active' : 'c-sidebar__link ' }}" href="/account/block">
                            <i class="fa fa-table u-mr-xsmall"></i> Hesabınız Askıda
                        </a>
                    </li>
                </ul>
              


            </div><!-- // .c-sidebar -->
        </div><!-- // .o-page__sidebar -->
