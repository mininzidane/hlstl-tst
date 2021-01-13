<?php

declare(strict_types=1);

namespace App\Form;

use App\Service\EmailRenderer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class EmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->setMethod('POST');

        $builder->add('strategy', ChoiceType::class, [
            'choices' => [
                'Full table strategy' => EmailRenderer::FULL_TABLE_STRATEGY,
                'Each row strategy' => EmailRenderer::EACH_ROW_STRATEGY,
            ],
            'expanded' => true,
            'label' => 'Email Strategy',
        ]);

        $builder->add('template', TextareaType::class, [
            'label' => 'Template',
        ]);
    }
}
