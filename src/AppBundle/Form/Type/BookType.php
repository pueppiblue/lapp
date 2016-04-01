<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 30.11.15
 * Time: 17:18
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title')
            ->add('author')
            ->add('isbn')
            ->add('price')
            ->add('save','submit')
        ;

    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Book',
                'validation_groups' => array('creation'),
            )
        );

    }
}
