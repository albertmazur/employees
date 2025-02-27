<form  action="{{route("list")}}" method="get" class="border p-2 m-2 rounded-4">
    <h2 class="m-3">{{__("employee.find")}}</h2>
    <div class="d-flex">
        <div class="flex-fill">
            <div class="form-group m-3">
                <label class="h5">
                    {{__("employee.name")}}
                    <input type="text" name="first-name" class="form-control" @isset($data['first-name']) value="{{$data['first-name']}}" @endisset placeholder="{{__("employee.name")}}" />
                </label>
                <br>
                <label class="h5">
                    {{__("employee.lastName")}}
                    <input type="text" name="last-name" class="form-control" @isset($data['last-name']) value="{{$data['last-name']}}" @endisset placeholder="{{__("employee.lastName")}}" />
                </label>
            </div>
        </div>
        <div class="flex-fill">
            <div class="form-group mx-3 w-75">
                <label class="h5">{{__("employee.department")}}:</label>
                <select class="form-control" name="department">
                    <option @selected(is_null($data['department'])) value="">{{__("employee.form.everything")}}</option>
                    @foreach ($departmentAll as $d)
                        <option @selected($data['department']==$d->dept_no) value="{{$d->dept_no}}">{{$d->dept_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-3">
                <label class="h5">{{__("employee.salary")}}:</label>
                <div class="d-flex">
                    <div class="me-1">
                        <input type="number" class="form-control" name="minSalary" @isset($data['minSalary']) value="{{$data['minSalary']}}" @endisset placeholder="{{__("employee.form.min")}}" aria-label="minimum salary">
                    </div>
                    <div class="ms-1">
                        <input type="number" class="form-control" name="maxSalary" @isset($data['maxSalary']) value="{{$data['maxSalary']}}" @endisset placeholder="{{__("employee.form.max")}}" aria-label="maximum salary">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-fill">
            <div class="form-group m-3">
                <label class="h5">{{__("Płeć")}}:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="gender" value="" @checked(is_null($data['gender']))>
                    <label class="form-check-label">
                        {{__("employee.form.everyone")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="gender" value="M" @checked($data['gender']=="M")>
                    <label class="form-check-label">
                        {{__("employee.men")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="gender" value="F" @checked($data['gender']=="F")>
                    <label class="form-check-label">
                        {{__("employee.women")}}
                    </label>
                </div>
            </div>
            <div class="form-group m-3">
                <label class="h5">{{__("employee.employees")}}:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="presence" value="" @checked(is_null($data['presence']))>
                    <label class="form-check-label">
                        {{__("employee.form.everyone")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="presence" value="present" @checked($data['presence']=="present")>
                    <label class="form-check-label">
                        {{__("employee.form.present")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="presence" value="absent" @checked($data["presence"]=="absent")>
                    <label class="form-check-label">
                        {{__("employee.form.absent")}}
                    </label>
                </div>
            </div>
        </div>
    </div>    

    <div class="form-group d-flex m-3">
        <button class="btn btn-primary" type="submit">{{__("employee.find")}}</button>
        <div class="ms-auto">
            <button type="button" id="downloadButton" class="btn btn-dark ms-auto">{{__("employee.form.buttons.export")}}</button>
            <button type="button" id="resetExport" class="btn btn-secondary ms-auto">{{__("employee.form.buttons.resetExport")}}</button>
        </div>

    </div>
    <div class="text-end me-3">
        <p class="text-danger" id="export-error-message"></p>
        <p>{{__("employee.form.textExport")}}: <span id="count-export">0</span></p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger m-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
