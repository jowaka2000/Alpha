<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Completed extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $casts = [
        'employer_id' => 'int',
    ];

    public function getRouteKeyName()
    {
        return 'search_id';
    }
    public function toSearchableArray()
    {
        return [
            'order_id' => $this->order_id,
            'topic' => $this->topic,
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assigned()
    {
        return $this->belongsTo(Assigned::class, 'assigned_id');
    }

    public function scopeAllPending($query, $search)
    {

        if ($search != null) {
            if (auth()->user()->user_type === 'employer') {
                $query = Completed::search($search)
                    ->where('employer_id', auth()->user()->id)
                    ->where('status', 'pending')
                    ->orderby('created_at', 'desc')
                    ->paginate(6);
            } else {
                $query = Completed::search($search)
                    ->where('user_id', auth()->user()->id)
                    ->where('status', 'pending')
                    ->orderby('created_at', 'desc')
                    ->paginate(6);
            }
        } else {
            $query = $query->where('status', 'pending')->where(function ($query) {
                $query->where('employer_id', auth()->user()->id)
                    ->orWhere('user_id', auth()->user()->id);
            })->latest()
             ->paginate(6);
        }
        return $query;
    }


    public function scopeAllRevision($query, $search)
    {
        if ($search != null) {
            if (auth()->user()->user_type === 'employer') {
                $query = Completed::search($search)
                    ->where('employer_id', auth()->user()->id)
                    ->where('status', 'revised')
                    ->orderby('created_at', 'desc')
                    ->paginate(6);
            } else {
                $query = Completed::search($search)
                    ->where('user_id', auth()->user()->id)
                    ->where('status', 'revised')
                    ->orderby('created_at', 'desc')
                    ->paginate(6);
            }
        } else {
            if (auth()->user()->user_type === 'employer') {
                $query = $query->where([
                    'employer_id' => auth()->user()->id,
                    'status' => 'revised'
                ])->orderby('created_at', 'desc')->paginate(6);
            } else {
                $query = $query->where('user_id', auth()->user()->id)->where('status', 'revised')->orderby('created_at', 'desc')->paginate(6);
            }
        }


        return $query;
    }


    public function scopeAllApproved($query, $search)
    {

        if ($search != null) {
            if (auth()->user()->user_type === 'employer') {
                $query = Completed::search($search)
                    ->where('employer_id', auth()->user()->id)
                    ->where('status', 'approved')
                    ->orderby('created_at', 'desc')
                    ->paginate(10);
            } else {
                $query = Completed::search($search)->where('user_id', auth()->user()->id)->where('status', 'approved')->orderby('created_at', 'desc')->paginate(10);
            }
        } else {
            $query = $query->where('status', 'approved')->where(function ($query) {
                $query->where('employer_id', auth()->user()->id)
                    ->orWhere('user_id', auth()->user()->id);
            })->latest()
             ->paginate(6);
        }

        return $query;
    }
}
