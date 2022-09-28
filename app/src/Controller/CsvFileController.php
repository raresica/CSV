<?php

namespace App\Controller;

use App\Entity\CsvFile;
use App\Entity\User;
use App\Form\CsvFileType;
use App\Message\AddCsv;
use App\Message\Name;
use League\Csv\Exception;
use League\Csv\Statement;
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
    //adaugare id pentru fisier. trimit csv file in front. Verific daca exista.
    public function new(Request $request, SluggerInterface $slugger, MessageBusInterface $bus): \Symfony\Component\HttpFoundation\Response
    {
        $CsvFile = new CsvFile();
        $form = $this->createForm(CsvFileType::class, $CsvFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $file */
            $file = $form->get('fileName')->getData();
            $entityType = $form->get('entityType')->getData();

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
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
                        ->offset(1)
                    ;
                    $records = $stmt->process($csv);

                    $columnA = $form->get('columnA')->getData();
                    $columnB = $form->get('columnB')->getData();
                    $columnC = $form->get('columnC')->getData();
                    $columnD = $form->get('columnD')->getData();

                    foreach ($records as $row) {
                        if ($entityType == "csv") {
                            $bus->dispatch(new AddCsv($row[$columnA], $row[$columnB]));
                        } else {
                            $bus->dispatch(new Name($row[$columnA], $row[$columnB], $row[$columnC], $row[$columnD]));
                        }
                       }

                } catch (FileException $e) {
                    dd($e->getMessage());
                    // ... handle exception if something happens during file upload
                } catch (Exception $e) {
                    dd($e->getMessage());
                }

                // instead of its contents

            }

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('csv_file/index.html.twig', [
            'form' => $form,
        ]);
    }
    
}
