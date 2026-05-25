<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">

        <!-- Encabezado -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold text-pink-500">
                Mis Baby Showers
            </h1>

            <button onclick="openModal()"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-lg">
                + Crear Evento
            </button>
        </div>

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de eventos -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-pink-200">
                    <tr>
                        <th class="p-4">Nombre</th>
                        <th class="p-4">Fecha</th>
                        <th class="p-4">Lugar</th>
                        <th class="p-4">Descripción</th>
                        <th class="p-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr class="border-b">
                            <td class="p-4">{{ $event->name }}</td>
                            <td class="p-4">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                            <td class="p-4">{{ $event->location }}</td>
                            <td class="p-4">{{ $event->description }}</td>
                            <td class="p-4">
                                <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                No hay eventos creados aún.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="eventModal"
         class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-pink-500">Crear Evento</h2>
                <button onclick="closeModal()" class="text-gray-500 text-2xl">&times;</button>
            </div>

            <form id="eventForm" action="{{ route('events.store') }}" method="POST">
                @csrf

                <!-- Datos básicos -->
                <div class="mb-4">
                    <label class="block mb-2">Nombre del evento</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Fecha</label>
                    <input type="date" name="date" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Lugar</label>
                    <input type="text" name="location" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2">Descripción</label>
                    <textarea name="description" class="w-full border rounded-lg px-4 py-2"></textarea>
                </div>

                <!-- Invitados -->
                <h3 class="text-lg font-semibold mb-2">Invitados (mínimo 1)</h3>
                <div id="guests-container" class="space-y-2"></div>
                <button type="button" onclick="addGuest()" class="bg-pink-500 text-white px-3 py-1 rounded mb-4">+ Invitado</button>

                <!-- Regalos -->
                <h3 class="text-lg font-semibold mb-2">Regalos (mínimo 1)</h3>
                <div id="gifts-container" class="space-y-2"></div>
                <button type="button" onclick="addGift()" class="bg-pink-500 text-white px-3 py-1 rounded mb-4">+ Regalo</button>

                <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                    Guardar Evento
                </button>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        function openModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            if(document.querySelectorAll('#guests-container .guest-item').length === 0) addGuest();
            if(document.querySelectorAll('#gifts-container .gift-item').length === 0) addGift();
        }

        function closeModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function addGuest() {
            const container = document.getElementById('guests-container');
            const div = document.createElement('div');
            div.classList.add('guest-item', 'flex', 'space-x-2');
            div.innerHTML = `
                <input type="text" name="guests[][name]" placeholder="Nombre invitado" class="border px-2 py-1 rounded w-1/2" required>
                <input type="email" name="guests[][email]" placeholder="Correo (opcional)" class="border px-2 py-1 rounded w-1/2">
            `;
            container.appendChild(div);
        }

        function addGift() {
            const container = document.getElementById('gifts-container');
            const div = document.createElement('div');
            div.classList.add('gift-item');
            div.innerHTML = `
                <input type="text" name="gifts[][name]" placeholder="Nombre del regalo" class="border px-2 py-1 rounded w-full" required>
            `;
            container.appendChild(div);
        }

        document.addEventListener('DOMContentLoaded', () => {
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
    </script>
</x-app-layout>
