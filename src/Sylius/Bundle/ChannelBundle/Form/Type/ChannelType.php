<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\ChannelBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Channel\Model\ChannelTypes;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ChannelType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'sylius.form.channel.name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'sylius.form.channel.description',
                'required' => false,
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.form.channel.enabled',
                'required' => false,
            ])
            ->add('hostname', TextType::class, [
                'label' => 'sylius.form.channel.hostname',
                'required' => false,
            ])
            ->add('color', ColorType::class, [
                'label' => 'sylius.form.channel.color',
                'required' => false,
            ])
            ->add('type', ChoiceType::class,[
                'label' => 'sylius.form.channel.type',
                'required' => false,
                'choices' => [
                    'sylius.ui.channel.types.website' => ChannelTypes::TYPE_WEBSITE,
                    'sylius.ui.channel.types.mobile' => ChannelTypes::TYPE_MOBILE,
                    'sylius.ui.channel.types.pos' => ChannelTypes::TYPE_POS,
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_channel';
    }
}
