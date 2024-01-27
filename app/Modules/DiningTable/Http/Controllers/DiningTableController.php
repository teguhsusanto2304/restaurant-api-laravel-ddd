<?php

namespace App\Modules\DiningTable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\DiningTable\DiningTableRepositoryInterface;
use App\Modules\DiningTable\DiningTableServiceInterface;
use App\Modules\DiningTable\DiningTableDTO;
use App\Http\Resources\DiningTableResource;

class DiningTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DiningTableRepositoryInterface $diningTableRepository)
    {
        $diningTable = $diningTableRepository->getAllDiningTables();

        return response()->json([
            "success"=>true,
            "message"=>"list of dining table",
            "data"=>DiningTableResource::collection($diningTable)],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, DiningTableServiceInterface $diningTableService)
    {
        $rules = [
            'table_number' => 'required|string|max:5|unique:dining_tables',
            'description' => 'required'
        ];
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["success"=>false,
            "message"=>$validator->errors()], 422);
        }
        $diningTableDTO = new DiningTableDTO(
            $request->input("table_number"),
            $request->input("description")
        );
        
        
        $diningTableService->createDiningTable($diningTableDTO);

        return response()->json( 
            ["success"=>true,
            "message"=>"data was created"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, DiningTableRepositoryInterface $diningTableRepository)
    {
        $diningTbale = $diningTableRepository->getDiningTableById($id);

        if (!$diningTbale) {
            return response()->json([
                "message" => "Dining Table Not Found."
            ], 404);
        }

        return response()->json($diningTbale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, DiningTableServiceInterface $diningTableService)
    {
        $rules = [
            'table_number' => 'required|string|max:5',
            'description' => 'required'
        ];
        foreach($request->all() as $key=>$value){
            $request[$key] = $value;
        }
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["success"=>false,
            "message"=>$validator->errors()], 422);
        }
        $diningTableDTO = new DiningTableDTO(
            $request->input("table_number"),
            $request->input("description")
        );

        $diningTable = $diningTableService->updateDiningTable($id, $diningTableDTO);

        if (!$diningTable) {
            return response()->json([
                "message" => "Dining Table Not Found."
            ], 404);
        }
        return response()->json( 
            ["success"=>true,
            "message"=>"data was updated",
        "data"=>$diningTable], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DiningTableServiceInterface $diningTableService)
    {
        $diningTable = $diningTableService->deleteDiningTable($id);

        if (!$diningTable) {
            return response()->json([
                "message" => "Dining Table Not Found."
            ], 404);
        }

        return response()->json([
            "message" => "Dining Table was Deleted.",
            "Data" => $diningTable
        ]);
    }
}
