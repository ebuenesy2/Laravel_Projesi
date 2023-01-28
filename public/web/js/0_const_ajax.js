$(function () {

                   
    //! Ajax  Post
    $.ajax({
        url: "/ajax/example/post",
        method: "post",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            name: "enes",
            surname:"yildirim"
        },
        success: function(response){
            alert("başarılı");
            console.log("response:", response);
            console.log("success:", response.status);
        },
        error: function (error) {
            alert("hatalı");
            console.log("error:", error);
        }
    }); //! Ajax Post Son

});
