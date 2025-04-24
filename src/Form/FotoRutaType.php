<?php

namespace App\Form;

use App\Entity\FotoRuta;
use App\Entity\Ruta;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FotoRutaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descripcionFoto')
            ->add('idRuta', EntityType::class, [
                'label' => 'Ruta de la foto',
                'class' => Ruta::class,
                'choice_label' => 'nombre',
            ])
            ->add('imageFile', VichFileType::class, [
                'required' => true,
                'label' => 'Imagen de la ruta',
                'attr' => [
                    'accept' => 'image/jpeg,image/png' // Opcional, filtra a nivel del navegador
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FotoRuta::class,
        ]);
    }
}
