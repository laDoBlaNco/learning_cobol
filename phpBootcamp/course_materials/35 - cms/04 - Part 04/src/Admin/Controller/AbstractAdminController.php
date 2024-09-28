<?php

namespace App\Admin\Controller;

abstract class AbstractAdminController {
    public function __construct() {}

    protected function render($view, $params) {
        extract($params);
    
        ob_start();
        require __DIR__ . '/../../../views/admin/' . $view . '.view.php';
        $contents = ob_get_clean();
        
        require __DIR__ . '/../../../views/admin/layouts/main.view.php';
    }

    protected function error404() {
        http_response_code(404);
        
        $this->render('abstract/error404', []);
    }
}