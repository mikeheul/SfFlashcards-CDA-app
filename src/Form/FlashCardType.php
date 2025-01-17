<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FlashCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextType::class, [
                'label' => 'Question',
                'required' => true,
                'attr' => [
                    'class' => 'form-fields' 
                ]    
            ])
            ->add("answer", TextType::class, [
                'label' => 'Answer',
                'required' => true,
                'attr' => [
                    'class' => 'form-fields' 
                ]
            ])
            ->add("submit", SubmitType::class, [
                'attr' => [
                    'class' => 'btn-submit' 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
