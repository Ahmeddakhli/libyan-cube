<?php

namespace Modules\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Wildside\Userstamps\Userstamps;

class PaymentPlan extends Model
{   
    use SoftDeletes, SoftCascadeTrait, Userstamps;

    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';
    const DELETED_BY = 'deleted_by';

    protected $table = 'payment_plans';
    protected $fillable = ['title','model_id','model_type', 'delivery_date', 'down_payment', 'installment_amount', 'years_of_installments','discount'];


    public function paymentPlanable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();
    }
}
