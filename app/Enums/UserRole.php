<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */

/** @noinspection ALL */

namespace App\Enums;

enum UserRole : string
{
    case SECRETAIRE = 'secretaire';
    case MAGISTRAT = 'magistrat';
    case CHEF_OFFICE = 'chef_office';
    case ADMIN = 'admin';
    case JUGE = 'juge';

}
