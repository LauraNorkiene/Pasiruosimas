<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $cityId=$request->session()->get('filter_city_id', null);
        $find=$request->session()->get('find_post',$request->search);
        $orderBy=$request->session()->get('order_by', 'name');
        $dir=$request->session()->get('order_direction', 'ASC');
        if($cityId!=null){
            $hotels =  Hotel::where('city_id',$cityId )->get();
        }else{
            $hotels=Hotel::filter($cityId)->findPosts($find)->orderBy($orderBy,$dir)->get();
        }



        return view('hotels.index',['hotels'=>$hotels, 'cities'=>City::all(), 'filter_city_id'=>$cityId,'orderBy'=>$orderBy, 'orderDirection'=>$dir]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('hotels.edit', ['cities'=>City::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $hotel = new Hotel();

        $hotel->name=$request->name;

        if($request->file('img')!=null) {
            $foto = $request->file('img');
            $fotoname = $request->id . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $hotel->img=$fotoname;
        }

        $hotel->price=$request->price;
        $hotel->travel_time=$request->travel_time;
        $hotel->city_id=$request->city_id;

        $hotel->save();
        return redirect()->route('hotel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Hotel $hotel)
    {
        return view('hotels.edit',[
            'hotel'=>$hotel,
            'cities'=>City::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Hotel $hotel)
    {
        if($request->file('img')!=null) {
            $foto = $request->file('img');

            $fotoname = $request->hotel_name . '_' . rand() . '.' . $foto->extension();
            $foto->storeAs('images',$fotoname);
            $hotel->img=$fotoname;
        }

        $hotel->fill($request->all());
        $hotel->save();
        return redirect()->route('hotel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotel.index');
    }

    public function cityHotels($id)
    {
        return view('hotels.index',['hotels'=>Hotel::where('city_id',$id)->get()]);
    }

    public function display($name){
        $file=storage_path('app/images/'.$name);
        return response()->file( $file );
    }

    public function rateHotels(Request $request, $id){
        $rate=Hotel::find($id);
        $rate->rate_count++;
        $rate->rate_sum=$rate->rate_sum+$request->ivertinimas;
        $rate->save();
        return redirect()->back(); }

    public function findPost(Request $request) {
        $request->session()->put('find_post', $request->name);
        return redirect()->route('hotels.index');
    }

    public function filterHotels(Request $request){
        $request->session()->put('filter_city_id',$request->city_id);
        return redirect()->route('hotels.index');
    }
}
