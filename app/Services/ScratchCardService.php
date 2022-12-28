<?php

namespace App\Services;

use App\Models\ScratchCard;
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
}