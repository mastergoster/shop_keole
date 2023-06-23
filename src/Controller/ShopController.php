<?php

namespace App\Controller;

use App\Repository\ProductsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    #[Route('/', name: 'app_shop')]
    public function index(
        ProductsRepository $products,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $products = $paginator->paginate(
            $products = $products->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('shop/index.html.twig', [
            'items' => $products
        ]);
    }
}
