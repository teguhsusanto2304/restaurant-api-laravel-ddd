<?php

namespace App\Modules\Reservation;

use App\Modules\Reservation\ReservationDTO;
use App\Modules\Reservation\Reservation;

interface ReservationRepositoryInterface
{
    public function getAllReservations(String $reservationDate,$isWalkIn,$iscancel);

    public function getReservationById(string $id);

    public function createReservation(ReservationDTO $reservationDTO);

    public function saveReservation(Reservation $reservation);

    public function deleteReservation(Reservation $Reservation);

    public function getCountReservationByFields(array $fields);
}
