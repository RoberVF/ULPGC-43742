<?php

namespace App\Enums;

enum SensorType: string {
    case Temperature = 'temperature';
    case Humidity = 'humidity';
}