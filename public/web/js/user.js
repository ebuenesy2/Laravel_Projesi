$(function () {

    //alert("deneme");
    
 
    //******* Sabit **********/
    
    //! Active
    document.querySelectorAll('#listItemActive').forEach(function (i) {
        i.addEventListener('click', function (event) {
           
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_active_status = event.target.getAttribute("data_active");
            var data_token = event.target.getAttribute("data_token");
           
            Swal.fire({
                title: data_active_status == "true" ? 'Pasif Yapmak İster misiniz ?' : "Aktif Yapmak İster misiniz ?",
                text: "Bunu geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: data_active_status == "true" ? '#ed1c24' : "#1bb934",
                confirmButtonText: data_active_status == "true" ? 'Pasif Yap' : "Aktif Yap",
                cancelButtonColor: 'black',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    //! Ajax         
                    $.ajax({
                        url: "/user/update",
                        method: "post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {
                            id: data_id,
                            active: data_active_status,
                            token: data_token
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
    
    //! Email Onay Kontrol   
    document.querySelectorAll('.modal_doc').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //alert("doc");
          
            //! Attr - Diğer Veri Alma
            var data_adminCheck = event.target.getAttribute("data_adminCheck");
            console.log("data_adminCheck:", data_adminCheck);
              
            if (data_adminCheck == 1) { $('#email_checkStatus').html('<span class="c-badge c-badge--success">ONAYLANDI</span>'); }
            if (data_adminCheck == 0) { $('#email_checkStatus').html('<span class="c-badge c-badge--danger">ONAYLANMADI</span>');}
            
      
        });

    });  //! Email Onay Kontrol  Son
          
    //! Modal Bilgileri
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
          
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_token = event.target.getAttribute("data_token");
            var data_dateofBirth = event.target.getAttribute("data_dateofBirth");
            var data_country = event.target.getAttribute("data_country");
            var data_city = event.target.getAttribute("data_city");
            var data_userRoleToken = event.target.getAttribute("data_userRoleToken");
            var data_img = event.target.getAttribute("src");
            
            var data_companyId = event.target.getAttribute("data_companyId");
            var data_companyTitle = event.target.getAttribute("data_companyTitle");
            var data_categoryTitle = event.target.getAttribute("data_categoryTitle");          
            
            //! Console
            console.log("data_id:", data_id);
            console.log("data_token:", data_token);
            console.log("data_userRoleToken:", data_userRoleToken);
            
            //! Return
            $('#user_idRole').html("#" + data_id);
            $('#user_idRole').attr("data_token", data_token);
            $("#apiRoleListChange [data_token=" + data_userRoleToken + "]").prop("selected", true);
            
            //! Resim
            $('#productViewImage').attr('src', data_img);
                        
            $('#user_id').html("#"+data_id);
            $('#dateofBirth').html(data_dateofBirth);
            $('#country').html(data_country);
            $('#city').html(data_city);
            
            $('#companyId').html("#"+data_companyId);
            $('#companyTitle').html(data_companyTitle);
            $('#categoryTitle').html(data_categoryTitle);
      
        });

    });  //! Modal Bilgileri Son
    
    
    //! Kullanıcı Role  Güncelleme
    $('#userRoleUpload').click(function (e) {
        e.preventDefault();
        
        var user_idRole = $('#user_idRole').html(); //! id
        var user_idRoleToken = $('#user_idRole').attr("data_token"); //! Token
        
        var apiRoleListChangeId = $("#apiRoleListChange").val();
        var apiRoleListChangeToken = $("#apiRoleListChange [value="+apiRoleListChangeId+"]").attr("data_token");
         
        // console.log("apiRoleListChangeId:", apiRoleListChangeId);
        // console.log("apiRoleListChangeToken:", apiRoleListChangeToken);
        
        // console.log("user_idRole:", user_idRole);
        // console.log("user_idRoleToken:", user_idRoleToken);
        
                
        //! Ajax 
        $.ajax({
            url: "/user/update/role",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                token: user_idRoleToken,
                userRoleToken: apiRoleListChangeToken
            },
            success: function(response){
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
                alert("hatalı");
                console.log("error:", error);
            }
        }); //! Ajax

        
        
    }); //! Kullanıcı Role  Güncelleme Son
    
    

});