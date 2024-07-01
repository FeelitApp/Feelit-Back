<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class UserInfoUpdateType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->setMethod('POST')
      ->add('email', EmailType::class, [
        'constraints' => [
          new Assert\NotBlank(message: 'Votre email est invalide.'),
          new Assert\Email(message: 'Votre email est invalide.'),
        ],
        'required' => false,
        'empty_data' => ''
      ])
      ->add('username', TextType::class, [
        'constraints' => [
          new Assert\NotBlank(message: 'Votre nom d\'utilisateur est invalide.'),
          new Assert\Length(
            min: 3,
            max: 20,
            minMessage: 'Votre nom d\'utilisateur doit contenir au moins {{ limit }} caractères.',
            maxMessage: 'Votre nom d\'utilisateur doit contenir au maximum {{ limit }} caractères.',
          ),
        ],
        'required' => false,
        'empty_data' => ''
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
      'csrf_protection' => false
    ]);
  }

  public function getBlockPrefix(): string
  {
    return '';
  }
}
