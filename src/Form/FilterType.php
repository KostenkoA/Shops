<?php

namespace App\Form;


use App\Model\Filter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    /**
     *buildForm for filter
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Search', TextType::class, [
                'label' => 'Search: ',
                'required' => false
            ])
            ->add('priceFrom', NumberType::class, [
                'label' => 'Price from: ',
                'required' => false
            ])
            ->add('priceTo', NumberType::class, [
                'label' => 'Price to: ',
                'required' => false
            ])
            ->add('nameAscDesc', ChoiceType::class, [
                'choices' => [
                    'Asc' => 'ASC',
                    'Desc' => 'DESC'
                ],
                'label' => 'ASC or DESC: '
            ])
             ->add('Filter', SubmitType::class)
            ;
    }

    /**
     * Sets options resolver
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Filter::class,
        ]);
    }

}