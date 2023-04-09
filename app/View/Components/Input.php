<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
	protected array $input = [];

	protected string $filename = 'general';

    /**
     * Create a new component instance.
     */
    public function __construct(
		protected string $name,
        protected ?string $type = 'text',
        protected ?string $label = '',
        protected ?string $id = '',
        protected ?string $placeholder = '',
        protected ?string $value = '',
        protected ?string $selected = '',
        protected ?string $class = 'form-control',
        protected ?array $options = [],
        protected ?array $attrs = [],
	) {
        $this->parse_options(); /* Parse Options */
		$this->parse_attrs(); /* Parse Attributes */
		$this->input = init_input(get_defined_vars());
    }

	private function parse_options() :void {
		$this->options['id_prefix'] ??= 'input';
	}

	private function parse_attrs() :void {
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
		if (in_array($this->input['type'], ['radio', 'check'])) {
			$this->filename = 'checklist';
		} elseif (in_array($this->input['type'], ['textarea'])) {
			$this->filename = 'textarea';
		} elseif (in_array($this->input['type'], ['select'])) {
			$this->filename = 'select';
		} elseif (in_array($this->input['type'], ['file'])) {
			$this->filename = 'file';
		} else $this->filename = 'checklist';

		$viewpath = 'components.input.' . $this->filename;
        return view($viewpath, ['input' => $this->input]);
    }
}
