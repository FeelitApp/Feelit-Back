<?php
namespace App\Service;

use Symfony\Component\Form\FormInterface;

/**
 * Class FormService
 * @package App\Service
 */
class FormService
{
  /**
   * Handle form errors for API Mode
   *
   * @param FormInterface $form
   * @return array
   */
  public function getFormErrors(FormInterface $form): array
  {
    $errors = [];
    foreach ($form->getErrors(true) as $error) {
      if (!$error->getOrigin()) continue;
      $fieldName = $error->getOrigin()->getName();
      $fieldName = strlen($fieldName) > 0 ? $fieldName : '__global';
      if (!isset($errors[$fieldName])) $errors[$fieldName] = [];
      $errors[$fieldName][] = $error->getMessage();
    }
    return $errors;
  }
}