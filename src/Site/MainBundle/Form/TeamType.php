<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'required' => true,
                'label' => 'backend.team.name'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.team.img'
            ))
//            ->add('event', 'entity', array(
//                'label'=>'backend.team.event',
//                'class'=>'SiteMainBundle:Event',
//                'multiple'=>true,
//                'expanded'=>true
//            ))
            ->add('players', 'entity', array(
                'label'=>'backend.team.players',
                'class'=>'SiteMainBundle:Player',
                'multiple'=>true,
                'expanded'=>true
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Team',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_team';
    }
}
