<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $guarded = ['id'];

    const STATUS_NEW = 0;

    const STATUS_ACCEPTED = 10;

    const STATUS_COMPLITED = 20;

    /**
     * @return array
     */
    public function getStatuses()
    {
        return [
          self::STATUS_NEW => 'Новый',
          self::STATUS_ACCEPTED => 'Подтвержден',
          self::STATUS_COMPLITED => 'Завершен',
        ];
    }

    public function isCompleted()
    {
        return $this->status == self::STATUS_COMPLITED;
    }

    /**
     * @return int
     */
    public function getPrice() : int
    {
        $price = 0;

        foreach ($this->products as $product){
            $price += $product->pivot->price * $product->pivot->quantity;
        }

        return $price;
    }

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products')
            ->withPivot(['quantity','price']);
    }

    /**
     * @return BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}
