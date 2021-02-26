<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('recherche', SearchType::class, ['label' => 'Recherche']);
        $builder->add('envoyer', SubmitType::class, ['label' => 'Envoyer']);

    }
}

?>