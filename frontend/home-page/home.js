document.addEventListener('DOMContentLoaded', function () {
    const userNav = document.getElementById('userNav');
    const username = localStorage.getItem('username');
    const profielFoto = localStorage.getItem('profiel_foto');
    const loginBtn = document.getElementById('login-btn');
    const userProfile = document.getElementById('user-profile');
    const logoutBtn = document.getElementById('logout-btn');

    if (username) {
        // Show user profile section
        if (loginBtn) loginBtn.style.display = 'none';
        if (userProfile) userProfile.style.display = 'inline-flex';

        // Determine profile photo URL
        const profilePhotoUrl = profielFoto && profielFoto !== 'null' && profielFoto !== ''
            ? '../../uploads/' + profielFoto
            : '../../images/default.jpg';

        // Show profile photo and username
        if (userNav) {
            userNav.innerHTML = `
                <img src="${profilePhotoUrl}"
                     alt="Profile Photo"
                     class="profile-photo"
                     style="width:32px;height:32px;border-radius:50%;object-fit:cover;margin-right:8px;">
                <span class="user-username">${username}</span>
            `;
            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    localStorage.removeItem('username');
                    localStorage.removeItem('profiel_foto');
                    window.location.href = '../home-page/home.html';
                });
            }
        }
    } else {
        // Show login button, hide user profile
        if (loginBtn) loginBtn.style.display = 'inline-block';
        if (userProfile) userProfile.style.display = 'none';
        if (userNav) {
            userNav.innerHTML = `<a href="./../login-page/login.html">Login</a>`;
        }
    }

    // Logout logic for separate logout button (if present)
    if (logoutBtn) {
        logoutBtn.onclick = function () {
            localStorage.removeItem('username');
            localStorage.removeItem('profiel_foto');
            window.location.href = '../home-page/home.html';
        };
    }
});
