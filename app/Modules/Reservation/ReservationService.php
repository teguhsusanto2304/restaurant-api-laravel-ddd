<?php

namespace App\Modules\Reservation;

use App\Modules\Reservation\ReservationServiceInterface;
use App\Modules\Reservation\ReservationDTO;

class ReservationService implements ReservationServiceInterface
{
    protected $reservationTableRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function getAllReservations(String $reservationDate)
    {
        return $this->reservationRepository->getAllReservations($reservationDate);
    }

    public function getReservationById(string $id)
    {
        return $this->reservationRepository->getReservationById($id);
    }

    public function createReservation(ReservationDTO $reservationDTO)
    {
        return $this->reservationRepository->createReservation($reservationDTO);
    }

    public function updateReservation(string $id, ReservationDTO $reservationDTO)
    {
        $reservation = $this->reservationRepository->getReservationById($id);

        if (!$reservation) {
            return null;
        }

        $reservation->custmer_name = $reservationDTO->getCustomerName();
        $reservation->dining_table_id = $reservationDTO->getDiningTableId();
        $reservation->reservation_date = $reservationDTO->getReservationDate();
        $reservation->duration_minute = $reservationDTO->getDurationMinute();
        return $this->reservationRepository->saveReservation($reservation);
    }
    public function cancelReservation(string $id)
    {
        $reservation = $this->reservationRepository->getReservationById($id);

        if (!$reservation) {
            return null;
        }
        $reservation->canceled_at = NOW();
        $reservation->is_cancel = 1;
        return $this->reservationRepository->saveReservation($reservation);
    }

    public function deleteReservation(string $id)
    {
        $reservation = $this->reservationRepository->getReservationById($id);

        if (!$reservation) {
            return null;
        }

        $this->reservationRepository->deleteReservation($reservation);

        return $reservation;
    }
    public function isAvailable(String $diningTableId,String $reservationDate):bool
    {
        return  $this->reservationRepository->getCountReservationByFields(['dining_table_id'=>$diningTableId,'reservation_date'=>$reservationDate]);
    } 
}
