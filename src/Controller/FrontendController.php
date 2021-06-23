<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FrontendController extends AbstractController
{

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {}
    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return new RedirectResponse($this->urlGenerator->generate('app_dashboard'));
        } else {
            return $this->render('frontend/index.html.twig');
        }
    }
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(UserRepository $userRepository)
    {
        $loggedUser = $userRepository->findOneBy(['email' => $this->getUser()->getEmail()]);
        return $this->render('frontend/dashboard.html.twig', [
            'user' => $loggedUser
        ]);
    }

}
