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

    };

    socket.onerror = function (evt) {
         toastr.error("Socket Hata"); console.log("Socket ERR: " + evt.data);
        socketConnectionStatus = 0;
    };


    //! Başlangıc
    function init() {

        try {

            var temp_id = $('#product_info').attr('data-temp_id');
            var productInfoListJson = JSON.parse(localStorage.getItem('productInfoList')); //! Veri Çekme

            //! Arama
            var dbFind = productInfoListJson.find(a => a.product_id == Number(temp_id));

            if (dbFind) {

                //console.log("dbFind:", dbFind);

                //! Seçim
                $('#brandTitle option[data-token="' + dbFind.brandToken + '"]').prop('selected', true); // Marka
                $('#productStockTitle option[data_title="' + dbFind.productStockTitle + '"]').prop('selected', true); // Stok Birimi
                $('#productPriceType option[data_title="' + dbFind.productPriceType + '"]').prop('selected', true); // Para Birimi


                //! Ürün
                $('#productName').val(dbFind.productName);
                $('#productCode').val(dbFind.productCode);

                //! Stok
                $('#productStock').val(dbFind.productStock);

                //! Fiyat
                $('#productPrice').val(dbFind.productPrice);


                //! Ürün Detayları

                //! avatar_img
                $('#product_main_img').attr('src', dbFind.productImageUrl);

                //! other_img
                $('[id=productImageView][data_id=1]').attr('src', dbFind.productOtherImageUrl1)
                $('[id=productImageView][data_id=2]').attr('src', dbFind.productOtherImageUrl2)
                $('[id=productImageView][data_id=3]').attr('src', dbFind.productOtherImageUrl3)
                $('[id=productImageView][data_id=4]').attr('src', dbFind.productOtherImageUrl4)
                $('[id=productImageView][data_id=5]').attr('src', dbFind.productOtherImageUrl5)
                $('[id=productImageView][data_id=6]').attr('src', dbFind.productOtherImageUrl6)


                //! Diğer Resimler Gösteriyor
                if (dbFind.productOtherImageUrl1) { $('[id=productImageViewList][data_id=1]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl2) { $('[id=productImageViewList][data_id=2]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl3) { $('[id=productImageViewList][data_id=3]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl4) { $('[id=productImageViewList][data_id=4]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl5) { $('[id=productImageViewList][data_id=5]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl6) { $('[id=productImageViewList][data_id=6]').css('display', 'flex'); }

                //! Cancel Gösteriyor
                //if (dbFind.productOtherImageUrl1) { $('[id=productImageViewCancel][data_id=1]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl2) { $('[id=productImageViewCancel][data_id=2]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl3) { $('[id=productImageViewCancel][data_id=3]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl4) { $('[id=productImageViewCancel][data_id=4]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl5) { $('[id=productImageViewCancel][data_id=5]').css('display', 'flex'); }
                if (dbFind.productOtherImageUrl6) { $('[id=productImageViewCancel][data_id=6]').css('display', 'flex'); }




                //! Açıklama
                $('#description').html(dbFind.description);


                //! Önizleme

                //! avatar_img
                $('#productViewImage').attr('src', dbFind.productImageUrl)

                //! other_img
                $('[id=productReImageView][data_id=1]').attr('src', dbFind.productOtherImageUrl1)
                $('[id=productReImageView][data_id=2]').attr('src', dbFind.productOtherImageUrl2)
                $('[id=productReImageView][data_id=3]').attr('src', dbFind.productOtherImageUrl3)
                $('[id=productReImageView][data_id=4]').attr('src', dbFind.productOtherImageUrl4)
                $('[id=productReImageView][data_id=5]').attr('src', dbFind.productOtherImageUrl5)
                $('[id=productReImageView][data_id=6]').attr('src', dbFind.productOtherImageUrl6)


                //! Ürün
                $('#preview_img_productName').html(dbFind.productName);
                $('#preview_img_productCode').html(dbFind.productCode);
                $('#preview_img_categoryTitle').html(dbFind.categoryTitle);
                $('#preview_img_brandTitle').html(dbFind.brandTitle);

                $('#preview_img_productStock').html(dbFind.productStock);
                $('#preview_img_productStockTitle').html(dbFind.productStockTitle);
                $('#preview_img_productPrice_productPriceType').html(dbFind.productPrice+" "+dbFind.productPriceType);
                $('#preview_description').html(dbFind.description);

            }

            //! Return
            //console.log("productInfoListJson:", productInfoListJson);
            //console.log("dbFind:", dbFind);
            //console.log("temp_id:", temp_id);

        } catch (error) {
            //console.log("error:", error);
        }

    }

    init();
    //! Başlangıc Son


    //! Step1
    $('#product_add_step1').click(function (e) {
        e.preventDefault();

        //alert("step1");

        //! GeçisiId
        var temp_id = new Date().getTime();

        //! Token
        var companyToken = $('#user_info').attr("data_companytoken");
        var categoryToken = $('#user_info').attr("data_categorytoken");
        var categoryTitle = $('#user_info').attr("data_categoryTitle");



        //! Marka
        var brandId = document.getElementById("brandTitle").value;
        var brandTitle = $('#brandTitle option[value="' + brandId + '"]').html();
        var brandToken = $('#brandTitle option[value="' + brandId + '"]').attr('data-token');

        //! Ürün Kodları
        var productName = $('#productName').val();
        var productCode = $('#productCode').val();

        //! Ürün Stok
        var productStockTitleId = document.getElementById("productStockTitle").value;
        var productStockTitle = $('#productStockTitle option[value="' + productStockTitleId + '"]').html();
        var productStock = $('#productStock').val();

        //! Ürün Fiyat
        var priceTypeId = document.getElementById("productPriceType").value;
        var productPriceType = $('#productPriceType option[value="' + priceTypeId + '"]').html();
        var productPrice = $('#productPrice').val();

        //! Ürün Açıklaması
        var description = document.getElementById('description').value;


        if (brandId == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Ürün Markası Seçilmedi'
            })
        }
        else {

            //! Geçisi id var mı
            if ($('#product_info').attr('data-temp_id')) {
                //alert("product var");

                //! Veri Bul
                var temp_id = $('#product_info').attr('data-temp_id');
                var productInfoListJson = JSON.parse(localStorage.getItem('productInfoList')); //! Veri Çekme

                //! Arama
                var dbFind = productInfoListJson.find(a => a.product_id == Number(temp_id));

                //! Arama
                if (dbFind) {

                    //! dbFind
                    dbFind["categoryToken"] = categoryToken;
                    dbFind["companyToken"] = companyToken;
                    dbFind["brandToken"] = brandToken;

                    dbFind["productName"] = productName;
                    dbFind["productCode"] = productCode;
                    dbFind["productStockTitle"] = productStockTitle;
                    dbFind["productStock"] = productStock;

                    dbFind["productPriceType"] = productPriceType;
                    dbFind["productPrice"] = productPrice;
                    dbFind["productPrice"] = productPrice;

                    dbFind["description"] = description;

                    dbFind["productImageUrl"] = null;
                    dbFind["productOtherImageUrl1"] = null;
                    dbFind["productOtherImageUrl2"] = null;
                    dbFind["productOtherImageUrl3"] = null;
                    dbFind["productOtherImageUrl4"] = null;
                    dbFind["productOtherImageUrl5"] = null;
                    dbFind["productOtherImageUrl6"] = null;


                    //! Local Güncelleme
                    localStorage.setItem('productInfoList', JSON.stringify(productInfoListJson));

                    //! Site Yönlendirme
                    var productAdd_step2 = "/product/add/step2?temp_id=" + temp_id;
                    window.location.href = productAdd_step2;
                }
                else {

                    Swal.fire({
                        icon: 'error',
                       text: 'Ürün Bilgileri Girilmedi'
                    })

                }

            }
            else {

                //alert("dosya yok");

                //! ProductList
                var productInfoList = {
                    product_id: temp_id,
                    product_status: "add",
                    companyToken: companyToken,
                    categoryToken: categoryToken,
                    categoryTitle: categoryTitle,
                    brandToken: brandToken,
                    brandTitle: brandTitle,
                    productName: productName,
                    productCode: productCode,
                    productStockTitle: productStockTitle,
                    productStock: productStock,
                    productPriceType: productPriceType,
                    productPrice: productPrice,
                    description: description
                }; //! ProductList Son



                //! Local
                var productInfoListJson = JSON.parse(localStorage.getItem('productInfoList')); //! Veri Çekme

                //! Yoksa
                if (!productInfoListJson) { productInfoListJson = []; }

                //! Verileri EKliyor
                productInfoListJson.push(productInfoList);


                //! Local Güncelleme
                localStorage.setItem('productInfoList', JSON.stringify(productInfoListJson));

                //! Site Yönlendirme
                var productAdd_step2 = "/product/add/step2?temp_id=" + temp_id;
                window.location.href = productAdd_step2;
            }
        }

    });  //! Step1 Son



    //! Dosya Yükleme Main Product
    $("#uploadForm_mainProduct").on('submit', function (e) {
        e.preventDefault();

        //alert("tiklama uploadForm_mainProduct");

        //! Form Data verileri
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressBarUser_mainPicture").width(percentComplete + '%');
                        $("#progressBarUser_mainPicture").html(percentComplete + '%');
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
                $("#progressBarUser_mainPicture").width('0%');
                $('#uploadStatus_main_img').html('<img src="../../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatus_main_img').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                //console.log("resp:", resp);

                //! avatar_img
                $('#product_main_img').attr('src', resp.file_path);

                //! Önizleme
                //$('#file_url_view_fileupload').html(resp.file_path);

                //! upload Durum
                $('#uploadStatus_main_img').css('display', 'none');
            }
        }); //! Ajax

    });  //! Dosya Yükleme Main Product Son


    //! Dosya Yükleme Multi Product
    $("#uploadForm_multiProduct").on('submit', function (e) {
        e.preventDefault();

        //alert("tiklama uploadForm_Multi");

        //! Form Data verileri
        var formData = new FormData(this);

        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressBarMulti").width(percentComplete + '%');
                        $("#progressBarMulti").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "/file_upload/multi/control",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#progressBarMulti").width('0%');
                $('#uploadStatusMulti').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                $('#uploadStatusMulti').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                //alert("sonuc");
                //console.log("resp:", resp);

                const files = resp.files;
                const filesCount = resp.files.length;

                $('#ProductCount').attr('data_count', filesCount); //! Dosya Sayısı

                //! Resimleri Gizle
                for (let index = 2; index <= 6 ; index++) {
                    $('[id=productImageViewList][data_id=' + index + ']').css('display', 'none'); //! List Gösteriyor
                    $('[id=productImageView][data_id=' + index + ']').attr('src', null); //! Resim Gizliyor
                    $('[id=productImageView][data_id=' + index + ']').css('display', 'none'); //! Resim Gösteriyor
                    $('[id=productImageViewCancel][data_id=' + index + ']').css('display', 'none'); //! Cancel Gösteriyor
                };   //! Resimleri Gizle Son

                //! Resimleri Göster
                for (var index = 0; index < files.length; index++) {
                    if (index < 5) {
                        var productImageUrl = files[index].file_path;
                        $('[id=productImageViewList][data_id=' + Number(index+2) + ']').css('display', 'flex'); //! List Gösteriyor
                        $('[id=productImageView][data_id=' + Number(index+2) + ']').attr('src', productImageUrl); //! Resim Gösteriyor
                        $('[id=productImageView][data_id=' + Number(index+2) + ']').css('display', 'flex'); //! Resim Gösteriyor
                        $('[id=productImageViewCancel][data_id=' + Number(index+2) + ']').css('display', 'flex'); //! Cancel Gösteriyor
                    }
                }   //! Resimleri Göster Son


                //! Resim 5 dan fazla ise
                if (filesCount > 5) {
                     Swal.fire({
                        icon: 'info',
                       text: 'En fazla 5 tane resim yükleniyor'
                    })
                }


                 //! upload Durum
                $('#uploadStatusMulti').css('display', 'none');

            }
        }); //! Ajax

    });  //! Dosya Yükleme Multi Product Son

     //! Product ImageCancel
    document.querySelectorAll('#productImageViewCancel').forEach(function (i) {
        i.addEventListener('click', function (event) {

            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");

            //! Return
            $('[id=productImageViewList][data_id=' + data_id + ']').css('display', 'none'); //! Cancel Gizliyor
            $('[id=productImageViewCancel][data_id=' + data_id + ']').css('display', 'none'); //! Cancel Gizliyor
            $('[id=productImageView][data_id=' + data_id + ']').attr('src', null); //! Resim Siliyor
            $('[id=productImageView][data_id=' + data_id + ']').css('display', 'none'); //! Resim Gizliyor

        });
    });  //! Product ImageCancel Son

    //! Step2
    $('#product_add_step2').click(function (e) {
        e.preventDefault();
       
        var img_url = $('#product_main_img').attr('src');

        var otherImageCount = $('#ProductCount').attr('data_count'); //! Dosya Sayısı


        //! Veri Bul
        var temp_id = $('#product_info').attr('data-temp_id');
        var productInfoListJson = JSON.parse(localStorage.getItem('productInfoList')); //! Veri Çekme

        //! Arama
        var dbFind = productInfoListJson.find(a => a.product_id == Number(temp_id));

        //! Arama
        if (dbFind) {
            
            //! Güncelle
            dbFind["productImageUrl"] = img_url;
            dbFind["productOtherImageUrl1"] = img_url;

            //! Sayac
            var productCount = 1;

            //! Verileri Alıyor
            for (let index = 1; index <= 6; index++) {
                if (index <= 5) {
                    var productImageUrl = $('[id=productImageView][data_id=' + Number(index + 1) + ']').attr('src');

                    if (productImageUrl) { 
                        dbFind["productOtherImageUrl" + Number(productCount + 1)] = productImageUrl;
                        var productCount = Number(productCount + 1);
                    }
                    
                    if (index+1 != productCount) {
                        dbFind["productOtherImageUrl" + Number(productCount + 1)] = null;
                    }
                    
                }
                
            } //! Verileri Alıyor Son
            
            //! Local Güncelleme
            localStorage.setItem('productInfoList', JSON.stringify(productInfoListJson));

            //! Site Yönlendirme
            var productAdd_step3 = "/product/add/step3?temp_id=" + temp_id;
            window.location.href = productAdd_step3;
        }
        else {

            Swal.fire({
                icon: 'error',
                text: 'Ürün Bilgileri Girilmedi'
            })

        }



    });  //! Step2 Son


    //! Kaydet
    $('#product_add_save').click(function (e) {
        e.preventDefault();

        //alert("product_add_save");

        //! Veri Bul
        var temp_id = $('#product_info').attr('data-temp_id');
        var productInfoListJson = JSON.parse(localStorage.getItem('productInfoList')); //! Veri Çekme

        //! Arama
        var dbFind = productInfoListJson.find(a => a.product_id == Number(temp_id));
        var dbFindIndex = productInfoListJson.findIndex(a => a.product_id == Number(temp_id));

        //! Ajax
        $.ajax({
            url: "/product/add/post",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: dbFind,
            success: function (response) {
                //alert("başarılı");
            console.log("response:", response);
                //console.log("success:", response.status);

                if (response.status == 0) {
                    Swal.fire({
                        icon: 'error',
                       text: 'Ürün Eklenemedi'
                    })
                }
                else {
                    Swal.fire({
                       icon: 'success',
                       text: 'Ürün Eklendi'
                    })


                    //! Veri Siliyor
                    productInfoListJson.splice(dbFindIndex, 1);

                    //! Local Güncelleme
                    localStorage.setItem('productInfoList', JSON.stringify(productInfoListJson));

                    //! Site Yönlendirme
                    window.location.href = "/product/list";
                }
            },
            error: function (error) {
                alert("hatalı");
                console.log("error:", error);
            }
        }); //! Ajax Son


    }); //! Kaydet Son


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
                        url: "/product/delete",
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
                        url: "/product/update/active",
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


    //! Entegrasyon
    $('#btn_product_integration').click(function (e) {
        e.preventDefault();

        //alert("Entegrasyon ürün");

        //! Xml
        var xml_adres = $('#file_url_view_fileupload').html();
        var xml_count = 0;

        //! Token
        var companyToken = $('#user_info').attr("data_companytoken");
        var categoryToken = $('#user_info').attr("data_categorytoken");
        var categoryTitle = $('#user_info').attr("data_categoryTitle");


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //! Dosya Okudu
                var gelen = this.responseText;
                //console.log("gelen:", gelen);

                xmlParse(gelen); //! Foksiyona gönderdi
            }
        };
        xmlhttp.open("GET", xml_adres, true); //! içinden alıyor
        xmlhttp.send();

        //Xml Parçalama
        function xmlParse(xmlGet) {
            var xmlDoc = new DOMParser().parseFromString(xmlGet, "text/xml");
            //console.log("xmlDoc:", xmlDoc);

            //! Ideasoft
            var xIdeasoft = xmlDoc.getElementsByTagName("label");
            var xIdeasoftSayisi = xIdeasoft.length; //! Sayısı
            //console.log("xIdeasoftSayisi:", xIdeasoftSayisi);

            //! Ticimax
            var xTicimax = xmlDoc.getElementsByTagName("UrunKartiID");
            var xTicimaxSayisi = xTicimax.length; //! Sayısı
            //console.log("xTicimaxSayisi:", xTicimaxSayisi);

            if (xIdeasoftSayisi > 0) { xmlParseIdeasoft(xmlDoc); }
            else if (xTicimaxSayisi > 0) { xmlParseTicimax(xmlDoc); }


        } //Xml Parçalama Son

        //! Ideasoft
        function xmlParseIdeasoft(xmlDoc) {
            //alert("ideasoft");

            var siteName = "İdeasoft";

            var x = xmlDoc.getElementsByTagName("label");
            var xSayisi = x.length; //! Sayısı
            console.log("x:", xSayisi);

            let jsonData = [];

            for (i = 0; i < x.length; i++) {
                var supplierProductID = xmlDoc.getElementsByTagName("id")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("id")[i]?.childNodes[0].nodeValue : null;
                var stockCode = xmlDoc.getElementsByTagName("stockCode")[i].childNodes[0].nodeValue;
                var brand = xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue;
                var barcode = xmlDoc.getElementsByTagName("barcode")[i]?.childNodes[0]?.nodeValue;
                var discountedPrice = null;
                var buyPrice = null;
                var salePrice = xmlDoc.getElementsByTagName("price1")[i].childNodes[0].nodeValue;

                var tax = xmlDoc.getElementsByTagName("tax")[i].childNodes[0].nodeValue;
                var priceWithTax = xmlDoc.getElementsByTagName("priceWithTax")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("priceWithTax")[i]?.childNodes[0].nodeValue : null;
                var isTax = null;
                var isStock = xmlDoc.getElementsByTagName("stock")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("stock")[i]?.childNodes[0].nodeValue : null;
                var stock = xmlDoc.getElementsByTagName("stockAmount")[i].childNodes[0].nodeValue;

                var picture1Path = xmlDoc.getElementsByTagName("picture1Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture1Path")[i]?.childNodes[0].nodeValue : null;
                var picture2Path = xmlDoc.getElementsByTagName("picture2Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture2Path")[i]?.childNodes[0].nodeValue : null;
                var picture3Path = xmlDoc.getElementsByTagName("picture3Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture3Path")[i]?.childNodes[0].nodeValue : null;
                var picture4Path = xmlDoc.getElementsByTagName("picture4Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture4Path")[i]?.childNodes[0].nodeValue : null;
                var picture5Path = xmlDoc.getElementsByTagName("picture5Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture5Path")[i]?.childNodes[0].nodeValue : null;
                var picture6Path = xmlDoc.getElementsByTagName("picture6Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture6Path")[i]?.childNodes[0].nodeValue : null;
                var picture7Path = xmlDoc.getElementsByTagName("picture7Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture7Path")[i]?.childNodes[0].nodeValue : null;
                var picture8Path = xmlDoc.getElementsByTagName("picture8Path")[i]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("picture8Path")[i]?.childNodes[0].nodeValue : null;

                var pictureMainP = xmlDoc.getElementsByTagName("picture")[i]?.childNodes[0].nodeValue;
                var pictureMainP1 = xmlDoc.getElementsByTagName("picture1Path")[i]?.childNodes[0].nodeValue;
                var pictureMain = pictureMainP ? pictureMainP : pictureMainP1;

                var productFullDetails = xmlDoc.getElementsByTagName("fullDetails")[i]?.childNodes[0].nodeValue;
                var productDetail = xmlDoc.getElementsByTagName("details")[i]?.childNodes[0].nodeValue;
                var productDetails = productFullDetails ? productFullDetails : productDetail;

                var productName = xmlDoc.getElementsByTagName("label")[i].childNodes[0].nodeValue;

                var supplierStatus = xmlDoc.getElementsByTagName("status")[i].childNodes[0].nodeValue;
                var moneyType = xmlDoc.getElementsByTagName("currencyAbbr")[i].childNodes[0].nodeValue;
                var warranty = xmlDoc.getElementsByTagName("warranty")[i].childNodes[0].nodeValue;

                //console.log("supplierProductID:",supplierProductID);

                //! Datalar
                var data = {
                    siteName: siteName,
                    supplierProductID: supplierProductID,
                    stockCode: stockCode,
                    brand: brand,
                    barcode: barcode,
                    discountedPrice: discountedPrice,
                    buyPrice: buyPrice,
                    salePrice: salePrice,
                    tax: tax,
                    priceWithTax: priceWithTax,
                    isTax: isTax,
                    isStock: isStock,
                    stock: stock,
                    picture1Path: picture1Path,
                    picture2Path: picture2Path,
                    picture3Path: picture3Path,
                    picture4Path: picture4Path,
                    picture5Path: picture5Path,
                    picture6Path: picture6Path,
                    picture7Path: picture7Path,
                    picture8Path: picture8Path,
                    pictureMain: pictureMain,
                    productDetails: productDetails,
                    productName: productName,
                    supplierStatus: supplierStatus,
                    moneyType: moneyType,
                    warranty: warranty,
                };

                //ajaxPost(data); //! Api Post

                jsonData.push(data);
            }

            ajaxPost(jsonData); //! Api Post

            //console.log(jsonData);
        }  //! Ideasoft Son

        //! Ticimax
        function xmlParseTicimax(xmlDoc) {
            //alert("Ticimax");

            var siteName = "Ticimax";
            var companyid = 1;
            var categoryId = 0;

            var x = xmlDoc.getElementsByTagName("UrunKartiID");
            var xSayisi = x.length; //! Sayısı
            //console.log("x:", xSayisi);

            let jsonData = [];

            for (i = 0; i < x.length; i++) {
                var supplierProductID = xmlDoc.getElementsByTagName("UrunKartiID")[i].childNodes[0].nodeValue;
                var stockCode = xmlDoc.getElementsByTagName("StokKodu")[i].childNodes[0].nodeValue;
                var brand = xmlDoc.getElementsByTagName("Marka")[i].childNodes[0].nodeValue;
                var barcode = xmlDoc.getElementsByTagName("Barkod")[i]?.childNodes[0]?.nodeValue ? xmlDoc.getElementsByTagName("Barkod")[i]?.childNodes[0]?.nodeValue : null;

                var discountedPrice = xmlDoc.getElementsByTagName("IndirimliFiyat")[i].childNodes[0].nodeValue;
                var buyPrice = xmlDoc.getElementsByTagName("AlisFiyati")[i].childNodes[0].nodeValue;
                var salePrice = xmlDoc.getElementsByTagName("SatisFiyati")[i].childNodes[0].nodeValue;
                var tax = xmlDoc.getElementsByTagName("KdvOrani")[i].childNodes[0].nodeValue;
                var priceWithTax = null;
                var isTax = xmlDoc.getElementsByTagName("KDVDahil")[i].childNodes[0].nodeValue;

                var isStock = null;
                var stock = xmlDoc.getElementsByTagName("StokAdedi")[i].childNodes[0].nodeValue;

                var picture1Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[0]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[0]?.childNodes[0].nodeValue : null;
                var picture2Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[1]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[1]?.childNodes[0].nodeValue : null;
                var picture3Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[2]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[2]?.childNodes[0].nodeValue : null;
                var picture4Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[3]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[3]?.childNodes[0].nodeValue : null;
                var picture5Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[4]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[4]?.childNodes[0].nodeValue : null;
                var picture6Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[5]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[5]?.childNodes[0].nodeValue : null;
                var picture7Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[6]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[6]?.childNodes[0].nodeValue : null;
                var picture8Path = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[7]?.childNodes[0].nodeValue ? xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[7]?.childNodes[0].nodeValue : null;
                var pictureMain = xmlDoc.getElementsByTagName("Resimler")[i].getElementsByTagName("Resim")[0]?.childNodes[0].nodeValue;

                var productDetails = xmlDoc.getElementsByTagName("Aciklama")[i].childNodes[0].nodeValue;
                var productName = xmlDoc.getElementsByTagName("UrunAdi")[i].childNodes[0].nodeValue;
                var supplierStatus = null;
                var moneyType = xmlDoc.getElementsByTagName("ParaBirimi")[i].childNodes[0].nodeValue;
                var warranty = null;

                //console.log("moneyType: ",moneyType);

                //! Datalar
                var data = {
                    siteName: siteName,
                    companyid: companyid,
                    supplierProductID: supplierProductID,
                    categoryId: categoryId,
                    stockCode: stockCode,
                    brand: brand,
                    barcode: barcode,
                    discountedPrice: discountedPrice,
                    buyPrice: buyPrice,
                    salePrice: salePrice,
                    tax: tax,
                    priceWithTax: priceWithTax,
                    isTax: isTax,
                    isStock: isStock,
                    stock: stock,
                    picture1Path: picture1Path,
                    picture2Path: picture2Path,
                    picture3Path: picture3Path,
                    picture4Path: picture4Path,
                    picture5Path: picture5Path,
                    picture6Path: picture6Path,
                    picture7Path: picture7Path,
                    picture8Path: picture8Path,
                    pictureMain: pictureMain,
                    productDetails: productDetails,
                    productName: productName,
                    supplierStatus: supplierStatus,
                    moneyType: moneyType,
                    warranty: warranty,
                }; //! Data Son



                //! ProductList
                var productInfoList = {
                    companyToken: companyToken,
                    categoryToken: categoryToken,
                    brandToken: "brandToken",
                    productImageUrl: pictureMain,
                    productName: productName,
                    productCode: stockCode,
                    productPrice: buyPrice,
                    productDiscountPrice: discountedPrice,
                    productBasketPrice: salePrice,
                    productPriceType: moneyType,
                    productStock: stock,
                    productStockTitle: "productStockTitle",
                    description: productDetails

                }; //! ProductList Son

                jsonData.push(data);
            }

            ajaxPost(jsonData);

            //console.log(jsonData);
        } //! Ticimax Son

        //! Ajax
        function ajaxPost(jsonData) {

            //console.log("jsonData:", jsonData);

            //! Gösteriyor
            $('#progressBarIntegrationVal').css('display', 'flex');

            //! Veri
            var jsonLength = jsonData.length;
            var temp_count = Number(jsonData.length) / 10;
            var temp_count_last = Number(jsonData.length) % 10;

            for (let index = 0; index < temp_count; index++) {

                //! Tanımlar
                var temp = [];
                var first = index * 10;
                var total = Number(index + 1) * 10;
                //console.log("first:", first, " total:", total);

                //! Verileri Alıyor
                for (let indx = first; indx < total; indx++) {
                    if (jsonData[indx]) { temp[indx - first] = jsonData[indx]; }
                } //! Verileri Alıyor Son


                //! Ajax
                $.ajax({
                    url: "/product/add/post/multi",
                    method: "post",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        addDataList:temp
                    },
                    success: function (response) {
                        //alert("başarılı");
                        //console.log("response:", response);
                        //console.log("success:", response.status);

                        var percentComplete = 100;
                        $("#progressBarIntegration").width(percentComplete + '%');
                        $("#progressBarIntegration").html(percentComplete + '%');
                        $('#progressBarIntegrationVal').html(jsonLength + "/" + total);



                        if (response.status == 0) {
                            // Swal.fire({
                            //     icon: 'error',
                            //     title: 'Oops...',
                            //     text: 'Ürün Eklenemedi'
                            // })
                        }
                        else {

                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'Oops...',
                            //     text: 'Ürün Eklendi'
                            // })


                            //! Site Yönlendirme
                            // window.location.href = "/product/list";
                        }
                    },
                    error: function (error) {
                        //alert("hatalı");
                        //console.log("error:", error);
                    }
                }); //! Ajax Son


                //console.log("temp:", temp);
                //console.log("jsonLength:", jsonLength);
                //console.log(jsonLength + "/" + total);
            }


            Swal.fire({
                icon: 'success',
                text: 'Ürün Eklendi'
            })

        } //! Ajax Son


    });  //! Entegrasyon Son


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


    //! Modal  Açma
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {

            //! Attr - Diğer Veri Alma
            //var data_id = event.target.getAttribute("data_id");
            //var data_token = event.target.getAttribute("data_token");
            var data_img = event.target.getAttribute("src");
            //var data_name = event.target.getAttribute("data_name");

            //! Yazma
            //$('#brand_name_update').val(data_name);
            //$('#brand_name_update').attr("data_token",data_token);

            //! Resim
            $('#productViewImage').attr('src', data_img);

            //! Return
            // console.log("data_id:", data_id);
            // console.log("data_token:", data_token);
            // //console.log("data_name:", data_name);
            // console.log("src:",data_img );





        });
    });  //! Modal  Açma Son

    //! Step1 Güncelleme
    $('#product_update_step1').click(function (e) {
        e.preventDefault();

        //alert("product_update_step1");

        //! product_id
        var data_id = $('#product_info').attr("data_id");
        var data_token = $('#product_info').attr("data_token");

         //! Token
        var companyToken = $('#user_info').attr("data_companytoken");
        var categoryToken = $('#user_info').attr("data_categorytoken");
        var categoryTitle = $('#user_info').attr("data_categoryTitle");

        //! Marka
        var brandId = document.getElementById("brandTitle").value;
        var brandTitle = $('#brandTitle option[value="' + brandId + '"]').html();
        var brandToken = $('#brandTitle option[value="' + brandId + '"]').attr('data-token');

        //! Ürün Kodları
        var productName = $('#productName').val();
        var productCode = $('#productCode').val();

        //! Ürün Stok
        var productStockTitleId = document.getElementById("productStockTitle").value;
        var productStockTitle = $('#productStockTitle option[value="' + productStockTitleId + '"]').html();
        var productStock = $('#productStock').val();

        //! Ürün Fiyat
        var priceTypeId = document.getElementById("productPriceType").value;
        var productPriceType = $('#productPriceType option[value="' + priceTypeId + '"]').html();
        var productPrice = $('#productPrice').val();

        //! Ürün Açıklaması
        var description = document.getElementById('description').value;


        if (brandId == 0) {
            Swal.fire({
                icon: 'error',
                text: 'Ürün Markası Seçilmedi'
            })
        }
        else {

            //! Ajax
            $.ajax({
                url: "/product/update/step1",
                method: "post",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    id: data_id,
                    companyToken: companyToken,
                    categoryToken: categoryToken,
                    brandTitle: brandTitle,
                    brandToken: brandToken,
                    productName: productName,
                    productCode: productCode,
                    productPrice: productPrice,
                    productPriceType: productPriceType,
                    productStock: productStock,
                    productStockTitle: productStockTitle,
                    description: description,
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
                        });


                         //Veri Gönderme
                        const jsonVeri = JSON.stringify({
                            isSocketToken: false,
                            toSocketToken: null,
                            isServerToken: false,
                            toServerToken: null,
                            isPrivateMessageUserId: false,
                            toPrivateMessageUserId: null,
                            data:data_token,
                            dataType: "Product",
                            dataTypeTitle: "product_update",
                            dataTypeDescription: "Ürün Güncellendi",
                            dataTypeDescription_EN: "Product has been updated.",
                            status: "success"
                        });

                        socket.send(jsonVeri);
                        //Veri Gönderme Son

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

    });  //! Step1 Güncelleme Son


    //! Dosya Yükleme
    $("#uploadForm_productImage").on('submit', function (e) {
        e.preventDefault();

        //alert("tiklama uploadForm_productImage");

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
                $('#productImageUrl').attr('src', resp.file_path);

                //! Önizleme
                //$('#file_url_view_fileupload').html(resp.file_path);

                //! upload Durum
                $('#uploadStatus').css('display', 'none');
            }
        }); //! Ajax

    });  //! Dosya Yükleme Son

    //! Step2 Güncelleme
    $('#product_update_step2').click(function (e) {
        e.preventDefault();

        //alert("product_update_step2");

        //! product_id
        var data_id = $('#product_info').attr("data_id");
        var data_token = $('#product_info').attr("data_token");

        //! MainImage
        var productImageUrl = $('#productImageUrl').attr("src");
        
        
        //! Tanım
        var productList = [];

        //! Verileri Alıyor
        for (let index = 1; index <= 6; index++) {
            if (index <= 5) {
                var productImageUrlOther = $('[id=productImageView][data_id=' + Number(index + 1) + ']').attr('src');

                if (productImageUrlOther) {  productList.push(productImageUrlOther); }
                
            }
            
        } //! Verileri Alıyor Son
        
        
        //! Ajax
        $.ajax({
            url: "/product/update/step2",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: data_id,
                productImageUrl: productImageUrl,
                productOtherImageUrl1: productImageUrl,
                productOtherImageUrl2: productList[0],
                productOtherImageUrl3: productList[1],
                productOtherImageUrl4: productList[2],
                productOtherImageUrl5: productList[3],
                productOtherImageUrl6: productList[4],

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
                    });

                    //Veri Gönderme
                    const jsonVeri = JSON.stringify({
                        isSocketToken: false,
                        toSocketToken: null,
                        isServerToken: false,
                        toServerToken: null,
                        isPrivateMessageUserId: false,
                        toPrivateMessageUserId: null,
                        data: data_token,
                        dataType: "Product",
                        dataTypeTitle: "product_update",
                        dataTypeDescription: "Ürün Güncellendi",
                        dataTypeDescription_EN: "Product has been updated.",
                        status: "success"
                    });

                    socket.send(jsonVeri);
                    //Veri Gönderme Son

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



    });  //! Step2 Güncelleme Son


    //! Ürün Resimleri Bul
    document.querySelectorAll('.product_preview').forEach(function (i) {
        i.addEventListener('click', function (event) {

            //! Attr - Diğer Veri Alma
            var data_img = event.target.getAttribute("src");

            //! Resim
            $('#productViewImage').attr('src', data_img);

            //! Return
            console.log("product_main_img:", data_img);




        });
    }); //! Ürün Resimleri Bul Son


    // Yazı yazma
    var text_max=255;
    $('#maxSonuc').html('Max: '+text_max+' karakter:!');

    $('#description').keyup(function(){
        var text_uzunluk=$('#description').val().length;
        var kalan_max=text_max-text_uzunluk;

        $('#maxSonuc').html('Max: '+kalan_max+' karakter:!');

    });
    // Yazı yazma Son

});