@php
    use Carbon\Carbon;
@endphp

@extends("layout.index")

@section("content")
    <main class="d-flex flex-column">
        <div>
            <div class="d-flex align-items-center justify-content-between">
                <h2>{{__("employee.headerSingle")}}</h2>
                <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{route("list")}}">{{__("employee.backHomePage")}}</a>
            </div>
            <p>{{__("employee.name")}}: {{$employee->first_name}}</p>
            <p>{{__("employee.lastName")}}: {{$employee->last_name}}</p>
            <p>{{__("employee.gender")}}: {{$employee->gender == 'M' ? __("employee.man") : __("employee.woman")}}</p>
            <p>{{__("employee.hire_date")}}: {{$employee->hire_date}}</p>
            <p>{{__("employee.questionManager")}}: {{count($employee->manager)>0 ? __("employee.yes") : __("employee.no")}}</p>
            <p>{{__("employee.department")}}: {{$employee->departments[0]->dept_name}}</p>
            <p>{{__("employee.hire_date")}}: {{$employee->hire_date}}</p>
            <p>{{__("employee.title")}}: {{$employee->titles[0]->title}}</p>
            <p>{{__("employee.salary")}}: {{$employee->salaries[0]->salary}}</p>
        </div>
        <div class="d-flex">
            <div class="m-5">
                <h4 class="mt-3">{{__('employee.historySalary')}}</h4>
                @if ($employee->salaries)
                    <table class="table">
                        <thead>
                            <th>{{__('employee.lp')}}</th>
                            <th>{{__('employee.salary')}}</th>
                            <th>{{__('employee.from')}}</th>
                            <th>{{__('employee.to')}}</th>
                        </thead>    
                        <tbody>
                            @foreach ($employee->salaries as $salary)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$salary->salary}}</td>
                                    <td>{{$salary->from_date }}</td>
                                    <td>{{Carbon::parse($salary->to_date)->eq(Carbon::parse('9999-01-01')) ?  __("employee.now") : Carbon::parse($salary->to_date)->format("d-m-Y")}}</td>
                                </tr>
                            @endforeach
                        </tbody>   
                    </table>
                    <p>{{__('Suma wszystkich wypłat')}}: <b>{{$employee->sumSalaries()}}</b></p>
                @else
                    <h4 class="mt-3">{{__('employee.noEmployeeData')}}
                @endif

            </div>
            <div class="m-5">
                <h4 class="mt-3">{{__('employee.historyTitle')}}</h4>
                @if ($employee->titles)
                <table class="table">
                        <thead>
                            <th>{{__('employee.lp')}}</th>
                            <th>{{__('employee.title')}}</th>
                            <th>{{__('employee.from')}}</th>
                            <th>{{__('employee.to')}}</th>
                        </thead>    
                        <tbody>
                            @foreach ($employee->titles as $title)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$title->title}}</td>
                                    <td>{{Carbon::parse($title->from_date)->format('d-m-Y')}}</td>
                                    <td>{{Carbon::parse($title->to_date)->eq(Carbon::parse('9999-01-01')) ?  __('employee.now') : Carbon::parse($title->to_date)->format('d-m-Y')}}</td>
                                </tr>
                            @endforeach
                        </tbody>   
                    </table>
                @else
                    <h4 class="mt-3">{{__('employee.noEmployeeData')}}
                @endif
            </div>
            <div class="m-5">
                <h4 class="mt-3">{{__('employee.historyDepartment')}}</h4>
                @if ($employee->departments)
                <table class="table">
                        <thead>
                            <th>{{__('employee.lp')}}</th>
                            <th>{{__('employee.department')}}</th>
                            <th>{{__('employee.from')}}</th>
                            <th>{{__('employee.to')}}</th>
                        </thead>    
                        <tbody>
                            @foreach ($employee->departments as $department)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$department->dept_name}}</td>
                                    <td>{{Carbon::parse($department->pivot->from_date)->format('d-m-Y')}}</td>
                                    <td>{{Carbon::parse($department->pivot->to_date)->eq(Carbon::parse('9999-01-01')) ?  __('employee.now') : Carbon::parse($department->pivot->to_date)->format('d-m-Y')}}</td>
                                </tr>
                            @endforeach
                        </tbody>   
                    </table>
                @else
                    <h4 class="mt-3">{{__('employee.noEmployeeData')}}
                @endif
            </div>
        </div>
    </main>
@endsection