<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Email",
                'constraints' => [
                    new NotBlank(['message' => 'email shall be user email']),
                    new Email(['message' => 'email shall be of correct format'])
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Password',
                    'constraints' => [
                        new NotBlank(['message' => 'Password shall not be blank.']),
                        new Length(['min' => 6, 'minMessage' => 'Password shall contain at least {{ limit }} characters.'])
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm Password',
                    'constraints' => [
                        new NotBlank(['message' => 'Password confirmation is required.'])
                    ]
                ],
                'invalid_message' => 'The password fields must match.',
                'mapped' => false
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'User Role',
                'mapped' => false,  // This ensures roles are not directly mapped to the database
                'required' => true, // Make it required if needed
                'placeholder' => 'Select Role',
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'User' => 'ROLE_USER',
                ],
                'attr' => [
                    'class' => 'form-control',  // You can use Bootstrap or your custom classes
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',  // The default field name for CSRF token
            'csrf_token_id' => 'registration_item',
           
            
             
        ]);
    }

}



