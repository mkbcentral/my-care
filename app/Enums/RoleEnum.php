<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMINISTRATOR = '1';
    case DOCTOR = '2';
    case NURSE = '3';
    case RECEPTIONIST = '4';
    case PATIENT = '5';
}
