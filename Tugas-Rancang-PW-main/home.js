const sections = document.querySelectorAll('.section');

function toggleVisibility() {
    sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top;
        const sectionBottom = section.getBoundingClientRect().bottom;
        const windowHeight = window.innerHeight;

        if (sectionTop >= 0 && sectionBottom <= windowHeight) {
            section.classList.add('show');
        } else {
            section.classList.remove('show');
        }
    });
}

window.addEventListener('scroll', toggleVisibility);
window.addEventListener('load', toggleVisibility);
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('transparent');
    } else {
        navbar.classList.remove('transparent');
    }
});

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

