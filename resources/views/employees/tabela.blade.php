@extends("layout.index")

@section("content")
    @include("employees.form")
    <div class="border p-2 m-2 rounded-4">
        <table class="table table-striped">
            <thead>
                @section("headerTable")
                    <tr>
                        <th>Id</th>
                        <th>{{__("Imię")}}</th>
                        <th>{{__("Nazwisko")}}</th>
                        <th>{{__("Płeć")}}</th>
                        <th>{{__("Department")}}</th>
                        <th>{{__("Tytuł")}}</th>
                        <th>{{__("Pensja")}}</th>
                        <th>{{__("Do exportu")}}</th>
                    </tr>
                @endsection

                @yield("headerTable")
            </thead>
            <tbody class="table-group-divider">
                <form id="checkboxForm" action="{{route("download")}}" method="get">
                    @foreach ($employees as $e)
                        <tr>
                            <td>{{$e->emp_no}}</td>
                            <td>{{$e->first_name}}</td>
                            <td>{{$e->last_name}}</td>
                            <td>{{$e->gender}}</td>
                            <td>{{$e->currentDepartment()->dept_name}}</td>
                            <td>{{$e->currentTitle()->title}}</td>
                            <td>{{$e->currentSalary()->salary}}</td>
                            <td><input class="form-check-input" type="checkbox" name="id[]" value="{{$e->emp_no}}"></td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
            <tfoot>@yield("headerTable")</tfoot>
        </table>
        <div>
            {{$employees->links()}}
        </div>
    </div>
@endsection



