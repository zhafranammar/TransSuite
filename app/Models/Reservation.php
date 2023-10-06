<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'user_approval1_id',
        'user_approval2_id',
        'driver_id',
        'start_date',
        'end_date',
        'status',
        'message',
    ];

    /**
     * Get the vehicle associated with the reservation.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the supervisor user associated with the reservation.
     */
    public function userApproval1()
    {
        return $this->belongsTo(User::class, 'user_approval1_id');
    }

    /**
     * Get the manager user associated with the reservation.
     */
    public function userApproval2()
    {
        return $this->belongsTo(User::class, 'user_approval2_id');
    }
}
