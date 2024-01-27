<?php

namespace App\Modules\DiningTable;

use App\Modules\DiningTable\DiningTableDTO;

interface DiningTableServiceInterface
{
    public function getAllDiningTables();

    public function getDiningTableById(string $id);

    public function createDiningTable(DiningTableDTO $diningTableDTO);

    public function updateDiningTable(string $id, DiningTableDTO $diningTableDTO);

    public function deleteDiningTable(string $id);
}
