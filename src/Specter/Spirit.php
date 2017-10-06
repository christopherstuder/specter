<?php
namespace Specter;

use Specter\Specter;
use Specter\Apparition;

abstract class Spirit
{
    protected $specter;
    protected $layout = 'default';
    protected $params = [];
    protected $post = [];
    protected $get = [];

    public function __construct(Specter $specter, $params = [])
    {
        $this->specter = $specter;
        $this->params = $params;
        $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    }

    protected function render($file, array $vars = []) {
        $r = '';
        $apparition = new Apparition($this->specter);
        $r .= $apparition->appear('layouts/' . $this->layout . '/header.php',
            $vars);
        $r .= $apparition->appear($file, $vars);
        $r .= $apparition->appear('layouts/' . $this->layout . '/footer.php',
            $vars);
        return $r;
    }
}
