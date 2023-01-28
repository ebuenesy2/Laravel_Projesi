$(function () {
 
         
    //! Modal  Açma
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
         
            //! Resim Al
            var data_img = event.target.getAttribute("src");
            
            //! Resim
            $('#productViewImage').attr('src', data_img);
        
        });
    });  //! Modal  Açma Son
    
    
    //! Kullanıcı Güncelleme
    $('#user_update').click(function (e) {
        e.preventDefault();  
        
          
        if (!$('#firstName').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Adınız  Eksik'
            })
        }
        
        else if (!$('#country').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Ülke  Eksik'
            })
        }
        
        else if (!$('#city').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Şehir Eksik'
            })
        }
        
        
        else {
            $.ajax({
                url: "/user/info/setting",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token: $('#yildirimDev').attr('userToken'),
                    name: $('#firstName').val(),
                    surname: $('#lastName').val(),
                    gsm: $('#gsm').val(),
                    dateofBirth: $('#dateofBirth').val(),
                    country: $('#country').val(),
                    city: $('#city').val(),
                },
                success: function (response) {
                    // alert("başarılı");
                    // console.log("response:", response);
                    // console.log("success:", response.status);
                
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Veri Güncellendi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        
                        //! Çerezleri Düzenle
                        document.cookie="name="+$('#firstName').val(); 
                        document.cookie="surname="+$('#lastName').val(); 
                        
                        //! Sayfa Güncelle
                        window.location.reload();
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata Oluştu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
               
                },
                error: function (error) {
                    alert("hatalı");
                    console.log("error:", error);
                
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata Oluştu',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }); //! Ajax
        }
      

    }); //! Kullanıcı Güncelleme Son
    
    //! Sifre Güncelleme
    $('#pass_update').click(function (e) {
        e.preventDefault();
        
        var old_pass = $('#old_pass').val()
        var new_pass = $('#new_pass').val()
        var re_pass = $('#re_pass').val()
        
        if (new_pass == re_pass) {
            
            $.ajax({
                url: "/user/pass/setting",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token:$('#yildirimDev').attr('userToken'),
                    old_pass: $('#old_pass').val(),
                    new_pass: $('#new_pass').val()
                },
                success: function(response){
                    // alert("başarılı");
                    // console.log("response:", response);
                    // console.log("success:", response.status);
                    
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Veri Güncellendi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata Oluştu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }      
                
                },
                error: function (error) {
                    alert("hatalı");
                    console.log("error:", error);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata Oluştu',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }); //! Ajax

        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Sifreler Farklı',
                showConfirmButton: false,
                timer: 1500
            })
        }
        
        
    });   //! Sifre Güncelleme  Son  
    
    //! Firma Oluştur
    $('#company_add').click(function (e) {
        e.preventDefault();
               
         var CategoryListChangeId = document.getElementById("CategoryListChange").value;
        //console.log("CategoryListChangeId:", CategoryListChangeId);
        
        var CategoryListChangeHtml = $('#CategoryListChange option[value="' + CategoryListChangeId + '"]').html();
        var CategoryListChangeHtml = CategoryListChangeHtml.replace('&amp;', '&');
        
     
        if (!$('#titleofcompany').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Firma Ünvanı Eksik'
            })
        }
        else if (!$('#taxAdministration').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Vergi Dairesi Eksik'
            })
        }
        else if (!$('#taxNo').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Vergi Numarası Eksik'
            })
        }
            
        else if (!$('#mersisNo').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Mersis Numarası Eksik'
            })
        }
                 
        else if (!$('#phoneNumber').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Sabit Telefon Numarası Eksik'
            })
        }
                      
        else if (!$('#emailAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'E-Mail Adresi Eksik'
            })
        }
                           
        else if (!$('#companyAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Firma Adresi Eksik'
            })
        }
                                
        else if (!$('#billingAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Fatura Adresi Eksik'
            })
        }
                                      
        else if (!$('#webAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Web Site Adresi Eksik'
            })
        }
            

        else if (CategoryListChangeId == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Kategori Seçilmedi'
            })
        }
        else {            
                       
            $.ajax({
                url: "/user/company/add",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    userToken: $('#yildirimDev').attr('userToken'),
                    categoryToken: $('#CategoryListChange option[value="'+CategoryListChangeId +'"]').attr('data-token'),
                    categoryTitle: CategoryListChangeHtml,
                    titleofcompany: $('#titleofcompany').val(),
                    taxAdministration: $('#taxAdministration').val(),
                    taxNo: $('#taxNo').val(),
                    mersisNo: $('#mersisNo').val(),
                    phoneNumber: $('#phoneNumber').val(),
                    emailAddress: $('#emailAddress').val(),
                    companyAddress: $('#companyAddress').val(),
                    billingAddress: $('#billingAddress').val(),
                    webAddress: $('#webAddress').val(),
                    created_byToken:  $('#yildirimDev').attr('userToken')                   
                },
                success: function(response){
                    //alert("başarılı");
                    console.log("response:", response);
                    // console.log("success:", response.status);
                    
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Firma Bilgileri Eklendi',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                        //! Sayfa Yenileme
                        //window.location.reload();
                        
                        //! Firma Ekleme Buton Değiştiriyor
                         $('#company_add').css('display', 'none'); //! Gizleme
                         $('#company_update').css('display', 'block'); //! Gösterme
                        
                        
                        //! Firma Dosyaları Göster
                        $('#error_company_doc').css('display', 'none');
                        $('#company_doc1').css('display', 'block');
                        $('#company_doc2').css('display', 'block');
                        
                        
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata Oluştu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }      
                
                },
                error: function (error) {
                    alert("hatalı");
                    console.log("error:", error);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata Oluştu',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }); //! Ajax
        }
    });    //! Firma Oluştur Son  
        
    //! Firma Güncelle
    $('#company_update').click(function (e) {
        e.preventDefault();
        
         var CategoryListChangeId = document.getElementById("CategoryListChange").value;
        //console.log("CategoryListChangeId:", CategoryListChangeId);
        
        var CategoryListChangeHtml = $('#CategoryListChange option[value="' + CategoryListChangeId + '"]').html();
        var CategoryListChangeHtml = CategoryListChangeHtml.replace('&amp;', '&');
        
        console.log("CategoryListChangeHtml", CategoryListChangeHtml);
      
        if (!$('#titleofcompany').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Firma Ünvanı Eksik'
            })
        }
        else if (!$('#taxAdministration').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Vergi Dairesi Eksik'
            })
        }
        else if (!$('#taxNo').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Vergi Numarası Eksik'
            })
        }
            
        else if (!$('#mersisNo').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Mersis Numarası Eksik'
            })
        }
                 
        else if (!$('#phoneNumber').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Sabit Telefon Numarası Eksik'
            })
        }
                      
        else if (!$('#emailAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'E-Mail Adresi Eksik'
            })
        }
                           
        else if (!$('#companyAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Firma Adresi Eksik'
            })
        }
                                
        else if (!$('#billingAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Fatura Adresi Eksik'
            })
        }
                                      
        else if (!$('#webAddress').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Hata Var',
                text: 'Web Site Adresi Eksik'
            })
        }

        else if (CategoryListChangeId == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kategori Seçilmedi'
            })
        }
        else {
            
            $.ajax({
                url: "/user/company/update",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token:$('#yildirimDev').attr('companyToken'),
                    userToken: $('#yildirimDev').attr('userToken'),
                    categoryToken: $('#CategoryListChange option[value="'+CategoryListChangeId +'"]').attr('data-token'),
                    categoryTitle: CategoryListChangeHtml,
                    titleofcompany: $('#titleofcompany').val(),
                    taxAdministration: $('#taxAdministration').val(),
                    taxNo: $('#taxNo').val(),
                    mersisNo: $('#mersisNo').val(),
                    phoneNumber: $('#phoneNumber').val(),
                    emailAddress: $('#emailAddress').val(),
                    companyAddress: $('#companyAddress').val(),
                    billingAddress: $('#billingAddress').val(),
                    webAddress: $('#webAddress').val(),
                    updated_byToken: $('#yildirimDev').attr('userToken')
                },
                success: function(response){
                    //alert("başarılı");
                    //console.log("response:", response);
                    // console.log("success:", response.status);
                    
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Veri Güncellendi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        
                        //window.location.reload();
                        
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata Oluştu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }      
                
                },
                error: function (error) {
                    alert("hatalı");
                    console.log("error:", error);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata Oluştu',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }); //! Ajax
            
        }
        
    }); //! Firma Güncelle Son
    
    //! Banka Ekle
    $('#bank_add').click(function (e) {
        e.preventDefault();
        
               
        var BankListChangeId = document.getElementById("BankListChange").value;
        var bankToken = $('#BankListChange option[value='+BankListChangeId+']').attr('data-token');     

        if (BankListChangeId == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Banka Seçilmedi'
            })
        }
        else {
            
            $.ajax({
                url: "/user/bankAccount/add",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    userToken: $('#yildirimDev').attr('userToken'),
                    bankId: Number(BankListChangeId),
                    bankToken: $('#BankListChange option[value="' + BankListChangeId + '"]').attr('data-token'),
                    bankTitle: $('#BankListChange option[value="' + BankListChangeId + '"]').html(),
                    bankAccountTitle: $('#bankAccountTitle').val(),
                    branch: $('#branch').val(),
                    nameSurname: $('#nameSurname').val(),
                    accountNumber: $('#accountNumber').val(),
                    ibanNo: $('#ibanNo').val(),
                    created_byToken: $('#yildirimDev').attr('userToken')
                },
                success: function(response){
                    // alert("başarılı");
                    // console.log("response:", response);
                    // console.log("success:", response.status);
                    
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Veri Güncellendi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata Oluştu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }      
                
                },
                error: function (error) {
                    alert("hatalı");
                    console.log("error:", error);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata Oluştu',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }); //! Ajax
        }
        
    }) //! Banka Ekle Son
    
    //! Banka Güncelle
    $('#bank_update').click(function (e) {
        e.preventDefault();
        
        var BankListChangeId = document.getElementById("BankListChange").value;
        var bankToken = $('#BankListChange option[value='+BankListChangeId+']').attr('data-token');     

        if (BankListChangeId == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Banka Seçilmedi'
            })
        }
        else {
                        
            $.ajax({
                url: "/user/bankAccount/update",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token:   $('#yildirimDev').attr('bankToken'),
                    bankId: Number(BankListChangeId),
                    bankToken: $('#BankListChange option[value="' + BankListChangeId + '"]').attr('data-token'),
                    bankTitle: $('#BankListChange option[value="' + BankListChangeId + '"]').html(),
                    bankAccountTitle: $('#bankAccountTitle').val(),
                    branch: $('#branch').val(),
                    nameSurname: $('#nameSurname').val(),
                    accountNumber: $('#accountNumber').val(),
                    ibanNo: $('#ibanNo').val(),
                    updated_byToken: $('#yildirimDev').attr('userToken')
                },
                success: function(response){
                    // alert("başarılı");
                    // console.log("response:", response);
                    // console.log("success:", response.status);
                    
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Veri Güncellendi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata Oluştu',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }      
                
                },
                error: function (error) {
                    alert("hatalı");
                    console.log("error:", error);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata Oluştu',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }); //! Ajax
            
        }
        
    }) //! Banka Güncelle Son
    
    
    //! Dosya Durumu
    function fileStatus(statusId) {

        var alertHtml = '';
        
        if (statusId == 5) { alertHtml = ' <div class="c-alert c-alert--warning"><i class="c-alert__icon fa fa-check-circle"></i> İnceleniyor! </div>'; }
        else if (statusId == 7) { alertHtml = ' <div class="c-alert c-alert--danger"><i class="c-alert__icon fa fa-check-circle"></i> Reddedildi, Tekrar Gönder! </div>'; }
        else if (statusId == 6) { alertHtml = ' <div class="c-alert c-alert--success"><i class="c-alert__icon fa fa-check-circle"></i> Tebrikler, Onaylandı! </div>'; }
        else { alertHtml = ' <div class="c-alert c-alert--info"><i class="c-alert__icon fa fa-check-circle"></i> Lütfen Yükleme Yapınız! </div>'; }
       

        return alertHtml;
    }; //! Dosya Durumu Son
    
    //! Dosya Yükleme
    $("#uploadForm").on('submit', function (e) {
        e.preventDefault();

        //alert("upload submit");
              
        //! Form Data verileri
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressBarUser").width(percentComplete + '%');
                        $("#progressBarUser").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "/user/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#progressBarUser").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                //console.log("resp:", resp);
               
                //! avatar_img
                $('#avatar_img').attr('src', resp.file_path);
                
                 //! Çerezleri Düzenle
                document.cookie = "userImageUrl=" + resp.file_path;
               
                //! upload Durum
                $('#uploadStatus').css('display', 'none');
               
                
                //! Çerez Resim Güncelleme
                document.cookie=" userImageUrl="+resp.file_path; 
               
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme Son
    
    //! Dosya Yükleme - Kimlik Fotokopisi
    $("#personalIdentityPhotoUploadForm").on('submit', function (e) {
        e.preventDefault();

        //alert("personalIdentityPhotoUploadForm submit");
              
        //! Form Data verileri
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressbarKimlikFotokopisi").width(percentComplete + '%');
                        $("#progressbarKimlikFotokopisi").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "/personalIdentityPhoto/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#progressbarKimlikFotokopisi").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                //console.log("resp:", resp);
               
                //! avatar_img
                $('#avatar_img').attr('src', resp.file_path);
               
                $('#uploadStatusKimlikFotokopisi_AlertStatus_before').css('display', 'none');
                $('#uploadStatusKimlikFotokopisi_AlertStatus').html(fileStatus(5));
               
                //! upload Durum
                $('#uploadStatus').css('display', 'none');
               
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme - Kimlik Fotokopisi Son
        
    //! Dosya Yükleme - Vergi Levhası
    $("#taxSheetFileUploadControl").on('submit', function(e){
        e.preventDefault();

        //alert("taxSheetFileUploadControl submit");
              
        //! Form Data verileri
        var formData = new FormData(this); 

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressbarVergiLevhası").width(percentComplete + '%');
                        $("#progressbarVergiLevhası").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            url: "/taxSheet/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
               $("#progressbarVergiLevhası").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
           success: function (resp) {
               //alert("sonuc");
               //console.log("resp:", resp);
               
              //! avatar_img
               $('#avatar_img').attr('src', resp.file_path);
              
               //! Upload
               $('#uploadStatusVergiLevhası_AlertStatus_before').css('display', 'none');
               $('#uploadStatusVergiLevhası_AlertStatus').html(fileStatus(5));
               
              //! upload Durum
              $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme - Vergi Levhası Son
    
    //! Dosya Yükleme - Sicil Gazetesi
    $("#tradeRegistryGazetteFileUploadControl").on('submit', function(e){
        e.preventDefault();

        //alert("tradeRegistryGazetteFileUploadControl submit");
              
        //! Form Data verileri
        var formData = new FormData(this); 

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressbarSicilGazetesi").width(percentComplete + '%');
                        $("#progressbarSicilGazetesi").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            url: "/tradeRegistryGazette/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("#progressbarSicilGazetesi").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
           success: function (resp) {
               //alert("sonuc");
               //console.log("resp:", resp);
               
              //! avatar_img
               $('#avatar_img').attr('src', resp.file_path);
               
               //! Upload
               $('#uploadStatusSicilGazetesi_AlertStatus_before').css('display', 'none');
               $('#uploadStatusSicilGazetesi_AlertStatus').html(fileStatus(5));
               
              //! upload Durum
              $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme - Sicil Gazetesi Son
        
    //! Dosya Yükleme - İmza Sirküsü
    $("#circularOfSignatureFileUploadControl").on('submit', function(e){
        e.preventDefault();

        //alert("circularOfSignatureFileUploadControl submit");
              
        //! Form Data verileri
        var formData = new FormData(this); 

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressbarİmzaSirküsü").width(percentComplete + '%');
                        $("#progressbarİmzaSirküsü").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            url: "/circularOfSignature/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("#progressbarİmzaSirküsü").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
           success: function (resp) {
               //alert("sonuc");
               //console.log("resp:", resp);
               
              //! avatar_img
               $('#avatar_img').attr('src', resp.file_path);               
                              
               //! Upload
               $('#uploadStatusİmzaSirküsü_AlertStatus_before').css('display', 'none');
               $('#uploadStatusİmzaSirküsü_AlertStatus').html(fileStatus(5));
               
              //! upload Durum
              $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme - İmza Sirküsü Son
            
    //! Dosya Yükleme - Ticaret Odası Kaydı
    $("#chamberOfCommerceRegistrationFileUploadControl").on('submit', function(e){
        e.preventDefault();

        //alert("chamberOfCommerceRegistrationFileUploadControl submit");
              
        //! Form Data verileri
        var formData = new FormData(this); 

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressbarTicaretOdasıKaydı").width(percentComplete + '%');
                        $("#progressbarTicaretOdasıKaydı").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            url: "/chamberOfCommerceRegistration/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("#progressbarTicaretOdasıKaydı").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
           success: function (resp) {
               //alert("sonuc");
               //console.log("resp:", resp);
               
              //! avatar_img
               $('#avatar_img').attr('src', resp.file_path);
                                             
               //! Upload
               $('#uploadStatusTicaretOdasıKaydı_AlertStatus_before').css('display', 'none');
               $('#uploadStatusTicaretOdasıKaydı_AlertStatus').html(fileStatus(5));
               
              //! upload Durum
              $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme - Ticaret Odası Kaydı Son
    
    //! Dosya Yükleme - Hizmet Sözlesmesi
    $("#serviceContractFileUploadControl").on('submit', function(e){
        e.preventDefault();

        //alert("serviceContractFileUploadControl submit");
              
        //! Form Data verileri
        var formData = new FormData(this); 

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressbarHizmetSözlesmesi").width(percentComplete + '%');
                        $("#progressbarHizmetSözlesmesi").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            url: "/serviceContract/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("#progressbarHizmetSözlesmesi").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
           success: function (resp) {
               //alert("sonuc");
               //console.log("resp:", resp);
               
              //! avatar_img
               $('#avatar_img').attr('src', resp.file_path);
                                                            
               //! Upload
               $('#uploadStatusHizmetSözlesmesi_AlertStatus_before').css('display', 'none');
               $('#uploadStatusHizmetSözlesmesi_AlertStatus').html(fileStatus(5));
               
              //! upload Durum
              $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
    }); //! Dosya Yükleme - Hizmet Sözlesmesi Son

});
