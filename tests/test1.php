#!/usr/bin/php
<?php
/**
 * undocumented function
 *
 * @return void
 */
declare(encoding='UTF-8');
const N = 9472;
function test()
{
    #$ar = unpack("C*",0X20AC);
    $ar = unpack('C*',0X2580);
    $bin = "\xE2\x82\xAC";
    $ar2 = unpack("C*",$bin);
    #printf("Dec    Oct    char\n");
    #for ($i=0;$i <=127 ;$i++)
    #{
    # $t = ($i+N);
    # printf("%d    %o     %c\n",$i,$i,$i);
    #}
    #
    #$ar = [65,66,67,0];

    $str= '';
    $n = 0;
    
    $ar[1] =  (($ar[1]>>12)|0xE0);
    $ar[2] =  ((($ar[2]>>6) & 0x3F) | 0x80);
    $ar[3] =  (($ar[3]&0x3F) | 0x80); 
    foreach ($ar as $key => $value) {
        printf("key : %s, value : %X\n",$key,$value); 
        $str[$n++] = chr($value);
    }
    printf("bin : '%s'\n",$bin);
    printf("str : '%s'\n",$str);
    printf("\n");
    #printf("%s\n",$str);
    #var_dump($ar);
   
    #printf("%s\n" , $c);
}
test();

