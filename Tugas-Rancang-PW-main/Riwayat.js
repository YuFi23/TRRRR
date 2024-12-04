// Fungsi untuk memuat riwayat pembelian
function loadRiwayat() {
    fetch('get_riwayat.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            const table = document.getElementById('riwayat-table');
            table.innerHTML = ''; // Hapus data lama
            
            if (Array.isArray(data) && data.length > 0) {
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.concert_name}</td>
                        <td>${item.ticket_type}</td>
                        <td>${item.created_at}</td>
                        <td>${item.payment_status}</td>
                    `;
                    table.appendChild(row);
                });
            } else {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td colspan="5">Tidak ada data riwayat pembelian.</td>
                `;
                table.appendChild(row);
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan saat memuat data:', error);
        });
}

// Muat data secara otomatis setiap 5 detik
setInterval(loadRiwayat, 5000); // Refresh setiap 5 detik
window.onload = loadRiwayat;

// Menangani klik pada avatar untuk menampilkan atau menyembunyikan menu dropdown
document.getElementById('avatar').addEventListener('click', function() {
    var dropdown = document.getElementById('dropdown-menu');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
});

// Menutup dropdown jika area di luar avatar diklik
window.addEventListener('click', function(event) {
    var dropdown = document.getElementById('dropdown-menu');
    var avatar = document.getElementById('avatar');
    if (!avatar.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});
