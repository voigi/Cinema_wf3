<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MailerType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options){
    $builder->add('demand', TextType::class, ['label' => 'Intitulé de votre la requête',
    'constraints' => [
      new NotBlank([ 'message' => 'votre résumer est vide']),
      new Length([
          'min' => 2,
          'max' => 255,
          'minMessage' => 'Votre champs doit contenir au moins {{ limit }} caractères',
          'maxMessage' => 'Votre champs doit contenir moins de {{ limit }} caractères',
          ]),

      ],
    ]);
    $builder->add('contenu', TextareaType::class, ['label' => 'insérer votre requête',
    'constraints' => [
      new NotBlank([ 'message' => 'votre champ est vide']),
      ],
    ]);
    
  }

}