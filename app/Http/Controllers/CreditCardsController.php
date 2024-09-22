<?php

namespace App\Http\Controllers;

use App\Models\CreditCards;
use Exception;
use Illuminate\Http\Request;

class CreditCardsController extends Controller
{
    public function CreditCardsPage(){
        $card = new CreditCards;
        return view('app.creditCards', ['cards' => $card->listCards()]);
    }

    public function AddCreditCardPage(){
        $card = new CreditCards;
        if($card->validAddress() == false){
            return redirect()->route('configurations')->withErrors(['error' => 'Preencha os dados de cobrança para em seguida cadastrar um novo cartão de crédito.']);
        }
        return view('app.addCreditCard');
    }

    public function AddCreditCardPost(Request $request){
        try {
            $card = new CreditCards;
            $card->insertCard($request);
            return redirect()->route('credit-cards')->with(['success' => 'Cartão de crédito adicionado com sucesso!']);
        } catch (Exception $e){
            return redirect()->route('add-credit-card')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function DeleteCreditCard(int $id){
        $card = new CreditCards();
        $card->remove($id);
        return response()->json([]);
    }
}
