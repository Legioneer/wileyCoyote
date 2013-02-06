<?php

class Template
{
    /**
     * Holds the template filename or string
     *
     * @var string
     */
    protected $template;

    /**
     * Array of variables
     *
     * @var array
     */
    protected $variables;

    /**
     * Used to determine whether to include or eval template
     *
     * @var bool
     */
    protected $eval = false;

    /**
     * Construct method
     *
     * @param string $template Template filename or string
     * @param array $variables
     * @param int $type
     */
    public function __construct($template, array $variables = array(), $eval = false)
    {
        $this->template = $template;
        $this->variables = $variables;
        $this->eval = ($eval === true);
    }

    /**
     * Renders template with variables
     *
     * @return string
     */
    public function render()
    {
		extract($this->variables);
        ob_start();
        if ($this->eval === true) {
            eval('?>' . $this->template);
        } else {
            include $this->template;
        }
        return ob_get_clean();
    }

    /**
     * Converts object to string. Relies on render method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
