<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'disabled' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'row_attr' => [5],
                'required' => false
            ])
            ->add('parent', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'required' => false, // Set to true if parent category is required
                'placeholder' => 'Select Category', // Optional
            ]);
            // ->add('createdAt')
            // ->add('updatedAt')
            // ->add('contentItems')
            // ->add('parent')
            // ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
