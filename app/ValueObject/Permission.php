<?php

namespace App\ValueObject;

enum Permission: string
{
    case ALL = '*';
    case ROLES = 'roles';
    case FILAMENT = 'filament';
}
