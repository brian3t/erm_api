<?php

namespace app\models;


abstract class MpConfig extends \stdClass
{
    /** @var  stdClass $ftp */
    protected $ftp = \stdClass::class;
    protected $MP_REF_NUM_COL = 0;
    protected $order_columns = [];
}