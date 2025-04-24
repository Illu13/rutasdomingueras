<?php

namespace App\Form;

use App\Entity\Ruta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RutaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('descripcionCorta')
            ->add('descripcionLarga')
            ->add('imageFile', VichFileType::class, [
                'required' => true,
                'label' => 'Imagen de la ruta',
                'attr' => [
                    'accept' => 'image/jpeg,image/png' // Opcional, filtra a nivel del navegador
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ruta::class,
        ]);
    }
}
