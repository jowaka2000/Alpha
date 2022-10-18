<?php

namespace App\Models;

use App\Casts\OrderCasts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'search_id';
    }


     protected $casts =[
        'deadline'=>'datetime',
        'pay_day'=>'datetime'
     ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function completed()
    {
        return $this->hasOne(Completed::class, 'order_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function bids()
    {
        return $this->hasMany(Order::class);
    }

    public function revise()
    {
        return $this->hasOne(Revise::class);
    }
    public function files()
    {
        return $this->hasMany(File::class, 'order_id');
    }
    public function earning()
    {
        return $this->hasOne(Earning::class);
    }
    public function rejecteds()
    {
        return $this->hasMany(Rejected::class, 'order_id');
    }

    public function scopeMyOrders($query)
    {
        if (auth()->user()->user_type === 'employer') {
            $query = $query
                ->where('status', 'biding')
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(10);
        } else {
            $query = $query
                ->where('status', 'biding')
                ->where(function ($query) {
                    $user = User::find(auth()->user()->id);
                    $employers = json_decode($user->employers, true);
                    $query->where('user_id', $employers['employer1'])
                        ->orWhere('user_id', $employers['employer2'])
                        ->orWhere('user_id', $employers['employer3']);
                })
                ->latest()
                ->paginate(10);
        }

        return $query;
    }

    public function scopeAllOrders($query)
    {
        return $query->where('order_visibility', 'public')->where('status', 'biding')->latest()->paginate(10);
    }
    public function assigned()
    {
        return $this->hasOne(Assigned::class, 'order_id');
    }

    public function scopeDeletedModels($query)
    {
        $query = Order::onlyTrashed()->orderby('deleted_at', 'desc')->get();
        return $query;
    }

    public function scopeAllPublicOrders($query)
    {
        if (auth()->user()->user_type === 'writer') {
            $query = $query->where('order_visibility', 'public')->where('status', 'biding')->count();
        } else {
            $query = $query->where('user_id', auth()->user()->id)->where('status', 'biding')->count();
        }
        return $query;
    }


}
