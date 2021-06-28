<?php
namespace lib\widgets; 
use lib\widgets\colors\Colors;
use lib\widgets\Screen;

//Charboxes
/* 9472 [─] */ define('LIGHT_HORIZONTAL',0X2500);
/* 9473 [━] */ define('HEAVY_HORIZONTAL',0X2501);
/* 9474 [│] */ define('LIGHT_VERTICAL',0X2502);
/* 9475 [┃] */ define('HEAVY_VERTICAL',0X2503);
/* 9476 [┄] */ define('LIGHT_TRIPLE_DASH_HORIZONTAL',0X2504);
/* 9477 [┅] */ define('HEAVY_TRIPLE_DASH_HORIZONTAL',0X2505);
/* 9478 [┆] */ define('LIGHT_TRIPLE_DASH_VERTICAL',0X2506);
/* 9479 [┇] */ define('HEAVY_TRIPLE_DASH_VERTICAL',0X2507);
/* 9480 [┈] */ define('LIGHT_QUADRUPLE_DASH_HORIZONTAL',0X2508);
/* 9481 [┉] */ define('HEAVY_QUADRUPLE_DASH_HORIZONTAL',0X2509);
/* 9482 [┊] */ define('LIGHT_QUADRUPLE_DASH_VERTICAL',0X250A);
/* 9483 [┋] */ define('HEAVY_QUADRUPLE_DASH_VERTICAL',0X250B);
/* 9484 [┌] */ define('LIGHT_DOWN_AND_RIGHT',0X250C);
/* 9485 [┍] */ define('DOWN_LIGHT_AND_RIGHT_HEAVY',0X250D);
/* 9486 [┎] */ define('DOWN_HEAVY_AND_RIGHT_LIGHT',0X250E);
/* 9487 [┏] */ define('HEAVY_DOWN_AND_RIGHT',0X250F);
/* 9488 [┐] */ define('LIGHT_DOWN_AND_LEFT',0X2510);
/* 9489 [┑] */ define('DOWN_LIGHT_AND_LEFT_HEAVY',0X2511);
/* 9490 [┒] */ define('DOWN_HEAVY_AND_LEFT_LIGHT',0X2512);
/* 9491 [┓] */ define('HEAVY_DOWN_AND_LEFT',0X2513);
/* 9492 [└] */ define('LIGHT_UP_AND_RIGHT',0X2514);
/* 9493 [┕] */ define('UP_LIGHT_AND_RIGHT_HEAVY',0X2515);
/* 9494 [┖] */ define('UP_HEAVY_AND_RIGHT_LIGHT',0X2516);
/* 9495 [┗] */ define('HEAVY_UP_AND_RIGHT',0X2517);
/* 9496 [┘] */ define('LIGHT_UP_AND_LEFT',0X2518);
/* 9497 [┙] */ define('UP_LIGHT_AND_LEFT_HEAVY',0X2519);
/* 9498 [┚] */ define('UP_HEAVY_AND_LEFT_LIGHT',0X251A);
/* 9499 [┛] */ define('HEAVY_UP_AND_LEFT',0X251B);
/* 9500 [├] */ define('LIGHT_VERTICAL_AND_RIGHT',0X251C);
/* 9501 [┝] */ define('VERTICAL_LIGHT_AND_RIGHT_HEAVY',0X251D);
/* 9502 [┞] */ define('UP_HEAVY_AND_RIGHT_DOWN_LIGHT',0X251E);
/* 9503 [┟] */ define('DOWN_HEAVY_AND_RIGHT_UP_LIGHT',0X251F);
/* 9504 [┠] */ define('VERTICAL_HEAVY_AND_RIGHT_LIGHT',0X2520);
/* 9505 [┡] */ define('DOWN_LIGHT_AND_RIGHT_UP_HEAVY',0X2521);
/* 9506 [┢] */ define('UP_LIGHT_AND_RIGHT_DOWN_HEAVY',0X2522);
/* 9507 [┣] */ define('HEAVY_VERTICAL_AND_RIGHT',0X2523);
/* 9508 [┤] */ define('LIGHT_VERTICAL_AND_LEFT',0X2524);
/* 9509 [┥] */ define('VERTICAL_LIGHT_AND_LEFT_HEAVY',0X2525);
/* 9510 [┦] */ define('UP_HEAVY_AND_LEFT_DOWN_LIGHT',0X2526);
/* 9511 [┧] */ define('DOWN_HEAVY_AND_LEFT_UP_LIGHT',0X2527);
/* 9512 [┨] */ define('VERTICAL_HEAVY_AND_LEFT_LIGHT',0X2528);
/* 9513 [┩] */ define('DOWN_LIGHT_AND_LEFT_UP_HEAVY',0X2529);
/* 9514 [┪] */ define('UP_LIGHT_AND_LEFT_DOWN_HEAVY',0X252A);
/* 9515 [┫] */ define('HEAVY_VERTICAL_AND_LEFT',0X252B);
/* 9516 [┬] */ define('LIGHT_DOWN_AND_HORIZONTAL',0X252C);
/* 9517 [┭] */ define('LEFT_HEAVY_AND_RIGHT_DOWN_LIGHT',0X252D);
/* 9518 [┮] */ define('RIGHT_HEAVY_AND_LEFT_DOWN_LIGHT',0X252E);
/* 9519 [┯] */ define('DOWN_LIGHT_AND_HORIZONTAL_HEAVY',0X252F);
/* 9520 [┰] */ define('DOWN_HEAVY_AND_HORIZONTAL_LIGHT',0X2530);
/* 9521 [┱] */ define('RIGHT_LIGHT_AND_LEFT_DOWN_HEAVY',0X2531);
/* 9522 [┲] */ define('LEFT_LIGHT_AND_RIGHT_DOWN_HEAVY',0X2532);
/* 9523 [┳] */ define('HEAVY_DOWN_AND_HORIZONTAL',0X2533);
/* 9524 [┴] */ define('LIGHT_UP_AND_HORIZONTAL',0X2534);
/* 9525 [┵] */ define('LEFT_HEAVY_AND_RIGHT_UP_LIGHT',0X2535);
/* 9526 [┶] */ define('RIGHT_HEAVY_AND_LEFT_UP_LIGHT',0X2536);
/* 9527 [┷] */ define('UP_LIGHT_AND_HORIZONTAL_HEAVY',0X2537);
/* 9528 [┸] */ define('UP_HEAVY_AND_HORIZONTAL_LIGHT',0X2538);
/* 9529 [┹] */ define('RIGHT_LIGHT_AND_LEFT_UP_HEAVY',0X2539);
/* 9530 [┺] */ define('LEFT_LIGHT_AND_RIGHT_UP_HEAVY',0X253A);
/* 9531 [┻] */ define('HEAVY_UP_AND_HORIZONTAL',0X253B);
/* 9532 [┼] */ define('LIGHT_VERTICAL_AND_HORIZONTAL',0X253C);
/* 9533 [┽] */ define('LEFT_HEAVY_AND_RIGHT_VERTICAL_LIGHT',0X253D);
/* 9534 [┾] */ define('RIGHT_HEAVY_AND_LEFT_VERTICAL_LIGHT',0X253E);
/* 9535 [┿] */ define('VERTICAL_LIGHT_AND_HORIZONTAL_HEAVY',0X253F);
/* 9536 [╀] */ define('UP_HEAVY_AND_DOWN_HORIZONTAL_LIGHT',0X2540);
/* 9537 [╁] */ define('DOWN_HEAVY_AND_UP_HORIZONTAL_LIGHT',0X2541);
/* 9538 [╂] */ define('VERTICAL_HEAVY_AND_HORIZONTAL_LIGHT',0X2542);
/* 9539 [╃] */ define('LEFT_UP_HEAVY_AND_RIGHT_DOWN_LIGHT',0X2543);
/* 9540 [╄] */ define('RIGHT_UP_HEAVY_AND_LEFT_DOWN_LIGHT',0X2544);
/* 9541 [╅] */ define('LEFT_DOWN_HEAVY_AND_RIGHT_UP_LIGHT',0X2545);
/* 9542 [╆] */ define('RIGHT_DOWN_HEAVY_AND_LEFT_UP_LIGHT',0X2546);
/* 9543 [╇] */ define('DOWN_LIGHT_AND_UP_HORIZONTAL_HEAVY',0X2547);
/* 9544 [╈] */ define('UP_LIGHT_AND_DOWN_HORIZONTAL_HEAVY',0X2548);
/* 9545 [╉] */ define('RIGHT_LIGHT_AND_LEFT_VERTICAL_HEAVY',0X2549);
/* 9546 [╊] */ define('LEFT_LIGHT_AND_RIGHT_VERTICAL_HEAVY',0X254A);
/* 9547 [╋] */ define('HEAVY_VERTICAL_AND_HORIZONTAL',0X254B);
/* 9548 [╌] */ define('LIGHT_DOUBLE_DASH_HORIZONTAL',0X254C);
/* 9549 [╍] */ define('HEAVY_DOUBLE_DASH_HORIZONTAL',0X254D);
/* 9550 [╎] */ define('LIGHT_DOUBLE_DASH_VERTICAL',0X254E);
/* 9551 [╏] */ define('HEAVY_DOUBLE_DASH_VERTICAL',0X254F);
/* 9552 [═] */ define('DOUBLE_HORIZONTAL',0X2550);
/* 9553 [║] */ define('DOUBLE_VERTICAL',0X2551);
/* 9554 [╒] */ define('DOWN_SINGLE_AND_RIGHT_DOUBLE',0X2552);
/* 9555 [╓] */ define('DOWN_DOUBLE_AND_RIGHT_SINGLE',0X2553);
/* 9556 [╔] */ define('DOUBLE_DOWN_AND_RIGHT',0X2554);
/* 9557 [╕] */ define('DOWN_SINGLE_AND_LEFT_DOUBLE',0X2555);
/* 9558 [╖] */ define('DOWN_DOUBLE_AND_LEFT_SINGLE',0X2556);
/* 9559 [╗] */ define('DOUBLE_DOWN_AND_LEFT',0X2557);
/* 9560 [╘] */ define('UP_SINGLE_AND_RIGHT_DOUBLE',0X2558);
/* 9561 [╙] */ define('UP_DOUBLE_AND_RIGHT_SINGLE',0X2559);
/* 9562 [╚] */ define('DOUBLE_UP_AND_RIGHT',0X255A);
/* 9563 [╛] */ define('UP_SINGLE_AND_LEFT_DOUBLE',0X255B);
/* 9564 [╜] */ define('UP_DOUBLE_AND_LEFT_SINGLE',0X255C);
/* 9565 [╝] */ define('DOUBLE_UP_AND_LEFT',0X255D);
/* 9566 [╞] */ define('VERTICAL_SINGLE_AND_RIGHT_DOUBLE',0X255E);
/* 9567 [╟] */ define('VERTICAL_DOUBLE_AND_RIGHT_SINGLE',0X255F);
/* 9568 [╠] */ define('DOUBLE_VERTICAL_AND_RIGHT',0X2560);
/* 9569 [╡] */ define('VERTICAL_SINGLE_AND_LEFT_DOUBLE',0X2561);
/* 9570 [╢] */ define('VERTICAL_DOUBLE_AND_LEFT_SINGLE',0X2562);
/* 9571 [╣] */ define('DOUBLE_VERTICAL_AND_LEFT',0X2563);
/* 9572 [╤] */ define('DOWN_SINGLE_AND_HORIZONTAL_DOUBLE',0X2564);
/* 9573 [╥] */ define('DOWN_DOUBLE_AND_HORIZONTAL_SINGLE',0X2565);
/* 9574 [╦] */ define('DOUBLE_DOWN_AND_HORIZONTAL',0X2566);
/* 9575 [╧] */ define('UP_SINGLE_AND_HORIZONTAL_DOUBLE',0X2567);
/* 9576 [╨] */ define('UP_DOUBLE_AND_HORIZONTAL_SINGLE',0X2568);
/* 9577 [╩] */ define('DOUBLE_UP_AND_HORIZONTAL',0X2569);
/* 9578 [╪] */ define('VERTICAL_SINGLE_AND_HORIZONTAL_DOUBLE',0X256A);
/* 9579 [╫] */ define('VERTICAL_DOUBLE_AND_HORIZONTAL_SINGLE',0X256B);
/* 9580 [╬] */ define('DOUBLE_VERTICAL_AND_HORIZONTAL',0X256C);
/* 9581 [╭] */ define('LIGHT_ARC_DOWN_AND_RIGHT',0X256D);
/* 9582 [╮] */ define('LIGHT_ARC_DOWN_AND_LEFT',0X256E);
/* 9583 [╯] */ define('LIGHT_ARC_UP_AND_LEFT',0X256F);
/* 9584 [╰] */ define('LIGHT_ARC_UP_AND_RIGHT',0X2570);
/* 9585 [╱] */ define('LIGHT_DIAGONAL_UPPER_RIGHT_TO_LOWER_LEFT',0X2571);
/* 9586 [╲] */ define('LIGHT_DIAGONAL_UPPER_LEFT_TO_LOWER_RIGHT',0X2572);
/* 9587 [╳] */ define('LIGHT_DIAGONAL_CROSS',0X2573);
/* 9588 [╴] */ define('LIGHT_LEFT',0X2574);
/* 9589 [╵] */ define('LIGHT_UP',0X2575);
/* 9590 [╶] */ define('LIGHT_RIGHT',0X2576);
/* 9591 [╷] */ define('LIGHT_DOWN',0X2577);
/* 9592 [╸] */ define('HEAVY_LEFT',0X2578);
/* 9593 [╹] */ define('HEAVY_UP',0X2579);
/* 9594 [╺] */ define('HEAVY_RIGHT',0X257A);
/* 9595 [╻] */ define('HEAVY_DOWN',0X257B);
/* 9596 [╼] */ define('LIGHT_LEFT_AND_HEAVY_RIGHT',0X257C);
/* 9597 [╽] */ define('LIGHT_UP_AND_HEAVY_DOWN',0X257D);
/* 9598 [╾] */ define('HEAVY_LEFT_AND_LIGHT_RIGHT',0X257E);
/* 9599 [╿] */ define('HEAVY_UP_AND_LIGHT_DOWN',0X257F);
/* 9600 [▀] */ define('UPPER_HALF_BLOCK',0X2580);
/* 9601 [▁] */ define('LOWER_ONE_EIGHTH_BLOCK',0X2581);
/* 9602 [▂] */ define('LOWER_ONE_QUARTER_BLOCK',0X2582);
/* 9603 [▃] */ define('LOWER_THREE_EIGHTHS_BLOCK',0X2583);
/* 9604 [▄] */ define('LOWER_HALF_BLOCK',0X2584);
/* 9605 [▅] */ define('LOWER_FIVE_EIGHTHS_BLOCK',0X2585);
/* 9606 [▆] */ define('LOWER_THREE_QUARTERS_BLOCK',0X2586);
/* 9607 [▇] */ define('LOWER_SEVEN_EIGHTHS_BLOCK',0X2587);
/* 9608 [█] */ define('FULL_BLOCK',0X2588);
/* 9609 [▉] */ define('LEFT_SEVEN_EIGHTHS_BLOCK',0X2589);
/* 9610 [▊] */ define('LEFT_THREE_QUARTERS_BLOCK',0X258A);
/* 9611 [▋] */ define('LEFT_FIVE_EIGHTHS_BLOCK',0X258B);
/* 9612 [▌] */ define('LEFT_HALF_BLOCK',0X258C);
/* 9613 [▍] */ define('LEFT_THREE_EIGHTHS_BLOCK',0X258D);
/* 9614 [▎] */ define('LEFT_ONE_QUARTER_BLOCK',0X258E);
/* 9615 [▏] */ define('LEFT_ONE_EIGHTH_BLOCK',0X258F);
/* 9616 [▐] */ define('RIGHT_HALF_BLOCK',0X2590);
/* 9617 [░] */ define('LIGHT_SHADE',0X2591);
/* 9618 [▒] */ define('MEDIUM_SHADE',0X2592);
/* 9619 [▓] */ define('DARK_SHADE',0X2593);
/* 9620 [▔] */ define('UPPER_ONE_EIGHTH_BLOCK',0X2594);
/* 9621 [▕] */ define('RIGHT_ONE_EIGHTH_BLOCK',0X2595);
/* 9622 [▖] */ define('QUADRANT_LOWER_LEFT',0X2596);
/* 9623 [▗] */ define('QUADRANT_LOWER_RIGHT',0X2597);
/* 9624 [▘] */ define('QUADRANT_UPPER_LEFT',0X2598);
/* 9625 [▙] */ define('QUADRANT_UPPER_LEFT_AND_LOWER_LEFT_AND_LOWER_RIGHT',0X2599);
/* 9626 [▚] */ define('QUADRANT_UPPER_LEFT_AND_LOWER_RIGHT',0X259A);
/* 9627 [▛] */ define('QUADRANT_UPPER_LEFT_AND_UPPER_RIGHT_AND_LOWER_LEFT',0X259B);
/* 9628 [▜] */ define('QUADRANT_UPPER_LEFT_AND_UPPER_RIGHT_AND_LOWER_RIGHT',0X259C);
/* 9629 [▝] */ define('QUADRANT_UPPER_RIGHT',0X259D);
/* 9630 [▞] */ define('QUADRANT_UPPER_RIGHT_AND_LOWER_LEFT',0X259E);
/* 9631 [▟] */ define('QUADRANT_UPPER_RIGHT_AND_LOWER_LEFT_AND_LOWER_RIGHT',0X259F);

