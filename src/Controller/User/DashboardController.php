<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    // public function configureUserMenu(UserInterface $user): UserMenu
    // {
    //     $userMenuItems = [
    //         MenuItem::linkToCrud('user','fa-id-card', User::class),
    //         MenuItem::linkToUrl('Settings','fa-user-cog','/user/settings'),
    //         MenuItem::linkToLogout('__ea__user.sign_out', 'fa-sign-out')
    //     ];

    //     if ($this->isGranted(Permission::EA_EXIT_IMPERSONATION)) {
    //         $userMenuItems[] = 
    //         MenuItem::linkToExitImpersonation(
    //             '__ea__user.exit_impersonation', 
    //             'fa-user-lock'
    //         );
    //     }

    //     return UserMenu::new()
    //         ->displayUserName()
    //         ->displayUserAvatar()
    //         ->setName(method_exists($user, '__toString') ? (string) $user : $user->getName())
    //         ->setAvatarUrl(null)
    //         ->setMenuItems($userMenuItems);
    // }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecf Quai Antique');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('user', 'fa fa-home', User::class);
    }
}
