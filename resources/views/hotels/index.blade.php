@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Viešbučiai</div>

                    <div class="card-body">
                        <a href="{{ route('hotel.create') }}" class="btn btn-success">Pridėti naują</a>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nuotrauka</th>
                                <th>Pavadinimas</th>
                                <th>Kaina</th>

                                <th>Kelionės trukmė</th>
                                <th>Miestas</th>
                                <th colspan="2">Veiksmai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td><img src="{{ route('images',$hotel->img)}}" style=" width: 324px; height: 216px;"></td>
                                    <td>{{ $hotel->name }}</td>
                                    <td>{{ $hotel->price }}</td>

                                    <td>{{ $hotel->travel_time }}</td>
                                    <td>{{ $hotel->city->name }}</td>
                                    <td>
                                        <a href="{{ route('hotel.edit', $hotel->id) }}" class="btn btn-success">Redaguoti</a>


                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('hotel.destroy', $hotel->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button  class="btn btn-danger">Ištrinti</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
