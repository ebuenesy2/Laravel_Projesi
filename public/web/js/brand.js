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
                        url: "/brand/update/active",
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
                        url: "/brand/delete",
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
            
    //! Ekleme
    $('#brand_add').click(function (e) {
        e.preventDefault();
        
        //alert("brand_add");
        
        //! Text
        var brand_name = $('#brand_name').val();
        
        if (brand_name) {           
                    
            //! Ajax         
            $.ajax({
                url: "/brand/add",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    brandTitle: brand_name
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
        else {
            
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Marka Adı Eksik',
                showConfirmButton: false,
                timer: 2000
            })
        }

        
    });  //! Ekleme Son
    
    //! Modal  Açma
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //alert("açıld");
            
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_token = event.target.getAttribute("data_token");
            var data_name = event.target.getAttribute("data_name");
           
            //! Yazma
            $('#brand_name_update').val(data_name);
            $('#brand_name_update').attr("data_token",data_token);
            
            // //! Return
            // console.log("data_id:", data_id);
            // console.log("data_token:", data_token);
            // console.log("data_name:", data_name);            
        
        });
    });  //! Modal  Açma Son
    
    
    //! Güncelle
    $('#brand_update').click(function (e) {
        e.preventDefault();
        
        //alert("brand_update");
        
        //! Text
        var brand_name_update = $('#brand_name_update').val();
        var brand_token_update = $('#brand_name_update').attr("data_token");
        
        //console.log("brand_name_update:", brand_name_update);
        //console.log("brand_token_update:", brand_token_update);
        
        if (brand_name_update) {
            
            //! Ajax         
            $.ajax({
                url: "/brand/update",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    token: brand_token_update,
                    brandTitle: brand_name_update
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
        else {
            
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Marka Adı Eksik',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
        
        
        
        
    });  //! Güncelle Son
    
    //******* Ekleme Ve Güncelleme Son **********/

});