<?php

namespace App\Enums;

enum ReviewRating: int
{
    case OneStar = 1;
    case TwoStars = 2;
    case ThreeStars = 3;
    case FourStars = 4;
    case FiveStars = 5;
}
