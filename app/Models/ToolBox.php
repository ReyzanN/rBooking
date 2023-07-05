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
}
