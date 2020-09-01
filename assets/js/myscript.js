const flashData = $('.flash-data').data('flashdata');
const dataFlash = $('.privflash').data('flashdata');


// console.log(flashData);
if (flashData){ //untuk aproval ijin sakit
    Swal.fire({
        title: 'Berhasil',
        text : 'Pengajuan Izin  ' + flashData,
        type : 'success',
    });
};

// Untuk aproval CUti
const flashDataCt = $('.flashCuti').data('flashdata');
if (flashDataCt){ //untuk aproval ijin sakit
    Swal.fire({
        title: 'Berhasil',
        text : 'Pengajuan Cuti ' + flashDataCt,
        type : 'success',
    });
};

if (dataFlash){ //untuk aproval ijin sakit
    Swal.fire({
        title: 'Berhasil',
        text : 'Data Pribadi Berhasil ' + dataFlash,
        type : 'success',
    });
};

const sbuFlash = $('.flash-unit').data('flashdata');
if (sbuFlash){ //untuk tambah SBU
    Swal.fire({
        title: 'Berhasil',
        text : 'Data Telah ' + sbuFlash,
        type : 'success',
    });
};

const sbuFlashErr = $('.flash-err').data('flashdata');
if(sbuFlashErr){
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Data Gagal ' + sbuFlashErr,
    });
};

const empFlash = $('.karyflash').data('flashdata');
if(empFlash){ //tambah Karyawan
    Swal.fire({
        title: 'Berhasil',
        text : 'Data Karyawan Telah ' + empFlash,
        type : 'success',
    });
};

// Page kontrak
const conEmpFlash = $('.conflash').data('flashdata');
if(conEmpFlash){
    swal.fire({
        title: 'Berhasil',
        text : 'Data Kontrak Karyawan Telah ' + conEmpFlash,
        type : 'success',
    });
};

// Page User Akses
const aksesFlash = $('.accflash').data('flashdata');
if(aksesFlash){
    swal.fire({
        title: 'Berhasil',
        text : 'Akses Untuk User Telah ' + aksesFlash,
        type : 'success',
    });
};



// tombol aproval class tombol-apv ijin sakit / ijin lambat
$('.tombol-apv').on('click', function(e){

    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Pengajuan akan disetujui!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
});

// tombol aproval class tombol-tolak  ijin lambat
$('.tombol-tolak').on('click', function(e){

    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Pengajuan akan ditolak!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
});


$('.tombol-hapus').on('click', function(e){

    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Pengajuan ijin akan dibatalkan!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
});

$('.tombol-del').on('click', function(e){

    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Data akan dihapus!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
});

$('.tombol-ccl').on('click',function(){
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Pengajuan sudah dibatalkan'
    })
});


$('.tombol-eoc').on('click', function(e){

    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Kontrak karyawan akan diakhiri",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
});
$('.tombol-cuti').on('click', function(e){

    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Kamu Yakin?',
        text: "Cuti karyawan akan di nonaktifkan",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
});

$('.tombol-addCuti').on('click'), function(){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
        footer: '<a href>Why do I have this issue?</a>'
    })
}


const rfidFlash = $('.checkFlash').data('flashdata');
if(rfidFlash){
    Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: rfidFlash,
    });
};

// proses absen jika berhasil => Halaman absenHome
const absenFlash = $('.punchflash').data('flashdata');
if(absenFlash){
    swal.fire({
        type : 'success',
        title: 'Berhasil',
        text : 'Absen Kehadiran ' + absenFlash,
    });
};

const gagalAbsen = $('.gagalflash').data('flashdata');
if(gagalAbsen){
    swal.fire({
        type: 'error',
        title: 'Oops...',
        text: 'Absen Sudah Dilakukan !',
    });
};

// proses absen jika berhasil => Halaman absenHome
const pwdFlash = $('.passflash').data('flashdata');
if(pwdFlash){
    swal.fire({
        type : 'success',
        title: 'Berhasil',
        text : 'Password Telah ' + pwdFlash,
    });
};

// Alert untuk insert comment pengajuan ijin terlambat
const commentFlash = $('.comment-flash').data('flashdata');
if(commentFlash){
    swal.fire({
        type : 'success',
        title: 'Berhasil',
        text : 'Alasan Telah ' + commentFlash,
    });
};

// Alert Proses Aproval/Tolak Ijin terlambat
const ApvFlash = $(".Apvflash").data('flashdata');
if(ApvFlash){
    swal.fire({
        type : 'success',
        title: 'Berhasil',
        text : 'Pengajuan Telah ' + ApvFlash,
    })
}


