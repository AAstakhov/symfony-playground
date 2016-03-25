<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('isbn')
            ->add('published', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('authors', CollectionType::class, [
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => 'AppBundle:Author',
                    'choice_label' => 'fullName',
                    'placeholder' => 'Choose...',
                    'label' => false,
                ],
                'allow_add' => true,
                'prototype' => true,
            ])
            ->add('coverImageFile')
            ->add('isSpecialValidationEnabled', CheckboxType::class, [
                'label' => 'Enable special validation',
                // shows that this field is not a part of the domain object
                'mapped' => false,
                'required' => false,
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Book',
            'validation_groups' =>
                function(FormInterface $form) {
                    $isSpecialValidationEnabled = $form->get('isSpecialValidationEnabled')->getData();
                    return $isSpecialValidationEnabled ? ['Default', 'Special'] : ['Default'];
                }
        ]);
    }
}
