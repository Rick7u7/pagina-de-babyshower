document.addEventListener('DOMContentLoaded', () => {
    // Modal
    window.openModal = function() {
        const modal = document.getElementById('eventModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        if(document.querySelectorAll('#guests-container .guest-item').length === 0) addGuest();
        if(document.querySelectorAll('#gifts-container .gift-item').length === 0) addGift();
    };

    window.closeModal = function() {
        const modal = document.getElementById('eventModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    };

    window.addGuest = function() {
        const container = document.getElementById('guests-container');
        const div = document.createElement('div');
        div.classList.add('guest-item', 'flex', 'space-x-2');
        div.innerHTML = `
            <input type="text" name="guests[][name]" placeholder="Nombre invitado" class="border px-2 py-1 rounded w-1/2" required>
            <input type="email" name="guests[][email]" placeholder="Correo (opcional)" class="border px-2 py-1 rounded w-1/2">
        `;
        container.appendChild(div);
    };

    window.addGift = function() {
        const container = document.getElementById('gifts-container');
        const div = document.createElement('div');
        div.classList.add('gift-item');
        div.innerHTML = `
            <input type="text" name="gifts[][name]" placeholder="Nombre del regalo" class="border px-2 py-1 rounded w-full" required>
        `;
        container.appendChild(div);
    };

    // Log de envío
    const form = document.getElementById('eventForm');
    if (form) {
        form.addEventListener('submit', (e) => {
            console.log("Submit disparado ✅");

            const formData = new FormData(form);
            for (let [key, value] of formData.entries()) {
                console.log(key, ":", value);
            }
        });
    }
});
