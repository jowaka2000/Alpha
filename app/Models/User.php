<?php

namespace App\Models;

use App\Casts\ReferralCasts;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use App\Models\Invite;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;


    public $employer;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'number',
        'chanel',
        'availability',
        'user_type',
        'description',
        'subscribed',
        'end_of_subscription',
        'policies',
        'renewed',
        'subjects',
        'plan',
        'image',
        'orders',
        'rejected',
        'refunds',
        'refferal_code',
        'employers',
        'success_rate',
        'phone_verified',
        'old_password',
        'online',
        'valid',
        'search_id',
        'old_profile_data',
        'password'
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => strtolower($this->email),
            'subjects'=>json_decode(strtolower($this->subjects))
        ];
    }

    public function scopeMyEmployers($query){
        $writer = User::find(auth()->user()->id);

        $employerIds = json_decode($writer->employers,true);

        $query= $query->where('id',$employerIds['employer1'])->orWhere('id',$employerIds['employer2'])->orWhere('id',$employerIds['employer3'])->get();
        return $query;
    }
    public function scopeMyWritersToPay($query, $search)
    {

        if ($search != null) {
            $query = User::search($search)->where('user_type', 'writer')->orderby('success_rate', 'desc')->get();

            $query= $query->reject(function($query){
                return $query->whereJsonContains('employers->employer1', auth()->user()->id)
                ->orWhereJsonContains('employers->employer2', auth()->user()->id)
                ->orWhereJsonContains('employers->employer3', auth()->user()->id);
            });
        } else {
            $query = $query->where('user_type', 'writer')->where(function($query){
                $query->whereJsonContains('employers->employer1', auth()->user()->id)
                ->orWhereJsonContains('employers->employer2', auth()->user()->id)
                ->orWhereJsonContains('employers->employer3', auth()->user()->id);
            })
            ->where('blocked', false)
            ->orderby('success_rate', 'desc')
            ->get();
        }

        return $query;
    }

    public function scopeAllWriters($query, $search)
    {
        if ($search != null) {
            $query = User::search($search)->where('user_type', 'writer')->where('blocked', false)->get();
        } else {
            $query = $query->where('user_type', 'writer')
            ->where(function ($query) {
                $query->whereJsonContains('employers->employer1', '')
                    ->orWhereJsonContains('employers->employer2', '')
                    ->orWhereJsonContains('employers->employer3', '');
            })
            ->whereNot(function ($query) {
                $query->whereJsonContains('employers->employer1', auth()->user()->id)
                    ->orWhereJsonContains('employers->employer2', auth()->user()->id)
                    ->orWhereJsonContains('employers->employer3', auth()->user()->id);
            })
            ->where('blocked', false)
            ->orderby('success_rate','desc')
            ->get();
        }
        return $query;
    }

    public function scopeMyWriters($query, $search)
    {
        if ($search != null) {
            $query = User::search($search)->where('user_type', 'writer')->where('blocked', false)->get();

//            $query = $query->except()
        } else {
            $query = $query->where('user_type', 'writer')->where(function($query){
                $query->whereJsonContains('employers->employer1', auth()->user()->id)
                ->orWhereJsonContains('employers->employer2', auth()->user()->id)
                ->orWhereJsonContains('employers->employer3', auth()->user()->id);
            })
            ->where('blocked', false)
            ->orderby('success_rate', 'desc')
            ->get();
        }

        return $query;
    }


    public function scopeEmployerWriters($query, User $employer){

        $this->employer=$employer;

        $query = $query->where('user_type', 'writer')->where(function($query){
            $query->whereJsonContains('employers->employer1', $this->employer->id)
            ->orWhereJsonContains('employers->employer2', $this->employer->id)
            ->orWhereJsonContains('employers->employer3', $this->employer->id);
        })
        ->where('blocked', false)
        ->get();

        return $query;
    }

    public function scopeAllClients($query, $search)
    {
        if ($search != null) {
            $query = User::search($search)->where('user_type', 'employer')->where('blocked', false)->paginate(10);
        } else {
            $query = $query->where('user_type', 'employer')->where('blocked', false)->paginate(10);
        }
        return $query;
    }

    public function scopeAllWritersToPay($query){

        $orders = Order::where('user_id',auth()->user()->id)->where('status','completed')->where('paid',false)->get();

        $allWriters = [];

        foreach($orders as $order){
            $writer = User::find($order->completed->user->id);
            array_push($allWriters,$writer);
        }

        $allWriters = collect($allWriters);
        return $allWriters;
    }

    public function access(){
        return $this->hasOne(Access::class);
    }

    public function helps(){
        return $this->hasMany(Help::class);
    }
    public function deposits(){
        return $this->hasMany(Deposit::class);
    }

    public function referrals(){
        return $this->hasOne(Referral::class,'user_id');
    }

    public function assigned()
    {
        return $this->hasMany(Assigned::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


    public function completed()
    {
        return $this->hasMany(Completed::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function bio(){
        return $this->hasOne(Bio::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function invites()
    {
        return $this->hasMany(Invite::class, 'user_id');
    }

    public function invokes()
    {
        return $this->hasMany(Invoke::class,'user_id');
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function unlocks()
    {
        return $this->hasMany(Unlock::class);
    }

    public function uncloksAssigned()
    {
        return $this->hasMany(Unlock::class, 'assigned_user_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function unlockPayments()
    {
        return $this->hasMany(UnlocksPayment::class);
    }

    public function unlocksEarnings()
    {
        return $this->hasMany(UnlocksEarning::class);
    }

    public function equity()
    {
        return $this->hasOne(Equity::class,'user_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'online'=>'boolean'
    ];


    public function getRouteKeyName()
    {
        return 'search_id';
    }

    public function setKeyName($key)
    {
        return 'id';
    }

}
