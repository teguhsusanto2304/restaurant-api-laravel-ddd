<?php

namespace App\Modules\DiningTable;

use App\Modules\DiningTable\DiningTableServiceInterface;
use App\Modules\DiningTable\DiningTableDTO;

class DiningTableService implements DiningTableServiceInterface
{
    protected $diningTableRepository;

    public function __construct(DiningTableRepositoryInterface $diningTableRepository)
    {
        $this->diningTableRepository = $diningTableRepository;
    }

    public function getAllDiningTables()
    {
        return $this->diningTableRepository->getAllDiningTables();
    }

    public function getDiningTableById(string $id)
    {
        return $this->diningTableRepository->getDiningTableById($id);
    }

    public function createDiningTable(DiningTableDTO $diningTablekDTO)
    {
        return $this->diningTableRepository->createDiningTable($diningTablekDTO);
    }

    public function updateDiningTable(string $id, DiningTableDTO $diningTableDTO)
    {
        $diningTable = $this->diningTableRepository->getDiningTableById($id);

        if (!$diningTable) {
            return null;
        }

        $diningTable->table_number = $diningTableDTO->getTableNumber();

        $diningTable->description = $diningTableDTO->getDescription();

        return $this->diningTableRepository->saveDiningTable($diningTable);
    }

    public function deleteDiningTable(string $id)
    {
        $diningTable = $this->diningTableRepository->getDiningTableById($id);

        if (!$diningTable) {
            return null;
        }

        $this->diningTableRepository->DiningTableTask($diningTable);

        return $diningTable;
    }
}
