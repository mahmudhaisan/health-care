<?php

namespace Health\Care;

/**
 * Class Admin
 *
 * @package Health\Care
 */
class Admin
{

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        new Admin\Menu();
        new Admin\Profile();

        $patient_views = new Admin\Patients_Views();

        $this->dispatch_actions($patient_views);

    }

    public function dispatch_actions($patient_views)
    {
        add_action('admin_init', array($patient_views, 'form_handler'));

    }
}
