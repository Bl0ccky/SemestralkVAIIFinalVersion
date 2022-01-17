<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Models\Blog;
use App\Models\Tour;
use App\Models\User;
use function Sodium\add;

class AdminController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        return $this->html(
            [
                'active' => 'home'
            ]);
    }

    public function addTourForm()
    {
        return $this->html(
            [
                'active' => 'addTour',
                'badName' => $this->request()->getValue('badName'),
                'badImage' => $this->request()->getValue('badImage'),
                'badPrice' => $this->request()->getValue('badPrice'),
                'badDate' => $this->request()->getValue('badDate'),
                'badCapacity' => $this->request()->getValue('badCapacity')
            ]);
    }

    public function specificTourEdit()
    {
        return $this->html(
            [
                'active' => 'adminer',
                'id_tour' => $this->request()->getValue('id_tour'),
                'badName' => $this->request()->getValue('badName'),
                'badImage' => $this->request()->getValue('badImage'),
                'badPrice' => $this->request()->getValue('badPrice'),
                'badDate' => $this->request()->getValue('badDate'),
                'badCapacity' => $this->request()->getValue('badCapacity')
            ]
        );
    }
    
    public function specificTourEditForm()
    {
        $id_tour = $this->request()->getValue('edited_tour');
        $this->redirect('admin', 'specificTourEdit',
            [
                'id_tour' => $id_tour,
                'badName' => $this->request()->getValue('badName'),
                'badImage' => $this->request()->getValue('badImage'),
                'badPrice' => $this->request()->getValue('badPrice'),
                'badDate' => $this->request()->getValue('badDate'),
                'badCapacity' => $this->request()->getValue('badCapacity')
            ]);
        
    }

    public function addBlogForm()
    {
        return $this->html(
            [
                'active' => 'addBlog',
                'badName' => $this->request()->getValue('badName'),
                'badImage' => $this->request()->getValue('badImage')
            ]);
    }

    public function adminer()
    {
        $users = User::getAll();
        $tours = Tour::getAll();
        return $this->html(
            [
                'active' => 'adminer',
                'users' => $users,
                'tours' => $tours,
                'message' => $this->request()->getValue('message'),
                'deletedTour' => $this->request()->getValue('deletedTour')
            ]);
    }

    public function addTour()
    {
        self::addOrEditTour("add");

    }
    public function editTour()
    {
        self::addOrEditTour("edit");
    }

    public function addOrEditTour($addOrEdit)
    {
        if($addOrEdit == "add")
        {
            $redirect = 'addTourForm';
        }
        else
        {
            $redirect = 'specificTourEditForm';
        }

        $name = $this->request()->getValue('tour_name');
        $price = $this->request()->getValue('tour_price');
        $date = $this->request()->getValue('tour_date');
        $capacity = $this->request()->getValue('tour_capacity');
        $info = $this->request()->getValue('tour_info');

        $badName = '';
        $badImage = '';
        $badPrice = '';
        $badDate = '';
        $badCapacity = '';

        if($addOrEdit == "add")
        {
            $tour = new Tour();
        }
        else
        {
            $tour = Tour::getOne($this->request()->getValue('edited_tour'));
        }

        $correctTour = true;
        if(!Auth::validUserName($name))
        {
            $correctTour = false;
            $badName = 'Meno musí byť vyplnené!';

        }
        if(!Auth::validTourPrice($price))
        {
            $correctTour = false;
            $badPrice = 'Cena zájazdu musí byť minimálne 100!';
        }
        if(!Auth::validTourDate($date))
        {
            $correctTour = false;
            $badDate = 'Dátum musí byť min. o 2 týždne neskôr';
        }
        if($addOrEdit == "add")
        {
            if (!Auth::validTourCapacity($capacity))
            {
                $correctTour = false;
                $badCapacity = 'Kapacita je príliš nízka! Min. 5';
            }
        }
        else
        {
            if (!Auth::validTourCapacity($capacity))
            {
                $correctTour = false;
                $badCapacity = 'Kapacita je príliš nízka! Min. 5';
            }
            elseif ($capacity < Auth::getNumOfOrdersForTour($tour->getId()))
            {
                $correctTour = false;
                $badCapacity = 'Kapacita je príliš nízka! Nemôže byť nižšia ako počet prihlásených!';
            }

        }

        if(!isset($_FILES['tour_image']) && $addOrEdit == "add")
        {
            $correctTour = false;
            $badImage = 'Zájazd musí mať nejaký obrázok!';
        }

        if($correctTour)
        {

            $tour->setName($name);
            $tour->setPrice($price);
            $tour->setDate($date);
            $tour->setInfo($info);
            $tour->setCapacity($capacity);

            $fileName = Auth::isSentAnyFile('tour_image', Configuration::TOUR_IMAGE_DIR);
            if($fileName != null)
            {
                if($tour->getImage())
                {
                    unlink(Configuration::TOUR_IMAGE_DIR . $tour->getImage());
                }

                $tour->setImage($fileName);
                move_uploaded_file($_FILES['tour_image']['tmp_name'], Configuration::TOUR_IMAGE_DIR . "$fileName");


            }

            $tour->save();
            if($addOrEdit == "add")
            {
                $this->redirect('home', 'tours', ['message' => 'Zájazd úspešne pridaný!']);
            }
            else
            {
                $this->redirect('home', 'specificTour', ['successEdit' => 'Zájazd úspešne upravený!', 'id_tour' => $tour->getId()]);
            }

        }
        else
        {
            $this->redirect('admin', $redirect,
                ['badName' => $badName,
                    'badImage' => $badImage,
                    'badPrice' => $badPrice,
                    'badDate' => $badDate,
                    'badCapacity' => $badCapacity,
                    'edited_tour' => $this->request()->getValue('edited_tour')
                ]);
        }

    }



    public function deleteTour()
    {
        $id_tour = $this->request()->getValue('deleted_tour');
        $tour = Tour::getOne($id_tour);
        if($tour)
        {
            Auth::deleteAllTourInfoFromDatabase($id_tour);
            unlink(Configuration::TOUR_IMAGE_DIR . $tour->getImage());
            $tour->delete();

        }
    }

    public function addBlog()
    {
        $name = $this->request()->getValue('blog_name');
        $text = $this->request()->getValue('blog_text');

        $badName = '';
        $badImage = '';

        $correctBlog = true;
        if(!Auth::validUserName($name))
        {
            $correctBlog = false;
            $badName = 'Meno musí byť vyplnené!';
        }
        if(!isset($_FILES['blog_image']))
        {
            $correctBlog = false;
            $badImage = 'Zájazd musí mať nejaký obrázok!';
        }

        if($correctBlog)
        {
            $blog = new Blog();

            $blog->setName($name);
            $blog->setText($text);

            $fileName = Auth::isSentAnyFile('blog_image', Configuration::BLOG_IMAGE_DIR);
            if($fileName != null)
            {
                if($blog->getImage())
                {
                    unlink(Configuration::TOUR_IMAGE_DIR . $blog->getImage());
                }

                $blog->setImage($fileName);
                move_uploaded_file($_FILES['blog_image']['tmp_name'], Configuration::BLOG_IMAGE_DIR . "$fileName");

            }
            $blog->setIdUser(Auth::getId());
            $blog->save();
            $this->redirect('home', 'blogs', ['message' => 'Blog úspešne pridaný!']);

        }
        else
        {
            $this->redirect('admin', 'addBlogForm',
                ['badName' => $badName,
                    'badImage' => $badImage,
                ]);

        }
    }

    public function editUsers()
    {
        foreach (User::getAll() as $user)
        {
            if($this->request()->getValue($user->getId()) != null)
            {
                $user->setAuthorization("admin");
            }
            else
            {
                $user->setAuthorization("user");
            }
            $user->save();
        }
        $this->redirect('admin', 'adminer', ['message' => 'Zmeny úspešne prevedené!']);

    }

    
}