@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
<body class="bg-green-50">
    @include('shared.navbar')

    <div class="flex items-center justify-center bg-green-50 dark:bg-green-50 mt-5 mb-5 mx-auto w-full md:w-3/5">
        <div class="p-6 rounded-lg shadow-2xl shadow-black py-8 lg:py-16 bg-lime-700 dark:bg-lime-700">
            <h2 class="font-extrabold mb-2 pb-2 text-center text-4xl tracking-tight text-yellow-500">Reserve Your Visit to Our Zoo</h2>
            <p class="mb-2 font-light text-center text-white dark:text-white sm:text-xl">
                Don't wait, book your tickets today! Immerse yourself in the fascinating world of our zoo. Spaces are limited, so don't miss your chance for unforgettable experiences. See you at our zoo!
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-6">
                <div>
                    <form id="user-reservation-form" method="POST" action="{{ route('user-reservation.reserve') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="p-4 mt-3 mb-4 text-3xl text-red-600 rounded-lg bg-lime-950 dark:bg-lime-950 dark:text-red-600 font-extrabold" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                        <div class="mb-4">
                            <label for="visit-date" class="block text-2xl font-medium text-white tracking-wide">Select Date</label>
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-black dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input type="date" id="visit-date" name="visit-date" class="mt-1 block w-full p-2 pl-8 border-2 border-black rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-green-50" min="{{ date('Y-m-d') }}" max="{{ now()->addMonths(3)->toDateString() }}">
                            </div>
                        </div>
                        @foreach($tickets as $ticket)
                            <div class="mb-4">
                                <label for="quantity-{{ $ticket->id }}" class="mb-2 block text-1xl tracking-wide font-medium text-white">{{ $ticket->type }} - ${{ $ticket->price }}</label>
                                <div class="flex max-w-sm">
                                    <button type="button" class="bg-lime-950 dark:bg-lime-950 dark:hover:bg-lime-900 dark:border-black hover:bg-gray-200 border border-gray-300 rounded-l-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none" onclick="document.getElementById('quantity-{{ $ticket->id }}').stepDown()">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity-{{ $ticket->id }}" name="quantity[{{ $ticket->id }}]" class="w-full p-2 text-center border-t-2 border-b-2 border-black shadow-sm focus:ring-yellow-600 focus:border-yellow-600 sm:text-sm bg-green-50" min="0" max="40" value="0">
                                    <button type="button" class="bg-lime-950 dark:bg-lime-950 dark:hover:bg-lime-900 dark:border-black hover:bg-gray-200 border border-gray-300 rounded-r-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none" onclick="document.getElementById('quantity-{{ $ticket->id }}').stepUp()">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex pt-6">
                            <button type="submit" id="next-button" class="font-bold text-1xl bg-red-700 text-white px-10 py-4 rounded-md hover:bg-red-950 mr-5 shadow shadow-black">Book</button>
                        </div>
                        <div class="flex pt-6">
                            <p class="text-white font-bold">
                                You can book a maximum of 40 tickets of each type!
                            </p>
                        </div>
                    </form>
                </div>

                <div class="flex items-center justify-center mt-5 md:mt-3">
                    <img src="{{ asset('img/zoo_welcome.jpg') }}" alt="zoo image" class="rounded-3xl border-2 border-white">
                </div>
            </div>


        </div>
    </div>

    @include('shared.footer')
</body>
</html>
