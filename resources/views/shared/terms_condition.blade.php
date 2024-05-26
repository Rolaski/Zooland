@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
    <body class="bg-green-50">
            @include('shared.navbar')

            <div class="flex items-center justify-center min-h-screen bg-green-50 my-3 md:my-6 text-white">
                <div class="bg-lime-900 rounded-lg shadow-2xl shadow-black p-6 max-w-3xl w-full">
                    <h2 class="text-5xl text-center font-extrabold mb-4 text-yellow-500">Zoo Regulations</h2>
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold mb-2 text-yellow-500">Regulations</h3>
                        <p>Please adhere to all zoo regulations for the safety and enjoyment of all visitors and animals.</p>
                        <ul class="list-disc list-inside mb-4">
                            <li>Respect the Animals: Do not feed, tease, or provoke the animals. Maintain a safe distance from all enclosures and do not attempt to touch or climb over barriers.</li>
                            <li>Supervise Children: Children must be supervised at all times. Ensure they follow zoo rules and stay within designated paths and viewing areas.</li>
                            <li>No Smoking: Smoking is prohibited throughout the zoo premises to ensure a healthy and clean environment for all.</li>
                            <li>Keep the Zoo Clean: Dispose of trash and recycling in designated bins. Do not litter or leave waste in any areas.</li>
                            <li>Follow Signage: Adhere to all posted signs and guidelines, including restricted areas and safety notices.</li>
                            <li>Photography: Non-commercial photography is allowed. However, do not use flash as it can disturb the animals.</li>
                            <li>Noise Control: Keep noise levels to a minimum to avoid stressing the animals and disturbing other visitors.</li>
                            <li>Pets: Pets are not allowed within the zoo premises to prevent any potential harm to the zoo animals or visitors.</li>
                            <li>Emergency Procedures: Follow staff instructions during emergencies and evacuations. Familiarize yourself with the nearest exits and emergency procedures.</li>
                        </ul>
                        <p>We appreciate your cooperation in following these regulations to ensure a safe and enjoyable experience for everyone. Thank you for your understanding and support.</p>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2 text-yellow-500" id="ticketInfo">Ticket Conditions and Types</h3>
                        <ul class="list-disc list-inside mb-4">
                            <li>Normal Ticket - For all visitors</li>
                            <li>Discounted Ticket - For children and youth up to 26 years old</li>
                            <li>Senior Ticket - For visitors 65 years and older</li>
                            <li>VIP Ticket - Experience a full day with our staff, including animal feeding sessions, private conferences, and the opportunity to name a chosen animal</li>
                        </ul>
                        <p>Please note that tickets are non-refundable and must be used on the date specified at the time of purchase. Discounted tickets require proof of age or student status at the time of entry. Each ticket type grants access to all regular exhibits and shows. VIP ticket holders enjoy additional exclusive benefits such as behind-the-scenes tours and interactions with our animal caretakers.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2 text-yellow-500" >Ticket Descriptions</h3>
                        <div class="mb-4">
                            <h4 class="text-lg font-semibold mb-1">Normal Ticket</h4>
                            <p>Our standard ticket grants you access to all regular exhibits, shows, and animal encounters. This ticket is perfect for families, friends, and solo visitors looking to explore the zoo at their own pace.</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-lg font-semibold mb-1">Discounted Ticket</h4>
                            <p>Available for children and youth up to 26 years old, the discounted ticket offers the same benefits as the normal ticket at a reduced price. Please bring valid identification or proof of student status to qualify for this discount.</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-lg font-semibold mb-1">Senior Ticket</h4>
                            <p>For visitors aged 65 and older, the senior ticket provides access to all regular exhibits and shows at a reduced rate. Enjoy a leisurely day at the zoo with all the same benefits as our normal ticket holders.</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold mb-1">VIP Ticket</h4>
                            <p>The VIP ticket offers a unique, all-inclusive experience. Spend a full day with our staff, participate in animal feeding sessions, attend private conferences, and even get the opportunity to name a chosen animal. This ticket provides an exclusive, behind-the-scenes look at the zoo and its operations.</p>
                        </div>
                    </div>
                </div>
            </div>
            @include('shared.footer')
    </body>
</html>
