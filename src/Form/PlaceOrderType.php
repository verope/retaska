<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\PurchaseOrder;
use App\Entity\Country;
use App\Entity\PaymentMethod;
use App\Entity\Transportation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfUnits')
            ->add('email')
            ->add('phoneNumber')
            ->add('firstName')
            ->add('lastName')
            ->add('city')
            ->add('postcode')
            ->add('streetAddress')
            ->add('streetNumber')
            ->add('note')
            ->add('country', EntityType::class, [
            'class' => Country::class,
            'choice_label' => 'name',
            'multiple'=> false,
            'expanded' => false
            ])
            ->add('transportation', EntityType::class, [
            'class' => Transportation::class,
            'choice_label' => 'type',
            'multiple'=> false,
            'expanded' => false
            ])
            /*
            ->add('paymentMethod', EntityType::class, [
            'class' => PaymentMethod::class,
            'choice_label' => 'type',
            'multiple'=> false,
            'expanded' => true
            ])
            */
            ->add('paymentMethod', EntityType::class, [
            'class' => PaymentMethod::class,
            'choice_label' => 'type',
            'choice_attr' => function($paymentMethod) {
                return ['data-price' => $paymentMethod->getSurcharge()];
            }
            ])
            
        ;
    }

}
