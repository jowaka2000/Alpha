<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Assigned extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $casts =[
        'owner_id'=>'int',
    ];

    public function getRouteKeyName()
    {
        return 'search_id';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function completed()
    {
        return $this->hasOne(Completed::class, 'assigned_id');
    }

    public function toSearchableArray()
    {
        return [
            'order_id' => $this->order_id,
            'topic' => $this->topic,
        ];
    }

    public function scopeAllAssigned($query, $search)
    {

        if ($search != null) {
            if (auth()->user()->user_type === 'employer') {
                $query = Assigned::search($search)->where('stage', 1)->where('owner_id', auth()->user()->id)->orderby('create_at', 'desc')->paginate(10);
            } else {
                $query = Assigned::search($search)->where('stage', 1)->where('user_id', auth()->user()->id)->orderby('create_at', 'desc')->paginate(10);
            }
        } else {
            $query = $query->where('stage', 1)->where('user_id', auth()->user()->id)->orWhere('owner_id', auth()->user()->id)->latest()->paginate(10);
        }
        return $query;
    }


    public function scopeCountAllAssignedOrders($query)
    {

        if (auth()->user()->user_type === 'writer') {
            $query = $query->where('stage', 1)->where('user_id', auth()->user()->id)->count();
        } else {
            $query = $query->where('stage', 1)->where('owner_id', auth()->user()->id)->count();
        }

        return $query;
    }
}
