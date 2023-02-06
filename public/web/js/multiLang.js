$(document).ready(function () {
 
     

    $(function () {
      
        $('.dropdown-item').click(function () {
            var lang = $(this).attr('id');
            
            console.log("lang:", lang);
            
            
            document.cookie = "multiLang="+lang; //! Çerez Yok
            
            localStorage.setItem('multiLang', JSON.stringify(lang)); //! LocalStroage
            location.reload(); //! Sayfa Güncelleme Yapıyor
            
            
        
        });
    });
    
    var langJson =  JSON?.parse(localStorage.getItem('multiLang')) ||  "tr"; //! Veri Çekme
    
   
    if (langJson == "en") { 
        $("#lang_img_url").attr('src', window.location.origin + "/img/lang/lang-english.svg");
    }
    else {
         $("#lang_img_url").attr('src', window.location.origin + "/img/lang/lang-turkish.svg");
    }

    
    /*******  Lang.json  ******/
   
    $.getJSON("../../web/json/multiLang.json", function (jsonData) {
       var arrLang = jsonData;
        
        //! Verileri Çevir
        $('[class=yildirimdevLangRef]').each(function (index, element) {
            
            console.log("index:", index);
            console.log("element:", element);
            
            var key = $(this).attr('key'); //! İtem
            if (key) { $(this).html(arrLang[langJson][key]); }
            
            $('[class=yildirimdevLangRef][key=' + key + ']').html(arrLang[langJson][key]);
            
            console.log("arrLang:", arrLang);
            console.log("en:", arrLang[langJson][key]);
        
        });
    })
    
    /*******  Lang.json Son ******/
    
 
   
      
});