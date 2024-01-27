<?php

namespace App\Modules\DiningTable;

use App\Modules\DiningTable\DiningTableDTO;
use App\Modules\DiningTable\DiningTable;

interface DiningTableRepositoryInterface
{
    public function getAllDiningTables();

    public function getDiningTableById(string $id);

    public function createDiningTable(DiningTableDTO $diningTableDTO);

    public function saveDiningTable(DiningTable $diningTable);

    public function deleteDiningTable(DiningTable $diningTable);
}
