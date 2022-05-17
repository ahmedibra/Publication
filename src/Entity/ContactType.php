<?php

namespace App\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nom', TextType::class)
          ->add('telephone', TextType::class)
          ->add('sujet', TextType::class)
          ->add('email', EmailType::class)
          ->add('message', TextareaType::class,['attr' =>[ 'rows' => 10 , 'cols' => 60],])
          ->add('envoyer', SubmitType::class,[
    'attr' => ['class' => 'button button-contactForm boxed-btn'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}