//Specials letters at map et the very beginning 0X00 to 1XFF and the symbol 7F
/*  32   [ ] */ define('SPACE',0X0020);
/*  9786 [☺] */ define('WHITE_SMILING_FACE',0X263A);
/*  9787 [☻] */ define('BLACK_SMILING_FACE',0X263B);
/*  9829 [♥] */ define('BLACK_HEART_SUIT',0X2665);
/*  9830 [♦] */ define('BLACK_DIAMOND_SUIT',0X2666);
/*  9827 [♣] */ define('BLACK_CLUB_SUIT',0X2663);
/*  9824 [♠] */ define('BLACK_SPADE_SUIT',0X2660);
/*  8226 [•] */ define('BULLET',0X2022);
/*  9688 [◘] */ define('INVERSE_BULLET',0X25D8);
/*  9675 [○] */ define('WHITE_CIRCLE',0X25CB);
/*  9689 [◙] */ define('INVERSE_WHITE_CIRCLE',0X25D9);
/*  9794 [♂] */ define('MALE_SIGN',0X2642);
/*  9792 [♀] */ define('FEMALE_SIGN',0X2640);
/*  9834 [♪] */ define('EIGHTH_NOTE',0X266A);
/*  9835 [♫] */ define('BEAMED_EIGHTH_NOTES',0X266B);
/*  9788 [☼] */ define('WHITE_SUN_WITH_RAYS',0X263C);
/*  9658 [►] */ define('BLACK_RIGHT_POINTING_POINTER',0X25BA);
/*  9668 [◄] */ define('BLACK_LEFT_POINTING_POINTER',0X25C4);
/*  8597 [↕] */ define('UP_DOWN_ARROW',0X2195);
/*  8252 [‼] */ define('DOUBLE_EXCLAMATION_MARK',0X203C);
/*   182 [¶] */ define('PILCROW_SIGN',0X00B6);
/*   167 [§] */ define('SECTION_SIGN',0X00A7);
/*  9644 [▬] */ define('BLACK_RECTANGLE',0X25AC);
/*  8616 [↨] */ define('UP_DOWN_ARROW_WITH_BASE',0X21A8);
/*  8593 [↑] */ define('UPWARDS_ARROW',0X2191);
/*  8595 [↓] */ define('DOWNWARDS_ARROW',0X2193);
/*  8594 [→] */ define('RIGHTWARDS_ARROW',0X2192);
/*  8592 [←] */ define('LEFTWARDS_ARROW',0X2190);
/*  8735 [∟] */ define('RIGHT_ANGLE',0X221F);
/*  8596 [↔] */ define('LEFT_RIGHT_ARROW',0X2194);
/*  9650 [▲] */ define('BLACK_UP_POINTING_TRIANGLE',0X25B2);
/*  9660 [▼] */ define('BLACK_DOWN_POINTING_TRIANGLE',0X25BC);
/*  8962 [⌂] */ define('HOUSE',0X2302);

