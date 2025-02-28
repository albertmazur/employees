@extends("layout.index")

@section("content")
    <div class="max-w-xl mt-5 mx-auto sm:px-6 lg:px-8">
        <div class="d-flex flex-column justify-content-center text-center pt-8 sm:justify-start sm:pt-0">
            <div class="px-4 fs-1 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                @yield('code')
            </div>

            <div class="ml-4 mb-3 fs-3 text-lg text-gray-500 uppercase tracking-wider">
                @yield('message')
            </div>
            <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{route("list")}}">{{ __("employee.backHomePage") }}</a>
        </div>
    </div>
@endsection
