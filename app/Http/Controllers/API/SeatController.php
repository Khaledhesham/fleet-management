<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListAvailableSeatsRequest;
use App\Seat;
use App\Services\Reservation\ListAvailableSeatsService;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function __construct(ListAvailableSeatsService $listAvailableSeatsService) {
        $this->listAvailableSeatsService = $listAvailableSeatsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function index(ListAvailableSeatsRequest $request)
    {
        $response = $this->listAvailableSeatsService->list($request);
        return $response->format();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
