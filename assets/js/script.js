document.addEventListener('DOMContentLoaded', function() {
    // Efek fade-in halaman
    document.body.style.opacity = 0;
    document.body.style.transition = "opacity 0.6s ease";
    setTimeout(() => { document.body.style.opacity = 1; }, 50);

    // Interaksi Konfirmasi Hapus
    const deleteButtons = document.querySelectorAll('a[onclick]');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Bisa ditambahkan logika kustom di sini jika ingin menggunakan modal
            console.log("Tombol hapus diklik");
        });
    });
});