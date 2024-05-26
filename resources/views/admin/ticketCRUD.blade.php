@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
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
            <h2 class="text-4xl font-extrabold text-red-700">Ticket Management</h2>
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="toggleAddTicketForm()">Add New Ticket</a>
        </div>

        <!-- Form for adding new ticket -->
        <div id="addTicketForm" class="hidden mb-8">
            <form action="{{ route('admin.tickets.store') }}" method="POST">
                @csrf
                <div class="flex flex-col mb-4">
                    <label for="type" class="text-lg font-bold mb-2">Type</label>
                    <input type="text" name="type" id="type" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="price" class="text-lg font-bold mb-2">Price</label>
                    <input type="text" name="price" id="price" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="available_quantity" class="text-lg font-bold mb-2">Available Quantity</label>
                    <input type="text" name="available_quantity" id="available_quantity" class="border rounded-lg px-3 py-2" required>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold text-2xl py-3 px-8 rounded">Add Ticket</button>
            </form>
        </div>
        <!-- Display existing tickets -->
        <div class="grid grid-cols-1 gap-4">
            @foreach($tickets as $ticket)
                <div class="bg-lime-700 shadow-2xl shadow-black rounded-2xl px-8 pt-6 pb-8 mb-4 text-white">
                    <div class="mb-4">
                        <p class="text-2xl font-bold text-yellow-500">Type:
                            <span class="text-white">{{ $ticket->type }} </span>
                        </p>
                        <hr class="my-3 border-t border-yellow-500">
                        <p class="text-2xl font-bold text-yellow-500">Price:
                            <span class="text-white">{{ $ticket->price }}</span>
                        </p>
                        <hr class="my-2 border-t border-yellow-500">
                        <p class="text-2xl font-bold text-yellow-500">Available Quantity:
                            <span class="text-white">{{ $ticket->available_quantity }}</span>
                        </p>
                        <hr class="my-2 border-t border-yellow-500">
                    </div>
                    <div class="flex justify-end">
                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-4 px-12 rounded mr-2 md:mr-5 text-2xl" onclick="toggleEditTicketForm({{ $ticket->id }})">Edit</button>
                        <form id="deleteForm_{{ $ticket->id }}" action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-4 px-12 rounded text-2xl">Delete</button>
                        </form>
                    </div>
                    <div id="editTicketForm_{{ $ticket->id }}" class="hidden mb-4 text-black">
                        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="flex flex-col mb-4">
                                <label for="type" class="text-lg font-bold mb-2 text-white">Type</label>
                                <input type="text" name="type" id="type" class="border rounded-lg px-3 py-2" value="{{ $ticket->type }}" required>
                                @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="price" class="text-lg font-bold mb-2 text-white">Price</label>
                                <input type="text" name="price" id="price" class="border rounded-lg px-3 py-2" value="{{ $ticket->price }}" required>
                                @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="available_quantity" class="text-lg font-bold mb-2 text-white">Available Quantity</label>
                                <input type="text" name="available_quantity" id="available_quantity" class="border rounded-lg px-3 py-2" value="{{ $ticket->available_quantity }}" required>
                                @error('available_quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-2xl py-3 px-8 rounded mr-2 md:mr-4">Save</button>
                                <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold text-2xl py-3 px-8 rounded" onclick="toggleEditTicketForm({{ $ticket->id }})">Cancel</button>
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
        function toggleAddTicketForm() {
            var form = document.getElementById('addTicketForm');
            form.classList.toggle('hidden');
        }

        function toggleEditTicketForm(ticketId) {
            var form = document.getElementById('editTicketForm_' + ticketId);
            form.classList.toggle('hidden');
        }
    </script>
</body>

</html>
