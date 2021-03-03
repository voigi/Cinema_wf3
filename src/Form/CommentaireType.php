<?php

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentaireType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('contenu', TextareaType::class, ['label' => 'Commentaire']);
        $builder->add('note', ChoiceType::class, [
            'choices'  => [
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7' => 7,
                '8' => 8,
                '9' => 9,
                '10' => 10
            ],
        ]);
        $builder->add('envoyer', SubmitType::class, ['label' => 'Envoyer']);

    }
}

?>