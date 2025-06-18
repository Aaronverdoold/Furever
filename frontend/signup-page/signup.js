document.getElementById('add-dier-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('../../backend/add_dier.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const msg = document.getElementById('add-dier-message');
            if (data.success) {
                msg.textContent = 'Pet added successfully!';
                this.reset();
            } else {
                msg.textContent = 'Error: ' + data.error;
            }
        });
});