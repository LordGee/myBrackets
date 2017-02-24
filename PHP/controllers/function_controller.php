<?php
    function encryptPassword($_e, $_p) {
        $count = strlen($_e);
        $use = ($count / 2) + 2;
        $s1 = substr($_e, 0, $use);
        $s2 = substr($_e, -$use);
        $s1encrypt = hash('sha256', $s1, false);
        $s2encrypt = hash('sha256', $s2, false);
        $_pass = hash('sha256', $_p, false);
        $paSalt = $s2encrypt . $_pass . $s1encrypt;
        for ($i = 0; $i < $count; $i++) {
            $paSalt = hash('sha256', $paSalt, false);
        }
        return $paSalt;
    }
?>