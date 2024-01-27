<?php

namespace App\Modules\Reservation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Reservation\ReservationRepositoryInterface;
use App\Modules\Reservation\ReservationServiceInterface;
use App\Modules\Reservation\ReservationDTO;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\CancelReservationResource;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ReservationRepositoryInterface $reservationRepository)
    {
        $reservation = $reservationRepository->getAllReservations($request->query('at'),$request->query('walkin'),$request->query('cancel'));
        $result = ($request->query('cancel'))?CancelReservationResource::collection($reservation):ReservationResource::collection($reservation);
        return response()->json([
            "succes"=>true,
            "message"=>"list of Reservatione",
            "data"=>$result],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ReservationServiceInterface $reservationService)
    {
        $rules = [
            'dining_table_id' => 'required|string|exists:dining_tables,id',
            'reservation_date' => 'required|date|after:today',
            'duration_minute' => 'required|numeric|max:60'
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["success"=>false,
            "message"=>$validator->errors()], 422);
        }
        $reservationDTO = new ReservationDTO(
            \Auth::user()->name,
            $request->input("dining_table_id"),
            $request->input("reservation_date"),
            $request->input("duration_minute"),
            \Auth::user()->id,
            "0"
        );
        if($reservationService->isAvailable($request->input("dining_table_id"),$request->input("reservation_date"))===false){
                return response()->json(["success"=>false,
                "message"=>'Dining table was reserved'], 201);
        }
        $reservationService->createReservation($reservationDTO);

        return response()->json( 
            ["success"=>true,
            "message"=>"data was created"], 201);
    }

    public function walkin(Request $request, ReservationServiceInterface $reservationService)
    {
        $rules = [
            'dining_table_id' => 'required|string|exists:dining_tables,id',
            'customer_name' => 'required|max:100',
            'duration_minute' => 'required|numeric|max:60'
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["success"=>false,
            "message"=>$validator->errors()], 422);
        }
        $reservationDTO = new ReservationDTO(
            $request->input("customer_name"),
            $request->input("dining_table_id"),
            NOW(),
            $request->input("duration_minute"),
            \Auth::user()->id,
            "1"
        );
        if($reservationService->isAvailable($request->input("dining_table_id"),NOW())===false){
            return response()->json(["success"=>false,
            "message"=>'Dining table was reserved'], 201);
    }
        $reservationService->createReservation($reservationDTO);

        return response()->json( 
            ["success"=>true,
            "message"=>"data was created"], 201);
    }
    /**
     * Cancel a reservation.
     */
    public function cancel(string $id, ReservationServiceInterface $reservationService)
    {
        $reservation = $reservationService->cancelReservation($id);

        if (!$reservation) {
            return response()->json([
                "message" => "Reservation Not Found."
            ], 404);
        }

        return response()->json([
            "message" => "Reservation was canceled.",
            "Data" => $reservation
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
