<?php

namespace App\Form;

use App\Entity\FriendGroup;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FriendGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',
                TextType::class,[
                    'required' => true,
                ])
            ->add('users',
                EntityType::class,
                [
                    'required'=>true, 'class' => Users::class, 'choice_label' => 'email',
                     'multiple' => true,
                     'expanded' => true,
                    'by_reference' => false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FriendGroup::class,
        ]);
    }
}
