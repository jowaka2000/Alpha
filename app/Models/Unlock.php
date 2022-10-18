<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unlock extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function unlocks()
    {
        return $this->hasMany(UnlockFile::class, 'unlock_id');
    }

    public function unlockAnswersFiles()
    {
        return $this->hasMany(UnlockAnswersFile::class, 'unlock_id');
    }

    public function unlockPayment()
    {
        return $this->hasOne(UnlocksPayment::class, 'unlock_id');
    }



    public function scopeInProgress($query)
    {
        return  $query
            ->where('status', 'taken')
            ->where(function ($query) {
                $query->where('assigned_user_id', auth()->user()->id)
                    ->orWhere('user_id', auth()->user()->id);
            })
            ->latest()
            ->get();
    }

    public function scopeRefunds($query)
    {
        return $query
            ->where('status', 'refund')
            ->where(function ($query) {
                $query->where('assigned_user_id', auth()->user()->id)
                    ->orWhere('user_id', auth()->user()->id);
            })
            ->latest()
            ->get();
    }

    public function scopePaidUnlocks($query)
    {
        $query = $query->where('status', 'taking')->latest()->get();  //include paid unlocks here

        if(env('ENVIRONMENT')!='dev'){
            $query= $query
            ->where('status', 'taking')
            ->where('paid', true)
            ->latest()
            ->get();
        }

        return $query;
    }

    public function scopeUnpaid($query)
    {
        return $query
            ->where('user_id', auth()->user()->id)
            ->where('status', 'taking')
            ->where('paid', false)
            ->latest()
            ->get();
    }

    public function scopeCompleted($query){
        return $query
        ->where('status','completed')
        ->where(function($query){
            $query->where('assigned_user_id',auth()->user()->id)
                  ->orWhere('user_id',auth()->user()->id);
        })
        ->latest()
        ->get();
    }
}
