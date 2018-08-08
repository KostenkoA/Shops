<?php

namespace App\Form;


use App\Entity\Product;
use App\Entity\ProductImage;
use App\Model\ProductModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    /**
     * buildForm for add product
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name product: '
            ])
            ->add('typeId', ChoiceType::class, [
                'label' => 'Select type of product',
                'choices' => [
                    'Digital Camera' => 1,
                    'Phones' => 2,
                    'Tablet' => 3,
                    'Notebook' => 4,
                    'Other' => 5
                ]
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Set price'
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Comment',
                'required' => false
            ])
            ->add('imagePath', FileType::class, [
                'label' => 'Add image',
                'multiple' => true
            ])
            ->add('Add product', SubmitType::class)
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
            'data_class' => ProductModel::class,
        ]);
    }

}