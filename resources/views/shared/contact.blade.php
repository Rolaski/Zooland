<div class="flex justify-center w-full md:h-full">
    <section class="w-full rounded-lg bg-lime-700 dark:bg-lime-700">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-white dark:text-yellow-500">Contact Us</h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-white dark:text-white sm:text-xl">Have a question about our animals? Want to share your experience or provide feedback? Interested in learning more about our educational programs and events? Reach out to us!</p>
            <form id="contact-form" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-1xl tracking-wide font-medium text-white dark:text-white">Your email</label>
                    <input type="email" id="email" class="shadow-sm bg-green-50 border border-black text-black text-sm rounded-lg focus:ring-yellow-600  focus:border-yellow-600 block w-full p-2.5 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600  dark:focus:border-yellow-600 dark:shadow-sm-light" placeholder="name@email.com" required>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-1xl tracking-wide font-medium text-white dark:text-white">Subject</label>
                    <input type="text" id="subject" class="block p-3 w-full text-sm text-black bg-green-50 rounded-lg border border-black shadow-sm focus:ring-yellow-600  focus:border-primary-500 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600  dark:focus:border-yellow-600  dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-1xl tracking-wide font-medium text-white dark:text-white">Your message</label>
                    <textarea id="message" rows="6" class="block p-2.5 w-full text-sm text-black bg-green-50 rounded-lg shadow-sm border border-black focus:ring-yellow-600  focus:border-primary-500 dark:bg-green-50 dark:border-black dark:placeholder-gray-400 dark:text-black dark:focus:ring-yellow-600  dark:focus:border-yellow-600 " placeholder="Leave a comment..." required></textarea>
                </div>
                <button class="py-3 px-5 text-1xl tracking-wide font-medium text-center text-white rounded-lg bg-red-700 sm:w-fit hover:bg-red-950 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-red-700 dark:hover:bg-red-950 dark:focus:ring-primary-800 shadow shadow-black">Send message</button>
            </form>
        </div>
    </section>
</div>

<script>
    document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Zapobiega domyślnemu zachowaniu formularza (np. odświeżeniu strony)

        // Czyszczenie pól formularza
        document.getElementById('email').value = '';
        document.getElementById('subject').value = '';
        document.getElementById('message').value = '';

        // Opcjonalnie: wyświetlenie komunikatu o powodzeniu wysłania wiadomości
        alert('Message sent successfully!');
    });
</script>
