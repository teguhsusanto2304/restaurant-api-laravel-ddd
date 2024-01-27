<?php

namespace App\Modules\DiningTable;

use Illuminate\Support\Facades\Validator;

class DiningTableDTO
{
    private string $tableNumber;
    private string $description;

    public function __construct(string $tableNumber, string $description)
    {        
        $this->tableNumber = $tableNumber;
        $this->description = $description;
    }
    public function getTableNumber(): string
    {
        return $this->tableNumber;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
