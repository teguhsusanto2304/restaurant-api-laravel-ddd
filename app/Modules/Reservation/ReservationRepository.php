<?php

namespace App\Modules\Reservation;

use App\Modules\Reservation\ReservationDTO;
use App\Modules\Reservation\Reservation;
use App\Modules\Reservation\ReservationRepositoryInterface;
use Auth;
use DB;
use Faker\Core\Number;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function getAllReservations(String $reservationDate,$isWalkIn,$iscancel =null)
    {
        if(!empty($reservationDate)){
            if(!is_null($isWalkIn)){
                $data = Reservation::where(DB::raw("DATE_FORMAT(reservation_date,'%Y-%m-%d')"),$reservationDate)
                                ->where('is_cancel',0)
                                ->where('is_walkin',(bool) $isWalkIn)
                                ->get();
            } else if(!is_null($iscancel)){
                $data = Reservation::where(DB::raw("DATE_FORMAT(reservation_date,'%Y-%m-%d')"),$reservationDate)
                                ->where('is_cancel',(bool) $iscancel)
                                ->get();
            } else {
                $data = Reservation::where(DB::raw("DATE_FORMAT(reservation_date,'%Y-%m-%d')"),$reservationDate)
                ->where('is_cancel',0)
                ->get();
            }
        } else {
            $data = Reservation::all();
        }
        return $data;
    }

    public function getReservationById(string $id)
    {
        return Reservation::find($id);
    }

    public function createReservation(ReservationDTO $reservationDTO)
    {
        $reservation = new Reservation();

        $reservation->customer_name = $reservationDTO->getCustomerName();

        $reservation->dining_table_id = $reservationDTO->getDiningTableId();

        $reservation->reservation_date = $reservationDTO->getReservationDate();

        $reservation->duration_minute = $reservationDTO->getDurationMinute();

        $reservation->user_id = $reservationDTO->getUserId();
        
        $reservation->is_walkin = $reservationDTO->getIsWalkIn(); 

        $reservation->save();
    }

    public function saveReservation(Reservation $reservation)
    {
        $reservation->save();

        return $reservation;
    }

    public function deleteReservation(Reservation $reservation)
    {
        $reservation->delete();
    }
    public function getCountReservationByFields(Array $fields):bool
    {
        $rs = [];
        $dt = Reservation::select('reservation_date',\DB::raw("DATE_FORMAT(DATE_ADD(reservation_date, INTERVAL duration_minute MINUTE),'%Y-%m-%d %H:%i:%s') end_reservation_date"))->where('dining_table_id',$fields['dining_table_id'])->get();
        foreach($dt as $data){
            $start_at = new \DateTime($data['reservation_date']);
            $end_at = new \DateTime($data['end_reservation_date']);
            $param_at = new \DateTime($fields['reservation_date']);
            if( $start_at->format('Y-m-d H:i:s') <= $param_at->format('Y-m-d H:i:s') && $end_at->format('Y-m-d H:i:s') >= $param_at->format('Y-m-d H:i:s')){
                $rs['result'] = false;
            } else {
                $rs['result'] = true;
            }
        }
        if(!empty($rs)){
            if($rs['result']===true){
                return true;
            } else{
                return false;
            }
        } else {
            return true;
        }
        
    }
}
