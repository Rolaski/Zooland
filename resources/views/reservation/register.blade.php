@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
<body class="bg-green-50">
    @include('shared.navbar')


    <div class="max-w-md mx-auto my-10 bg-lime-700 rounded-lg overflow-hidden shadow-lg">
        <div class="px-6 py-4">
            <h2 class="text-4xl font-bold text-center mb-2 text-yellow-500">Register</h2>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-white text-sm font-bold mb-2">Name</label>
                    <input id="name" placeholder="Your name" type="text" class="form-input w-full rounded-lg bg-green-50 border-black focus:border-yellow-600 focus:ring-yellow-600" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="surname" class="block text-white text-sm font-bold mb-2">Surname</label>
                    <input id="surname" placeholder="Your surname" type="text" class="form-input w-full rounded-lg bg-green-50 border-black focus:border-yellow-600 focus:ring-yellow-600" name="surname" value="{{ old('surname') }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white text-sm font-bold mb-2">Email</label>
                    <input id="email" placeholder="email@gmail.com" type="email" class="form-input w-full rounded-lg bg-green-50 border-black focus:border-yellow-600 focus:ring-yellow-600" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white text-sm font-bold mb-2">Password</label>
                    <input id="password" placeholder="password" type="password" class="form-input w-full rounded-lg bg-green-50 border-black focus:border-yellow-600 focus:ring-yellow-600" name="password" required autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-white text-sm font-bold mb-2">Confirm Password</label>
                    <input id="password_confirmation"  placeholder="password" type="password" class="form-input w-full rounded-lg bg-green-50 border-black focus:border-yellow-600 focus:ring-yellow-600" name="password_confirmation" required autocomplete="new-password">
                </div>

                <!-- Password check -->
                @error('password')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                <div class="mb-4">
                    <label for="avatar" class="block text-white text-sm font-bold mb-2">Avatar</label>
                    <input id="avatar" type="file" class="form-input w-full text-white" name="avatar" accept="image/*" required>
                </div>

                <div class="mb-4">
                    <input type="hidden" name="role" value="user">
                </div>

                <div class="flex">
                    <button type="submit" class="w-full bg-red-700 hover:bg-red-900 text-white font-bold my-3 py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">Register</button>
                </div>
            </form>
        </div>
    </div>


    @include('shared.footer')
</body>
</html>
