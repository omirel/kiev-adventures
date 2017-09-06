<?php
namespace AppBundle\Form\Type;

use Sulu\Bundle\ContactBundle\Entity\ContactAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileContactAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('address', $options['address_type'], $options['address_type_options']);
        $builder->add('main', 'hidden', [
            'required' => false,
            'data' => 1,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => ContactAddress::class,
                'address_type' => ProfileAddressType::class,
                'address_type_options' => ['label' => false],
                'validation_groups' => ['profile'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contact_address';
    }
}