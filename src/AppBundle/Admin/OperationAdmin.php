<?php
/*
 * This file is part of the Olivier project
 *
 * (c) Artem Genvald <genvaldartem@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Operation Entity Admin
 *
 * @author Artem Genvald <genvaldartem@gmail.com>
 */
class OperationAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected $baseRoutePattern = 'operation';

    /**
     * {@inheritdoc}
     */
    protected $baseRouteName = 'admin_operation';

    /**
     * {@inheritdoc}
     */
    protected $datagridValues = [
        '_page'       => 1,
        '_sort_order' => 'DESC',
        '_sort_by'    => 'date'
    ];

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Operation', ['class' => 'col-md-6'])
                ->add('sourceAccount')
                ->add('destinationAccount')
                ->add('date', 'sonata_type_date_picker', [
                    'dp_language' => 'uk'
                ])
                ->add('value')
                ->add('commission')
            ->end()
            ->with('Additional', ['class' => 'col-md-6'])
                ->add('tag', 'sonata_type_model', ['required' => false])
                ->add('place', 'sonata_type_model', ['required' => false])
                ->add('comment')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('date', null, [
                'format' => 'd.m.Y'
            ])
            ->add('value')
            ->add('commission')
            ->add('comment')
            ->add('sourceAccount')
            ->add('destinationAccount')
            ->add('tag', null, ['required' => false])
            ->add('place')
            ->add('_action', 'actions', [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => []
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('sourceAccount')
            ->add('destinationAccount')
            ->add('tag')
            ->add('place')
            ->add('date')
            ->add('value')
            ->add('commission')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('sourceAccount')
            ->add('destinationAccount')
            ->add('tag')
            ->add('place')
            ->add('date')
            ->add('value')
            ->add('commission')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt');
    }
}
