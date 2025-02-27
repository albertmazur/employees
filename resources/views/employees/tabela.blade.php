@extends("layout.index")

@section("content")
    @include("employees.form")
    <div class="border p-2 m-2 rounded-4">
        <table class="table table-striped">
            <thead>
                @section("headerTable")
                    <tr class="text-center">
                        <th>Id</th>
                        <th>{{__("employee.name")}}</th>
                        <th>{{__("employee.lastName")}}</th>
                        <th>{{__("employee.salary")}}</th>
                        <th>{{__("employee.department")}}</th>
                        <th>{{__("employee.title")}}</th>
                        <th>{{__("employee.salary")}}</th>
                        <th>{{__("employee.export")}}</th>
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
                        <td>{{$e->gender == 'M' ? __('employee.man') : __('employee.woman')}}</td>
                        <td>{{$e->departments[0]->dept_name}}</td>
                        <td>{{$e->titles[0]->title}}</td>
                        <td>{{$e->salaries[0]->salary}}</td>
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

    <script>
        const translations = @json(__('messages'));
    </script> 
@endsection
