<?php

namespace App\Http\Controllers;

use App\Models\{User,ScratchCard};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ScratchCardService;
use App\Http\Requests\ScratchCardRequest;
class ScratchCardController extends Controller
{

    /**
     * Fetch User
     * @param Request $request
     * @return User 
     */
    public function index(Request $request)
    {
        try {
            $scratch_cards = ScratchCard::filter($request->all())->get();
            return response()->json(["error" => false, "message" => "Success", "data" => $scratch_cards], 200);
        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function store(ScratchCardRequest $request)
    {
        try {
            $unused_cards = ScratchCard::where('is_scratched',false)->where('is_active',true)->count();
            
            if($unused_cards >= $request->number_of_scratch_cards) {
                return response()->json([
                    'error' => false,
                    'message' => "$unused_cards number of active scratch cards still exists in the DB. Did not create any new scratch card",
                ], 200);
            }

            $cards = (new ScratchCardService)->createScratchCards($request->all());
            return response()->json([
                'error' => false,
                'message' => 'Scratch Cards Created Successfully',
            ], 200);

        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}