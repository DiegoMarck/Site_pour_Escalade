<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Entity\Topo;
use App\Entity\User;
use App\Entity\Carousel;
use App\Entity\Entrainement;
use App\Repository\SiteRepository;
use App\Repository\TopoRepository;
use App\Repository\UserRepository;
use App\Repository\CarouselRepository;
use App\Repository\EntrainementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

/**
 * @Route("/admin")
 */
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private UserRepository $userRepository,
        private TopoRepository $topoRepository,
        private SiteRepository $siteRepository,
        private EntrainementRepository $entrainementRepository,
        private CarouselRepository $carouselRepository
    ) {
    }

    /**
     * @Route("", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'users' => $this->userRepository->countAllUser(),
            'topos' => $this->topoRepository->countAllTopo(),
            'sites' => $this->siteRepository->countAllSite(),
            'entrainements' => $this->entrainementRepository->countAllEntrainement(),
            'carousels' => $this->carouselRepository->countAllCarousel()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Escalade');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Topos', 'fas fa-map', Topo::class);
        yield MenuItem::linkToCrud('Sites', 'fas fa-mountain', Site::class);
        yield MenuItem::linkToCrud('Entrainements', 'fas fa-dumbbell', Entrainement::class);
        yield MenuItem::linkToCrud('Carousel', 'fas fa-images', Carousel::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user);
    }
}
