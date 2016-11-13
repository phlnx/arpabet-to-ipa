<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ( __DIR__ . '/../src/App.php' );

$o = new ArpabetToIPA\App();

print $o -> getIPA("K AH0 N D IH1 SH AH0 N");
