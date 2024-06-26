@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
<body class="bg-green-50">
    @include('shared.navbar')

    <div class="container my-10 mx-auto w-full md:w-3/5">
        <h1 class="text-5xl font-bold mb-6 text-center text-red-700">My Reservations</h1>

        @if (session('status'))
            <div class="bg-green-950 text-white p-4 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">
            @forelse ($userReservations as $reservation)
            <div class="bg-lime-700 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-2 text-center text-white">Reservation Date: {{ $reservation->reservation_date }}</h2>
                <hr class="my-4">
                <ul class="grid grid-cols-4 gap-x-4 gap-y-2">
                    @foreach ($reservation->tickets as $ticket)
                        <li class="flex justify-center items-center">
                            <span class="text-2xl font-bold text-yellow-500">Ticket Type:</span>
                        </li>
                        <li class="flex justify-center items-center mr-4">
                            <span class="text-2xl text-white">{{ $ticket->type }}</span>
                        </li>
                        <li class="flex justify-center items-center">
                            <span class="text-2xl font-bold text-yellow-500">Quantity:</span>
                        </li>
                        <li class="flex justify-center items-center">
                            <span class="text-2xl text-white">{{ $ticket->pivot->quantity }}</span>
                        </li>
                    @endforeach
                </ul>
                    <form action="{{ route('user-reservation.destroy', $reservation->id) }}" method="POST" class="mt-4 flex items-center justify-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-700 hover:bg-red-950 text-white font-bold py-2 px-4 rounded shadow shadow-black">
                            Delete Reservation
                        </button>
                    </form>
            </div>
            @empty
                <div class="bg-lime-700 shadow-md rounded-lg p-8 text-center">
                    <p class="text-white text-5xl">You have no reservations yet...</p>
                </div>
            @endforelse
        </div>
    </div>

    @include('shared.footer')
</body>
</html>
