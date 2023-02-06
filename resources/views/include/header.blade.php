       
    <main class="o-page__content" style="margin-top:{{ Request::is('/') ? '-25px;' : '0px'}}">
       <header class="c-navbar u-mb-medium">
                <button class="c-sidebar-toggle u-mr-small">
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                    <span class="c-sidebar-toggle__bar"></span>
                </button><!-- // .c-sidebar-toggle -->

                <h2 class="c-navbar__title u-mr-auto " > <p  class="yildirimdevLangRef"  key="welcome"  > HOŞGELDİNİZ </p>   <p id="welcome_nameSurname" style="display: flex;justify-content: center;margin-top: -10px;" >  <div id="userNameSurname" style="font-size: 12px; display: flex; justify-content: center; " >{{$name}}   {{$surname}}</div> </p> </h2>
                
                
                <div  style="display:flex; gap:10px; " >
                    
                    <div class="c-dropdown dropdown">
                        <a style="text-decoration:none"  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="c-avatar__img" src="{{asset('/img/lang')}}/lang-turkish.svg"   id="lang_img_url" >
                        </a>

                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                            <a style="text-decoration:none" class="c-dropdown__item dropdown-item" id="tr"> Türkçe </a>
                            <a style="text-decoration:none" class="c-dropdown__item dropdown-item" id="en"> English </a>
                        </div>
                    </div>

                    <div class="c-dropdown dropdown">
                        <a style="text-decoration:none"  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="c-avatar__img" src="{{$userImageUrl}}" alt="Profile Picture">
                        </a>

                        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                            <a style="text-decoration:none" class="c-dropdown__item dropdown-item" href="/account_settings">Profil Ayarları</a>
                            <a style="text-decoration:none" class="c-dropdown__item dropdown-item" href="/login">Güvenli Çıkış</a>
                        </div>
                    </div>
                    
                </div> 
                
            </header>