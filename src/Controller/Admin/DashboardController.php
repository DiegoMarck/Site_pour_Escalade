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
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    protected $userRepository;
    protected $topoRepository;
    protected $siteRepository;
    protected $entrainementRepository;
    protected $carouselRepository;

    public function __construct(

        UserRepository $userRepository,
        TopoRepository $topoRepository,
        SiteRepository $siteRepository,
        EntrainementRepository $entrainementRepository,
        CarouselRepository $carouselRepository
    ) {
        $this->userRepository = $userRepository;
        $this->topoRepository = $topoRepository;
        $this->siteRepository = $siteRepository;
        $this->entrainementRepository = $entrainementRepository;
        $this->CarouselRepository = $carouselRepository;
    }
    // /**
    //  * @Route("/admin", name="admin")
    //  * @IsGranted("ROLE_ADMIN")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
    //         // 'countAllUser' => $this->userRepository->countAllUser(),
    //         'countAllSite' => $this->siteRepository->countAllSite(),
    //         'countAllTopo' => $this->topoRepository->countAllTopo(),
    //         'users' => $this->userRepository->findAll()
    //     ]);
    //     // return parent::index();
    // }
    // Dans src/Controller/Admin/DashboardController.php, modifiez la méthode index :

    // src/Controller/Admin/DashboardController.php

    // src/Controller/Admin/DashboardController.php

    // /**
    //  * @Route("/admin", name="admin")
    //  * @IsGranted("ROLE_ADMIN")
    //  */
    // public function index(): Response
    // {
    //     // Utilisation des méthodes existantes pour le comptage
    //     $stats = [
    //         'users' => $this->userRepository->countAllUser(),
    //         'sites' => $this->siteRepository->countAllSite(),
    //         'sites_pending' => $this->siteRepository->count(['isValidated' => false]),
    //         'topos' => $this->topoRepository->countAllTopo(),
    //         'entrainements' => $this->entrainementRepository->count([])
    //     ];

    //     return $this->render('admin/index.html.twig', [
    //         'stats' => $stats,
    //     ]);
    // }

    // src/Controller/Admin/DashboardController.php

    /**
     * @Route("/admin", name="admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        try {
            $users = $this->userRepository->countAllUser();
            $sites = $this->siteRepository->countAllSite();
            $topos = $this->topoRepository->countAllTopo();

            // Dump pour déboguer
            dump([
                'users_count' => $users,
                'sites_count' => $sites,
                'topos_count' => $topos
            ]);

            return $this->render('admin/index.html.twig', [
                'stats' => [
                    'users' => $users,
                    'sites' => $sites,
                    'sites_pending' => 0,
                    'topos' => $topos,
                    'entrainements' => 0
                ]
            ]);
        } catch (\Exception $e) {
            // Log l'erreur
            dump($e->getMessage());

            // Retourner des valeurs par défaut en cas d'erreur
            return $this->render('admin/index.html.twig', [
                'stats' => [
                    'users' => 0,
                    'sites' => 0,
                    'sites_pending' => 0,
                    'topos' => 0,
                    'entrainements' => 0
                ]
            ]);
        }
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet_Escalade');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Site', 'fa fa-globe', Site::class);
        yield MenuItem::linkToCrud('Topo', 'fa fa-book', Topo::class);
        yield MenuItem::linkToCrud('User', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Entrainement', 'fa fa-running', Entrainement::class);
        yield MenuItem::linkToCrud('Carousel', 'fa fa-images', Carousel::class);
    }
    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUsername())
            ->setAvatarUrl('https://img1.freepng.fr/20180224/vte/kisspng-rock-climbing-icon-woman-rock-climbing-5a90fb26174870.4591308215194509180954.jpg')
            // ->setGravatarEmail($user->getUsername())
            ->displayUserAvatar(true)
        ;
    }
}
