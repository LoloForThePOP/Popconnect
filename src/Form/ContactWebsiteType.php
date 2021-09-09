<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactWebsiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add(
            'authorEmail',
            EmailType::class,
            [
                'label' => 'Your Email Address',

                'attr' => [
                    
                    'placeholder'    => 'Email',
                ],

                'required'   => true,
            ]
            )

        ->add(
            'content',
            TextareaType::class,
            [

                'label' => 'Your Message',

                'required'   => true,

                'attr' => [

                    'placeholder'    => "Type Here",
                ],
            ]
            
        )
    ;
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
