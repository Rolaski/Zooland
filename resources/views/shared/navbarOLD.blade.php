<nav class="bg-lime-700 border-gray-200 w-full">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://github.com/Rolaski" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="{{ asset('img/zooland_icon.png') }}"  class="h-20" alt="Zooland Logo" />
          <span class="self-center text-3xl font-semibold whitespace-nowrap dark:text-white">Zooland</span>
      </a>
      <div class="hidden md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-lime-700 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-g9 dark:bg-lime-700 md:dark:bg-g9 dark:border-gray-700">
          <li>
            <a href="{{route('home')}}" class="font-bold text-3xl block py-2 px-3 text-white rounded hover:bg-g10 md:hover:bg-transparent md:border-0 md:hover:text-white md:p-0 dark:text-white md:dark:hover:text-red-700 dark:hover:bg-g10 dark:hover:text-white md:dark:hover:bg-transparent md:text-g5" aria-current="page">Home</a>
          </li>
          <li>
            <a href="{{route('home')}}#section2" class="font-bold text-3xl block py-2 px-3 text-white rounded hover:bg-g10 md:hover:bg-transparent md:border-0 md:hover:text-white md:p-0 dark:text-white md:dark:hover:text-red-700 dark:hover:bg-g10 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
          </li>
          <li>
            <a href="{{route('home')}}#section1" class="font-bold text-3xl block py-2 px-3 text-white rounded hover:bg-g10 md:hover:bg-transparent md:border-0 md:hover:text-white md:p-0 dark:text-white md:dark:hover:text-red-700 dark:hover:bg-g10 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
          </li>
          <li>
            <a href="{{route('home')}}#section3" class="font-bold text-3xl block py-2 px-3 text-white rounded hover:bg-g10 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-700 dark:hover:bg-g10 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
          </li>
          <li>
            <a href="{{route('home')}}#section3" class="font-bold text-3xl block py-2 px-3 text-white rounded hover:bg-g10 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-700 dark:hover:bg-g10 ark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
          </li>
          <li>
            <a href="{{route('terms-and-condition')}}" class="font-bold text-3xl block py-2 px-3 text-white rounded hover:bg-g10 md:hover:bg-transparent md:border-0 md:hover:text-red-700 md:p-0 dark:text-white md:dark:hover:text-red-700 dark:hover:bg-g10 ark:hover:text-white md:dark:hover:bg-transparent">Rules</a>
          </li>
        </ul>
      </div>
      <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse mt-3">
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-white dark:hover:bg-yellow-500 dark:focus:ring-black" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <!-- Button Log in -->
        @guest
        <div class="flex items-center">
            <a href="{{ route('login') }}" class="text-2xl font-extrabold shadow shadow-black text-white bg-red-700 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300  rounded-lg px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-700 dark:hover:bg-red-900 dark:focus:ring-yellow-900">Log in</a>
            <a href="{{ route('register') }}" class="text-2xl font-extrabold shadow shadow-black text-white bg-yellow-700 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300  rounded-lg px-5 py-2.5 text-center mr-2 mb-2 dark:bg-yellow-700 dark:hover:bg-yellow-500 dark:focus:ring-yellow-900">Register</a>
        </div>
        @endguest

        @auth
        <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img class="size-12 rounded-full" src="{{ Auth::user()->avatar ? asset('img/avatars/' . Auth::user()->avatar) : asset('img/avatars/default.png') }}" alt="user photo">


        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
            <div class="px-4 py-3">
                <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-sm text-white dark:text-white dark:hover:text-white">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth
    </div>
    </div>
  </nav>

