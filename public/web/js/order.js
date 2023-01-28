$(function () {

    //alert("deneme");
    
 
         
    var yildirimDev_serverToken = $('#yildirimDev').attr('servertoken');
    var yildirimDev_socketUrl = $('#yildirimDev').attr('socketUrl');
    let socketConnectionStatus = 0;
    var socket = "";
    
    //! Socket Baglantısı
    // let userId = document.cookie.split(';').find((row) => row.startsWith(' userID='))?.split('=')[1]; //! userid
    // userId = Number(userId);
    
    const zmnUserId = new Date().getTime();
    const userId = Number(zmnUserId);
    
    var socket = new WebSocket('wss://'+yildirimDev_socketUrl+'/socket/' + userId);  // Url
    
    socket.onopen = function () {
        socketConnectionStatus = 1;
        console.log("Socket Bağlandı");
        toastr.success("Socket Bağlandı");
        
         //Veri Gönderme
        const jsonVeri = JSON.stringify({
            serverToken: yildirimDev_serverToken,
            userToken: "bex360Laravel_userToken",
            name: "bex360Laravel_Name",
            surname: "bex360Laravel_Surname",
            dataType: "Init",
            dataTypeTitle: "Init",
            dataTypeDescription: "Ayarlama Yapıldı",
            dataTypeDescription_EN: "The settings has been done.",
            status: "success"
        });
         
        socket.send(jsonVeri);
        //Veri Gönderme Son
    };
    
    socket.onclose = function (evt) {
        toastr.error("Socket Kapatıldı");
        socketConnectionStatus = 0;
    };
    
    socket.onmessage = function (evt) {
        const serverData = JSON.parse(evt.data);
        console.log('Message from server Data ', serverData);
        
        //! Veri Alma
        let gelenData = event.data;
        const obj = JSON.parse(gelenData);
        console.log("obj:", obj);
        
        
        // Bağlantı Bilgileri
        if (obj.serverToken ==yildirimDev_serverToken && obj.dataType == "Order" && obj.dataTypeTitle == "order_add") {
           
            var userRoleData = obj.data;
            var userRole = document.cookie.split(';').find((row) => row.startsWith(' userRoleToken='))?.split('=')[1];
            var sitePathName = window.location.pathname; // /supportrequest/list
            
            //! Admin
            if (userRole == "token" && sitePathName == "/orders/list") { toastr.success("Yeni Sipariş Geldi"); window.location.reload(); }
            
            //! Firma 
            for (let index = 0; index < userRoleData.length; index++) {
               if (userRole ==  userRoleData[index] && sitePathName == "/orders/list") { toastr.success("Yeni Sipariş Geldi"); window.location.reload(); }
            }
            
            
        }
    };
    
    socket.onerror = function (evt) {
        toastr.error("Socket Hata"); console.log("Socket ERR: " + evt.data);
        socketConnectionStatus = 0;
    };
    
    //! Active
    document.querySelectorAll('#listItemActive').forEach(function (i) {
        i.addEventListener('click', function (event) {
           
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_cargoToken = event.target.getAttribute("data_cargoToken");
            var data_companyToken = event.target.getAttribute("data_companyToken");
            var data_token = event.target.getAttribute("data_token");
            
             console.log("data_cargoToken:", data_cargoToken);
             console.log("data_companyToken:", data_companyToken);
             console.log("data_token:", data_token);
           
            Swal.fire({
                title: data_cargoToken == "token5" ? 'Siparişler Kargoya Hazır mı?' : "Hazırlandı",
                text: "Bunu geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: data_cargoToken == "token5" ? 'green' : "#ed1c24",
                confirmButtonText: data_cargoToken == "token5" ? 'Evet' : "Hayır",
                cancelButtonColor: 'black',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    //alert("onaylandı");
                    
                    //! Ajax         
                    $.ajax({
                        url: "/orders/updated/cargo",
                        method: "post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {
                            token: data_token,
                            companyToken: data_companyToken,
                            cargoStatus: "token14"
                        },
                        success: function (response) {
                            //alert("başarılı");
                            console.log("response:", response);
                            // console.log("success:", response.status);
                            
                            if (response.status) {
                                
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'İşleminiz Başarılı',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                
                                //! Sayfa Yenileme
                                window.location.reload();
                                
                            }
                            else {
                                
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'İşleminiz Başarısız',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }
                        },
                        error: function (error) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'İşleminiz Başarısız',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            console.log("error:", error);
                        }
                    }); //! Ajax
                    
                }
            })
        
           
       
        });
    }); //! Active Son
      
      
    //! Delete
    document.querySelectorAll('#listItemDelete').forEach(function (i) {
        i.addEventListener('click', function (event) {
           
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            
            //console.log("data_id:", data_id);
           
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bunu geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Evet Sil',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    //! Ajax         
                    $.ajax({
                        url: "/sabit/delete",
                        method: "post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {
                            id: data_id
                        },
                        success: function (response) {
                            // alert("başarılı");
                            // console.log("response:", response);
                            // console.log("success:", response.status);
                            
                            if (response.status) {
                                
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'İşleminiz Başarılı',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                
                                //! Sayfa Yenileme
                                window.location.reload();
                            }
                            else {
                                
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'İşleminiz Başarısız',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }
                        },
                        error: function (error) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'İşleminiz Başarısız',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            console.log("error:", error);
                        }
                    }); //! Ajax
                    
                }
            })
        });
    }); //! Delete Son
    
        
    //! Sayfa Sayısı
    $('#row_count').change(function (e) {
        e.preventDefault();
        
        var row_countValue = document.getElementById("row_count").value;
        
         //! Site Yönlendirme
        let siteUrl = window.location.origin + window.location.pathname + "?page=1" + "&rowcount=" + row_countValue;
        window.location.href = siteUrl;
        
    }); //! Sayfa Sayısı Son

   
    //! Tümü Seçme
    $('input[type="checkbox"][name="showAllRows"]').click(function () {
       
        //! Tüm Elemanları Seçiyor
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
       
        //! Elemanları alıyor
        var eleman = document.getElementsByName('chk_product');
        var eleman_sayisi = eleman.length;
       
        for (var i = 0; i < eleman_sayisi; i++) {
            var eleman_id = eleman[i].id;
            var ischecked = eleman[i].checked;
            
            console.log("eleman_id:", eleman_id, " ischecked:", ischecked);
         
        }
       
        console.log("eleman:", eleman);
        console.log("eleman_sayisi:", eleman_sayisi);

    }); //! Tümü Seçme Son
    

    //! Dosya Yükleme
    $("#uploadForm_general").on('submit', function (e) {
        e.preventDefault();

        //alert("tiklama uploadForm_general");
              
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
            url: "/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#progressBarUser").width('0%');
                $('#uploadStatus').html('<img src="../../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                //console.log("resp:", resp);
               
                //! avatar_img
                //$('#product_img').attr('src', resp.file_path);
                
                //! Önizleme
                $('#file_url_view_fileupload').html(resp.file_path);
               
                //! upload Durum
                $('#uploadStatus').css('display', 'none');
            }
        }); //! Ajax
        
    });  //! Dosya Yükleme Son
    
    //******* Sabit Son **********/
    
    
    //******* Ekleme Ve Güncelleme **********/
    
    //! Modal  Açma
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //alert("açıld");
            
            //! Attr - Diğer Veri Alma
            var data_token = event.target.getAttribute("data_token");
            var data_id = event.target.getAttribute("data_id");
            var data_companyToken = event.target.getAttribute("data_companyToken");
            var data_status = event.target.getAttribute("data_status");
            
            var data_cargocompanyid = event.target.getAttribute("data_cargocompanyid"); 
            var data_cargoCompanyToken = event.target.getAttribute("data_cargoCompanyToken"); //! Kargo Firması
            var data_cargoTrackingCode = event.target.getAttribute("data_cargoTrackingCode"); //! Kargo Takip Kodu
            
           
            //! Console
            console.log("data_token:", data_token);
            console.log("data_id:", data_id);
            console.log("data_companyToken:", data_companyToken);
            console.log("data_status:", data_status);
           
            // //! Return Yazma
            $('#cargo_export').attr("data_token",data_token);
            $('#cargo_export').attr("data_companyToken", data_companyToken);
            
            $('#cargo_update').attr("data_token",data_token);
            $('#cargo_update').attr("data_companyToken", data_companyToken);
            
            $('#cargoTrackingCode').val(data_cargoTrackingCode == "null" ? '' : data_cargoTrackingCode);
            
            //! İşlemler Gizliyor
            document.querySelectorAll('#productUpload').forEach(function (i) {
      
                //! Attr - Diğer Veri Alma
                var data_token_new = event.target.getAttribute("data_token");
                var data_companyToken_new = event.target.getAttribute("data_companyToken");
                    
                if (data_token == data_token_new && data_companyToken == data_companyToken_new) {
                    if (data_status == "token15" || data_status == "token16" || data_status == "token17" ) {
                        $("[id=productUpload][data_myorderid=" + data_id + "][data_companytoken=" + data_companyToken + "]").css('display', 'none');
                    } //! GİZLE
                }
             
        
      
            }); //! İşlemler Gizliyor Son
            
            
            //! Kargo Firması Seçiyor
            if (data_cargoCompanyToken != "null" ) { $('#cargoCompanyListChange option[value=' + data_cargocompanyid + ']').prop("selected", true);  }
            else { $('#cargoCompanyListChange option[value=0]').prop("selected", true); }
            
            
            
            //! Cari Hesap
            $('#apiToken').val(data_token);
            $('#apiTokenFatura').val(data_token);
            $('#companyTokenFatura').val(data_companyToken);
            
            $('#apiTokenDekont').val(data_token);
            $('#companyTokenDekont').val(data_companyToken);
            //! Cari Hesap Son
        
        });
    });  //! Modal  Açma Son
    
    
    //! Ürün Onaylama 
    document.querySelectorAll('#productUpload').forEach(function (i) {
        i.addEventListener('click', function (event) {
            event.preventDefault();
            
            //! Text
            var data_token = event.target.getAttribute("data_token");
            var data_companyToken = event.target.getAttribute("data_companyToken");
            
            //console.log("data_token:", data_token);
            //console.log("data_companyToken:", data_companyToken);
        
            //! PostData
            var PostData = {
                token: data_token,
                products: []
            };
        
            //! Tüm Ürünlerin Onay Kontrol
            document.querySelectorAll('[id=productCheck]').forEach(function (i) {
            
                var data_token_product = i.getAttribute('data_token');
                var data_producttoken = i.getAttribute('data_producttoken');
                var data_checked = i.getAttribute('checked') ? true : false;
            
                if (data_token == data_token_product) {
                    
                    var data = {
                        productToken: data_producttoken,
                        isActive: data_checked,
                        statusToken: data_checked == true ? "token6" : "token5"
                    };
            
                    PostData.products.push(data);
                }
            
            }) //! Tüm Ürünlerin Onay Kontrol Son
            
            //console.log("PostData:", PostData);
            
           
            //! Ajax         
            $.ajax({
                url: "/orders/updated/product",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: PostData,
                success: function (response) {
                    // alert("başarılı");
                    //console.log("response:", response);
                    // console.log("success:", response.status);
                
                    if (response.status) {
                    
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'İşleminiz Başarılı',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    
                        //! Sayfa Yenileme
                        window.location.reload();
                    
                    }
                    else {
                    
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'İşleminiz Başarısız',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                },
                error: function (error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'İşleminiz Başarısız',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    console.log("error:", error);
                }
            }); //! Ajax Son
            
            
            
        });
    });  //! Ürün Onaylama Son
    
    
     //! Modal  Açma
    document.querySelectorAll('.cargoExportModal').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            alert("cargoExportModal");
            
            //! Attr - Diğer Veri Alma
            var data_token = event.target.getAttribute("data_token");
            var data_id = event.target.getAttribute("data_id");
            var data_companyToken = event.target.getAttribute("data_companyToken");
         
           
            //! Console
            console.log("data_token:", data_token);
            console.log("data_id:", data_id);
            console.log("data_companyToken:", data_companyToken);
            
            //! Ajax         
            $.ajax({
                url: "/cargo/export/post",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token: data_token,
                    companyToken: data_companyToken
                },
                success: function (response) {
                    // alert("başarılı");
                    console.log("response:", response);
                    // console.log("success:", response.status);
                
                    if (response.status) {
                    
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'İşleminiz Başarılı',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    
                       
                    
                    }
                    else {
                    
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'İşleminiz Başarısız',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                },
                error: function (error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'İşleminiz Başarısız',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    console.log("error:", error);
                }
            }); //! Ajax Son
        
        });
    });  //! Modal  Açma Son
    
    
    //! Fatura Yükleme
    $("#uploadFormFatura").on('submit', function (e) {
        e.preventDefault();

              
       // ! Form Data verileri
       var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressBarFatura").width(percentComplete + '%');
                        $("#progressBarFatura").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "/current/invoice/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#progressBarFatura").width('0%');
                $('#uploadStatus').html('<img src="../../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                console.log("resp:", resp);
               
                
                //! Önizleme
                $('#invoiceFileUrlHidden').css('display', 'none'); //! Gizle
                $('#invoiceFileUrl').css('display', 'block'); //! Göster
                
                $('#invoiceFileUrl').attr('href', resp.file_path);
                $('#invoiceFileUrl').attr('download', resp.file_path);
               
                //! upload Durum
                $('#uploadStatus').css('display', 'none');
                
                //! Sayfa Yineleme
                window.location.reload();
                
            }
        }); //! Ajax
        
    });  //! Fatura Yükleme Son
    
        
    //! Dekont Yükleme
    $("#uploadFormDekont").on('submit', function (e) {
        e.preventDefault();

        //alert("tiklama uploadForm_general");
              
        //! Form Data verileri
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressBarDekont").width(percentComplete + '%');
                        $("#progressBarDekont").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "/current/receipt/file_upload/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#progressBarDekont").width('0%');
                $('#uploadStatus').html('<img src="../../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                console.log("resp:", resp);
                
                //! Önizleme
                $('#receiptFileUrl').attr('href',resp.file_path);
                $('#receiptFileUrl').attr('download',resp.file_path);
               
                //! upload Durum
                $('#uploadStatus').css('display', 'none');
                
                //! Sayfa Yineleme
                window.location.reload();
            }
        }); //! Ajax
        
    });  //! Dekont Yükleme Son
    
    
    //! Kargo Numarası
    $('#cargo_update').click(function (e) {
        
        //! Sipariş 
        var data_token = $('#cargo_update').attr('data_token');
        var data_companytoken = $('#cargo_update').attr('data_companytoken');
        
        //! Kargo 
        var cargoCompanyListChange = $('#cargoCompanyListChange').val();
        var cargoCompanyListHtml = $('#cargoCompanyListChange option[value="'+cargoCompanyListChange +'"]').html(); 
        var cargoCompanyListToken = $('#cargoCompanyListChange option[value="' + cargoCompanyListChange + '"]').attr('data-token');
        
        //! Kargo Numarası
        var cargoTrackingCode = $('#cargoTrackingCode').val();
       
       
        if (Number(cargoCompanyListChange) == 0 ) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Kargo Firması Seçilmedi',
                showConfirmButton: false,
                timer: 2000
            });
        }
        else {
            
            //! Ajax         
            $.ajax({
                url: "/orders/updated/cargo/trackingCode",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token: data_token,
                    companyToken: data_companytoken,
                    cargoStatus: "token15",
                    cargoCompanyToken: cargoCompanyListToken,
                    cargoTrackingCode: cargoTrackingCode
                },
                success: function (response) {
                    // alert("başarılı");
                    console.log("response:", response);
                    // console.log("success:", response.status);
                
                    if (response.status) {
                    
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'İşleminiz Başarılı',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    
                        //! Sayfa Yenileme
                        window.location.reload();
                    }
                    else {
                    
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'İşleminiz Başarısız',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                },
                error: function (error) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'İşleminiz Başarısız',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    console.log("error:", error);
                }
            }); //! Ajax Son
            
        }
                 
     
        
        
    }); //! Kargo Numarası
   
    
    //******* Ekleme Ve Güncelleme Son **********/

});