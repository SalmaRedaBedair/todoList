<?php
function date_validation($date,$type)
{
    // Check if the date is set
    if (!isset($date) || $date === '') {
        $_SESSION["$type"] = "The date is not set.";
        return false;
    }

    $date_format = 'Y-m-d';
    $valid_date = true;

    // Convert date string to date object
    $date_obj = DateTime::createFromFormat($date_format, $date);

    // Check if the date string matches the specified format and is a valid date
    if (!$date_obj || $date_obj->format($date_format) !== $date) {
        $valid_date = false;
    }

    if (!$valid_date) {
        $_SESSION["$type"] = "The date $date is not valid.";
        return false;
    }

    return true;
}
?>