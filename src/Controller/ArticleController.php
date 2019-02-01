<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 31/01/2019
 * Time: 15:19
 */

namespace App\Controller;

use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;


class ArticleController extends  AbstractController
{
    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage() //its call a action
        //a controller must return a symfony response object
    {
        //return new Response('My first page !!!YOUPI');
         return $this->render('article/homepage.html.twig');
    }
    //ITs call slug
    ///news/why-asteroids-taste-like-bacon
    /**
     * @Route("/news/{slug}", name="article_show")//match with enything
     *
     */
    //When you change the url call its return in the $slug l'urlapres/news
    //Route and controller systeme

    public function show($slug,MarkdownInterface $markdown, AdapterInterface $cache)//,Environment $twigEnvironment
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

        $articleContent  = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconi^sum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non cupim

EOF;

        $articleContent = $markdown ->transform($articleContent);

        //symfony var  dumper controller
        //  Normally you  user var_dump but Now you use only dump
        //dump($slug, $this);// Nice beautiful output , you can go deeper to deebug
        // render is just a shortcut of twig
        return $this -> render('article/show.html.twig',[
            'title' => ucwords(str_replace('-',' ',$slug)),
            'articleContent' =>$articleContent,
            'slug' => $slug,
            'comments'=> $comments,

        ]);
        //This case is to use the twigEncironnement service without shortcut
//                $html =$twigEnvironment -> render('article/show.html.twig',[
//            'title' => ucwords(str_replace('-',' ',$slug)),
//            'slug' => $slug,
//            'comments'=> $comments,
                //return new Response($html);
//          ]);


    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public  function  toggleArticleHeart($slug,LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article!

        $logger ->info('Article is being hearted');// you can check this in conole php tail -f var/log/dev.log
        //How did that work : BEfore that symfony execute the controller,
        //he looks at each arggument : for argument like slug he pass us  the wildcard value for the ROUTTER
        //BUT for the logger he looks like at the type it an realize it that we want symfony to pass the object
        //the order of the argument doesnt matter
        //  This is a powerful idea call Autowiring
        // If you need a services you just need to know the correect typeIt


        return new JsonResponse(['hearts' =>rand(5,100)]);
    }


}