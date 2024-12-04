// Tambahkan event listener untuk tombol submit
document.querySelector('form').addEventListener('submit', function(event) {
    // Mencegah default behavior dari form
    event.preventDefault();
    
    // Ambil nilai dari input
    var nama = document.querySelector('#nama').value;
    var email = document.querySelector('#email').value;
    var noTelp = document.querySelector('#no-telp').value;
    var metodePembayaran = document.querySelector('#metode-pembayaran').value;
    
    // Lakukan validasi
    if (nama === '' || email === '' || noTelp === '' || metodePembayaran === '') {
        alert('Silakan isi semua field!');
    } else {
        // Kirim data ke server
        // ...
    }
});