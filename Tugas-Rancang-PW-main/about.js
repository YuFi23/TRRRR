
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
