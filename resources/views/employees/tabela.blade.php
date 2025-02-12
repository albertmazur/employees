@extends("layout.index")

@section("content")
    @include("employees.form")
    <div class="border p-2 m-2 rounded-4">
        <table class="table table-striped">
            <thead>
                @section("headerTable")
                    <tr class="text-center">
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
                @foreach ($employees as $e)
                    <tr class="text-center">
                        <td>{{$e->emp_no}}</td>
                        <td>{{$e->first_name}}</td>
                        <td>{{$e->last_name}}</td>
                        <td>{{$e->gender}}</td>
                        <td>{{$e->currentDepartment()->dept_name}}</td>
                        <td>{{$e->currentTitle()->title}}</td>
                        <td>{{$e->currentSalary()->salary}}</td>
                        <td class="d-flex justify-content-center"><input class="form-check-input border border-dark " type="checkbox" name="employee_ids[]" value="{{$e->emp_no}}"></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>@yield("headerTable")</tfoot>
        </table>
        <div>
            {{$employees->links()}}
        </div>
    </div>
@endsection



