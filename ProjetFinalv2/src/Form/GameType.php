<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Games;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('Description')
            ->add('Cover')
            ->add('Price')
            ->add('Date')
            ->add('Discount')
            ->add('categories', EntityType::class, [
                'class' => Category::class
            ])
            ->add('users')
            ->add('developpers')
            ->add('codePromos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Games::class,
        ]);
    }
}
