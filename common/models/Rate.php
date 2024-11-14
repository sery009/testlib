<?php
namespace common\models;
class Rate
{
    public static function getBTC($sum)
    {
        $bit = 1.035*file_get_contents('https://blockchain.info/tobtc?currency=RUB&value='.$sum);
        return $bit;
    }
}