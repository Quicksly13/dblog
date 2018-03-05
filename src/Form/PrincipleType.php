<?php

namespace App\Form;

use App\Entity\PrincipleEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PrincipleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['select_mode'])
        {
            //construct the menu of principles to select from
            $principles[] = 'Add a new principle';
            $principles = array_merge($principles, $options['principles']);

            $builder
                    ->add('choose', ChoiceType::class, [
                        'mapped' => false,
                        'choices' => $principles,
                        'choice_label' => function ($value, $key, $index) {//ensure the choice name is the same as value
                            return $value;
                        }
                        ])
                    //adds form fields for submit buttons
                    ->add('go', SubmitType::class);
        }
        else
        {
            //get the boolean true or false value of 'preview_mode' in form options
            $previewMode = $options['preview_mode'];

            //adds form fields corresponding to Principle Entity properties
            $builder
                    ->add('id', HiddenType::class, [
                        'required' => false//needed for Doctrine to check if it's in the database already, should not be visible in form
                    ])
                    ->add('description', TextType::class, [
                        'attr' => ['readonly' => $previewMode]//if form is a preview, this field is readonly
                    ])
                    ->add('title', TextType::class, [
                        'attr' => ['readonly' => $previewMode]//if form is a preview, this field is readonly
                    ])
                    ->add('keywords', TextType::class, [
                        'attr' => ['readonly' => $previewMode]//if form is a preview, this field is readonly
                    ])
                    ->add('explanation', TextareaType::class, [
                        'attr' => ['readonly' => $previewMode]//if form is a preview, this field is readonly
                    ])
                    //adds form fields for submit buttons
                    ->add('preview', SubmitType::class, [
                        'attr' => ['disabled' => $previewMode]//if form is already a preview, this field is disabled
                    ])
                    ->add('confirm', SubmitType::class, [
                        'attr' => ['disabled' => $previewMode === true ? false : true]//the confirm button is enabled only in preview mode
                    ])
                    ->add('cancel', SubmitType::class);
        }      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([     
            'data_class' => PrincipleEntity::class,//binds this form type to the Principle entity class
            'select_mode' => false,//determines if the form is in select mode or not
            'principles' => [],//get the array of current principles for select mode
            'preview_mode' => false,//determines if the form is in preview mode or not
        ]);
    }
}
