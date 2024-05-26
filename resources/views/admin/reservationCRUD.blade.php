@include('shared.html')
@include('shared.head', ['pageTitle' => "Reservation Management"])
<body class="bg-green-50">
    @include('shared.navbar')

    <div class="container mx-auto my-8">
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.828 17.657A10 10 0 1 0 17.657 2.828 10 10 0 0 0 2.828 17.657ZM10 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16ZM11 12a1 1 0 0 0-1 1v1a1 1 0 0 0 2 0v-1a1 1 0 0 0-1-1Zm0-4a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0v-3a1 1 0 0 0-1-1Z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="bg-green-950 text-white p-4 rounded mb-4">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-4xl font-extrabold text-red-700">Reservation Management</h2>
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="toggleAddReservationForm()">Add New Reservation</a>
        </div>

        <!-- Form for adding new reservation -->
        <div id="addReservationForm" class="hidden mb-8">
            <form action="{{ route('admin.reservations.store') }}" method="POST">
                @csrf
                <div class="flex flex-col mb-4">
                    <label for="user_id" class="text-lg font-bold mb-2">User</label>
                    <select name="user_id" id="user_id" class="border rounded-lg px-3 py-2" onchange="handleUserSelection()">
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="guest_name" class="text-lg font-bold mb-2">Guest Name</label>
                    <input type="text" name="guest_name" id="guest_name" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="guest_surname" class="text-lg font-bold mb-2">Guest Surname</label>
                    <input type="text" name="guest_surname" id="guest_surname" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="guest_email" class="text-lg font-bold mb-2">Guest Email</label>
                    <input type="email" name="guest_email" id="guest_email" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="reservation_date" class="text-lg font-bold mb-2">Reservation Date</label>
                    <input type="date" name="reservation_date" id="reservation_date" class="border rounded-lg px-3 py-2" required min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 months')) }}">
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold text-2xl py-3 px-8 rounded">Add Reservation</button>
            </form>
        </div>

<!-- Display existing reservations -->
<div class="grid grid-cols-1 gap-4">
    @foreach($reservations as $reservation)
        <div class="bg-lime-700 shadow-2xl shadow-black rounded-2xl px-8 pt-6 pb-8 mb-4 text-white">
            <div class="mb-4">
                <p class="text-2xl font-bold text-yellow-500">Reservation number:
                    <span class="text-white">{{ $reservation->id }}</span>
                </p>
                <hr class="my-2 border-t border-yellow-500">
                @if(empty($reservation->guest_name) && empty($reservation->guest_surname) && empty($reservation->guest_email))
                    <p class="text-2xl font-bold text-yellow-500">User Name:
                        <span class="text-white">{{ $reservation->user->name }}</span>
                    </p>
                    <hr class="my-2 border-t border-yellow-500">
                    <p class="text-2xl font-bold text-yellow-500">User Surname:
                        <span class="text-white">{{ $reservation->user->surname }}</span>
                    </p>
                    <hr class="my-2 border-t border-yellow-500">
                    <p class="text-2xl font-bold text-yellow-500">User Email:
                        <span class="text-white">{{ $reservation->user->email }}</span>
                    </p>
                    <hr class="my-2 border-t border-yellow-500">
                @else
                    <p class="text-2xl font-bold text-yellow-500">Guest Name:
                        <span class="text-white">{{ $reservation->guest_name }}</span>
                    </p>
                    <hr class="my-3 border-t border-yellow-500">
                    <p class="text-2xl font-bold text-yellow-500">Guest Surname:
                        <span class="text-white">{{ $reservation->guest_surname }}</span>
                    </p>
                    <hr class="my-2 border-t border-yellow-500">
                    <p class="text-2xl font-bold text-yellow-500">Guest Email:
                        <span class="text-white">{{ $reservation->guest_email }}</span>
                    </p>
                    <hr class="my-2 border-t border-yellow-500">
                @endif
                <p class="text-2xl font-bold text-yellow-500">Reservation Date:
                    <span class="text-white">{{ $reservation->reservation_date }}</span>
                </p>
                <hr class="my-2 border-t border-yellow-500">
            </div>
            <div class="flex justify-end">
                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-4 px-12 rounded mr-2 md:mr-5 text-2xl" onclick="toggleEditReservationForm({{ $reservation->id }})">Edit</button>
                <form id="deleteForm_{{ $reservation->id }}" action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-4 px-12 rounded text-2xl">Delete</button>
                </form>
            </div>
            <div id="editReservationForm_{{ $reservation->id }}" class="hidden mb-4 text-black">
                <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <div class="flex flex-col mb-4">
                        <label for="user_id" class="text-lg font-bold mb-2 text-white">User</label>
                        <select name="user_id" id="user_id" class="border rounded-lg px-3 py-2">
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($reservation->user_id == $user->id) selected @endif>{{ $user->name }} {{ $user->surname }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="guest_name" class="text-lg font-bold mb-2 text-white">Guest Name</label>
                        <input type="text" name="guest_name" id="guest_name" class="border rounded-lg px-3 py-2" value="{{ $reservation->guest_name }}" required>
                        @error('guest_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="guest_surname" class="text-lg font-bold mb-2 text-white">Guest Surname</label>
                        <input type="text" name="guest_surname" id="guest_surname" class="border rounded-lg px-3 py-2" value="{{ $reservation->guest_surname }}" required>
                        @error('guest_surname')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="guest_email" class="text-lg font-bold mb-2 text-white">Guest Email</label>
                        <input type="email" name="guest_email" id="guest_email" class="border rounded-lg px-3 py-2" value="{{ $reservation->guest_email }}" required>
                        @error('guest_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="reservation_date" class="text-lg font-bold mb-2 text-white">Reservation Date</label>
                        <input type="date" name="reservation_date" id="reservation_date" class="border rounded-lg px-3 py-2" value="{{ $reservation->reservation_date }}" required min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+3 months')) }}">
                        @error('reservation_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-2xl py-3 px-8 rounded mr-2 md:mr-4">Save</button>
                        <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold text-2xl py-3 px-8 rounded" onclick="toggleEditReservationForm({{ $reservation->id }})">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <hr class="my-4">
    @endforeach
</div>
    </div>
    @include('shared.footer')

    <script>
        function toggleAddReservationForm() {
            var form = document.getElementById('addReservationForm');
            form.classList.toggle('hidden');
        }

        function toggleEditReservationForm(reservationId) {

            var form = document.getElementById('editReservationForm_' + reservationId);
            form.classList.toggle('hidden');
        }

        function handleUserSelection()
        {
            var userSelect = document.getElementById('user_id');
            var selectedValue = userSelect.value;
            var guestNameInput = document.getElementById('guest_name');
            var guestSurnameInput = document.getElementById('guest_surname');
            var guestEmailInput = document.getElementById('guest_email');

            if (userSelect.value !== '') {
                guestNameInput.disabled = true;
                guestSurnameInput.disabled = true;
                guestEmailInput.disabled = true;
                guestNameInput.value = '';
                guestSurnameInput.value = '';
                guestEmailInput.value = '';
                guestNameInput.classList.add('cursor-not-allowed');
                guestSurnameInput.classList.add('cursor-not-allowed');
                guestEmailInput.classList.add('cursor-not-allowed');
            } else {
                guestNameInput.disabled = false;
                guestSurnameInput.disabled = false;
                guestEmailInput.disabled = false;
                guestNameInput.classList.remove('cursor-not-allowed');
                guestSurnameInput.classList.remove('cursor-not-allowed');
                guestEmailInput.classList.remove('cursor-not-allowed');
            }
            console.log(selectedValue);
        }

    </script>
</body>
</html>
