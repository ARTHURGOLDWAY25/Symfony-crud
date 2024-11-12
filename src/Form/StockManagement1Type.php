<?php

namespace App\Form;

use App\Entity\StockManagement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockManagement1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('ProductDescription')
            ->add('AvailableQuantity')
            ->add('PricePerItem')
            ->add('ProductCategory')
            ->add('Supplier')
            ->add('sku')
            ->add('location')
            ->add('CreationDate')
            ->add('MinimumStock')
            ->add('LastPurchased')
            ->add('TotalValue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StockManagement::class,
        ]);
    }
}