//Special letters to map just before darkshades 0X80 to 0XAF
/*  199 [Ç] */ define('LATIN_CAPITAL_LETTER_C_WITH_CEDILLA',0X00C7);
/*  252 [ü] */ define('LATIN_SMALL_LETTER_U_WITH_DIAERESIS',0X00FC);
/*  233 [é] */ define('LATIN_SMALL_LETTER_E_WITH_ACUTE',0X00E9);
/*  226 [â] */ define('LATIN_SMALL_LETTER_A_WITH_CIRCUMFLEX',0X00E2);
/*  228 [ä] */ define('LATIN_SMALL_LETTER_A_WITH_DIAERESIS',0X00E4);
/*  224 [à] */ define('LATIN_SMALL_LETTER_A_WITH_GRAVE',0X00E0);
/*  229 [å] */ define('LATIN_SMALL_LETTER_A_WITH_RING_ABOVE',0X00E5);
/*  231 [ç] */ define('LATIN_SMALL_LETTER_C_WITH_CEDILLA',0X00E7);
/*  234 [ê] */ define('LATIN_SMALL_LETTER_E_WITH_CIRCUMFLEX',0X00EA);
/*  235 [ë] */ define('LATIN_SMALL_LETTER_E_WITH_DIAERESIS',0X00EB);
/*  232 [è] */ define('LATIN_SMALL_LETTER_E_WITH_GRAVE',0X00E8);
/*  239 [ï] */ define('LATIN_SMALL_LETTER_I_WITH_DIAERESIS',0X00EF);
/*  238 [î] */ define('LATIN_SMALL_LETTER_I_WITH_CIRCUMFLEX',0X00EE);
/*  236 [ì] */ define('LATIN_SMALL_LETTER_I_WITH_GRAVE',0X00EC);
/*  196 [Ä] */ define('LATIN_CAPITAL_LETTER_A_WITH_DIAERESIS',0X00C4);
/*  197 [Å] */ define('LATIN_CAPITAL_LETTER_A_WITH_RING_ABOVE',0X00C5);
/*  201 [É] */ define('LATIN_CAPITAL_LETTER_E_WITH_ACUTE',0X00C9);
/*  230 [æ] */ define('LATIN_SMALL_LETTER_AE',0X00E6);
/*  198 [Æ] */ define('LATIN_CAPITAL_LETTER_AE',0X00C6);
/*  244 [ô] */ define('LATIN_SMALL_LETTER_O_WITH_CIRCUMFLEX',0X00F4);
/*  246 [ö] */ define('LATIN_SMALL_LETTER_O_WITH_DIAERESIS',0X00F6);
/*  242 [ò] */ define('LATIN_SMALL_LETTER_O_WITH_GRAVE',0X00F2);
/*  251 [û] */ define('LATIN_SMALL_LETTER_U_WITH_CIRCUMFLEX',0X00FB);
/*  249 [ù] */ define('LATIN_SMALL_LETTER_U_WITH_GRAVE',0X00F9);
/*  255 [ÿ] */ define('LATIN_SMALL_LETTER_Y_WITH_DIAERESIS',0X00FF);
/*  214 [Ö] */ define('LATIN_CAPITAL_LETTER_O_WITH_DIAERESIS',0X00D6);
/*  220 [Ü] */ define('LATIN_CAPITAL_LETTER_U_WITH_DIAERESIS',0X00DC);
/*  162 [¢] */ define('CENT_SIGN',0X00A2);
/*  163 [£] */ define('POUND_SIGN',0X00A3);
/*  165 [¥] */ define('YEN_SIGN',0X00A5);
/* 8359 [₧] */ define('PESETA_SIGN',0X20A7);
/*  402 [ƒ] */ define('LATIN_SMALL_LETTER_F_WITH_HOOK',0X0192);
/*  225 [á] */ define('LATIN_SMALL_LETTER_A_WITH_ACUTE',0X00E1);
/*  237 [í] */ define('LATIN_SMALL_LETTER_I_WITH_ACUTE',0X00ED);
/*  243 [ó] */ define('LATIN_SMALL_LETTER_O_WITH_ACUTE',0X00F3);
/*  250 [ú] */ define('LATIN_SMALL_LETTER_U_WITH_ACUTE',0X00FA);
/*  241 [ñ] */ define('LATIN_SMALL_LETTER_N_WITH_TILDE',0X00F1);
/*  209 [Ñ] */ define('LATIN_CAPITAL_LETTER_N_WITH_TILDE',0X00D1);
/*  170 [ª] */ define('FEMININE_ORDINAL_INDICATOR',0X00AA);
/*  186 [º] */ define('MASCULINE_ORDINAL_INDICATOR',0X00BA);
/*  191 [¿] */ define('INVERTED_QUESTION_MARK',0X00BF);
/* 8976 [⌐] */ define('REVERSED_NOT_SIGN',0X2310);
/*  172 [¬] */ define('NOT_SIGN',0X00AC);
/*  189 [½] */ define('VULGAR_FRACTION_ONE_HALF',0X00BD);
/*  188 [¼] */ define('VULGAR_FRACTION_ONE_QUARTER',0X00BC);
/*  161 [¡] */ define('INVERTED_EXCLAMATION_MARK',0X00A1);
/*  171 [«] */ define('LEFT_POINTING_DOUBLE_ANGLE_QUOTATION_MARK',0X00AB);
/*  187 [»] */ define('RIGHT_POINTING_DOUBLE_ANGLE_QUOTATION_MARK',0X00BB);

