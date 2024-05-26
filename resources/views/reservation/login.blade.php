@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
<body class="bg-green-50">
    @include('shared.navbar')

    <section class="bg-green-50 dark:bg-green-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-4/5 lg:py-0 my-5 md:my-11">
            <div class="w-full bg-white rounded-lg shadow-lg shadow-black md:mt-0 sm:max-w-md xl:p-0 dark:bg-lime-700 dark:border-black">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-2xl text-center font-bold leading-tight tracking-tight text-yellow-500 md:text-2xl dark:text-yellow-500">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-1xl font-medium text-white dark:text-white">Your email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="bg-green-50 border border-black text-black sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600 dark:focus:border-yellow-600" placeholder="email@gmail.com">
                            @error('email')
                                <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-1xl font-medium text-gray-900 dark:text-white">Password</label>
                            <input id="password" type="password" name="password" required class="bg-green-50 border border-black text-black sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600 dark:focus:border-yellow-600" placeholder="password">
                            @error('password')
                                <span class="text-sm text-red-700 dark:text-red-400 font-bold">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-900 focus:outline-none font-bold rounded-lg text-1xl px-5 py-2.5 text-center dark:bg-red-700 dark:hover:bg-red-900 ">Log in</button>
                        <p class="text-1xl font-light text-gray-500 dark:text-white">
                            Don’t have an account yet? <a href="{{route ('register')}}" class="font-medium text-primary-600 hover:underline dark:text-yellow-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('shared.footer')
</body>
</html>
