<?php

namespace App\Form;

use App\Entity\Entry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('POST')
            ->add('sensation', NumberType::class, [
                'required' => true,
            ])
            ->add('feeling', NumberType::class, [
                'required' => true,
            ])
            ->add('emotion', NumberType::class, [
                'required' => true,
            ])
            ->add('comment', TextareaType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
      $resolver->setDefaults([
        'csrf_protection' => false,
      ]);
    }

    public function getBlockPrefix(): string
    {
      return '';
    }
}
