<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class FilmType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('titre', TextType::class, ['label' => 'Titre du film']);
        $builder->add('sortie', TextType::class, ['label' => 'Date de Sortie']);
        $builder->add('genre', TextType::class, ['label' => 'Genre']);
        $builder->add('synopsis', TextType::class, ['label' => 'Synopsis']);
        $builder->add('envoyer', SubmitType::class, ['label' => 'Envoyer']);

    }
}

?>