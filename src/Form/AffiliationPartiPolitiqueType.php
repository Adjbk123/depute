<?php

namespace App\Form;

use App\Entity\AffiliationPartiPolitique;
use App\Entity\Depute;
use App\Entity\PartiPolitique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffiliationPartiPolitiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateAffiliation', null, [
                'widget' => 'single_text',
            ])
            ->add('dateFinAffiliation', null, [
                'widget' => 'single_text',
            ])
            ->add('depute', EntityType::class, [
                'class' => Depute::class,
                'choice_label' => 'id',
            ])
            ->add('partiPolitique', EntityType::class, [
                'class' => PartiPolitique::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AffiliationPartiPolitique::class,
        ]);
    }
}
