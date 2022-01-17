<?php

namespace App;

use App\Config\Configuration;
use App\Models\Blog;
use App\Models\JoinedTour;
use App\Models\Review;
use App\Models\Tour;
use App\Models\User;
use DateTime;

class Auth
{

    public static function findIdByEmail($email)
    {
        foreach (User::getAll() as $user) {
            if ($user->getEmail() == $email) {
                return $user->getId();
            }
        }
        return 0;
    }

    public static function login($email, $password)
    {
        $id = self::findIdByEmail($email);
        if ($id != 0) {
            $user = User::getOne($id);

            if ($user->getEmail() == $email && password_verify($password, $user->getPassword())) {
                $_SESSION['id_user'] = $id;
                $_SESSION['email'] = $email;
                return true;
            } else {
                return false;
            }
        }
        return false;

    }

    public static function logout()
    {
        unset($_SESSION['email']);   //zrusim session, nebudem prihlaseny
        session_destroy();
    }


    public static function isLogged()
    {
        return isset($_SESSION['email']);
    }

    public static function isAdmin($email)
    {
        $id = self::findIdByEmail($email);
        if ($id != 0) {
            if (User::getOne($id)->getAuthorization() == 'admin') {
                return true;
            } else {
                return false;
            }
        }
        return false;

    }

    public static function getId()
    {
        return (Auth::isLogged() ? $_SESSION['id_user'] : "");
    }

    public static function getNumOfOrdersForTour($id_tour): int
    {
        $joinedTours = JoinedTour::getAll();
        $numOfOrders = 0;
        foreach ($joinedTours as $joinedTour) {
            if ($id_tour == $joinedTour->getIdTour()) {
                $numOfOrders++;
            }
        }
        return $numOfOrders;
    }

    public static function deleteAllUserInfoFromDatabase($id_user)
    {
        $joinedTours = JoinedTour::getAll('id_user = ?', [$id_user]);
        $reviews = Review::getAll('id_user = ?', [$id_user]);
        $blogs = Blog::getAll('id_user = ?', [$id_user]);

        foreach ($joinedTours as $joinedTour) {
            $joinedTour->delete();
        }

        foreach ($reviews as $review) {
            $review->delete();
        }

        foreach ($blogs as $blog) {

            unlink(Configuration::BLOG_IMAGE_DIR . $blog->getImage());
            $blog->delete();
        }

    }

    public static function deleteAllTourInfoFromDatabase($id_tour)
    {
        $joinedTours = JoinedTour::getAll();
        $reviews = Review::getAll();

        foreach ($joinedTours as $joinedTour) {
            if ($id_tour == $joinedTour->getIdTour()) {
                $joinedTour->delete();
            }
        }

        foreach ($reviews as $review) {
            if ($id_tour == $review->getIdTour()) {
                $review->delete();
            }
        }

    }

    public static function alreadyBookedTour($id_tour)
    {
        $id_user = self::getId();
        foreach (JoinedTour::getAll() as $joinedTour) {
            if ($joinedTour->getIdUser() == $id_user && $joinedTour->getIdTour() == $id_tour) {
                return true;
            }
        }
        return false;
    }

    public static function sameReviewText(string $text)
    {
        $id_user = self::getId();
        foreach (Review::getAll() as $review) {
            if ($review->getText() == $text && $review->getIdUser() == $id_user) {
                return true;
            }
        }
        return false;
    }

    public static function getYearsSinceDate($stringDate): int
    {
        $date = strtotime($stringDate);
        $years = abs(date('Y', $date) - date('Y'));
        if ($years > 0) {
            if (date('m') > date('m', $date)) {
                $years--;
            } else if (date('m') < date('m', $date)) {
                if (date('d') < date('d', $date)) {
                    $years--;
                }
            }
        }
        return $years;
    }

    public static function isSentAnyFile($nameOfFile, $fileDirection): ?string
    {
        if (isset($_FILES[$nameOfFile])) {       //Ak mi prisiel nejaky subor
            if ($_FILES[$nameOfFile]['error'] == UPLOAD_ERR_OK) {
                $name = time() . $_FILES[$nameOfFile]['name'];     //Vytvorim si meno suboru
                return $name;
            }
        }
        return null;
    }


    public static function validUserName(?string $name): bool
    {
        if (strlen($name) > 255 || $name == null || $name == "") {
            return false;
        } else {
            return true;
        }
    }

    public static function validPassword($password): bool
    {
        if ($password == null || $password == "") {
            return false;
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 255) {
            return false;
        } else {
            return true;
        }

    }

    public static function validDateOfBirth($date): bool
    {
        if ($date == null || $date == "") {
            return false;
        }
        if (self::getYearsSinceDate($date) >= 18 && self::getYearsSinceDate($date) < 110) {
            return true;
        } else {
            return false;
        }
    }

    public static function validTourDate($stringDate): bool
    {
        if ($stringDate == null || $stringDate == "") {
            return false;
        }
        $date = new DateTime($stringDate);
        $now = new DateTime();

        $dif = ($date->diff($now))->days;
        if (($date->diff($now))->days >= 14 && $date > $now) {
            return true;
        } else {
            return false;
        }

    }

    public static function validTourPrice($price): bool
    {
        if ($price == null || $price == 0) {
            return false;
        }
        if ($price < 100) {
            return false;
        } else {
            return true;
        }
    }

    public static function validTourCapacity($capacity): bool
    {
        if ($capacity == null || $capacity == 0) {
            return false;
        }
        if ($capacity < 5) {
            return false;
        } else {
            return true;
        }
    }

    public static function validEmail($email): bool
    {
        if ($email == null || $email == "") {
            return false;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) < 255) {
            return true;
        } else {
            return false;
        }
    }

    public static function validLogin($login): bool
    {
        if ($login == null || $login == "") {
            return false;
        } else if (strlen($login) > 255) {
            return false;
        } else {
            return true;
        }

    }


}