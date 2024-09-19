<?php

function lang($phrase)
{

  static $lang = array(

    'HOME'   => 'Home',
    'CATEGORIES'   => 'Categories',
    'ITEMS'     => 'Items',
  );

  return $lang[$phrase];
}
