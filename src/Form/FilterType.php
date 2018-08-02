<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Search:', TextType::class)
            ->add('from:', NumberType::class)
            ->add('to:', NumberType::class)
            ->add('Name:', CheckboxType::class, [
                'ASC'=>'asc',
            'DESC' => 'desc',
            ])
            ->add('Filter', SubmitType::class)
            ;
    }

}