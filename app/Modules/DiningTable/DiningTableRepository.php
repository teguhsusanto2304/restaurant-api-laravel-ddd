<?php

namespace App\Modules\DiningTable;

use App\Modules\DiningTable\DiningTableDTO;
use App\Modules\DiningTable\DiningTable;

class DiningTableRepository implements DiningTableRepositoryInterface
{
    public function getAllDiningTables()
    {
        return DiningTable::all();
    }

    public function getDiningTableById(string $id)
    {
        return DiningTable::find($id);
    }

    public function createDiningTable(DiningTableDTO $diningTableDTO)
    {
        $diningTable = new DiningTable();

        $diningTable->table_number = $diningTableDTO->getTableNumber();

        $diningTable->description = $diningTableDTO->getDescription();

        $diningTable->save();
    }

    public function saveDiningTable(DiningTable $diningTable)
    {
        $diningTable->save();

        return $diningTable;
    }

    public function deleteDiningTable(DiningTable $diningTable)
    {
        $diningTable->delete();
    }
}
