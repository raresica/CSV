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
    public function new(Request $request, SluggerInterface $slugger, MessageBusInterface $bus): \Symfony\Component\HttpFoundation\Response
    {
        $CsvFile = new CsvFile();
        $form = $this->createForm(CsvFileType::class, $CsvFile);
        $form->handleRequest($request);
       // dd($form->get('entityType')->getData());

        if ($form->isSubmitted() && $form->isValid() && $form->get('fileName')->getData()){
            /** @var UploadedFile $file */

            $file = $form->get('fileName')->getData();

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
                        ->offset(0)
                    ;
                    $records = $stmt->process($csv);

                    foreach ($records as $row) {

                       // $bus->dispatch(new AddCsv($row[0], $row[1]));
                        $bus->dispatch(new Name($row[0], $row[1], $row[2], $row[3]));
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
            'entityType' => $form->get('entityType')->getData(),
            'fileName' =>  $form->get('fileName')->getData()
        ]);
    }
    
}
