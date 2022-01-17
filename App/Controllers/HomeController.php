<?php

namespace App\Controllers;

use App\Auth;
use App\Models\Blog;
use App\Models\JoinedTour;
use App\Models\Review;
use App\Models\Tour;
use App\Models\User;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html(
            [
                'active' => 'home',
                'message' => $this->request()->getValue('message')
            ]);
    }

    public function about()
    {
        return $this->html(
            [
                'active' => 'about'
            ]
        );
    }

    public function tours()
    {
        $tours = Tour::getAll();
        return $this->html(
            [
                'active' => 'tours',
                'tours' => $tours,
                'message' => $this->request()->getValue('message')
            ]
        );
    }

    public function blogs()
    {
        $blogs = Blog::getAll();
        return $this->html(
            [
                'active' => 'blogs',
                'blogs' => $blogs,
                'message' => $this->request()->getValue('message')
            ]
        );
    }

    public function specificBlog()
    {
        return $this->html(
            [
                'active' => 'blogs',
                'id_blog' => $this->request()->getValue('id_blog')
            ]
        );

    }

    public function specificBlogForm()
    {
        $id_blog = $this->request()->getValue('id_blog');
        $this->redirect('home', 'specificBlog',['id_blog' => $id_blog]);

    }

    public function specificTour()
    {
        return $this->html(
            [
                'active' => 'tours',
                'id_tour' => $this->request()->getValue('id_tour'),
                'message' => $this->request()->getValue('message'),
                'successEdit' => $this->request()->getValue('successEdit'),

            ]
        );
    }

    public function specificTourForm()
    {
        $id_tour = $this->request()->getValue('id_tour');
        $this->redirect('home', 'specificTour',['id_tour' => $id_tour]);
    }

    public function addReview()
    {
        $id_user = $_SESSION['id_user'];
        $id_tour = $this->request()->getValue('id_tour');
        if(!Auth::sameReviewText($this->request()->getValue('review')))
        {
            $review = new Review();
            $review->setText($this->request()->getValue('review'));
            $review->setIdUser($id_user);
            $review->setIdTour($id_tour);
            $review->save();
        }

        $this->redirect('home', 'specificTour', ['id_tour' => $id_tour]);
    }


    public function joinTour()
    {
        $id_user = $_SESSION['id_user'];
        $id_tour = $this->request()->getValue('id_tour');
        if(Auth::isLogged())
        {
            if($id_user != null && $id_tour != null && !Auth::alreadyBookedTour($id_tour))
            {
                $joined_tour = new JoinedTour();
                $joined_tour->setIdUser($id_user);
                $joined_tour->setIdTour($id_tour);
                $joined_tour->save();
            }

            $this->redirect('home', 'specificTour', ['message' => 'Zájazd ste si úspěsne objednali!', 'id_tour' => $id_tour]);
        }
        else
        {
            $this->redirect('auth', 'loginForm', ['error' => 'Na objednanie zájazdu sa musíte prihlásiť!']);
        }



    }

    public function leaveTour()
    {
        if(isset($_SESSION['id_user']) && $this->request()->getValue('id_tour') != null)
        {
            $id_user = $_SESSION['id_user'];
            $id_tour = $this->request()->getValue('id_tour');
            $removed_tour = null;

            foreach (JoinedTour::getAll() as $joined_tour)
            {
                if ($joined_tour->getIdTour() == $id_tour && $joined_tour->getIdUser() == $id_user)
                {
                    $removed_tour = JoinedTour::getOne($joined_tour->getId());
                }
            }

            if($removed_tour != null)
            {
                $removed_tour->delete();
            }

        }

        $this->redirect('auth', 'profile', ['message' => 'Zájazd ste si úspešne odhlásili!']);
    }

    public function getAllTours()
    {
        $minPrice = $this->request()->getValue('minPrice');
        $maxPrice = $this->request()->getValue('maxPrice');
        if($minPrice == "" && $maxPrice == "")
        {
            $tours = Tour::getAll();
        }
        else if($minPrice == "")
        {
            $tours = Tour::getAll('price <= ?', [$maxPrice]);
        }
        else if($maxPrice == "")
        {
            $tours = Tour::getAll('price >= ?', [$minPrice]);
        }
        else
        {
            $tours = Tour::getAll('price >= ? AND price <= ?', [$minPrice, $maxPrice]);
        }
        if(empty($tours))
        {
            return $this->json('ArrayIsEmpty');
        }

        return $this->json($tours);
    }

    public function getNumOfOrders()
    {
        $id_tour = $this->request()->getValue('id_tour');
        return $this->json(Auth::getNumOfOrdersForTour($id_tour));
    }

}