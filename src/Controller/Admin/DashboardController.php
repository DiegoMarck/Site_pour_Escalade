<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Entity\Topo;
use App\Entity\User;
use App\Entity\Entrainement;
use App\Repository\SiteRepository;
use App\Repository\TopoRepository;
use App\Repository\UserRepository;
use App\Repository\EntrainementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{   
    protected $userRepository;
    protected $topoRepository;
    protected $siteRepository;
    protected $entrainementRepository;

    public function __construct(

        UserRepository $userRepository,
        TopoRepository $topoRepository,
        SiteRepository $siteRepository,
        EntrainementRepository $entrainementRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->topoRepository = $topoRepository;
        $this->siteRepository = $siteRepository;
        $this->entrainementRepository = $entrainementRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUser' => $this->userRepository->findAll()
            // 'allUser' => $this->userRepository->findAll(),
        ]);
        // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetEscalade4 4');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Site', 'fa fa-globe', Site::class);
        yield MenuItem::linkToCrud('Topo', 'fa fa-book', Topo::class);
        yield MenuItem::linkToCrud('User', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Entrainement', 'fa fa-running', Entrainement::class);
    }
}
