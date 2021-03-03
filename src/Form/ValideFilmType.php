<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ValideFilmType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('publie', CheckboxType::class, [
            'label'    => 'Publier',
            'required' => false,
            ]);
        $builder->add('envoyer', SubmitType::class, ['label' => 'Confirmer']);

    }
}

?>