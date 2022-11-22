<?php

namespace App\Form;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EpisodeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('number')
            ->add('synopsis')
            //->add('season', null, ['choice_label' => 'number']);
            ->add('program', EntityType::class, [
                'class' => Program::class,
                'mapped' => false,
                'choice_label' => 'title'
            ]);
        //QUA FUNZIONA TUTTO
        // ->add('season', EntityType::class, [
        //     'class' => Season::class,
        //     'choice_label' => 'number',
        // ]);
        $formModifier = function (FormInterface $form, Program $program = null) {
            $seasons = null === $program ? [] : $program->getSeasons();

            $form->add('season', EntityType::class, [
                'class' => Season::class,
                'placeholder' => '',
                'choices' => $seasons,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                //$form = $event->getForm();

                // this would be your entity Episode
                $data = $event->getData();

                //$program = $data->getTitle();
                $formModifier($event->getForm(), $data->getTitle());
                // dd($program);

            }
        );

        $builder->get('program')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $program = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback function!
                $formModifier($event->getForm()->getParent(), $program);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
        ]);
    }
}
