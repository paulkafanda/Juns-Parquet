<?php

namespace App\Enums;

enum JugementState : string
{
    case VALIDE = 'VALIDE';
    case EN_APPEL = 'EN APPEL';
    case EN_ATTENTE = 'EN ATTENTE';

}
