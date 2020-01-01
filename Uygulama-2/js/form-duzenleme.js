var firma_ad = document.getElementById("firma_ad");
var firma_tel  = document.getElementById("firma_tel");
var firma_mail = document.getElementById("firma_mail");


var hata_firma_ad = document.getElementById("firma_ad");
var hata_firma_tel = document.getElementById("firma_tel");
var hata_firma_mail = document.getElementById("firma_mail");



var phoneno = /^\d{10}$/;

function validate() {
    if(firma_ad.value == ""){
        hata_firma_ad.innerHTML = "Lütfen Firma Adını Giriniz!";
    }
    if(firma_tel.value == ""){
        hata_firma_tel.innerHTML = "Lütfen Firma Telefon Giriniz!";
    }
    if(firma_mail.value == ""){
        hata_firma_mail.innerHTML = "Lütfen Firma Mail Giriniz!";
    }
    if(isNaN(firma_tel.value) || firma_tel.value.match(phoneno)){
        hata_firma_tel.innerHTML = "Lütfen T.C Kimlik Numaranızı İçerisinde Harf Barındırmayan ve 11 Haneli Olacak Şekilde Giriniz.";
    }
};