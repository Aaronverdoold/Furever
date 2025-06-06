document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('loginForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch('../../backend/login/login.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        localStorage.setItem('username', data.naam);
                        localStorage.setItem('profiel_foto', data.profiel_foto || '');
                        window.location.href = '../home-page/home.html';
                    } else {
                        alert(data.message || 'Login failed');
                    }
                })
                .catch(error => {
                    alert('An error occurred');
                    console.error(error);
                });
        });
    }
});