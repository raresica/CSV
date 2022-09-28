<?php

namespace App\Form;

use App\Entity\CsvFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class CsvFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fileName', FileType::class, [
                'label' => 'Select a file to upload',
                // unmapped means that this field is not associated to any entity property
               'mapped' => false,

                // make it optional so you don't have to re-uploads the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fie lds can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '100M',
                        'mimeTypes' => [
                            'text/csv'
                        ],
                        'mimeTypesMessage' => 'Please uploads a valid CSV document',
                    ])
                ],
            ])
            ->add('entityType', ChoiceType::class, [
                'label' => 'Select entity type',
                'choices' => [
                    'Select' => null,
                    'Name' => "name",
                    'CsvFile' => "csv",
                ],
                'attr' => ['class' => 'form-control form-select']

            ])
//            ->add('fileLocation', TextType::class, [
//
//            ])
            ->add('columnA', ChoiceType::class, [
                'choices' => [
                    'Select' => null,
                    'Name' => "name",
                    'CsvFile' => "csv",
                ],
                'attr' => ['class' => 'form-control form-select']

            ])

            ->add('columnB', ChoiceType::class, [
                'choices' => [
                    'Select' => null,
                    'Name' => "name",
                    'CsvFile' => "csv",
                ],
                'attr' => ['class' => 'form-control form-select']

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CsvFile::class,
        ]);
    }

}
