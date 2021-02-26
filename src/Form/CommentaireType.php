<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentaireType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('contenu', TextareaType::class, ['label' => 'Commentaire']);
        $builder->add('envoyer', SubmitType::class, ['label' => 'Envoyer']);

    }
}

?>