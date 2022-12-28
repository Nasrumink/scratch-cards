<?php

namespace App\Services;

use App\Models\{ScratchCard,Transaction};
use DB;
use Exception;

class ScratchCardService
{

    /**
     * Create a unique scratch cards.
     * @param  array  $arr
     * @return Model\ScratchCard
     */    
    function createScratchCards(array $arr) {
        $cards = []; $i = 1;
        while($i <= $arr['number_of_scratch_cards']) {
            $temp['scratch_card_amount'] = rand(env('SCRATCH_CARD_MIN_AMT'),env('SCRATCH_CARD_MAX_AMT'));
            $temp['expiry_date'] = date('Y-m-d', strtotime(now(). ' + 5 days'));
            array_push($cards,$temp);
            $i++;
        }
        ScratchCard::insert($cards);
    }

    function createTransaction(array $arr) {
        DB::beginTransaction();
            $transaction = new Transaction();
            $transaction->user_id = $arr['user_id'];
            $transaction->scratch_card_id = $arr['scratch_card_id'];
            $transaction->transaction_amount = $arr['transaction_amount'];
            $transaction->transaction_date = now();
            $transaction->save();
            
            $card = ScratchCard::where('id',$arr['scratch_card_id'])->where('is_active',true)->where('is_scratched',false)->
            whereDate('expiry_date','>=',date('Y-m-d'))->first();
            if (empty($card))
                throw new \Exception('Invalid scratch card given.');
            $card->is_scratched = true;
            $card->save();
        DB::commit();    
    }
}