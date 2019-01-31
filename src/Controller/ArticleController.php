<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 31/01/2019
 * Time: 15:19
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends  AbstractController
{
    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage() //its call a action
        //a controller must return a symfony response object
    {
        return new Response('My first page !!!YOUPI');
        // return $this->render('article/homepage.html.twig');
    }
    //ITs call slug
    ///news/why-asteroids-taste-like-bacon
    /**
     * @Route("/news/{slug}")//match with enything
     *
     */
    //When you change the url call its return in the $slug l'urlapres/news
    //Route and controller systeme

    public function show($slug)
    {
        //return new Response('Future page to show one space articles!');
        // return new Response(sprintf(
        //    'Future page to show the article: %s',
        //    $slug));
        $comments = [
            'I ate a normal rock once . It did NOT taste like bacon !',
            'Woohoo! I\'m going on an all-asteroid diet !',
            'I like bacon too ! Buy some from my site! JeSuisUneArnaque.pif',
        ];
        //symfony var  dumper controller
        //  Normally you  user var_dump but Now you use only dump
        //dump($slug, $this);// Nice beautiful output , you can go deeper to deebug

        return $this -> render('article/show.html.twig',[
            'title' => ucwords(str_replace('-',' ',$slug)),
            'comments'=> $comments,
        ]);
    }


}