//Special letters to map after charboxes 0XE0  to 0X FF
/*  945 [α] */ define('GREEK_SMALL_LETTER_ALPHA',0X03B1);
/*  223 [ß] */ define('LATIN_SMALL_LETTER_SHARP_S',0X00DF);
/*  915 [Γ] */ define('GREEK_CAPITAL_LETTER_GAMMA',0X0393);
/*  960 [π] */ define('GREEK_SMALL_LETTER_PI',0X03C0);
/*  931 [Σ] */ define('GREEK_CAPITAL_LETTER_SIGMA',0X03A3);
/*  963 [σ] */ define('GREEK_SMALL_LETTER_SIGMA',0X03C3);
/*  181 [µ] */ define('MICRO_SIGN',0X00B5);
/*  964 [τ] */ define('GREEK_SMALL_LETTER_TAU',0X03C4);
/*  934 [Φ] */ define('GREEK_CAPITAL_LETTER_PHI',0X03A6);
/*  920 [Θ] */ define('GREEK_CAPITAL_LETTER_THETA',0X0398);
/*  937 [Ω] */ define('GREEK_CAPITAL_LETTER_OMEGA',0X03A9);
/*  948 [δ] */ define('GREEK_SMALL_LETTER_DELTA',0X03B4);
/* 8734 [∞] */ define('INFINITY',0X221E);
/*  966 [φ] */ define('GREEK_SMALL_LETTER_PHI',0X03C6);
/* 8745 [∩] */ define('INTERSECTION',0X2229);
/* 8801 [≡] */ define('IDENTICAL_TO',0X2261);
/*  177 [±] */ define('PLUS_MINUS_SIGN',0X00B1);
/* 8805 [≥] */ define('GREATER_THAN_OR_EQUAL_TO',0X2265);
/* 8804 [≤] */ define('LESS_THAN_OR_EQUAL_TO',0X2264);
/* 8992 [⌠] */ define('TOP_HALF_INTEGRAL',0X2320);
/* 8993 [⌡] */ define('BOTTOM_HALF_INTEGRAL',0X2321);
/*  247 [÷] */ define('DIVISION_SIGN',0X00F7);
/* 8776 [≈] */ define('ALMOST_EQUAL_TO',0X2248);
/*  176 [°] */ define('DEGREE_SIGN',0X00B0);
/* 8729 [∙] */ define('BULLET_OPERATOR',0X2219);
/*  183 [·] */ define('MIDDLE_DOT',0X00B7);
/* 8730 [√] */ define('SQUARE_ROOT',0X221A);
/* 8319 [ⁿ] */ define('SUPERSCRIPT_LATIN_SMALL_LETTER_N',0X207F);
/*  178 [²] */ define('SUPERSCRIPT_TWO',0X00B2);
/* 9632 [■] */ define('BLACK_SQUARE',0X25A0);
/*  160 [ ] */ define('NO_BREAK_SPACE',0X00A0);

