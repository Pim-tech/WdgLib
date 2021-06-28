#!/usr/bin/php
<?php

 $handle = fopen("/dev/stdin" , "r");
 system("stty -icanon -echo eol \001");

 while (1){
  $char  = fgetc($handle);
  switch ($char)
  {
  case 'A' : echo "You typed a 'A'\n";
  break;
  case 'B' : echo "You typed a 'B'\n";
  break;
  case 'Q' : echo "You type a 'Q' and we will quit.\n";
  break 2;
  default : printf("You typed a '%s' and it is not handled.\n", $char);
  }
 }
 system("stty sane");




