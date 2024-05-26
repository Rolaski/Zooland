@include('shared.html')
    @include('shared.head', ['pageTitle' => "Welcome to ZooLand!"])
    <body class="bg-green-50">
        @include('shared.navbar')
        @include('main.carousel')
        @include('main.content')
        @include('main.article')
        @include('main.section')
        @include('shared.footer')
    </body>
</html>
