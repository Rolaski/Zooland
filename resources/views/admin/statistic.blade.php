@include('shared.html')
@include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
<body class="bg-green-50">
    @include('shared.navbar')

    <div class="container mx-auto my-8">
        <div class="bg-white p-6 rounded-lg shadow-2xl shadow-black">
            <h1 class="text-4xl font-extrabold text-red-700 mb-4">Number of tickets booked by type</h1>
            <div id="chart" class="overflow-auto"></div>
        </div>
    </div>

    @include('shared.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [{
                    name: 'Booked',
                    data: [
                        @foreach($popularTickets as $ticket)
                            {{ $ticket->total_quantity }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                xaxis: {
                    categories: [
                        @foreach($popularTickets as $ticket)
                            '{{ $ticket->type }}',
                        @endforeach
                    ]
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
</body>
</html>