//Symbols characters

$global_screen = null;
/**
 * Class Shape
 */
class Shape
{
    /**
     * @param $dependencies
     */
    protected $xpos,$ypos,$width,$height;
    protected $color_attr;
    protected $obj_color;
    protected $charmap = 'iso10646';
    private $current_attr;
    private $startseq;
    protected $obj_screen;
    protected $obj_prescreen;
    protected $region = array();


    /*
     * This is mapping for only specials chars because we suppose that
     * ASCII chars do not need mapping 
     * */
      
    private $iso10646tocp437 = [
//Specials letters to map at the very beginning 0X00 to 1XF and the symbol 7F
        0X0020 => 0X00 , # 32   
        0X263A => 0X01 , # 9786 
        0X263B => 0X02 , # 9787 
        0X2665 => 0X03 , # 9829 
        0X2666 => 0X04 , # 9830 
        0X2663 => 0X05 , # 9827 
        0X2660 => 0X06 , # 9824 
        0X2022 => 0X07 , # 8226 
        0X25D8 => 0X08 , # 9688 
        0X25CB => 0X09 , # 9675 
        0X25D9 => 0X0A , # 9689 
        0X2642 => 0X0B , # 9794 
        0X2640 => 0X0C , # 9792 
        0X266A => 0X0D , # 9834 
        0X266B => 0X0E , # 9835 
        0X263C => 0X0F , # 9788 
        0X25BA => 0X10 , # 9658 
        0X25C4 => 0X11 , # 9668 
        0X2195 => 0X12 , # 8597 
        0X203C => 0X13 , # 8252 
        0X00B6 => 0X14 , # 182 
        0X00A7 => 0X15 , # 167 
        0X25AC => 0X16 , # 9644 
        0X21A8 => 0X17 , # 8616 
        0X2191 => 0X18 , # 8593 
        0X2193 => 0X19 , # 8595 
        0X2192 => 0X1A , # 8594 
        0X2190 => 0X1B , # 8592 
        0X221F => 0X1C , # 8735 
        0X2194 => 0X1D , # 8596 
        0X25B2 => 0X1E , # 9650 
        0X25BC => 0X1F , # 9660 
        0X2302 => 0X7F , # 8962 
        //Charboxes
        0X2591 => 0XB0,
        0X2592 => 0XB1,
        0X2593 => 0XB2,
        0X2502 => 0XB3,
        0X2524 => 0XB4,
        0X2561 => 0XB5,
        0X2562 => 0XB6,
        0X2556 => 0XB7,
        0X2555 => 0XB8,
        0X2563 => 0XB9,
        0X2551 => 0XBA,
        0X2557 => 0XBB,
        0X255D => 0XBC,
        0X255C => 0XBD,
        0X255B => 0XBE,
        0X2510 => 0XBF,
        0X2514 => 0XC0,
        0X2534 => 0XC1,
        0X252C => 0XC2,
        0X251C => 0XC3,
        0X2500 => 0XC4,
        0X253C => 0XC5,
        0X255E => 0XC6,
        0X255F => 0XC7,
        0X255A => 0XC8,
        0X2554 => 0XC9,
        0X2569 => 0XCA,
        0X2566 => 0XCB,
        0X2560 => 0XCC,
        0X2550 => 0XCD,
        0X256C => 0XCE,
        0X2567 => 0XCF,
        0X2568 => 0XD0,
        0X2564 => 0XD1,
        0X2565 => 0XD2,
        0X2559 => 0XD3,
        0X2558 => 0XD4,
        0X2552 => 0XD5,
        0x2553 => 0XD6,
        0x256B => 0XD7,
        0x256A => 0XD8,
        0x2518 => 0XD9,
        0x250C => 0XDA,
        0x2588 => 0XDB,
        0x2584 => 0XDC,
        0x258C => 0XDD,
        0x2590 => 0XDE,
        0x2580 => 0XDF,
//Special letters to map after charboxes 0XE0  to 0X FF
        0X03B1 => 0XE0 , # 945 
        0X00DF => 0XE1 , # 223 
        0X0393 => 0XE2 , # 915 
        0X03C0 => 0XE3 , # 960 
        0X03A3 => 0XE4 , # 931 
        0X03C3 => 0XE5 , # 963 
        0X00B5 => 0XE6 , # 181 
        0X03C4 => 0XE7 , # 964 
        0X03A6 => 0XE8 , # 934 
        0X0398 => 0XE9 , # 920 
        0X03A9 => 0XEA , # 937 
        0X03B4 => 0XEB , # 948 
        0X221E => 0XEC , # 8734 
        0X03C6 => 0XED , # 966 
        0X03B5 => 0XEE , 
        0X2229 => 0XEF , # 8745 
        0X2261 => 0XF0 , # 8801 
        0X00B1 => 0XF1 , # 177 
        0X2265 => 0XF2 , # 8805 
        0X2264 => 0XF3 , # 8804 
        0X2320 => 0XF4 , # 8992 
        0X2321 => 0XF5 , # 8993 
        0X00F7 => 0XF6 , # 247 
        0X2248 => 0XF7 , # 8776 
        0X00B0 => 0XF8 , # 176 
        0X2219 => 0XF9 , # 8729 
        0X00B7 => 0XFA , # 183 
        0X221A => 0XFB , # 8730 
        0X207F => 0XFC , # 8319 
        0X00B2 => 0XFD , # 178 
        0X25A0 => 0XFE , # 9632 
        0X00A0 => 0XFF , # 160 
    ];
    public function __construct(array $p = [],$obj_screen = null) 
    {
        if (array_key_exists('x',$p)){
            $this->xpos = $p['x'];
        }
        if (array_key_exists('y',$p)){
            $this->ypos = $p['y'];
        }
        if (array_key_exists('width',$p)){
            $this->width = $p['width'];
        }
        if (array_key_exists('height',$p)){
            $this->height = $p['height'];
        }
        if (array_key_exists('dimensions',$p)){
           [$this->xpos,$this->ypos,$this->width,$this->height] = $p['dimensions']; 
        }
        if (array_key_exists('color',$p)){
            $this->color_attr = $p['color'];
            $this->obj_color = new Colors();
           if (array_key_exists('color_depth',$p)){
               $this->obj_color->set_colordepth($p['color_depth']);
           }
           $this->startseq = $this->obj_color->get_startseq();
        }
        if (array_key_exists('cursor',$p)){
            switch ($p['cursor'])
            {
            case 'show' : 
                $this->show_cursor();
                break;
            case 'hide' :
                $this->erase_cursor();
                break;
            case 'save':
                ;
                break;
            case 'restore':
                ;
                break;
            default:
                printf("Bad option '%s' for cursor.\n",$p['cursor']);
            }
        }

        if ( ! is_null($obj_screen)){
            $this->obj_screen = $obj_screen;
            $this->obj_prescreen = $obj_screen->get_objprescreen();
        }
        else {
            $this->create_screen();
        }
        //Auto dimensions à la taille si pas de dimensions donnees 
        if ( null == $this->width){
            $this->xpos = 1;
            $this->width = $this->obj_screen->get_cols();
        }
        if ( null == $this->height){
            $this->ypos = 1;
            $this->height = $this->obj_screen->get_lines();
        }

    }


