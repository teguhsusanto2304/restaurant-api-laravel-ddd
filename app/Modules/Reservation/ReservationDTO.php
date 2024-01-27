<?php

namespace App\Modules\Reservation;

use Illuminate\Support\Facades\Validator;

class ReservationDTO
{
    private string $customerName;
    private string $diningTableId;
    private string $reservationDate;
    private string $durationMinute;
    private string $userId;
    private string $isWalkIn;

    public function __construct(
        string $customerName, 
        string $diningTableId,
        string $reservationDate,
        string $durationMinute, 
        string $userId,
        string $isWalkIn)
    {
        
        $this->customerName = $customerName;
        $this->diningTableId = $diningTableId;
        $this->reservationDate = $reservationDate;
        $this->durationMinute = $durationMinute;
        $this->userId = $userId;
        $this->isWalkIn = $isWalkIn;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getDiningTableId(): string
    {
        return $this->diningTableId;
    }
    public function getReservationDate(): string
    {
        return $this->reservationDate;
    }
    public function getDurationMinute(): string
    {
        return $this->durationMinute;
    }
    public function getUserId(): string
    {
        return $this->userId;
    }
    public function getIsWalkIn(): string
    {
        return $this->isWalkIn;
    }
}
