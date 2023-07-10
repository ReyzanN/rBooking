<?php

namespace App\Models;

trait ToolBox
{
    /**
     * @date 05/07/2023
     * @param \DateTime|string $dateTime
     * @return string
     * @throws \Exception
     */
    public function ParseDateToString(\DateTime|string $dateTime):string {
        if (is_string($dateTime)){
            $Date = new \DateTime($dateTime);
            return $Date->format('d/m/y H:i');
        }else {
            return $dateTime->format('d/m/y H:i');
        }
    }

    public function ParseDateForAppointment(\DateTime|string $dateTime):string {
        $Day = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
        $Month = array(
            'Jan' => 'Janvier',
            'Feb' => 'Février',
            'Mar' => 'Mars',
            'Apr' => 'Avril',
            'May' => 'Mai',
            'Jun' => 'Juin',
            'Jul' => 'Juillet',
            'Aug' => 'Août',
            'Sep' => 'Septembre',
            'Oct' => 'Octobre',
            'Nov' => 'Novembre',
            'Dec' => 'Décembre',
        );
        if (is_string($dateTime)){
            $Date = new \DateTime($dateTime);
            return $Day[$Date->format('w')].' '.$Date->format('d').' '.$Month[$Date->format('M')].' '.$Date->format('Y');
        }else {
            return $Day[$dateTime->format('w')].' '.$dateTime->format('d').' '.$Month[$dateTime->format('M')].' '.$dateTime->format('Y');
        }
    }
}
