<?php

namespace App\Controller;

use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\NumeroDonsRepository;
use App\Repository\NumeroZipcodeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/')]
class HomeController extends AbstractController
{
    public function __construct(){}

    public function randomColorRGB()
    {
        return "rgb(" . rand(0, 255) . ", " . rand(0, 255) . ", " . rand(0, 255) . ")";
    }

    public function randomColorRGBA(float $transparency)
    {
        return "rgb(" . rand(0, 255) . ", " . rand(0, 255) . ", " . rand(0, 255) . ", " . $transparency . ")";
    }

    #[Route('', name: 'app_home')]
    public function index(NumeroDonsRepository $donsrepo, NumeroZipcodeRepository $ziprepo, ChartBuilderInterface $chartBuilder)
    {
        // Info for charts    
            // Get number of occurences of all amount
                $allDons = $donsrepo->findAllAmount();
            // Get 10 most used zipcode
                $orderedZip = $ziprepo->findMostUsedZipcode();
            // Get other zipcode number of donator
                $otherZip = $ziprepo->findOthersZipcode();
            // Get top ten donators
                $topTen = $donsrepo->findToTenDonator();
        // Color for chart 1 and split amount and count
            foreach($allDons as $don){
                $montants[]=$don['Compteur'];
                $count[]=$don['montant'];
                $randomColor[]=$this->randomColorRGB();
                $randomBorderColor[]=$this->randomColorRGB();
            }
        // Color for chart 2 and split count and zipcode
            foreach($orderedZip as $zip){
                $numbers[]=$zip['Compteur'];
                $zipcodes[]=$zip['zipcode'];
                $randomColorChart2[]=$this->randomColorRGB();
                $randomBorderColorChart2[]=$this->randomColorRGB();
            }
            // Add data of others zipcodes
                $zipcodes[]="Autres";
                foreach($otherZip as $zip){
                    $numbers[]=$zip['Compteur'];
                }
            
        // Color for chart 3 and split amount and phone numbers
            foreach($topTen as $donator){
                $phoneNumbers[]=$donator['numero'];
                $amounts[]=$donator['montant'];
                $randomColorChart3[]=$this->randomColorRGB();
                $randomBorderColorChart3[]=$this->randomColorRGB();
            }
        
        // First chart (Number of donation amounts) [BAR]
            $donations = $chartBuilder->createChart(Chart::TYPE_BAR);

                $donations->setData([
                    'labels' => $montants,
                    'datasets' => [
                        [
                            'label' => 'Montant des dons et nombre de donateurs',
                            'backgroundColor' => $randomColorChart2,
                            'borderColor' => $randomBorderColorChart2,
                            'data' => $count,
                        ],
                    ],
                ]);

        // Second chart (Repartition departements) [PIE]
            $departements = $chartBuilder->createChart(Chart::TYPE_PIE);

            $departements->setData([
                'labels' => $zipcodes,
                'datasets' => [
                    [
                        'label' => 'Répartition de donation par code postal',
                        'backgroundColor' => $randomColor,
                        'borderColor' => $randomBorderColor,
                        'data' => $numbers,
                    ],
                ],
            ]);
        // Third chart (Top 10 Donators) [BAR]
            $topTenDonators = $chartBuilder->createChart(Chart::TYPE_BAR);

            $topTenDonators->setData([
                'labels' => $phoneNumbers,
                'datasets' => [
                    [
                        'label' => 'Top 10 donateurs',
                        'backgroundColor' => $randomColorChart3,
                        'borderColor' => $randomBorderColorChart3,
                        'data' => $amounts,
                    ],
                ],
            ]);

        return $this->render('Home/index.html.twig', [
            'departements'=>$departements,
            'donations'=>$donations,
            'topten'=>$topTen,
            'topTenDonators'=>$topTenDonators,
        ]);
    }
}
