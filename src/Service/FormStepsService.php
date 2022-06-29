<?php

namespace Drupal\boilerplate_forms\Service;

use Drupal\Core\TempStore\PrivateTempStoreFactory;
use Drupal\Core\Session\SessionManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Site\Settings;
use Drupal\boilerplate_forms\Service\Steps\Base;
use Drupal\boilerplate_forms\Service\Steps\Step1;
use Drupal\boilerplate_forms\Service\Steps\Step2;
use Drupal\boilerplate_forms\Service\Steps\Step3;
use Drupal\boilerplate_forms\Service\Steps\Review;

/**
 * Main service class.
 */
class FormStepsService {

  /**
   * Service.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStoreFactory
   */
  protected $tempStoreFactory;

  /**
   * Service.
   *
   * @var \Drupal\Core\Session\SessionManagerInterface
   */
  protected $sessionManager;

  /**
   * Service.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * Service.
   *
   * @var \Drupal\Core\Site\Settings
   */
  protected $siteSettings;

  /**
   * Service.
   *
   * @var \Drupal\boilerplate_forms\Service\Steps\Base
   */
  public $base;

  /**
   * Service.
   *
   * @var \Drupal\boilerplate_forms\Service\Steps\Step1
   */
  public $step1;

  /**
   * Service.
   *
   * @var \Drupal\boilerplate_forms\Service\Steps\Step2
   */
  public $step2;

  /**
   * Service.
   *
   * @var \Drupal\boilerplate_forms\Service\Steps\Step3
   */
  public $step3;

  /**
   * Service.
   *
   * @var \Drupal\boilerplate_forms\Service\Steps\Review
   */
  public $review;

  /**
   * Constructor to start order process.
   */
  public function __construct(
    PrivateTempStoreFactory $tsf,
    SessionManagerInterface $sm,
    AccountProxyInterface $cu,
    Settings $ss,
    Base $base,
    Step1 $step1,
    Step2 $step2,
    Step3 $step3,
    Review $review,
  ) {
    $this->tempStoreFactory = $tsf;
    $this->sessionManager = $sm;
    $this->currentUser = $cu;
    $this->siteSettings = $ss;
    $this->base = $base;
    $this->step1 = $step1;
    $this->step2 = $step2;
    $this->step3 = $step3;
    $this->review = $review;

    // Start a manual session for anonymous users.
    if ($this->currentUser->isAnonymous() && !isset($_SESSION['multistep_form_holds_session'])) {
      $_SESSION['multistep_form_holds_session'] = TRUE;
      $this->sessionManager->start();
    }

    $this->store = $this->tempStoreFactory->get('multistep_data');
  }

}
