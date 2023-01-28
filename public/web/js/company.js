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
                        url: "/company/update/active",
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
    
    //! Evrak Listesi
    document.querySelectorAll('.modal_doc').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //! Attr - Diğer Veri Alma
            //var data_id = event.target.getAttribute("data-id");
            var data_token = event.target.getAttribute("data_token");
            
            //! Belgeler
            var data_personalIdentityPhotoFileUrl = event.target.getAttribute("data_personalIdentityPhotoFileUrl"); //! Kimlik Fotokopisi
            var data_personalIdentityPhotoFileCheck = event.target.getAttribute("data_personalIdentityPhotoFileCheck");
            
            var data_taxSheetFileUrl = event.target.getAttribute("data_taxSheetFileUrl"); //! Vergi Levhası
            var data_taxSheetCheck = event.target.getAttribute("data_taxSheetCheck"); //! Vergi Levhası Check
            
            var data_tradeRegistryGazetteFileUrl = event.target.getAttribute("data_tradeRegistryGazetteFileUrl"); //! Ticaret Sicil Gazetesi
            var data_tradeRegistryGazetteCheck = event.target.getAttribute("data_tradeRegistryGazetteCheck"); //! Ticaret Sicil Gazetesi
            
             var data_circularOfSignatureFileUrl = event.target.getAttribute("data_circularOfSignatureFileUrl"); //! İmza Sirküsü
            var data_circularOfSignatureFileCheck = event.target.getAttribute("data_circularOfSignatureFileCheck");  
            
            var data_chamberOfCommerceRegistrationFileUrl = event.target.getAttribute("data_chamberOfCommerceRegistrationFileUrl"); //! Oda Sicil Kaydı
            var data_chamberOfCommerceRegistrationCheck = event.target.getAttribute("data_chamberOfCommerceRegistrationCheck"); //! Oda Sicil Kaydı
            
            var data_serviceContractFileUrl = event.target.getAttribute("data_serviceContractFileUrl"); //! Hizmet Sözleşmesi
            var data_serviceContractCheck = event.target.getAttribute("data_serviceContractCheck"); //! Hizmet Sözleşmesi
          
            //! Return
            $('#companyToken').attr("data_token", data_token); //! Token
            
            var personalIdentityPhotoFileUrl_Split = data_personalIdentityPhotoFileUrl.split('/'); 
            var personalIdentityPhotoFileUrl_Name = personalIdentityPhotoFileUrl_Split[personalIdentityPhotoFileUrl_Split.length-1];
            $('#personalIdentityPhotoFileUrl').attr("href", data_personalIdentityPhotoFileUrl);
            $('#personalIdentityPhotoFileUrl').attr("download", "Kimlik Fotokopisi_"+personalIdentityPhotoFileUrl_Name);
            $('#personalIdentityPhotoFileUrl').attr("title", "Kimlik Fotokopisi_" + personalIdentityPhotoFileUrl_Name);
            data_personalIdentityPhotoFileUrl ? $('#personalIdentityPhotoFileUrl').css("display","block") : $('#personalIdentityPhotoFileUrl').css("display", "none"); //! Dosya var
            data_personalIdentityPhotoFileUrl ? $('#personalIdentityPhotoFileUrlVisiblity').css("display","none") : $('#personalIdentityPhotoFileUrlVisiblity').css("display", "block"); //! Dosya Yok
            
            var taxSheetFileUrl_Split = data_taxSheetFileUrl.split('/');
            var taxSheetFileUrl_Name = taxSheetFileUrl_Split[taxSheetFileUrl_Split.length-1];
            $('#taxSheetFileUrl').attr("href", data_taxSheetFileUrl);
            $('#taxSheetFileUrl').attr("download", "Vergi Levhası_"+taxSheetFileUrl_Name);
            $('#taxSheetFileUrl').attr("title", "Vergi Levhası_" + taxSheetFileUrl_Name);
            data_taxSheetFileUrl ? $('#taxSheetFileUrl').css("display","block") : $('#taxSheetFileUrl').css("display", "none"); //! Dosya var
            data_taxSheetFileUrl ? $('#taxSheetFileUrlVisiblity').css("display","none") : $('#taxSheetFileUrlVisiblity').css("display", "block"); //! Dosya Yok
            
            var tradeRegistryGazetteFileUrl_Split = data_tradeRegistryGazetteFileUrl.split('/');
            var tradeRegistryGazetteFileUrl_Name = tradeRegistryGazetteFileUrl_Split[tradeRegistryGazetteFileUrl_Split.length-1];
            $('#tradeRegistryGazetteFileUrl').attr("href", data_tradeRegistryGazetteFileUrl);
            $('#tradeRegistryGazetteFileUrl').attr("download", "Ticaret Sicil Kaydı_"+tradeRegistryGazetteFileUrl_Name);
            $('#tradeRegistryGazetteFileUrl').attr("title", "Ticaret Sicil Kaydı_" + tradeRegistryGazetteFileUrl_Name);
            data_tradeRegistryGazetteFileUrl ? $('#tradeRegistryGazetteFileUrl').css("display","block") : $('#tradeRegistryGazetteFileUrl').css("display", "none"); //! Dosya var
            data_tradeRegistryGazetteFileUrl ? $('#tradeRegistryGazetteFileUrlVisiblity').css("display","none") : $('#tradeRegistryGazetteFileUrlVisiblity').css("display", "block"); //! Dosya Yok
            
            var circularOfSignatureFileUr_Split = data_circularOfSignatureFileUrl.split('/');
            var circularOfSignatureFileUr_Name = circularOfSignatureFileUr_Split[circularOfSignatureFileUr_Split.length-1];
            $('#circularOfSignatureFileUrl').attr("href", data_circularOfSignatureFileUrl);
            $('#circularOfSignatureFileUrl').attr("download", "İmza Sirküsü_"+circularOfSignatureFileUr_Name);
            $('#circularOfSignatureFileUrl').attr("title", "İmza Sirküsü_" + circularOfSignatureFileUr_Name);
            data_circularOfSignatureFileUrl ? $('#circularOfSignatureFileUrl').css("display","block") : $('#circularOfSignatureFileUrl').css("display", "none"); //! Dosya var
            data_circularOfSignatureFileUrl ? $('#circularOfSignatureFileUrlVisiblity').css("display","none") : $('#circularOfSignatureFileUrlVisiblity').css("display", "block"); //! Dosya Yok
            
            var chamberOfCommerceRegistrationFileUrl_Split = data_chamberOfCommerceRegistrationFileUrl.split('/');
            var chamberOfCommerceRegistrationFileUrl_Split_Name = chamberOfCommerceRegistrationFileUrl_Split[chamberOfCommerceRegistrationFileUrl_Split.length-1];
            $('#chamberOfCommerceRegistrationFileUrl').attr("href", data_chamberOfCommerceRegistrationFileUrl);
            $('#chamberOfCommerceRegistrationFileUrl').attr("download", "Oda Ticaret Kaydı_"+chamberOfCommerceRegistrationFileUrl_Split_Name);
            $('#chamberOfCommerceRegistrationFileUrl').attr("title", "Oda Ticaret Kaydı_" + chamberOfCommerceRegistrationFileUrl_Split_Name);
            data_chamberOfCommerceRegistrationFileUrl ? $('#chamberOfCommerceRegistrationFileUrl').css("display","block") : $('#chamberOfCommerceRegistrationFileUrl').css("display", "none"); //! Dosya var
            data_chamberOfCommerceRegistrationFileUrl ? $('#chamberOfCommerceRegistrationFileUrlVisiblity').css("display","none") : $('#chamberOfCommerceRegistrationFileUrlVisiblity').css("display", "block"); //! Dosya Yok
            
            var serviceContractFileUrl_Split = data_serviceContractFileUrl.split('/');
            var serviceContractFileUrl_Split_Name = serviceContractFileUrl_Split[serviceContractFileUrl_Split.length-1];
            $('#serviceContractFileUrl').attr("href", data_serviceContractFileUrl);
            $('#serviceContractFileUrl').attr("download", "Hizmet Sözleşmesi_"+serviceContractFileUrl_Split_Name);
            $('#serviceContractFileUrl').attr("title", "Hizmet Sözleşmesi_" + serviceContractFileUrl_Split_Name);
            data_serviceContractFileUrl ? $('#serviceContractFileUrl').css("display","block") : $('#serviceContractFileUrl').css("display", "none"); //! Dosya var
            data_serviceContractFileUrl ? $('#serviceContractFileUrlVisiblity').css("display","none") : $('#serviceContractFileUrlVisiblity').css("display", "block"); //! Dosya Yok
            
           
             
            // console.log("data_serviceContractCheck:", data_serviceContractCheck);
            
            
            //! Check Seçme
            
            //! data_personalIdentityPhotoFileCheck
            if (data_personalIdentityPhotoFileCheck == "token6") {
               $("#personalIdentityPhotoFileUrlSwitchClass").addClass('is-active');
               $("#personalIdentityPhotoFileUrlSwitch").attr("checked", true);
            }
            else if (data_personalIdentityPhotoFileCheck == "token5") {
               $("#personalIdentityPhotoFileUrlSwitchClass").removeClass('is-active');
               $("#personalIdentityPhotoFileUrlSwitch").attr("checked", false);
            } //! data_personalIdentityPhotoFileCheck Son
            
                        
            //! data_taxSheetCheck
            if (data_taxSheetCheck == "token6") {
               $("#taxSheetFileUrlSwitchClass").addClass('is-active');
               $("#taxSheetFileUrlSwitch").attr("checked", true);
            }
            else if (data_taxSheetCheck == "token5") {
               $("#taxSheetFileUrlSwitchClass").removeClass('is-active');
               $("#taxSheetFileUrlSwitch").attr("checked", false);
            } //! data_taxSheetCheck Son
                                    
            //! data_circularOfSignatureFileCheck
            if (data_circularOfSignatureFileCheck == "token6") {
               $("#circularOfSignatureFileUrlSwitchClass").addClass('is-active');
               $("#circularOfSignatureFileUrlSwitch").attr("checked", true);
            }
            else if (data_circularOfSignatureFileCheck == "token5") {
               $("#circularOfSignatureFileUrlSwitchClass").removeClass('is-active');
               $("#circularOfSignatureFileUrlSwitch").attr("checked", false);
            } //! data_circularOfSignatureFileCheck Son            
                                                
            //! data_tradeRegistryGazetteCheck
            if (data_tradeRegistryGazetteCheck == "token6") {
               $("#tradeRegistryGazetteFileUrlSwitchClass").addClass('is-active');
               $("#tradeRegistryGazetteFileUrlSwitch").attr("checked", true);
            }
            else if (data_tradeRegistryGazetteCheck == "token5") {
               $("#tradeRegistryGazetteFileUrlSwitchClass").removeClass('is-active');
               $("#tradeRegistryGazetteFileUrlSwitch").attr("checked", false);
            } //! data_tradeRegistryGazetteCheck Son
                                                            
            //! data_chamberOfCommerceRegistrationCheck
            if (data_chamberOfCommerceRegistrationCheck == "token6") {
               $("#chamberOfCommerceRegistrationFileUrlSwitchClass").addClass('is-active');
               $("#chamberOfCommerceRegistrationFileUrlSwitch").attr("checked", true);
            }
            else if (data_chamberOfCommerceRegistrationCheck == "token6") {
               $("#chamberOfCommerceRegistrationFileUrlSwitchClass").removeClass('is-active');
               $("#chamberOfCommerceRegistrationFileUrlSwitch").attr("checked", false);
            } //! data_chamberOfCommerceRegistrationCheck Son
                          
           
            //! data_serviceContractCheck
            if (data_serviceContractCheck == "token6") {
               $("#serviceContractFileUrlSwitchClass").addClass('is-active');
               $("#serviceContractFileUrlSwitch").attr("checked", true);
            }
            else if (data_serviceContractCheck == "token5") {
               $("#serviceContractFileUrlSwitchClass").removeClass('is-active');
               $("#serviceContractFileUrlSwitch").attr("checked", false);
            } //! data_serviceContractCheck Son
            
           
        
        });
    });  //! Evrak Listesi Son
    
    //! Evrak güncelleme
    $('#companyUpdate').click(function (e) {
        e.preventDefault();
        
        //alert("companyUpdate");
        
        var data_token = $('#companyToken').attr('data_token');
        
        var personalIdentityPhotoFileUrlSwitch = $('#personalIdentityPhotoFileUrl').css('display') == "block" ?  $('#personalIdentityPhotoFileUrlSwitch').attr('checked') ? true : false : null;
        var taxSheetFileUrlSwitch = $('#taxSheetFileUrl').css('display') == "block" ?  $('#taxSheetFileUrlSwitch').attr('checked') ? true : false : null;
        var circularOfSignatureFileUrlSwitch = $('#circularOfSignatureFileUrl').css('display') == "block" ? $('#circularOfSignatureFileUrlSwitch').attr('checked') ? true : false : null;
        var tradeRegistryGazetteFileUrlSwitch = $('#tradeRegistryGazetteFileUrl').css('display') == "block" ? $('#tradeRegistryGazetteFileUrlSwitch').attr('checked') ? true : false : null;
        var chamberOfCommerceRegistrationFileUrlSwitch =$('#chamberOfCommerceRegistrationFileUrl').css('display') == "block" ? $('#chamberOfCommerceRegistrationFileUrlSwitch').attr('checked') ? true : false : null;
        var serviceContractFileUrlSwitch = $('#serviceContractFileUrl').css('display') == "block" ? $('#serviceContractFileUrlSwitch').attr('checked') ? true : false : null;
        
        
        //! Ajax         
        $.ajax({
            url: "/company/update",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                personalIdentityPhotoFileUrlSwitch: personalIdentityPhotoFileUrlSwitch,
                taxSheetFileUrlSwitch: taxSheetFileUrlSwitch,
                circularOfSignatureFileUrlSwitch: circularOfSignatureFileUrlSwitch,
                tradeRegistryGazetteFileUrlSwitch: tradeRegistryGazetteFileUrlSwitch,
                chamberOfCommerceRegistrationFileUrlSwitch: chamberOfCommerceRegistrationFileUrlSwitch,
                serviceContractFileUrlSwitch: serviceContractFileUrlSwitch,
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
        }); //! Ajax Son
            
                
    });  //! Evrak güncelleme son
    
    
    //! Firma Bilgileri        
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_token = event.target.getAttribute("data_token");
            var data_titleofcompany = event.target.getAttribute("data_titleofcompany");
            var data_companyAddress = event.target.getAttribute("data_companyAddress");
            
            var data_phoneNumber = event.target.getAttribute("data_phoneNumber");
            var data_emailAddress = event.target.getAttribute("data_emailAddress");
            var data_webAddress = event.target.getAttribute("data_webAddress");
            
            var data_taxAdministration = event.target.getAttribute("data_taxAdministration");
            var data_taxNo = event.target.getAttribute("data_taxNo");
            var data_mersisNo = event.target.getAttribute("data_mersisNo");
            
            var data_paymentDate = event.target.getAttribute("data_paymentDate");
           
            //! Return Html
            $('#company_idRole').attr('data_token', data_token);
            
            $('#companyid').html("#"+data_id);
            $('#titleofcompany').html(data_titleofcompany);
            $('#companyAddress').html(data_companyAddress);
            
            $('#phoneNumber').html(data_phoneNumber);
            $('#emailAddress').html(data_emailAddress);
            $('#webAddress').html(data_webAddress);
            
            $('#taxAdministration_no').html(data_taxAdministration + " / " + data_taxNo);
            $('#mersisNo').html(data_mersisNo);
            
            $('#editPaymentDate').val(data_paymentDate);
            
            //! Return Console
            console.log("data_id:", data_id);
            console.log("data_token:", data_token);
            console.log("data_paymentDate:", data_paymentDate);
        
        });
    });  //! Firma Bilgileri Son
    
        
    //! Banka Bilgileri        
    document.querySelectorAll('.modal_bank').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //alert("banka");
            
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_bankStatus = event.target.getAttribute("data_bankStatus");
            var data_bankTitle = event.target.getAttribute("data_bankTitle");
            var data_bankAccountTitle = event.target.getAttribute("data_bankAccountTitle");
            var data_branch = event.target.getAttribute("data_branch");
            
            var data_nameSurname = event.target.getAttribute("data_nameSurname");
            var data_accountNumber = event.target.getAttribute("data_accountNumber");
            var data_ibanNo = event.target.getAttribute("data_ibanNo");
            
            if (data_bankStatus) { $('#bankModalSuccess').css('display', 'block'); $('#bankModalError').css('display', 'none');  }
            else if (!data_bankStatus) { $('#bankModalSuccess').css('display', 'none'); $('#bankModalError').css('display', 'block');  }

            $('#bankTitle').html(data_bankTitle);
            $('#bankAccountTitle').html(data_bankAccountTitle);
            $('#branch').html(data_branch);
            
            $('#nameSurname').html(data_nameSurname);
            $('#accountNumber').html(data_accountNumber);
            $('#ibanNo').html(data_ibanNo);
        
        });
    });  //! Banka Bilgileri Son
    
    
    //! Ödeme Günü Güncelleme
    $('#editPaymentDateUpdate').click(function (e) {
        e.preventDefault();
        
        var company_idRole = $('#company_idRole').html(); //! id
        var company_idRoleToken = $('#company_idRole').attr("data_token"); //! Token
        
        var editPaymentDate = $("#editPaymentDate").val();
       
         
        console.log("editPaymentDate:", editPaymentDate);
        
        console.log("company_idRole:", company_idRole);
        console.log("company_idRoleToken:", company_idRoleToken);
        
                
        //! Ajax 
        $.ajax({
            url: "/company/update/paymentdate",
            method: "post",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                token: company_idRoleToken,
                paymentDate: editPaymentDate
            },
            success: function(response){
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
                alert("hatalı");
                console.log("error:", error);
            }
        }); //! Ajax

        
        
    });  //! Ödeme Günü Güncelleme Son

});