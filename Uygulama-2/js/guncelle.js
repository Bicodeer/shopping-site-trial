function getRow(){
    var table = document.getElementById('tablo');
    var cells = table.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        var firma_adi = document.getElementById("firma_adi");
        var firma_tel = document.getElementById("firma_tel");
        var firma_mail = document.getElementById("firma_mail");

        var cell = cells[i];
        cell.onclick = function () {
            var rowId = this.parentNode.rowIndex;

            var secilmeyenSatirlar = table.getElementsByTagName('tr');
            for (var i = 0; i < secilmeyenSatirlar.length; i++) {
                secilmeyenSatirlar[i].style.backgroundColor = "";
            }

            var secilenSatir = table.getElementsByTagName('tr')[rowId];
            secilenSatir.style.backgroundColor = "yellow";

            firma_adi.value = secilenSatir.cells[0].innerHTML;
            firma_tel.value = secilenSatir.cells[1].innerHTML;
            firma_mail.value = secilenSatir.cells[2].innerHTML;

        }
    }
}