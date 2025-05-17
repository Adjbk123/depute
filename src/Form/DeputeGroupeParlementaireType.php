<?php

namespace App\Form;

use App\Entity\Depute;
use App\Entity\DeputeGroupeParlementaire;
use App\Entity\GroupeParlementaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeputeGroupeParlementaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debutMandat', null, [
                'widget' => 'single_text',
            ])
            ->add('finMandat', null, [
                'widget' => 'single_text',
            ])
            ->add('depute', EntityType::class, [
                'class' => Depute::class,
                'choice_label' => 'id',
            ])
            ->add('groupeParlementaire', EntityType::class, [
                'class' => GroupeParlementaire::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DeputeGroupeParlementaire::class,
        ]);
    }
}
