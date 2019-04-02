<?php

namespace TTBooking\InquiryDispenser\Subjects;

use Illuminate\Support\Collection;
use TTBooking\InquiryDispenser\Contracts\Subjects\Operator as OperatorContract;

abstract class Operator extends Subject implements OperatorContract
{
    public static function all()
    {
        /** @var Collection|Operator[] $operators */
        $operators = app('dispenser.operator.repository')->all();

        return $operators
            ->filter(function (Operator $operator) {
                return $operator->is(config('dispenser.operator.filtering'));
            })
            ->sortMultiple(config('dispenser.operator.ordering'));
    }

    abstract public function ready($ready);
    abstract public function match($inquiry);
    abstract public function limit($factor, $limit);
}
