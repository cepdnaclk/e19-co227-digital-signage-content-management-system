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
    if ($dayOfWeek == 0)
        $startDate->sub(new DateInterval('P6D'));
    else
        $startDate->sub(new DateInterval('P' . ($dayOfWeek - 1) . 'D'));

    // Output the dates of the week
    for ($i = 0; $i <= 6; $i++) {
        $currentDate = $startDate->format('Y-m-d');
        $dateOfWeek[] = $currentDate;
        $startDate->add(new DateInterval('P1D'));
    }

    return $dateOfWeek;
}

function getDatebyIndex(int $index): string
{
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    return $days[$index];
}
