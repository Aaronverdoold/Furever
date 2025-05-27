document.addEventListener('DOMContentLoaded', function () {
    const userNav = document.getElementById('userNav');
    const username = localStorage.getItem('username');

    if (userNav) {
        if (username) {
            userNav.innerHTML = `
                <span class="user-username">${username}</span>
                <a href="#" id="logout-link" class="logout-link">Logout</a>
            `;
            const logoutLink = document.getElementById('logout-link');
            if (logoutLink) {
                logoutLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    localStorage.removeItem('username');
                    window.location.href = '../home-page/home.html';
                });
            }
        } else {
            userNav.innerHTML = `
                <a href="./../login-page/login.html">Login</a>
            `;
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const username = localStorage.getItem('username');
    const loginBtn = document.getElementById('login-btn');
    const userProfile = document.getElementById('user-profile');
    const userNav = document.getElementById('userNav');
    const logoutBtn = document.getElementById('logout-btn');

    if (username) {
        if (loginBtn) loginBtn.style.display = 'none';
        if (userProfile) userProfile.style.display = 'inline-flex';
        if (userNav) userNav.textContent = username;
    } else {
        if (loginBtn) loginBtn.style.display = 'inline-block';
        if (userProfile) userProfile.style.display = 'none';
    }

    if (logoutBtn) {
        logoutBtn.onclick = function () {
            localStorage.removeItem('username');
            window.location.href = '../home-page/home.html';
        };
    }
});

document.addEventListener('DOMContentLoaded', updateNavigation);