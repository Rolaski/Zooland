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
        @if ($errors->has('email'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.828 17.657A10 10 0 1 0 17.657 2.828 10 10 0 0 0 2.828 17.657ZM10 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16ZM11 12a1 1 0 0 0-1 1v1a1 1 0 0 0 2 0v-1a1 1 0 0 0-1-1Zm0-4a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0v-3a1 1 0 0 0-1-1Z"/>
                </svg>
                {{ $errors->first('email') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-4xl font-extrabold text-red-700">User Management</h2>
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="toggleAddUserForm()">Add New User</a>
        </div>

        <!-- Form for adding new user -->
        <div id="addUserForm" class="hidden mb-8">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col mb-4">
                    <label for="name" class="text-lg font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="surname" class="text-lg font-bold mb-2">Surname</label>
                    <input type="text" name="surname" id="surname" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="email" class="text-lg font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="password" class="text-lg font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="border rounded-lg px-3 py-2" required>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="role" class="text-lg font-bold mb-2">Role</label>
                    <select name="role" id="role" class="border rounded-lg px-3 py-2" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="flex flex-col mb-4">
                    <label for="avatar" class="text-lg font-bold mb-2">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="border rounded-lg px-3 py-2" required>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold text-2xl py-3 px-8 rounded">Add User</button>
            </form>
        </div>

        <!-- Display existing users -->
        <div class="grid grid-cols-1 gap-4">
            @foreach($users as $user)
                @if($user->id !== 1)
                    <div class="bg-lime-700 shadow-2xl shadow-black rounded-2xl px-8 pt-6 pb-8 mb-4 text-white">
                        <div class="mb-4">
                            <p class="text-2xl font-bold text-yellow-500">Name:
                                <span class="text-white">{{ $user->name }} </span>
                            </p>
                            <hr class="my-3 border-t border-yellow-500">
                            <p class="text-2xl font-bold text-yellow-500">Surname:
                                <span class="text-white">{{ $user->surname }}</span>
                            </p>
                            <hr class="my-2 border-t border-yellow-500">
                            <p class="text-2xl font-bold text-yellow-500">Role:
                                <span class="text-white">{{ $user->role }}</span>
                            </p>
                            <hr class="my-2 border-t border-yellow-500">
                            <p class="text-2xl font-bold text-yellow-500">Email:
                                <span class="text-white">{{ $user->email }}</span>
                            </p>
                            <hr class="my-2 border-t border-yellow-500">
                        </div>
                        <div class="mb-4">
                            @if($user->avatar)
                                <img src="{{ asset('img/avatars/' . $user->avatar) }}" alt="Avatar" class="rounded-full h-24 w-24">
                            @else
                                <div class="rounded-full h-16 w-16 bg-gray-300"></div>
                            @endif
                        </div>
                        <div class="flex justify-end">
                            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-4 px-12 rounded mr-2 md:mr-5 text-2xl" onclick="toggleEditUserForm({{ $user->id }})">Edit</button>
                            <form id="deleteForm_{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-4 px-12 rounded text-2xl">Delete</button>
                            </form>
                        </div>
                        <div id="editUserForm_{{ $user->id }}" class="hidden mb-4 text-black">
                            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="flex flex-col mb-4">
                                    <label for="name" class="text-lg font-bold mb-2 text-white">Name</label>
                                    <input type="text" name="name" id="name" class="border rounded-lg px-3 py-2" value="{{ $user->name }}" required>
                                    @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-4">
                                    <label for="surname" class="text-lg font-bold mb-2 text-white">Surname</label>
                                    <input type="text" name="surname" id="surname" class="border rounded-lg px-3 py-2" value="{{ $user->surname }}" required>
                                    @error('surname')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-4">
                                    <label for="email" class="text-lg font-bold mb-2 text-white">Email</label>
                                    <input type="email" name="email" id="email" class="border rounded-lg px-3 py-2" value="{{ $user->email }}" required>
                                    @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-4">
                                    <label for="password" class="text-lg font-bold mb-2 text-white">Password</label>
                                    <input type="password" name="password" id="password" class="border rounded-lg px-3 py-2">
                                    <small class="text-gray-200">Leave blank to keep current password</small>
                                    @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-4">
                                    <label for="role" class="text-lg font-bold mb-2 text-white">Role</label>
                                    <select name="role" id="role" class="border rounded-lg px-3 py-2" required>
                                        <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                        <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                    @error('role')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex flex-col mb-4">
                                    <label for="avatar" class="text-lg font-bold mb-2 text-white">Avatar</label>
                                    <input type="file" name="avatar" id="avatar_{{ $user->id }}" class=" rounded-lg px-3 py-2">
                                    @error('avatar')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-2xl py-3 px-8 rounded mr-2 md:mr-4">Save</button>
                                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold text-2xl py-3 px-8 rounded" onclick="toggleEditUserForm({{ $user->id }})">Cancel</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <hr class="my-4">
                @endif
            @endforeach
        </div>
    </div>

    @include('shared.footer')

    <script>
        function toggleAddUserForm() {
            var form = document.getElementById('addUserForm');
            form.classList.toggle('hidden');
        }

        function toggleEditUserForm(userId) {
            var form = document.getElementById('editUserForm_' + userId);
            form.classList.toggle('hidden');
        }
    </script>
</body>
</html>
