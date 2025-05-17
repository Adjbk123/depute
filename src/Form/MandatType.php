<?php

namespace App\Form;

use App\Entity\Depute;
use App\Entity\GroupeParlementaire;
use App\Entity\Legislature;
use App\Entity\Mandat;
use App\Entity\PartiPolitique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MandatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debutMandat', null, [
                'widget' => 'single_text',
            ])
            ->add('finMandat', null, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('depute', EntityType::class, [
                'class' => Depute::class,
            ])
            ->add('partiPolitique', EntityType::class, [
                'class' => PartiPolitique::class,
                'choice_label' => 'nom',
            ])
            ->add('groupeParlementaire', EntityType::class, [
                'class' => GroupeParlementaire::class,
                'choice_label' => 'libelle',
            ])
            ->add('legislature', EntityType::class, [
                'class' => Legislature::class,
                'choice_label' => 'libelle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mandat::class,
        ]);
    }
}
