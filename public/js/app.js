document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('eventForm');

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // evita recarga

            // "printf" → ver si se dispara
            console.log("Submit disparado");

            // mostrar todo lo que se envía
            const formData = new FormData(form);
            for (let [key, value] of formData.entries()) {
                console.log(key, ":", value);
            }

            // si quieres dejar que Laravel lo procese:
            form.submit(); // quita el preventDefault si prefieres
        });
    }
});
