//menggunakan jquery
$(function() {
    $("#search").hide();

    //tambah event ketika key diketik
    $("#key").on("keyup", function() {
        //load nyalakan
        $(".loader").show();
        //menggunakan load
        // $("#container").load("ajax/mahasiswa.php/key=?" + $("#key").val());

        //menggunakan get
        $.get("ajax/mahasiswa.php?key=" + $("#key").val(), function(data) {
            $("#container").html(data);
            $(".loader").hide();
        });
    });
});

// //menggunakan ajax
// //ambil semua elemet yang dibutuhkan
// var key = document.getElementById("key");
// var search = document.getElementById("search");
// var container = document.getElementById("container");

// //buat event ketika key di ketik
// key.addEventListener("keyup", function() {
//     //buat object ajax
//     var xhr = new XMLHttpRequest();

//     //cek kesiapan ajax
//     xhr.onreadystatechange = function() {
//         if( xhr.readyState == 4 && xhr.status == 200 ) {
//             container.innerHTML = xhr.responseText
//         }
//     }

//     //eksekusi ajax
//     xhr.open("GET", "ajax/mahasiswa.php?key=" + key.value, true);
//     xhr.send();
// });