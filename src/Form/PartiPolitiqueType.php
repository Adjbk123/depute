<?php

namespace App\Form;

use App\Entity\PartiPolitique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartiPolitiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sigle')
            ->add('nom')
            ->add('photo',  FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'data_class' => null,
                'required'=>false
            ])
            ->add('fondation')
            ->add('historique')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PartiPolitique::class,
        ]);
    }
}
