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

    function howManyRounds($_s) {
        if ($_s == 2) {
            return 1;
        } elseif ($_s == 4) {
            return 2;
        } elseif ($_s == 8) {
            return 3;
        } elseif ($_s == 16) {
            return 4;
        } elseif ($_s == 32) {
            return 5;
        } elseif ($_s == 64) {
            return 6;
        } elseif ($_s == 128) {
            return 7;
        } else {
            return 0;
        }
    }

    function changePlayerOrder($_o, $_n) {
        for ($i = 0; $i < count($_o); $i++) {
                $temp = $_n[$_o[$i]];
                $ordered[$i] = $temp;
        }
        return $ordered;
    }

    function changeEmailOrder($_o, $_e) {
        for ($i = 0; $i < count($_o); $i++) {
                $temp = $_e[$_o[$i]];
                $ordered[$i] = $temp;
        }
        return $ordered;
    }

    function generateGames($_g, $_r, $_n, $_e, $_id) {
        global $eventObject;
        for ($r = 0; $r < $_r; $r++) {
            $p = 0;
            $_g = $_g / 2;
            for ($g = 0; $g < $_g; $g++) {
                if ($r + 1 == 1) {
                    $eventObject->updateGameNewEvent($_id, $r + 1, $g + 1, $_n[$p], $_n[$p + 1], $_e[$p], $_e[$p + 1], "Round");
                    $p += 2;
                } elseif ($_r - $r == 1) {
                    $eventObject->updateGameNewEvent($_id, $r + 1, $g + 1, "", "", "", "", "Final");
                } elseif ($_r - $r == 2) {
                    $eventObject->updateGameNewEvent($_id, $r + 1, $g + 1, "", "", "", "", "Semi-Final");
                } elseif ($_r - $r == 2) {
                    $eventObject->updateGameNewEvent($_id, $r + 1, $g + 1, "", "", "", "", "Quarter-Final");
                } else {
                    $eventObject->updateGameNewEvent($_id, $r + 1, $g + 1, "", "", "", "", "Round");
                }
            }
        }
    }

    function cleanUp() {
        $tempUser = $_SESSION['user'];
        $tempEid = $_SESSION['e_id'];
        session_destroy();
        session_start();
        $_SESSION['user'] = $tempUser;
        $_SESSION['e_id'] = $tempEid;
    }

    function updateNewBracket($_id) {
        global $eventObject;
        $event = $eventObject->getEventById($_id, $_SESSION['user']);
        for ($i = 0; $i < count($event['games']); $i++) {
            if ($event['games'][$i]['score1'] > 0 || $event['games'][$i]['score2'] > 0) {
                moveWinner($_id, $event['games'][$i]['id'], $event['games'][$i]['round'], $event['games'][$i]['game'], $event['games'][$i]['player1'], $event['games'][$i]['score1'], $event['games'][$i]['player2'], $event['games'][$i]['score2']);
            }
        }
        return $event;
    }

    function moveWinner($_id, $_gid, $_r, $_g, $_p1, $_s1, $_p2, $_s2) {
        global $eventObject;
        $nextGameNumber = null;
        $nextPosition = null;
        $nextRound = $_r + 1;
        if ($_g % 2 == 0) {
            $nextGameNumber = $_g / 2;
            $nextPosition = 2;
        } else {
            $nextGameNumber = ($_g + 1) / 2;
            $nextPosition = 1;
        }
        $games = $eventObject->getGameByIdRoundAndGame($_id, $_gid);
        $nextGameId = null;
        for ($g = 0; $g < count($games['games']); $g++) {
            if ($games['games'][$g]['round'] == $nextRound && $games['games'][$g]['game'] == $nextGameNumber) {
                $nextGameId = $games['games'][$g]['id'];
            }
        }
        if ($_s1 > $_s2) {
            if ($nextPosition == 2) {
                $_p2 = $_p1;
                $_p1 = null;
            } else {
                $_p2 = null;
            }
            $eventObject->updateWinnerToNextRound($_id, $nextGameId, $_p1, $_p2);
        } elseif ($_s2 > $_s1) {
            if ($nextPosition == 2) {
                $_p1 = null;
            } else {
                $_p1 = $_p2;
                $_p2 = null;
            }
            $eventObject->updateWinnerToNextRound($_id, $nextGameId, $_p1, $_p2);
        }
    }

    function uploadPicture()
    {
        $target_dir = "profile/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (isset($_POST["picture"])) {
            $check = getimagesize($_FILES["picture"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["picture"]["size"] > 20000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
            && $imageFileType != "GIF"
        ) {
            echo "Sorry, only specific image files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], "" . $target_file)) {
                // echo "Your file " . basename($_FILES["picture"]["name"]) . " has been uploaded.";
                return $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>