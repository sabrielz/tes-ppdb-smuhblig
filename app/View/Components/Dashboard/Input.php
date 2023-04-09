<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public array $input;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        ?string $type = '',
        ?string $label = '',
        ?string $id = '',
        ?string $placeholder = '',
        ?array $options = null,
        ?string $value = '',
        ?int $no = null,
    ) {
        $this->input['name'] = $name;
        $this->input['label'] = (empty($no) ? '' : "$no. ") . $label;

        if (empty($type)) {
            $this->input['type'] = 'text';
        }

        if (empty($label)) {
            $this->input['label'] .= Str::title($this->input['name']);
        }

        if (empty($id)) {
            $this->input['id'] = Str::camel($this->input['name']);
        }

        if (empty($placeholder)) {
            $this->input['placeholder'] = $this->input['label'];
        }

        if (empty($value)) {
            $this->input['value'] = null;
        }

        if (!empty($options)) {
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.input', $this->input);
    }
}
