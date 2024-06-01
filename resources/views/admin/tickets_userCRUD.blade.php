@include('shared.html')
@include('shared.head', ['pageTitle' => "User Tickets"])
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
            <h2 class="text-4xl font-extrabold text-red-700">User Tickets</h2>
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="toggleAddUserTicketForm()">Add New User Ticket</a>
        </div>

        <!-- Form for adding new user ticket -->
        <div id="addUserTicketForm" class="hidden mb-8">
            <form action="{{ route('admin.user_tickets.store') }}" method="POST">
                @csrf
                <div class="flex flex-col mb-4">
                    <label for="reservation_id" class="text-lg font-bold mb-2">Reservation ID</label>
                    <input type="number" name="reservation_id" id="reservation_id" class="border rounded-lg px-3 py-2">
                        @error('reservation_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
                <div class="flex flex-col mb-4">
                    <label for="ticket_id" class="text-lg font-bold mb-2">Ticket</label>
                    <select name="ticket_id" id="ticket_id" class="border rounded-lg px-3 py-2" required>
                        <option value="">-- Select Ticket --</option>
                        @foreach($tickets as $ticket)
                            <option value="{{ $ticket->id }}">{{ $ticket->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="quantity" class="text-lg font-bold mb-2">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="border rounded-lg px-3 py-2" required max="50">
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold text-2xl py-3 px-8 rounded">Add User Ticket</button>
            </form>
        </div>
        <!-- Display existing user tickets -->
        <div class="grid grid-cols-1 gap-4">
            @foreach($user_tickets as $user_ticket)
                <div class="bg-lime-700 shadow-2xl shadow-black rounded-2xl px-8 pt-6 pb-8 mb-4 text-white">
                    <div class="mb-4">
                        <p class="text-2xl font-bold text-yellow-500">Reservation ID:
                            <span class="text-white">{{ $user_ticket->reservation_id }}</span>
                        </p>
                        <hr class="my-3 border-t border-yellow-500">
                        <p class="text-2xl font-bold text-yellow-500">Ticket Type:
                            <span class="text-white">{{ $user_ticket->ticket->type }}</span>
                        </p>
                        <hr class="my-2 border-t border-yellow-500">
                        <p class="text-2xl font-bold text-yellow-500">Quantity:
                            <span class="text-white">{{ $user_ticket->quantity }}</span>
                        </p>
                        <hr class="my-2 border-t border-yellow-500">
                    </div>
                    <div class="flex justify-end">
                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-4 px-12 rounded mr-2 md:mr-5 text-2xl" onclick="toggleEditUserTicketForm({{ $user_ticket->id }})">Edit</button>
                        <form id="deleteForm_{{ $user_ticket->id }}" action="{{ route('admin.user_tickets.destroy', $user_ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-4 px-12 rounded text-2xl">Delete</button>
                        </form>
                    </div>
                    <!-- Form for editing user ticket -->
                    <div id="editUserTicketForm_{{ $user_ticket->id }}" class="hidden mb-4 text-black">
                        <form action="{{ route('admin.user_tickets.update', $user_ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-col mb-4">
                                <label for="ticket" class="text-lg font-bold mb-2 text-white">Ticket</label>
                                <select name="ticket_id" id="ticket" class="border rounded-lg px-3 py-2" required>
                                    <option value="">-- Select Ticket --</option>
                                    @foreach($tickets as $ticket)
                                        <option value="{{ $ticket->id }}">{{ $ticket->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="quantity" class="text-lg font-bold mb-2 text-white">Quantity</label>
                                <input type="text" name="quantity" id="quantity" class="border rounded-lg px-3 py-2" value="{{ $user_ticket->quantity }}" required max="50">
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-2xl py-3 px-8 rounded mr-2 md:mr-4">Save</button>
                                <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold text-2xl py-3 px-8 rounded" onclick="toggleEditUserTicketForm({{ $user_ticket->id }})">Cancel</button>
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
        function toggleAddUserTicketForm() {
            var form = document.getElementById('addUserTicketForm');
            form.classList.toggle('hidden');
        }

        function toggleEditUserTicketForm(userTicketId) {
            var form = document.getElementById('editUserTicketForm_' + userTicketId);
            form.classList.toggle('hidden');
        }
    </script>
</body>

</html>
