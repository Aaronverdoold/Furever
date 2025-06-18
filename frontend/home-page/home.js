document.addEventListener('DOMContentLoaded', function () {
    const userNav = document.getElementById('userNav');
    const username = localStorage.getItem('username');
    const profielFoto = localStorage.getItem('profiel_foto');
    const loginBtn = document.getElementById('login-btn');
    const userProfile = document.getElementById('user-profile');
    const logoutBtn = document.getElementById('logout-btn');

    if (username) {
        if (loginBtn) loginBtn.style.display = 'none';
        if (userProfile) userProfile.style.display = 'inline-flex';
        const profilePhotoUrl = profielFoto && profielFoto !== 'null' && profielFoto !== ''
            ? '../../uploads/' + profielFoto
            : '../../images/default.jpg';
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
        if (loginBtn) loginBtn.style.display = 'inline-block';
        if (userProfile) userProfile.style.display = 'none';
        if (userNav) {
            userNav.innerHTML = `<a href="./../login-page/login.html">Login</a>`;
        }
    }
    if (logoutBtn) {
        logoutBtn.onclick = function () {
            localStorage.removeItem('username');
            localStorage.removeItem('profiel_foto');
            window.location.href = '../home-page/home.html';
        };
    }

    const petProfiles = [
        { id: 1, name: "Buddy", image: "../../images/dog.jpg" },
        { id: 2, name: "Mittens", image: "../../images/cat.jpg" },
        { id: 3, name: "Luna", image: "../../images/dog-cat.jpg" }
    ];
    let currentIndex = 0;

    function showCard() {
        const cardStack = document.getElementById("card-stack");
        cardStack.innerHTML = "";
        const pet = petProfiles[currentIndex];
        if (!pet) {
            cardStack.innerHTML = "<p>No more pets to swipe!</p>";
            return;
        }
        const card = document.createElement("div");
        card.className = "pet-card";
        card.innerHTML = `
            <img src="${pet.image}" alt="${pet.name}" />
            <h4>${pet.name}</h4>
        `;
        cardStack.appendChild(card);
    }

    function handleSwipe(type) {
        currentIndex++;
        showCard();
    }

    document.querySelectorAll('.swipe-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const pet = petProfiles[currentIndex];
            if (!pet) return;
            const dierId = pet.id;
            const richting = this.dataset.richting;
            const gebruikerId = localStorage.getItem('gebruiker_id');
            fetch('../../backend/swipen/swipe.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    gebruiker_id: gebruikerId,
                    dier_id: dierId,
                    richting: richting
                })
            })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('swipe-message').textContent = data.success
                        ? 'Swipe saved!'
                        : 'Error: ' + data.error;
                });

            handleSwipe(richting === 'right' ? 'like' : 'dislike');
        });
    });

    showCard();
});