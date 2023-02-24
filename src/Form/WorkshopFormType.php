<?php

namespace App\Form;

use App\Entity\Workshop;
//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class WorkshopFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                "attr" => array(
                    "class" => "bg-transparent block border-b-2 w-full h-20 text-6xl outline-none",
                    "placeholder" => 'Enter title'
                ),
                "label" => false,
                "required"=>false
            ])
            ->add('startDate', TextType::class,[
                "attr" => array(
                    "class" => "bg-transparent block mt-10 border-b-2 w-full h-20 text-6xl outline-none",
                    "placeholder" => 'Enter start date'
                ),
                "label" => false,
                "required"=>false
            ])
            ->add('description', TextAreaType::class,[
                "attr" => array(
                    "class" => "bg-transparent block mt-10 border-b-2 w-full h-60 text-6xl outline-none",
                    "placeholder" => 'Enter description'
                ),
                "label" => false,
                "required"=>false
            ])
            ->add('imagePath', FileType::class, array(
                "required" => false,
                'mapped'=>false,
                "required"=>false
            ))
        ;
            //->add('organizers')        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workshop::class,
        ]);
    }
}
