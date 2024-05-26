@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
<body class="bg-green-50">
    @include('shared.navbar')

    <div class="max-w-md mx-auto my-10 bg-lime-700 rounded-lg overflow-hidden shadow-lg">
        <div class="px-6 py-4">
            <h2 class="text-4xl font-bold text-center mb-2 text-yellow-500">Edit Profile</h2>
            @if (session('success'))
                <div class="bg-green-950 text-white p-4 rounded mb-4">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                      </svg>
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-white text-sm font-bold mb-2">Name</label>
                    <input id="name" type="text" class="form-input w-full" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="surname" class="block text-white text-sm font-bold mb-2">Surname</label>
                    <input id="surname" type="text" class="form-input w-full" name="surname" value="{{ old('surname', $user->surname) }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" class="form-input w-full" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white text-sm font-bold mb-2">Password</label>
                    <input id="password" type="password" class="form-input w-full" name="password" autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-white text-sm font-bold mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-input w-full" name="password_confirmation" autocomplete="new-password">
                    <!-- Password check -->
                    @error('password')
                        <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="avatar" class="block text-white text-sm font-bold mb-2">Avatar</label>
                    <input id="avatar" type="file" class="form-input w-full text-white" name="avatar" accept="image/*">
                </div>

                <div class="mt-0">
                    @if($user->avatar)
                        <label for="avatar" class="text-white font-bold text-lg">Your current avatar:</label>
                        <img src="{{ asset('img/avatars/'.$user->avatar) }}" alt="Avatar" class="mt-2 rounded-md">
                    @endif
                </div>

                <div class="flex mt-3">
                    <button type="submit" class="w-full bg-red-700 hover:bg-red-900 text-white font-bold my-3 py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">Update</button>
                </div>
            </form>
        </div>
    </div>


    @include('shared.footer')
</body>
</html>
