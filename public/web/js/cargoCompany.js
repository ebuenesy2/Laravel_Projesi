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
                        url: "/cargo/company/update/active",
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
                        url: "/cargo/company/delete",
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
    
    //******* Sabit Son **********/
    
    
    //******* Ekleme Ve Güncelleme **********/
    
            
    //! Ekleme
    $('#new_add').click(function (e) {
        e.preventDefault();
          
           
        //! Text
        var cargoCompanyTitle = $('#cargoCompanyTitle').val();
        var cargoCustomerId = $('#cargoCustomerId').val(); //! Müşteri Numarası
       
        if (!cargoCompanyTitle) {  //! Kargo Firması Yoksa
            
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Firma Eksik',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
        else if (!cargoCustomerId) {  //! Müşteri Numarası Yoksa
            
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Müşteri Numarası Eksik',
                showConfirmButton: false,
                timer: 2000
            })
            
        }
        else {
            
            //! Ajax         
            $.ajax({
                url: "/cargo/company/add",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    cargoCompanyTitle: cargoCompanyTitle,
                    cargo_customerId: cargoCustomerId
                },
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
            
        }
        
      
    
    });  //! Ekleme Son
    
    //! Modal  Açma
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_token = event.target.getAttribute("data_token");
            var data_cargoCompanyTitle = event.target.getAttribute("data_cargoCompanyTitle");
            var data_cargo_customerId = event.target.getAttribute("data_cargo_customerId");
           
            //! Yazma
            $('#cargoCompanyTitle_update').attr("data_token", data_token);
            $('#cargoCompanyTitle_update').val(data_cargoCompanyTitle);
            $('#cargoCustomerId_update').val(data_cargo_customerId);
        
        });
    });  //! Modal  Açma Son
    
    
    //! Güncelle
    $('#db_update').click(function (e) {
        e.preventDefault();
        
        //alert("sabit_update");
        
        //! cargoCompanyTitle
        var token = $('#cargoCompanyTitle_update').attr("data_token");
        var cargoCompanyTitle_update = $('#cargoCompanyTitle_update').val();
        var cargoCustomerId_update = $('#cargoCustomerId_update').val();
      
        // console.log("token:", token);
        // console.log("cargoCompanyTitle_update:", cargoCompanyTitle_update);
        // console.log("cargoCustomerId_update:", cargoCustomerId_update);
        
            
       //! Ajax         
        $.ajax({
            url: "/cargo/company/update",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                token: token,
                cargoCompanyTitle: cargoCompanyTitle_update,
                cargo_customerId: cargoCustomerId_update
            },
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
        
    });  //! Güncelle Son
    
    //******* Ekleme Ve Güncelleme Son **********/

});