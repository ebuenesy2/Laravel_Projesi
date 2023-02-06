<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kargo Çıktısı | Bex360</title>

    <!---- Jquery dosyası çekme--->
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>

    <!---- Css  -->
    <style type="text/css">

    </style>
    <!---- Css Son  -->

</head>

<body>




    <!------  Çıkacak Yazı   -->
    <div id="source-html">

        <!---- Css  -->
        <style type="text/css" media="print">
            @page {
                size: auto;
                /* auto is the initial value */
                margin: 5mm;
                /* this affects the margin in the printer settings */
            }
        </style>
        <!---- Css Son  -->

        <html>

        <head>
            <meta content="text/html; charset=UTF-8" http-equiv="content-type">
            <style type="text/css">
                @import url('https://themes.googleusercontent.com/fonts/css?kit=fpjTOVmNbO4Lz34iLyptLUXza5VhXqVC6o75Eld_V98');

                ol {
                    margin: 0;
                    padding: 0
                }

                table td,
                table th {
                    padding: 0
                }

                .c0 {
                    border-right-style: solid;
                    padding: 0pt 5.4pt 0pt 5.4pt;
                    border-bottom-color: #000000;
                    border-top-width: 1pt;
                    border-right-width: 1pt;
                    border-left-color: #000000;
                    vertical-align: middle;
                    border-right-color: #000000;
                    border-left-width: 1pt;
                    border-top-style: solid;
                    border-left-style: solid;
                    border-bottom-width: 1pt;
                    width: 141.5pt;
                    border-top-color: #000000;
                    border-bottom-style: solid
                }

                .c5 {
                    border-right-style: solid;
                    padding: 0pt 5.4pt 0pt 5.4pt;
                    border-bottom-color: #000000;
                    border-top-width: 1pt;
                    border-right-width: 1pt;
                    border-left-color: #000000;
                    vertical-align: middle;
                    border-right-color: #000000;
                    border-left-width: 1pt;
                    border-top-style: solid;
                    border-left-style: solid;
                    border-bottom-width: 1pt;
                    width: 382.8pt;
                    border-top-color: #000000;
                    border-bottom-style: solid
                }

                .c1 {
                    color: #000000;
                    font-weight: 400;
                    text-decoration: none;
                    vertical-align: baseline;
                    font-size: 11pt;
                    font-family: "Calibri";
                    font-style: normal
                }

                .c4 {
                    padding-top: 0pt;
                    padding-bottom: 0pt;
                    line-height: 1.0;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                .c2 {
                    padding-top: 0pt;
                    padding-bottom: 8pt;
                    line-height: 1.0791666666666666;
                    orphans: 2;
                    widows: 2;
                    text-align: center
                }

                .c7 {
                    padding-top: 0pt;
                    padding-bottom: 8pt;
                    line-height: 1.0791666666666666;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                .c6 {
                    border-spacing: 0;
                    border-collapse: collapse;
                    margin-right: auto
                }

                .c9 {
                    background-color: #ffffff;
                    max-width: 523.3pt;
                    padding: 36pt 36pt 36pt 36pt
                }

                .c3 {
                    height: 20.8pt
                }

                .c8 {
                    height: 11pt
                }

                .title {
                    padding-top: 24pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 36pt;
                    padding-bottom: 6pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                .subtitle {
                    padding-top: 18pt;
                    color: #666666;
                    font-size: 24pt;
                    padding-bottom: 4pt;
                    font-family: "Georgia";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    font-style: italic;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                li {
                    color: #000000;
                    font-size: 11pt;
                    font-family: "Calibri"
                }

                p {
                    margin: 0;
                    color: #000000;
                    font-size: 11pt;
                    font-family: "Calibri"
                }

                h1 {
                    padding-top: 24pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 24pt;
                    padding-bottom: 6pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                h2 {
                    padding-top: 18pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 18pt;
                    padding-bottom: 4pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                h3 {
                    padding-top: 14pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 14pt;
                    padding-bottom: 4pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                h4 {
                    padding-top: 12pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 12pt;
                    padding-bottom: 2pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                h5 {
                    padding-top: 11pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 11pt;
                    padding-bottom: 2pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }

                h6 {
                    padding-top: 10pt;
                    color: #000000;
                    font-weight: 700;
                    font-size: 10pt;
                    padding-bottom: 2pt;
                    font-family: "Calibri";
                    line-height: 1.0791666666666666;
                    page-break-after: avoid;
                    orphans: 2;
                    widows: 2;
                    text-align: left
                }
            </style>
        </head>

        <body class="c9 doc-content">
            <p class="c7"><span class="c1">ALICI</span></p><a id="t.93346d9fa20e5664ea50e6e9983d194e15489259"></a><a
                id="t.0"></a>
            <table class="c6">
                <tr class="c3">
                    <td class="c0" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">F&#304;RMA</span></p>
                    </td>
                    <td class="c5" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1"> {{$warehouseInfo["warehouse_company"]}} </span></p>
                    </td>
                </tr>
                <tr class="c3">
                    <td class="c0" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">F&#304;RMA ADRES</span></p>
                    </td>
                    <td class="c5" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">{{$warehouseInfo["warehouse_address"]}}</span></p>
                    </td>
                </tr>
                <tr class="c3">
                    <td class="c0" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">F&#304;RMA TELEFON</span></p>
                    </td>
                    <td class="c5" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">{{$warehouseInfo["warehouse_phone"]}}</span></p>
                    </td>
                </tr>
            </table>
            <p class="c7 c8"><span class="c1"></span></p>
            <p class="c7"><span class="c1">G&Ouml;NDER&#304;C&#304;</span></p><a
                id="t.98e5fd7008ab19d461ade74a2a0132cf960b875c"></a><a id="t.1"></a>
            <table class="c6">
                <tr class="c3">
                    <td class="c0" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">G&Ouml;NER&#304;C&#304; F&#304;RMA</span></p>
                    </td>
                    <td class="c5" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">{{$company["titleofcompany"]}}</span></p>
                    </td>
                </tr>
                <tr class="c3">
                    <td class="c0" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">G&Ouml;NDER&#304;C&#304; F&#304;RMA ADRES</span></p>
                    </td>
                    <td class="c5" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">{{$company["companyAddress"]}}</span></p>
                    </td>
                </tr>
                <tr class="c3">
                    <td class="c0" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">G&Ouml;NDER&#304;C&#304; F&#304;RMA TELEFON</span></p>
                    </td>
                    <td class="c5" colspan="1" rowspan="1">
                        <p class="c4"><span class="c1">{{$company["phoneNumber"]}}</span></p>
                    </td>
                </tr>
            </table>
            <p class="c7 c8"><span class="c1"></span></p>
            <p class="c2"><span
                    style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 152.45px; height: 160.99px;"><img
                        alt="" src="{{$order['order_qrcode']}}"
                        style="width: 152.45px; height: 160.99px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);"
                        title=""></span></p>
        </body>

        </html>
    </div>
    <!------  Çıkacak Yazı  End  -->

 
    


</body>

</html>




<!------  script   -->
<script type="text/javascript">

    //! Okunacak Kısım
    var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
        "xmlns:w='urn:schemas-microsoft-com:office:word' " +
        "xmlns='http://www.w3.org/TR/REC-html40'>" +
        "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
    var body = document.getElementById("source-html").innerHTML; //! Gösterilecek Kısım
    var sourceHTML = header + body + "</body></html>";
    //! Okunacak Kısım Son


    //! Fonksiyon
    function printHTML(getHtml) {
        var printContents = getHtml;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        
        document.body.innerHTML = originalContents;
    }
    //! Fonksiyon Son

     printHTML(sourceHTML);
     
     
     
     window.onafterprint = function() {  window.location.href= "/orders/list"; };

     


</script>
<!------  End script   -->