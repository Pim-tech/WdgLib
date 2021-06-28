<?php

namespace lib\widgets; 
/**
 * Class Widget
 * @author yourname
 */
#   ULCORNER  => 218,            #Simple UpLeft CORNER Box
#   URCORNER  => 191, 
#   LRCORNER  => 217,
#   LLCORNER  => 192,
#
#   DURCORNER => 187,          #Double Up Left Corner etc ...
#   DLRCORNER => 188,
#   DULCORNER => 201,
#   DLLCORNER => 200,
#
#   HLINE     => 196,           #Simple Hline and Vline
#   VLINE     => 179,
#
#   DVLINE    => 186,          #Double Vline
#   DHLINE    => 205,           #Double Hline
#
#   PLUS      => 197,
#   BTEE      => 193,
#   TTEE      => 194,
#   LTEE      => 195,
#   RTEE      => 180,
#
#   DPLUS     => 206,          #Double CENTER JONCTION
#   DBTEE     => 202,
#   DTTEE     => 203,
#   DLTEE     => 204,
#   DRTEE     => 185,
#
#   MOSAI1    => 176,
#   MOSAI2    => 177,
#   MOSAI3    => 178
#
#
#   ULCORNER  => 108,            #Simple UpLeft CORNER Box
#   URCORNER  => 107,
#   LRCORNER  => 106,
#   LLCORNER  => 109,
#   HLINE     => 113,           #Simple Hline and Vline
#   VLINE     => 120,
#   DULCORNER => 108,
#   DURCORNER => 107,
#    DLLCORNER => 109,
#   DLRCORNER => 106,
#
#   PLUS       =>  110,
#   TTEE       => 119,
#   BTEE       => 118,
#   RTEE       => 117,
#   LTEE       => 116,
#   DPLUS      => 110,
#   DTTEE      => 119,
#   DBTEE      => 118,
#   DRTEE      => 117,
#   DLTEE      => 116,
#
#   DHLINE    => 113,
#   DVLINE    => 120,
#   MOSAI1    => 97,
#   MOSAI2    => 97,
 public   $MOSAI3    = '97';

class Widget
{

    public function __construct(int $mode=2)
    {
        echo "INTO Constructor\n";
         printf("MOSAI3 : %s\n",$MOSAI3);
    }
    
   public function test_mode($pour = 'all')
   {
        if ($pour == 'all' or $pour == 'xterm'){
            printf("chars for xterm\n");
            for ($i = 97; $i <=120 ;$i++) {
               printf("%d : %c\n",$i,$i);    
            }
        }
        if ($pour == 'all' or $pour == 'linux'){
            printf("chars for linux\n");
            for ($i = 176; $i <=218; $i++) {
               printf("%d : %c\n",$i,$i);    
            }
        }
   }
    
}
