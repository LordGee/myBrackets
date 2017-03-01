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

    function bracketSizeRequire($_n) {
        if ($_n < 2) {
            return 0;
        } elseif ($_n == 2) {
            return 2;
        } elseif ($_n > 2 && $_n <= 4) {
            return 4;
        } elseif ($_n > 4 && $_n <= 8) {
            return 8;
        } elseif ($_n > 8 && $_n <= 16) {
            return 16;
        } elseif ($_n > 16 && $_n <= 32) {
            return 32;
        } elseif ($_n > 32 && $_n <= 64) {
            return 64;
        } elseif ($_n > 64 && $_n <= 128) {
            return 128;
        } else {
            return 0;
        }
    }

    function generateBracket() {

    }
?>