<form  action="{{route("list")}}" method="get" class="border p-2 m-2 rounded-4">
    <h2 class="m-3">{{__("Szukaj")}}</h2>
    <div class="d-flex">
        <div>
            <div class="form-group mx-3 d-inline-block w-75">
                <h5>{{__("Departament")}}:</h5>
                <select class="form-control" name="department">
                <option @if ($department=="all" || $department==null) selected @endif value="all">{{__("Wszystkie")}}</option>
                @foreach ($departmentAll as $d)
                <option @if ($department==$d->dept_no) selected @endif value="{{$d->dept_no}}">{{$d->dept_name}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group m-3 d-l">
                <h5>{{__("Pensja")}}:</h5>
                <div class="row">
                    <div class="col-6">
                    <input type="number" class="form-control" name="minSalary" @isset($minSalary) value="{{$minSalary}}" @endisset placeholder="Min:" aria-label="minimum salary">
                    </div>
                    <div class="col-6">
                    <input type="number" class="form-control" name="maxSalary" @isset($maxSalary) value="{{$maxSalary}}" @endisset placeholder="Max:" aria-label="maximum salary">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="form-group m-3">
                <h5>{{__("Płeć")}}:</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="all" @if($gender=="all" || $gender==null) checked @endif>
                    <label class="form-check-label">
                        {{__("Wszyscy")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="M" @if($gender=="M") checked @endif>
                    <label class="form-check-label">
                        {{__("Mężczyźni")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="F" @if($gender=="F") checked @endif>
                    <label class="form-check-label">
                        {{__("Kobiety")}}
                    </label>
                </div>
            </div>
            <div class="form-group m-3">
                <h5>{{__("Pracownicy")}}:</h5>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employee" value="all" @if($employee=="all" || $employee==null) checked @endif>
                    <label class="form-check-label">
                        {{__("Wszyscy")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employee" value="present" @if($employee=="present") checked @endif>
                    <label class="form-check-label">
                        {{__("Obecni")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="employee" value="absent" @if($employee=="absent") checked @endif>
                    <label class="form-check-label">
                        {{__("Byli")}}
                    </label>
                </div>
            </div>
        </div>
    </div>    

    <div class="form-group d-flex m-3">
        <button class="btn btn-primary" type="submit">{{__("Szukaj")}}</button>
        <div class="ms-auto">
            <button type="button" id="downloadButton" class="btn btn-dark ms-auto">{{__("Eksportuj do pliku")}}</button>
            <button type="button" id="resetExport" class="btn btn-secondary ms-auto">{{__("Wyczyść zaznaczonych pracowników")}}</button>
        </div>

    </div>
    <p class="text-end me-3">{{__("Liczba pracowników zaznaczonych")}}: <span id="count-export">0</span></p>
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
