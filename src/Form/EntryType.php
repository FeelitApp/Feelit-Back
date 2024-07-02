<?php

namespace App\Form;

use App\Entity\Entry;
use App\Entity\Sensation;
use App\Entity\Feeling;
use App\Entity\Emotion;
use App\Entity\Need;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sensation', EntityType::class, [
                'class' => Sensation::class,
                'choice_label' => 'name',
            ])
            ->add('feeling', EntityType::class, [
                'class' => Feeling::class,
                'choice_label' => 'name',
            ])
            ->add('emotion', EntityType::class, [
                'class' => Emotion::class,
                'choice_label' => 'name'
            ])
            ->add('need', EntityType::class, [
                'class' => Need::class,
                'multiple' => true,
                'choice_label' => 'name',
            ])
            ->add('comment', TextareaType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entry::class,
        ]);
    }
}
