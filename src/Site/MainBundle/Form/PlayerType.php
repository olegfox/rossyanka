<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, array(
                'required' => true,
                'label' => 'backend.player.firstname'
            ))
            ->add('secondname', null, array(
                'required' => false,
                'label' => 'backend.player.secondname'
            ))
            ->add('file', 'file', array(
                'required' => false,
                'label' => 'backend.player.img'
            ))
            ->add('birthday', null, array(
                'required' => false,
                'label' => 'backend.player.birthday',
                'data' => new \DateTime("now"),
                'years' => range(1900, date('Y'))
            ))
            ->add('status', 'choice', array(
                'required' => true,
                'label' => 'backend.player.status',
                'choices' => array(
                    0 => 'backend.player.status_choice.main',
                    1 => 'backend.player.status_choice.yorth',
                    2 => 'backend.player.status_choice.archive',
                ),
                'translation_domain' => 'menu'
            ))
//            ->add('teams')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Player',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_player';
    }
}
