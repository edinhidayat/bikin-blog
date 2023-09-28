// Script HALAMAN UBAH
function ubah(e) {
    $("#button-ubah").on("click", function (e) {
        e.preventDefault();
    });
    console.log("OK");

    // Objek Ajax
    let xhr = new XMLHttpRequest();
    // Cek Kesiapan Ajax
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // $("#ubah").html("");
            $("#ubah").html(xhr.responseText);
        }
    };

    // Eksekusi Ajax
    xhr.open(`get`, `/dashboard/${e}/edit`, true);
    xhr.send();
}
