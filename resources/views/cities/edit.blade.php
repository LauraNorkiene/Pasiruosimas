@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Miestai</div>

                    <div class="card-body">

                        <form method="POST" action="{{ isset($city)?route('city.update',$city->id):route('city.store') }}">
                            @csrf

                            @if (isset($city))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" name="name" class="form-control" value="{{ isset($city)?$city->name:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sezonas</label>
                                <input type="text" name="season" class="form-control"  value="{{ isset($city)?$city->season:'' }}">
                            </div>

                            <button type="submit" class="btn btn-success">{{ isset($city)?'Išsaugoti':'Pridėti' }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
