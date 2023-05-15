<?php

namespace App\Enums;

enum RoleEnums: string
{
    case ADMINISTRATOR = '1';
    case DOCTOR = '2';
    case NURSE = '3';
    case RECEPTIONIST = '4';
}
