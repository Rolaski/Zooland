<div>
    <div class="bg-green-50 dark:bg-green-50 mt-5 mb-5 flex justify-center">
        <div class="w-full max-w-lg mx-auto p-6 border rounded-lg shadow-lg bg-lime-800 dark:bg-lime-700">
            <form method="POST" action="{{ route('guest.reservation.submit') }}">
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

                @if (session('status'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" id="reservation_date" name="reservation_date" value="{{ $visitDate }}">

                @foreach($quantities as $ticketId => $quantity)
                <input type="hidden" name="quantity[{{ $ticketId }}]" value="{{ $quantity }}">
                @endforeach


                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="guest_name" class="block mb-2 text-sm font-medium text-white dark:text-white">First name</label>
                        <input type="text" name="guest_name" id="guest_name" class="bg-green-50 border border-black text-black text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600 dark:focus:border-yellow-600" placeholder="John" required />
                    </div>
                    <div>
                        <label for="guest_surname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                        <input type="text" name="guest_surname" id="guest_surname" class="bg-green-50 border border-black text-black text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600 dark:focus:border-yellow-600" placeholder="Doe" required />
                    </div>
                </div>
                <div class="mb-6">
                    <label for="guest_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                    <input type="email" name="guest_email" id="guest_email" class="bg-green-50 border border-black text-black text-sm rounded-lg focus:ring-yellow-600 focus:border-yellow-600 block w-full p-2.5 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600 dark:focus:border-yellow-600" placeholder="john.doe@company.com" required />
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-black rounded bg-gray-50 focus:ring-3 focus:ring-yellow-600 dark:bg-white dark:border-black dark:focus:ring-yellow-600 dark:ring-offset-gray-800" required />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="{{ route('terms-and-condition') }}" class="text-yellow-500 hover:underline dark:text-yellow-500 font-bold">terms and conditions</a>.</label>
                </div>
                <div>
                    <div class="mb-4 text-center">
                        <p class="text-white text-lg font-bold">Visit Date: {{ $visitDate }}</p>
                    </div>
                    @foreach($quantities as $ticketId => $quantity)
                        @if ($quantity > 0)
                            @php
                                $ticketType = $tickets->where('id', $ticketId)->first()->type;
                            @endphp
                            <div class="mb-4">
                                <p class="text-white text-1xl font-medium">{{ $ticketType }}: {{ $quantity }} ticket(s)</p>
                            </div>
                            <hr class="my-4 border-yellow-600 dark:border-yellow-600">
                        @endif
                    @endforeach
                </div>
                <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-red-700 dark:hover:bg-red-900 dark:focus:ring-red-950 mb-3">Book now</button>
                <p class="text-1xl font-light text-white dark:text-white">
                    Already have an account? <a href="#" class="text-1xl font-medium text-yellow-500 hover:underline dark:text-yellow-500">Sign up</a>
                </p>
            </form>
        </div>
    </div>
