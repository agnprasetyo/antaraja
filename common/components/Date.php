<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */


namespace common\components;

use yii\base\Component;
use yii\db\Connection;
use yii\db\Expression;
use yii\db\Query;

/**
 *
 */
class Date extends Component
{
    public static $translate = [
        'April' => 'April',
        'August' => 'Agustus',
        'December' => 'Desember',
        'February' => 'Februari',
        'Friday' => 'Jumat',
        'January' => 'Januari',
        'July' => 'Juli',
        'June' => 'Juni',
        'March' => 'Maret',
        'May' => 'Mei',
        'Monday' => 'Senin',
        'November' => 'November',
        'October' => 'Oktober',
        'Saturday' => 'Sabtu',
        'September' => 'September',
        'Sunday' => 'Minggu',
        'Thursday' => 'Kamis',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
    ];

    /**
     * Gets current date from database
     *
     * @param  string          $format Date Format. Please refer to `date()` documentation.
     * @param  Connection|null $db     the database connection used to generate the SQL statement.
     *                                 If this parameter is not given, the `db` application
     *                                 component will be used.
     * @return string
     */
    public static function format($format = 'Y-m-d', $date)
    {
        $time = strtotime($date);
        $date = date($format, $time);

        return strtr($date, static::$translate);
    }

    /**
     * Gets current date from database
     *
     * @param  string          $format Date Format. Please refer to `date()` documentation.
     * @param  Connection|null $db     the database connection used to generate the SQL statement.
     *                                 If this parameter is not given, the `db` application
     *                                 component will be used.
     * @return string
     */
    public static function currentDate($format = 'Y-m-d', Connection $db = null)
    {
        $expression = new Expression('CURDATE()');
        $now        = (new Query)->select($expression)->scalar($db);

        $time = strtotime($now);
        $date = date($format, $time);

        return strtr($date, static::$translate);
    }

    /**
     * Gets current time from database
     *
     * @param string          $format Datetime Format. Please refer to `date()` documentation.
     * @param Connection|null $db     the database connection used to generate the SQL statement.
     *                                If this parameter is not given, the `db` application
     *                                component will be used.
     * @return string
     */
    public static function currentDateTime($format = 'Y-m-d H:i:s', Connection $db = null)
    {

        $expression = new Expression('NOW()');
        $now        = (new Query)->select($expression)->scalar($db);

        $time = strtotime($now);
        $date = date($format, $time);

        return strtr($date, static::$translate);
    }
}
