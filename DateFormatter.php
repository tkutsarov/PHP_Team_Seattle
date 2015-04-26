<?php
class DateFormatter {

    public static function getDateFromTimeStamp($timestamp){
        $date = date_create($timestamp);

        //$topicPostDay = date('d', (strtotime($date)));
        $topicPostDay = $date->format('d');
        $today = date('d');
        if ($topicPostDay === $today) {

            return 'Today, ' . date_format($date, 'H:i');
        } else if ($topicPostDay == $today - 1) {
            return 'Yesterday, ' . date_format($date, 'H:i');
        } else {
            return date_format($date, 'j F Y');
        }


}

}