<?php

function getWeekDates(string $inputDate): array
{
    // Create a DateTime object from the input date
    $date = new DateTime($inputDate);
    $dateOfWeek = [];

    // Calculate the day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
    $dayOfWeek = $date->format('w');

    // Calculate the start date of the week (Sunday)
    $startDate = clone $date;
    $startDate->sub(new DateInterval('P' . $dayOfWeek . 'D'));

    // Calculate the end date of the week (Saturday)
    $endDate = clone $date;
    $endDate->add(new DateInterval('P' . (6 - $dayOfWeek) . 'D'));

    // Output the dates of the week
    for ($i = 0; $i <= 6; $i++) {
        $currentDate = $startDate->format('Y-m-d');
        $dateOfWeek[] = $currentDate;
        $startDate->add(new DateInterval('P1D'));
    }

    return $dateOfWeek;
}
