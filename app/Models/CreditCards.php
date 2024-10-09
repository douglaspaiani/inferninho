<?php

namespace App\Models;

use App\Repositories\CreditCardsRepository;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditCards extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'number',
        'name',
        'valid',
        'code',
        'cpf',
        'brand'
    ];

    protected $CreditCardsRepository;

    public function __construct()
    {
        $this->CreditCardsRepository = new CreditCardsRepository;
    }

    public function getCard(int $id){
        return $this->CreditCardsRepository->find($id);
    }

    public function validAddress(){
        return $this->CreditCardsRepository->validAddress();
    }

    public function listCards(){
        return $this->CreditCardsRepository->listCards();
    }

    public function remove(int $id){
        return $this->CreditCardsRepository->remove($id);
    } 

    public function insertCard(Request $request){
        $request = $request->all();

        // valid CPF
        if(!validCpf($request['cpf'])){
            throw new Exception('CPF inválido, preencha novamente.');
        }

        // valid card number
        if(!validCreditCard($request['number'])){
            throw new Exception('Número do cartão inválido, preencha novamente.');
        }

        // verify expire card
        if(!verifyExpireCard($request['valid'])){
            throw new Exception('Cartão de crédito expirado, tente outro.');
        }

        // mount data
        $data = [
            'user' => Auth::id(),
            'number' => $request['number'],
            'name' => $request['name'],
            'valid' => $request['valid'],
            'code' => $request['code'],
            'cpf' => $request['cpf'],
            'brand' => verifyBrandCard($request['number'])
        ];

        return $this->CreditCardsRepository->insertCard($data);
    }

    public function ValidIntegrity(int $id_card){
        $card = $this->CreditCardsRepository->find($id_card);
        if($card['user'] == Auth::id()){
            return true;
        } else {
            return false;
        }
    }
}
