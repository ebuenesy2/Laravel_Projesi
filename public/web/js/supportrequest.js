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
        if (obj.serverToken ==yildirimDev_serverToken && obj.dataType == "supportrequest" && obj.dataTypeTitle == "supportrequest_add") {
           
            var userRoleData = obj.data;
            var userRole = document.cookie.split(';').find((row) => row.startsWith(' userRoleToken='))?.split('=')[1];
            var sitePathName = window.location.pathname; // /supportrequest/list
            
            //! Admin
            if (userRole == "token" && sitePathName == "/supportrequest/list") { toastr.success("Yeni Destek Talebi Geldi"); window.location.reload(); }
            
        }
    };
    
    socket.onerror = function (evt) {
        toastr.error("Socket Hata"); console.log("Socket ERR: " + evt.data);
        socketConnectionStatus = 0;
    };
    
 
    //******* Sabit **********/
    
    //! Active
    document.querySelectorAll('#listItemActive').forEach(function (i) {
        i.addEventListener('click', function (event) {
           
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_active_status = event.target.getAttribute("data_active");
            var data_token = event.target.getAttribute("data_token");
            
           
            Swal.fire({
                title: data_active_status == "true" ? 'Destek Talebini Kapatmak İster misiniz ?' : "Destek Talebini Açmak İster misiniz ?",
                text: "Bunu geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: data_active_status == "true" ? '#ed1c24' : "#1bb934",
                confirmButtonText: data_active_status == "true" ? 'Kapat' : "Aç",
                cancelButtonColor: 'black',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    //! Ajax         
                    $.ajax({
                        url: "/supportrequest/update/active",
                        method: "post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {
                            id: data_id,
                            active: data_active_status,
                            token: data_token
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
                        url: "/supportrequest/delete",
                        method: "post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {
                            id: data_id
                        },
                        success: function (response) {
                            //alert("başarılı");
                            //console.log("response:", response);
                            //console.log("success:", response.status);
                            
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
    $("#uploadForm").on('submit', function(e){
            e.preventDefault();

            //alert("upload submit");
                    
            //! Form Data verileri
            var formData = new FormData(this); 

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $("#progressBarUser").width(percentComplete + '%');
                            $("#progressBarUser").html(percentComplete+'%');
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
                processData:false,
                beforeSend: function(){
                    $("#progressBarUser").width('0%');
                    $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
                },
                error: function () {
                    //alert("hatali");
                    $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                },
                success: function (resp) {
                    //alert("basarili");
                    //console.log("resp:", resp);
                    //console.log("resp file_path:", resp.file_path);
                    
                    //! Yüklenen Dosya Url
                    $('#file_path').html(resp.file_path);
                    $('#file_url').html(resp.file_url);
                    
                    $('#supportrequest_answer').attr('disabled', false); //! Yanıtla Açık
                    $('#supportrequest_save').attr('disabled', false); //! Yanıtla Açık
                    
                    //! avatar_img
                    //$('#avatar_img').attr('src', resp.file_path);
                    
                    //! upload Durum
                    $('#uploadStatus').css('display','none');
                }
            }); //! Ajax
            
    }); //! Dosya Yükleme
    
    //******* Sabit Son **********/
    
        
    //! Destek Talebi Oluştur
    $('#supportrequest_save').click(function (e) {
        e.preventDefault();
        
        //alert("supportrequest_save");
        
        //! Destek 
        var title = $('#title').val();
        var description = $('#description').val();
  
        
        //! UserRole
        var userRoleId = document.getElementById("userRole").value;
        var userRoleTitle = $('#userRole option[value="' + userRoleId + '"]').html();
        var userRoleToken = $('#userRole option[value="' + userRoleId + '"]').attr('data-token');
        
                
        //! priority
        var priorityId = document.getElementById("priority").value;
        var priorityTitle = $('#priority option[value="' + priorityId + '"]').html();
        var priorityToken = $('#priority option[value="' + priorityId + '"]').attr('data-token');
        
        console.log("userRoleId:", userRoleId);
        console.log("priorityId:", priorityId);
        
        if (!title) {
            Swal.fire({
                icon: 'error',
                text: 'Konu Yok'
            })
        }
        else if (!description) {
            Swal.fire({
                icon: 'error',
                text: 'Yanıt Yok'
            })
        }
        else if (userRoleId == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Departman Seçilmedi'
            })
        }
        else if (priorityId == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Aciliyet Durumu Seçilmedi'
            })
        }
        else if (userRoleId != 0 && priorityId != 0) {
             
            var file_path = $('#file_path').html();
            var file_url = $('#file_url').html();
             
            console.log("file_path:", file_path);
            console.log("file_url:", file_url);
        
            //! Ajax
            $.ajax({
                url: "/supportrequest/add",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    title: title,
                    description: description,
                    priorityToken: priorityToken,
                    fileUrl: file_path,
                    fileUploadUrl: file_url,
                    statusToken: "token20",
                },
                success: function (response) {
                    //alert("başarılı");
                    console.log("response:", response);
                    //console.log("success:", response.status);
            
                    if (response.status) {
                
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'İşleminiz Başarılı',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        
                        
                        //! Socket Gönderme
                        const jsonVeri = JSON.stringify({
                            toAll: true,
                            toUserId: null,
                            dataType: "supportrequest",
                            dataTypeTitle: "supportrequest_add",
                            dataTypeDescription: "Destek Ekleme Başarılı",
                            dataId: 0,
                            data: null,
                            pageTable: "home",
                            pageToken: "homeToken"
                        });

                        socket.send(jsonVeri);
                        //! Socket Gönderme Son
                
                        //! Sayfa Yönlendirme
                        window.location.href = "/supportrequest/list";
                
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
   
        
    });   //! Destek Talebi Oluştur Son
    
            
    //! Destek Talebi Cevapla
    $('#supportrequest_answer').click(function (e) {
        e.preventDefault();
        
        //alert("supportrequest_answer");
        
        //! Açıklama
        var description = $('#description').val();
        
        //! supportRequestTitle
        var supportRequestTitleId = $('#listItemActive').attr('data_id');
        var supportRequestTitleToken = $('#listItemActive').attr('data_token');
        
        //! Dosya kontrolu
        var file_path = $('#file_path').html();
        var file_url = $('#file_url').html();
        
        if (description) {
       
            //! Ajax
            $.ajax({
                url: "/supportRequestComment/add",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                supportRequestTitleId: supportRequestTitleId,
                supportRequestTitleToken: supportRequestTitleToken,
                description: description,
                fileUrl:file_path,
                fileUploadUrl:file_url
                },
                success: function (response) {
                    //alert("başarılı");
                    //console.log("response:", response);
                    //console.log("success:", response.status);
                    
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
        else {
           Swal.fire({
                icon: 'error',
                text: 'Açıklama Yok'
            })
        }
   
        
    });   //! Destek Talebi Cevapla Son
    
    //! Dosya Seç
    $('#gerber_file_id').change(function () {
        
        var upload_files_count = 0;
        
        const upload_files = document.getElementById('gerber_file_id').files; //! Dosya Alıyor
        var upload_files_count = upload_files.length; //! Sayısı
        
        
        //! Button Kontrolu
        if (upload_files_count != 0) {
            $('#fileUploadButton').attr('disabled', false); //! Dosya Ekle Açık
            $('#supportrequest_answer').attr('disabled', ''); //! Yanıtla Kapalı
            $('#supportrequest_save').attr('disabled', ''); //! Yanıtla Kapalı
            
            $('#fileUploadClose').css('display', 'block'); //! Göster
        }
        else {
            $('#fileUploadButton').attr('disabled', ''); //! Dosya Ekle Kapalı
            $('#supportrequest_answer').attr('disabled', false); //! Yanıtla Açık
            $('#supportrequest_save').attr('disabled', false); //! Yanıtla Açık
            
            $('#fileUploadClose').css('display', 'none'); //! Gizle
        }
        
    });  //! Dosya Seç Son
    
    //! Dosya Yükleme İptal
    $('#fileUploadClose').click(function () {
       
        $('#gerber_file_id').val(''); //! Dosya Siliyor
        $('#fileUploadButton').attr('disabled', ''); //! Dosya Ekle Kapalı
        $('#supportrequest_answer').attr('disabled', false); //! Yanıtla Açık
            
        $('#fileUploadClose').css('display', 'none'); //! Gizle
        
    }); //! Dosya Yükleme İptal Son
    
    
    //! Yazı Kontrolu
    $('#description').keyup(function () { //! Yazma kapandı
        
        var sayisi = $('#description').val().length;
        
        if (sayisi ==0) {
            $('#description_writing').css('display', 'none');
            $('#description_writing').css('color', 'black');
        }
        else {
            $('#description_writing').css('display', 'flex');
            $('#description_writing').css('color', 'red');
        }
        
    }); //! Yazı Kontrolu Son
    

});