<?php

namespace App\Form;

use App\Entity\News;
use App\Entity\User;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('text')
            ->add('date')
            ->add('time')
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $user): string {
                    return $user->getFirstName() . ' ' . $user->getLastName()   ;
                },
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.roles LIKE :role')
                        ->setParameter('role', '%ROLE_ADMIN%')
                        ->orderBy('u.roles', 'ASC');
                },
            ])
            ->add('submit', SubmitType::class, ['label' => 'Toevoegen'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
