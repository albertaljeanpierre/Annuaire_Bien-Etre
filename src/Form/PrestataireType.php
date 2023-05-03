<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Prestataire;
use App\Repository\CategorieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom' , TextType::class, ['label' => 'Votre nom de prestataire :' ])
            ->add('siteInternet' , UrlType::class , ['label' => 'L\'URL de votre site internet :'])
            ->add('numTel' , TelType::class, ['label' => 'Votre numéro de téléphone :'])
            ->add('numTVA' , TextType::class, ['label' => 'Votre numéro de TVA Belge :', 'attr' => ['placeholder' => 'BE 0 123 456 789']])
//            ->add('user')
            ->add('categorie', EntityType::class, ['class' =>  Categorie::class ,

//                'query_builder' => function (CategorieRepository $categorieRepository) {
//                    return  $categorieRepository->createQueryBuilder('c')
//                        ->orderBy('c.nom', 'ASC');
//                },
                'choice_label' => 'nom']  )
            ->add('Valider' , SubmitType::class,  ['attr' => ['class' => 'button-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
