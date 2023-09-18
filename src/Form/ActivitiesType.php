<?php

namespace App\Form;

use App\Entity\Activities;
use App\Entity\FriendGroup;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name')
            ->add('cost')
            ->add('friendGroup',EntityType::class,//faut il changer le friendGroup en user ?
                [
                    'required'=>true,
                    'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('fg')
                        ->orderBy('fg.name', 'ASC')
                        ->where('fg.users IN (:userId)')
                        ->setParameter('userId', [$options['userId']]);
                    }, 'class' => FriendGroup::class, 'choice_label' => 'name'])
            ->add('user', EntityType::class,
                [
                    'required'=>true, 'class' => User::class, 'choice_label' => 'email'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'userId' => null,

            'data_class' => Activities::class,
        ]);
    }
}
