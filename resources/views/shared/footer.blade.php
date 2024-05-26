<footer class="bg-lime-700 dark:bg-lime-700 flex flex-col items-center w-full text-white p-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 w-full mt-2">

        <div class="justify-center flex flex-col items-center"> <!-- Dodano klasę flex i flex-col -->
            <a href="https://github.com/Rolaski" class="flex-col items-center space-x-3 rtl:space-x-reverse"> <!-- Zmieniono klasę na flex-col -->
                <img src="{{ asset('img/zooland_icon.png') }}" class="h-40 w-full" alt="Zooland Logo" /> <!-- Dodano klasę w-full -->
                <p class="self-center text-5xl font-semibold whitespace-nowrap dark:text-white mt-4">Zooland</p> <!-- Przeniesiono tekst pod obrazkiem -->
            </a>
        </div>

        <div class="flex flex-col items-center text-center ">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                  </svg>

                <h1 class="text-3xl font-bold text-yellow-500">Opening hours</h1>
            </div>
            <p class="text-base mt-2">Mon - Fri: 9:00 AM - 6:00 PM</p>
            <p class="text-base mt-2">Sat: 9:00 AM - 5:00 PM</p>
            <p class="text-base mt-2">Sun: 10:00 AM - 4:00 PM</p>
            <p class="text-1xl mt-4">We invite you all year round except:</p>
            <p class="text-base mt-2">January 1 - closed</p>
            <p class="text-base mt-2">Easter Sunday – closed</p>
            <p class="text-base mt-2">November 1 – closed</p>
            <p class="text-base mt-2">December 24, 25 – closed</p>
        </div>

        <div class="flex flex-col items-center text-center">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                </svg>
                <h1 class="text-3xl font-bold text-yellow-500">Address</h1>
            </div>
            <p class="text-base mt-2">Poland, 35-399 Rzeszów</p>
            <p class="text-base mt-2">Krakowska 194th St.</p>
        </div>

        <div class="flex flex-col items-center text-center">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                  </svg>
                <h1 class="text-3xl font-bold text-yellow-500">Contact</h1>
            </div>
            <p class="text-base mt-2">+48 697 931 854</p>
            <p class="text-base mt-2">+48 984 245 787</p>
            <p class="text-base mt-2">contact@zooland.pl</p>
        </div>

    </div>
    <hr class="my-6 border-white sm:mx-auto dark:border-white lg:my-8 w-full" />
    <div class="flex items-center justify-center w-full">
        <span class="text-sm text-white dark:text-white">© 2024 Zooland. All Rights Reserved.</span>
    </div>
</footer>
