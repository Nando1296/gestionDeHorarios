<?php

namespace App\View\Components\Menu;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Funcionalidad extends Component
{
    /**
     * @var string
     */
    public $nombre;
    /**
     * @var string
     */
    public $icono;
    /**
     * @var string
     */
    public $ruta;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $nombre, string $icono, string $ruta)
    {
        $this->nombre = $nombre;
        $this->icono = $icono;
        $this->ruta = $ruta;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.menu.funcionalidad');
    }
}
