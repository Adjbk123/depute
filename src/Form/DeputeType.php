<?php

namespace App\Form;

use App\Entity\Circonscription;
use App\Entity\Depute;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeputeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenoms', TextType::class, [
                'label' => 'Prénoms',
            ])
            ->add('dateNaissance', null, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
                'required'=>false
            ])
            ->add('lieuNaissance', TextType::class, [
                'label' => 'Lieu de naissance',
                'required'=>false

            ])
            ->add('profession', TextType::class, [
                'label' => 'Profession',
                'required' => false
            ])
            ->add('circonscription', EntityType::class, [
                'class' => Circonscription::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Depute::class,
        ]);
    }
}
