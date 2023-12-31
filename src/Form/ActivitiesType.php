<?php

namespace App\Form;

use App\Entity\Activities;
use App\Entity\FriendGroup;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name')
            ->add('cost')
            ->add('friendGroup',EntityType::class,
                [
                    'required'=>true, 'class' => FriendGroup::class, 'choice_label' => 'name'])

            ->add('currencies', ChoiceType::class, [
                'choices'  => [
                    'Euro (EUR)' => "EUR",
                    'Dollar american (USD)' => "USD",
                    'Yen (JPY)' => "JPY",
                    'livre sterling (GBP)' => "GBP",
                    'Dollar australien (AUD)' => "AUD",
                    'Dollar canadien (CAD)' => "CAD",
                    'Franc suisse (CHF)' => "CHF",
                ],
            ])
            ->add('user', EntityType::class,
                [
                    'required'=>true, 'class' => User::class, 'choice_label' => 'email'])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activities::class,
        ]);
    }
}
