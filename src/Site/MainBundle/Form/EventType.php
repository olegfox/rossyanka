<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'choice', array(
                'required' => true,
                'label' => 'backend.event.name',
                'choices' => array(
                    0 => 'backend.event.name_choice.championship',
                    1 => 'backend.event.name_choice.cup',
                    2 => 'backend.event.name_choice.europa_league',
                    3 => 'backend.event.name_choice.youth_championship'
                ),
                'expanded' => true,
                'multiple' => false,
                'translation_domain' => 'menu'
            ))
            ->add('tour', null, array(
                'required' => false,
                'label' => 'backend.event.tour'
            ))
            ->add('datetime', null, array(
                'required' => true,
                'label' => 'backend.event.datetime'
            ))
            ->add('score', null, array(
                'required' => false,
                'label' => 'backend.event.score'
            ))
            ->add('numberGoals', null, array(
                'required' => false,
                'label' => 'backend.event.number_goals',
                'attr' => array(
                    'min' => 0
                )
            ))
            ->add('numberYellowCards', null, array(
                'required' => false,
                'label' => 'backend.event.number_yellow_cards',
                'attr' => array(
                    'min' => 0
                )
            ))
            ->add('stadium', null, array(
                'required' => false,
                'label' => 'backend.event.stadium'
            ))
            ->add('eventTeam', 'bootstrap_collection', array(
                'label'=>'backend.event.teams',
                'type' => new EventTeamType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.event_team.add_team',
                'delete_button_text' => 'backend.event_team.delete_team',
                'sub_widget_col'     => 9,
                'button_col'         => 3
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Event',
            'translation_domain' => 'menu'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_event';
    }
}
