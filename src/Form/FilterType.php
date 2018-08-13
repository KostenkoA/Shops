<?php

namespace App\Form;


use App\Entity\MainCategory;
use App\Model\Filter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'label' => 'PriceFrom: ',
                'required' => false
            ])
            ->add('priceTo', NumberType::class, [
                'label' => 'PriceTo: ',
                'required' => false
            ])
            ->add('nameAscDesc', ChoiceType::class, [
                'choices' => [
                    'A-Z' => 'ASC',
                    'Z-A' => 'DESC'
                ],
                'label' => 'Name: '
            ])
            ->add('typeId', EntityType::class, [
                'class' => MainCategory::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label_format' => 'Category: '
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