    public function print_wch(int $id)
    {
      echo  wch($id);
    }

    //builds an UTF8 char and returns the string 
    protected function wch($w_char) : string
    {
        $str='';
        if (gettype($w_char) == 'string') {
            $str = $w_char;
            return $str;
        }

                  //printf("PASS 1\n");
       $ar = [];
       if ($this->charmap == 'iso10646'){ //utf8 
                  //printf("PASS 0\n");
                  //printf("PASS 1\n");
              if ($w_char<(1<<7))// 7 bit Unicode encoded as plain ascii
              {
                  $ar[0] = $w_char;
              }
              else if ($w_char<(1<<11))// 11 bit Unicode encoded in 2 UTF-8 bytes
              {
                  $ar = array(
                      (($w_char>>6)|0xC0),
                      (($w_char&0x3F)|0x80)
                  );
              }
              else if ($w_char<(1<<16))// 16 bit Unicode encoded in 3 UTF-8 bytes
              {
                 $ar = array ( 
                     (($w_char>>12) | 0XE0),
                     ((($w_char>>6) & 0X3F)| 0X80),
                     (($w_char&0X3F) | 0X80)
                 );
              } 
              else if ($w_char<(1<<21))// 21 bit Unicode encoded in 4 UTF-8 bytes
              {
                  $ar = array(
                  ((($w_char>>18))|0xF0),
                  ((($w_char>>12)&0x3F)|0x80),
                  ((($w_char>>6)&0x3F)|0x80),
                  (($w_char&0x3F)|0x80)
              );
            }
       for($i=0;$i<count($ar);$i++) 
              $str[$i] = chr($ar[$i]);
       $str[$i] = chr(0);

      } else if ($charmap == 'iso8859') {
      } else if ($charmap == 'iso8859-15') {
      } else if ($charmap == 'cp437'){
          if (! key_exists($w_char,$iso10646tocp437)){
              $obj_color->preset();
              printf("\nERROR char $w_ch not found in maps conversion : theres is no candidate for wide_char U+%X in cp437\n");
              exit(1);
          }
          $int_char = $iso10646tocp437[$w_char]; 
          $str[0] = chr($int_char);
          $str[1] = chr(0); 

      } else if ($charmap == 'latin1'){
      }

       return $str;
    }
    public function gotoxy(int $x, int $y){
        printf($this->startseq . "%d;%dH",$y,$x);
    }
    public function sgotoxy(int $x,int $y) : string {
        return sprintf($this->startseq . "%d;%dH",$y,$x);
    }
    public function mv_right(int $len){
        printf($this->startseq ."%dC",$len);
    }
    public function smv_right(int $len){
        return sprintf($this->startseq ."%dC",$len);
    }
    public function clear(){
        echo $startseq . '2J';
    }
    public function erase_cursor() {
        echo $this->startseq .'?25l';
    }
    public function show_cursor() {
        echo $this->startseq . '?25h';
    }
    public function serase_cursor(){
        return ($this->startseq .'?25l');
    }
    public function sshow_cursor(){
        return ($this->startseq . '?25h');
    }
    public function set_dimentions (int $x,int $y,int $width,int $height){
        $this->xpos = $x;
        $this->ypos = $y;
        $this->height = $height;
        $this->width = $width;
    }
    public function set_adimentions(array $dim){
        [$this->xpos,$this->ypos,$this->width,$this->height] = $dim;
    }
    public function set_charmap(string $map){
        $this->charmap = $map;

    }
    public function get_charmap(){
        return $this->charmap;
    }
    public function set_objcolor(Color &$obj)
    {
        $this->obj_color = $obj;
    }
    protected function get_objcolor()
    {
        return $this->obj_color;
    }
    public function get_objscreen() : Screen
    {
        return $this->obj_screen;
    }
    public function set_colorattr($color_attr)
    {
        $this->color_attr = $color_attr;
    }
    public function get_colorattr()
    {
        return $this->colorattr;
    }

