<?php

namespace Drupal\boilerplate_forms\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Template\TwigEnvironment;
use Drupal\boilerplate_forms\Service\FormStepsService;

/**
 * The order controller.
 */
class Controller extends ControllerBase {

  private $service = NULL;

  /**
   * Twig environment.
   *
   * @var Drupal\Core\Template\TwigEnvironment
   */
  protected $twig;

  /**
   * Constructor for controller.
   */
  public function __construct(FormStepsService $service, TwigEnvironment $twig) {
    $this->steps = $service;
    $this->twig = $twig;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('boilerplate_forms.service'),
      $container->get('twig')
    );
  }

}
