<form  action="{{route("list")}}" method="get" class="border p-2 m-2 rounded-4">
    <h2 class="m-3">{{__("Szukaj")}}</h2>
    <div class="d-flex">
        <div class="flex-fill">
            <div class="form-group m-3">
                <label class="h5">
                    {{ __("Imię") }}
                    <input type="text" name="first-name" class="form-control" @isset($data['first-name']) value="{{ $data['first-name'] }}" @endisset placeholder="{{ __("Imię") }}" />
                </label>
                <br>
                <label class="h5">
                    {{ __("Nazwisko") }}
                    <input type="text" name="last-name" class="form-control" @isset($data['last-name']) value="{{ $data['last-name'] }}" @endisset placeholder="{{ __("Nazwisko") }}" />
                </label>
            </div>
        </div>
        <div class="flex-fill">
            <div class="form-group mx-3 w-75">
                <label class="h5">{{__("Departament")}}:</label>
                <select class="form-control" name="department">
                    <option @selected(is_null($data['department'])) value="">{{__("Wszystkie")}}</option>
                    @foreach ($departmentAll as $d)
                        <option @selected($data['department']==$d->dept_no) value="{{$d->dept_no}}">{{$d->dept_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group m-3">
                <label class="h5">{{__("Pensja")}}:</label>
                <div class="d-flex">
                    <div class="me-1">
                        <input type="number" class="form-control" name="minSalary" @isset($data['minSalary']) value="{{$data['minSalary']}}" @endisset placeholder="Min:" aria-label="minimum salary">
                    </div>
                    <div class="ms-1">
                        <input type="number" class="form-control" name="maxSalary" @isset($data['maxSalary']) value="{{$data['maxSalary']}}" @endisset placeholder="Max:" aria-label="maximum salary">
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
                        {{__("Wszyscy")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="gender" value="M" @checked($data['gender']=="M")>
                    <label class="form-check-label">
                        {{__("Mężczyźni")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="gender" value="F" @checked($data['gender']=="F")>
                    <label class="form-check-label">
                        {{__("Kobiety")}}
                    </label>
                </div>
            </div>
            <div class="form-group m-3">
                <label class="h5">{{__("Pracownicy")}}:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="presence" value="" @checked(is_null($data['presence']))>
                    <label class="form-check-label">
                        {{__("Wszyscy")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="presence" value="present" @checked($data['presence']=="present")>
                    <label class="form-check-label">
                        {{__("Obecni")}}
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input border-dark" type="radio" name="presence" value="absent" @checked($data["presence"]=="absent")>
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
