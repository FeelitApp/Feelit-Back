<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

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
            ->add('need', NumberType::class, [
                'required' => false,
            ])
            ->add('comment', TextareaType::class, [
                'constraints' => [
                    new Assert\Length(
                        max: 1000,
                        maxMessage: 'Votre commentaire ne doit pas dépasser {{ limit }} caractères.',
                    ),
                ],
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
