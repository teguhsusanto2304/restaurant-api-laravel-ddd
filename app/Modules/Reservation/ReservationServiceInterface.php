<?php

namespace App\Modules\Reservation;

use App\Modules\Reservation\ReservationleDTO;

interface ReservationServiceInterface
{
    public function getAllReservations(String $reservationDate,String $walkIn,String $isCancel=NULL);

    public function getReservationById(string $id);

    public function createReservation(ReservationDTO $reservationDTO);

    public function updateReservation(string $id, ReservationDTO $reservationDTO);

    public function deleteReservation(string $id);

    public function cancelReservation(string $id);

    public function isAvailable(string $diningTableId, string $reservationDate);


}
