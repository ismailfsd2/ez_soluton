<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Products extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
        'barcode',
        'company_code',
        'cost',
        'price',
        'mrp',
        'tax_method',
        'taxes',
        'category_id',
        'unit_id',
        'brand_id',
        'suppliers',
        'alert_quantity',
        'description',
        'created_by',
        'status'
    ];
}
