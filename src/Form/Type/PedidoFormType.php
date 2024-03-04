<?php

namespace App\Form\Type;

use App\Entity\Mercado;
use App\Entity\Pedidos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('valor') 
            ->add('fecha')  
           /*  ->add('mercados', CollectionType::class, [
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => MercadoType::class
            ])   */   
            ->add('estado');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pedidos::class,
            'csrf_protection' => false,
            'validation_groups' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
    public function getName()
    {
        return '';
    }
}
