<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'Votre Email (identifiant de votre compte) :' , 'disabled' => true])
//            ->add('roles')
            ->add('password', PasswordType::class, ['label' => 'Votre mot de pass : '])

            ->add('adresseRue', TextType::class, ['label' => 'Rue : '])
            ->add('adresseNumber', TextType::class, ['label' => 'Le numéro de  maison : '])
//            ->add('inscription')
//            ->add('typeUtilisateur')
//            ->add('nbEssaisInfructueux')
//            ->add('banni')
//            ->add('inscriptionConfirmee')
//            ->add('prestataire')
            ->add('Valider' , SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
