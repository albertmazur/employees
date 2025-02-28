@extends("layout.index")

@section("content")
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="d-flex flex-column justify-content-center text-center pt-8 sm:justify-start sm:pt-0">
            <div class="px-4 fs-1 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                @yield('code')
            </div>

            <div class="ml-4 fs-3 text-lg text-gray-500 uppercase tracking-wider">
                @yield('message')
            </div>
        </div>
    </div>
@endsection
