<?php

namespace App\Controller;

use App\Form\Type\DollarValueByMonthType;
use App\Interfaces\ICsvInterface;
use App\Interfaces\IDollarInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     *
     * @Route("/", name="index_page")
     */
    public function indexAction(IDollarInterface $IDollar, ICsvInterface $csv, Request $request): Response
    {
        $form = $this->createForm(DollarValueByMonthType::class);
        $form->handleRequest($request);
        $date = $form->get('Mes')->getViewData();
        if ($form->isSubmitted()) {
            $dollarValues = $IDollar->dollarValuesByMonth($date);
            if ($form->get('download')->isClicked()) {
                $csv->createCsvDollarValuesByMonth($dollarValues);
                return $this->redirectToRoute('download_values');
            }
            return $this->render('DollarByMonth.html.twig', ['dollar_values' => $dollarValues]);
        }

        return $this->render('Index.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/download", name="download_values")
     */
    public function downloadDollarValuesByMonth(): BinaryFileResponse
    {
        $response = new BinaryFileResponse('../public/dollarValues.csv');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
        $response->deleteFileAfterSend();
        return $response;
    }
}