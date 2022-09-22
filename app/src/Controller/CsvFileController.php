<?php

namespace App\Controller;

use App\Entity\CsvFile;
use App\Form\CsvFileType;
use App\Message\AddCsv;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Exception;
use League\Csv\Statement;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use League\Csv\Reader;


class CsvFileController extends AbstractController
{
    #[Route('/csv_file', name: 'app_csv_file')]
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $db, MessageBusInterface $bus): \Symfony\Component\HttpFoundation\Response
    {
        $CsvFile = new CsvFile();
        $form = $this->createForm(CsvFileType::class, $CsvFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($form->get('fileName')->getData());
            /** @var UploadedFile $file */
            $file = $form->get('fileName')->getData();


            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('csv_directory'),
                        $newFilename
                    );
                    $CsvFile->setFileName($newFilename);


                    $csv = Reader::createFromPath("/app/public/uploads/csv/$newFilename");

                    $stmt = Statement::create()
                        ->offset(0)
                    ;

                    $records = $stmt->process($csv);
                   // dd($records);
                    foreach ($records as $row) {
//                        $x=(new CsvFile())
//                            ->setNane($row[0])
//                            ->setDescription($row[1])
//                            ->setFileName($newFilename);

                        $bus->dispatch(new AddCsv($row[0], $row[1]));
                       }


                } catch (FileException $e) {
                    dd($e->getMessage());
                    // ... handle exception if something happens during file upload
                } catch (Exception $e) {
                    dd($e->getMessage());
                }

                // instead of its contents

            }
            // ... persist the $product variable or any other work


            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('csv_file/index.html.twig', [
            'form' => $form,
        ]);
    }
    
}
