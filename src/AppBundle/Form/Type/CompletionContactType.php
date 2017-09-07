<?php
namespace AppBundle\Form\Type;

use Sulu\Bundle\ContactBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompletionContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $contact = $builder->getData();

        if (!$contact->getFirstName()) {
            $builder->add('firstName', 'text');
        }

        if (!$contact->getLastName()) {
            $builder->add('lastName', 'text');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'validation_groups' => ['completion'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'contact';
    }
}