    public function set_objscreen($obj_screen)
    {
        $this->obj_screen = $obj_screen;
    }
    public function hide(){
     $a_ref = $this->region;
     
         $str='';
        for ($i = 0; $i< count($a_ref);$i++){
            if ($a_ref[$i][0]<0 && $a_ref[$i][1]<0){
                $x = abs($a_ref[$i][0]);
                $y = abs($a_ref[$i][1]);
                $str.=$this->sgotoxy($x,$y);
            }
            else if ($a_ref[$i][0] == 1000 && $a_ref[$i][1] < 0){
               $str.=$this->smv_right(abs($a_ref[$i][1]));
            }
            else{
                if ($this->current_attr != $a_ref[$i][0]){
                    $this->current_attr = $a_ref[$i][0]; 
                    $str.=$this->obj_color->start_color($a_ref[$i][0]);
                }
                    $str .= mb_chr($a_ref[$i][1]);
            }
        }
         if (strlen($str) > 0)
           echo $str . "\e[0m"; 
    }
    public function create_screen()
    {
        global $global_screen;
        if (is_null($GLOBALS['global_screen'])){
            $global_screen = new Screen();
        }
        $this->obj_screen = $global_screen;
        $this->obj_prescreen = $this->obj_screen->get_objprescreen();
    }
}
