@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Viešbutis</div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($hotel)?route('hotel.update',$hotel->id):route('hotel.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if (isset($hotel))
                                @method('put')
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Pavadinimas</label>
                                <input type="text" name="name" class="form-control" value="{{ isset($hotel)?$hotel->name:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kaina</label>
                                <input type="text" name="price" class="form-control"  value="{{ isset($hotel)?$hotel->price:'' }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nuotrauka</label>
                                 <input type="file" class="form-control" name="img">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelionės trukmė</label>
                                <input type="text" name="travel_time" class="form-control" value="{{ isset($hotel)?$hotel->travel_time:'' }}">
                            </div>
                            <div class="mb-3">
                                <select name="city_id" class="form-select">
                                    @foreach($cities as $city)
                                        <option  value="{{$city->id}}" {{ isset($hotel)&&($city->id==$hotel->city_id)?'selected':'' }}> {{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{ isset($hotel)?'Išsaugoti':'Pridėti' }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
