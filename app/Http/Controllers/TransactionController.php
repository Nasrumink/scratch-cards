<?php

namespace App\Http\Controllers;

use App\Models\{User,ScratchCard,Transaction};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ScratchCardService;
use App\Http\Requests\TransactionRequest;
class TransactionController extends Controller
{

    /**
     * Fetch Transaction
     * @param Request $request
     * @return Transaction 
     */
    public function index(Request $request)
    {
        try {
            $transactions = Transaction::filter($request->all())->get();
            return response()->json(["error" => false, "message" => "Success", "data" => $transactions], 200);
        } catch (\Throwable $th) {
            //Log the error and return apropriate message.
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Create Transaction
     * @param Request $request
     * @return Transaction 
     */
    public function store(TransactionRequest $request)
    {
        try {
            $transaction = (new ScratchCardService)->createTransaction($request->all());
            return response()->json([
                'error' => false,
                'message' => 'Transaction Created Successfully',
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