<?php
namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sexe',ChoiceType::class,array('choices' => array(
                'M' => 'Male',
                'F' => 'Female'
            ),'attr' => array('class' => 'form-control')))
            ->add('firstname',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('lastname',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('tel',TelType::class,array('attr' => array('class' => 'form-control')))
            ->add('email',EmailType::class,array('attr' => array('class' => 'form-control')))
            ->add('adresse',TextType::class,array('attr' => array('class' => 'form-control')))
            ->add('submit',SubmitType::class,array('attr' => array('class' => 'btn btn-primary')))
            ;
    }
}