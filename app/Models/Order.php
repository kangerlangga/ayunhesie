<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_orders';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_orders','order_number','name_orders','email_orders','phone_orders','product_orders','qty_orders','total_orders','payment_method','status_orders','payment_status','proof_of_payment','shipping_address','tracking_number','notes','created_by','modified_by'];
}
