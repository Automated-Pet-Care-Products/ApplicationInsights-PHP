<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Stack_Frame. Stack frame information.
 */
class Stack_Frame extends Base_Data
{
    /**
     * Creates a new StackFrame.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_data->put('level', null);
        $this->_data->put('method', null);
    }

    /**
     * Gets the level field. Level in the call stack. For long stacks, SDK may not report every function in a call stack.
     */
    public function getLevel(): mixed
    {
        if ($this->_data->hasKey('level')) {
            return $this->_data->get('level');
        }
        return null;
    }

    /**
     * Sets the level field. Level in the call stack. For long stacks, SDK may not report every function in a call stack.
     */
    public function setLevel(mixed $level): void
    {
        $this->_data->put('level', $level);
    }

    /**
     * Gets the method field. Method name.
     */
    public function getMethod(): mixed
    {
        if ($this->_data->hasKey('method')) {
            return $this->_data->get('method');
        }
        return null;
    }

    /**
     * Sets the method field. Method name.
     */
    public function setMethod(mixed $method): void
    {
        $this->_data->put('method', $method);
    }

    /**
     * Gets the assembly field. Name of the assembly (dll, jar, etc.) containing this function.
     */
    public function getAssembly(): ?string
    {
        if ($this->_data->hasKey('assembly')) {
            return $this->_data->get('assembly');
        }
        return null;
    }

    /**
     * Sets the assembly field. Name of the assembly (dll, jar, etc.) containing this function.
     */
    public function setAssembly(?string $assembly): void
    {
        $this->_data->put('assembly', $assembly);
    }

    /**
     * Gets the fileName field. File name or URL of the method implementation.
     */
    public function getFileName(): ?string
    {
        if ($this->_data->hasKey('fileName')) {
            return $this->_data->get('fileName');
        }
        return null;
    }

    /**
     * Sets the fileName field. File name or URL of the method implementation.
     */
    public function setFileName(?string $fileName): void
    {
        $this->_data->put('fileName', $fileName);
    }

    /**
     * Gets the line field. Line number of the code implementation.
     */
    public function getLine(): ?int
    {
        if ($this->_data->hasKey('line')) {
            return $this->_data->get('line');
        }
        return null;
    }

    /**
     * Sets the line field. Line number of the code implementation.
     */
    public function setLine(?int $line): void
    {
        $this->_data->put('line', $line);
    }
}
