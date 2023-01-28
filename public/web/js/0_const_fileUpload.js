$(function () {

   //alert("File Upload");
   
   //! Dosya Yükleme
   $("#uploadForm").on('submit', function(e){
        e.preventDefault();

        alert("upload submit");
                
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
                alert("dosya yükleme  hatali");
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                alert("dosya yükleme basarili");
                console.log("resp:", resp);
                console.log("resp file_path:", resp.file_path);
                
                //! Yüklenen Dosya Url
                $('#file_path').html(resp.file_path);
                $('#file_url').html(resp.file_url);
                
                //! avatar_img
                //$('#avatar_img').attr('src', resp.file_path);
                
                //! upload Durum
                $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
   }); //! Dosya Yükleme
    
    
    //! **************** Modal ******************
    
    //! Modal  Açma
    document.querySelectorAll('.modal_info').forEach(function (i) {
        i.addEventListener('click', function (event) {
            // document.querySelector('.msg').innerHTML = i.id;
            
            //! Attr - Diğer Veri Alma
            var data_id = event.target.getAttribute("data_id");
            var data_token = event.target.getAttribute("data_token");
            //var data_name = event.target.getAttribute("data_name");
           
            //! Yazma
            $('#apiToken').val(data_token);
            
            //! Return
            console.log("data_id:", data_id);
            console.log("data_token:", data_token);
            //console.log("data_name:", data_name);           
        
        });
    });  //! Modal  Açma Son
    
    
    //! Dosya Yükleme
   $("#uploadFormFatura").on('submit', function(e){
        e.preventDefault();

        alert("upload submit");
                
        //! Form Data verileri
        var formData = new FormData(this); 

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $("#progressBarFatura").width(percentComplete + '%');
                        $("#progressBarFatura").html(percentComplete+'%');
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
                $("#progressBarFatura").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error: function () {
                alert("dosya yükleme  hatali");
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function (resp) {
                alert("dosya yükleme basarili");
                console.log("resp:", resp);
                console.log("resp file_path:", resp.file_path);
                
                //! avatar_img
                //$('#avatar_img').attr('src', resp.file_path);
                
                //! upload Durum
                $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
   }); //! Dosya Yükleme

});
