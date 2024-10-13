<?php

namespace App\Models;

use App\Repositories\AdminRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    use HasFactory;

    protected $AdminRepository;

    public function __construct()
    {
        $this->AdminRepository = new AdminRepository;
    }

    public function GetCreators(){
        return $this->AdminRepository->GetCreators();
    }

    public function GetSubscribers(){
        return $this->AdminRepository->GetSubscribers();
    }

    public function GetSubscribersByUser(int $id){
        return $this->AdminRepository->GetSubscribersByUser($id);
    }

    public function CountSubscribers(int $id){
        return $this->AdminRepository->CountSubscribers($id);
    }

    public function CountAllSubscribers($date = null){
        $current = $this->AdminRepository->CountAllSubscribers($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->CountAllSubscribers($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function CountAllGifts($date = null){
        $current = $this->AdminRepository->CountAllGifts($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->CountAllGifts($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function CountAllCreators($date = null){
        $current = $this->AdminRepository->CountAllCreators($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->CountAllCreators($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function CountAllSubscriptions($date = null){
        $current = $this->AdminRepository->CountAllSubscriptions($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->CountAllSubscriptions($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function CountAllViews($date = null){
        $current = $this->AdminRepository->CountAllViews($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->CountAllViews($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function GetInvoicingSubscriptions($date = null){
        $current = $this->AdminRepository->GetInvoicingSubscriptions($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->GetInvoicingSubscriptions($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function GetInvoicingPhotos($date = null){
        $current = $this->AdminRepository->GetInvoicingPhotos($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->GetInvoicingPhotos($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }

    public function GetInvoicingGifts($date = null){
        $current = $this->AdminRepository->GetInvoicingGifts($date);
        $datePast = Carbon::now()->subMonth()->format('m-Y');
        $past = $this->AdminRepository->GetInvoicingGifts($datePast);
        if ($current != 0) {
            $evo = (($current - $past) / $current) * 100;
        } else {
            $evo = 0;
        }
        return [
            'current' => $current,
            'evo' => $evo
        ];
    }
}
