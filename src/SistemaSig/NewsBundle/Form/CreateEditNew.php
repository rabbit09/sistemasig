<?php
/**
 * Created by JetBrains PhpStorm.
 * User: darvein
 * Date: 8/3/13
 * Time: 18:21
 * To change this template use File | Settings | File Templates.
 */

namespace SistemaSig\NewsBundle\Form;

use SistemaSig\NewsBundle\Entity\NewItem;
use Symfony\Component\Form\AbstractType;

//use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class CreateEditNew extends AbstractType
{

    //public function buildForm(FormBuilder $builder, array $options)
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $NewItem = new NewItem();

        $builder->add(
            'title',
            'text',
            array(
                'label' => 'Título',
                'required' => true
            )
        );

        $builder->add(
            'summary',
            'textarea',
            array(
                'label' => 'Resumen',
                'required' => false
            )
        );

        $builder->add(
            'body',
            'textarea',
            array(
                'label' => 'Contenido',
                'required' => true
            )
        );

        $builder->add(
            'city',
            'choice',
            array(
                'choices' => array(
                    $NewItem::LAPAZ => 'La Paz',
                    $NewItem::ELALTO => 'El Alto',
                    $NewItem::COCHABAMBA => 'Cochabamba',
                    $NewItem::SANTA_CRUZ => 'Santa Cruz',
                    $NewItem::BENI => 'Beni',
                    $NewItem::COBIJA => 'Cobija',
                    $NewItem::SUCRE => 'Sucre',
                    $NewItem::TARIJA => 'Tarija',
                    $NewItem::POTOSI => 'Potosi',
                ),
                'label' => 'Ciudad',
                'required' => true,
            )
        );

        $builder->add(
            'publishedDate',
            'date',
            array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'dateCalendar'),
                'label' => 'Fecha de publicación',
            )
        );

        $builder->add(
            'status',
            'choice',
            array(
                'choices' => array(
                    $NewItem::PUBLISHED => 'Publicado',
                    $NewItem::DRAFT => 'Borrador',
                ),
                'label' => 'Estado',
                'required' => true,
            )
        );

        $builder->add(
            'Crear',
            'submit',
            array(
                'label' => 'Crear noticia',
                'attr' => array('class' => 'btn btn-medium btn-primary')
            )
        );

    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'create_edit_new_item_form';
    }
}