<?php
namespace AppBundle\Form\Type;

use Sulu\Bundle\SecurityBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Sulu\Bundle\CommunityBundle\Form\Type\RegistrationType as SuluRegistrationType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends SuluRegistrationType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contact', RegistrationContactType::class);

        $builder->add('username', TextType::class);

        $builder->add('email', EmailType::class);

        $builder->add('plainPassword', RepeatedType::class, array(
            'mapped' => false,
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => array('attr' => array('class' => 'form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15')),
            'required' => true,
            'first_options'  => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ));

        $builder->add(
            'terms',
            CheckboxType::class,
            [
                'label' => false,
                'mapped' => false,
                'required' => true
            ]
        );

        $builder->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
                'contact_type_options' => ['label' => false],
                'validation_groups' => ['registration'],
            ]
        );
    }
}