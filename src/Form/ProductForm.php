<?php

namespace App\Form;


use App\Entity\MainCategory;
use App\Model\ProductModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('typeId', EntityType::class, [
                'class' => MainCategory::class,
                'choice_label' => 'name'
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