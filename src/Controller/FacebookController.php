<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Facebook\Facebook;

class FacebookController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private UrlGeneratorInterface $urlGenerator,
        private EntityManagerInterface $em,
        private string $baseUrl='https://graph.facebook.com/v11.0'
        )
    {}
    /**
     * @Route("/connect/facebook", name="connect_facebook_start")
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        // full list of permissions to be found here: 
        // https://developers.facebook.com/docs/permissions/reference
        // TODO: separate permissions
        return $clientRegistry
            ->getClient('facebook_main') 
            ->redirect([
	    	'public_profile',
            'email',
            'pages_manage_posts',
            'user_posts',
            'pages_read_engagement',
            `user_events`
            ],[]);
    }

    /**
     * @Route("/connect/facebook/check", name="connect_facebook_check")
     */
    public function connectCheckAction()
    {
        return $this->redirectToRoute('app_dashboard');
    }

    /**
     * @Route("/services/facebook/posts", name="facebook_post_list")
     */
    public function facebookPostList()
    {   
        $fb = new Facebook([
            'app_id' => $_ENV['OAUTH_FACEBOOK_ID'],
            'app_secret' => $_ENV['OAUTH_FACEBOOK_SECRET'],
            'graph_api_version'=> 'v11.0',
            'http_client_handler' => 'stream',
        ]);

        $accessToken = $this->userRepository->findOneBy(['email' => 
            $this->getUser()->getEmail()])->getFacebookToken();
        $currentUser = $this->userRepository->findOneBy(['email' => 
            $this->getUser()->getEmail()]);
        //$fb->get('/me/feed', $accessToken);
        try 
        {
            $response = $fb->get('/me/feed', $accessToken);
        } 
        catch(FacebookResponseException $e)
        {
            echo 'Graph returned an error:' . $e->getMessage();
            exit();
        } 
        catch(FacebookSDKException $e)
        {
            echo 'Facebook SDK returned an error:' . $e->getMessage();
            exit();
        }
        $posts = json_decode($response->getBody(),true);
        
        // dd($posts['data']);
        return $this->render('facebook/post_list.html.twig', [
            'posts' => $posts['data'],
            'user' => $currentUser
        ]);
    }
}
