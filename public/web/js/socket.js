$(function () {

    //console.log("socket");
    
    // let socketConnectionStatus = 0;
    // var socket = "";
    
    // //! Socket Baglantısı
    // let userId = document.cookie.split(';').find((row) => row.startsWith(' userID='))?.split('=')[1]; //! userid
    // userId = Number(userId);
    
    // var socket = new WebSocket('ws://socket.yildirimdev.com/socket/' + userId);  // Url
    
    
    // socket.onopen = function () {
    //     socketConnectionStatus = 1;
    //     console.log("Bağlandı");
    // };
    // socket.onclose = function (evt) {
    //     alert("Sunucu Kapatıldı");
    //     socketConnectionStatus = 0;
    // };
    // socket.onmessage = function (evt) {
    //     const serverData = JSON.parse(evt.data);
    //     console.log('Message from server Data ', serverData);
        
    //     const dataTypeTitle = serverData.dataTypeTitle;
    //     console.log("dataTypeTitle:", dataTypeTitle);
        
    //     if (dataTypeTitle == "supportrequest_add")
    //     {
    //         //alert("destek eklendi");
    //         var sitePathName = window.location.pathname; // /supportrequest/list
       
    //         if (sitePathName == "/supportrequest/list") { window.location.reload(); }
            
    //     }
        
        
    // };
    // socket.onerror = function (evt) {
    //     console.log("ERR: " + evt.data);
    //     socketConnectionStatus = 0;
    // };
    

    

});
