$(function () {

    alert("image");
    

    
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
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
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
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<img src="../upload/images/loader.gif" style="width: 200px;" />');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
           success: function (resp) {
               //alert("sonuc");
               console.log("resp:", resp);
               
              //! upload Durum
              $('#uploadStatus').css('display','none');
            }
        }); //! Ajax
        
    });
});
