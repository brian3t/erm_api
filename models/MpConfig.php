<?php

namespace app\models;


abstract class MpConfig extends \stdClass
{
    /** @var  stdClass $ftp */
    protected $ftp = null;
    /** @var  stdClass $api */
    protected $api = null;
    protected $MP_REF_NUM_COL = 0;
    protected $order_columns = [];
    protected $ORDER_FILE_NAME_PRE = "";
}