<?php
/** @noinspection PhpUnused */

declare(strict_types=1);

namespace ApplicationInsights\Channel\Contracts;

/**
 * Data contract class for type Exception_Details. Exception details of the exception in a chain.
 */
class Exception_Details extends Base_Data
{
    /**
     * Creates a new ExceptionDetails.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_data->put('typeName', null);
        $this->_data->put('message', null);
        $this->_data->put('hasFullStack', true);
    }

    /**
     * Gets the id field.
     * In case the exception is nested (outer exception contains inner one),
     * the id and outerId properties are used to represent the nesting.
     */
    public function getId(): mixed
    {
        if ($this->_data->hasKey('id')) {
            return $this->_data->get('id');
        }
        return null;
    }

    /**
     * Sets the id field.
     * In case the exception is nested (outer exception contains inner one),
     * the id and outerId properties are used to represent the nesting.
     */
    public function setId($id): void
    {
        $this->_data->put('id', $id);
    }

    /**
     * Gets the outerId field.
     * The value of outerId is a reference to an element in ExceptionDetails that represents the outer exception
     */
    public function getOuterId(): ?int
    {
        if ($this->_data->hasKey('outerId')) {
            return (int)$this->_data->get('outerId');
        }
        return null;
    }

    /**
     * Sets the outerId field.
     * The value of outerId is a reference to an element in ExceptionDetails that represents the outer exception
     */
    public function setOuterId(int $outerId): void
    {
        if ($outerId > 0) {
            $this->_data->put('outerId', $outerId);
        }
    }

    /**
     * Gets the typeName field. Exception type name.
     */
    public function getTypeName(): mixed
    {
        if ($this->_data->hasKey('typeName')) {
            return $this->_data->get('typeName');
        }
        return null;
    }

    /**
     * Sets the typeName field. Exception type name.
     */
    public function setTypeName(mixed $typeName): void
    {
        $this->_data->put('typeName', $typeName);
    }

    /**
     * Gets the message field. Exception message.
     */
    public function getMessage(): ?string
    {
        if ($this->_data->hasKey('message')) {
            return $this->_data->get('message');
        }
        return null;
    }

    /**
     * Sets the message field. Exception message.
     */
    public function setMessage(?string $message): void
    {
        $this->_data->put('message', $message);
    }

    /**
     * Gets the hasFullStack field.
     * Indicates if full exception stack is provided in the exception.
     * The stack may be trimmed, such as in the case of a StackOverflow exception.
     */
    public function getHasFullStack(): bool
    {
        if ($this->_data->hasKey('hasFullStack')) {
            return (bool)$this->_data['hasFullStack'];
        }
        return false;
    }

    /**
     * Sets the hasFullStack field.
     * Indicates if full exception stack is provided in the exception.
     * The stack may be trimmed, such as in the case of a StackOverflow exception.
     */
    public function setHasFullStack(bool $hasFullStack): void
    {
        $this->_data->put('hasFullStack', $hasFullStack);
    }

    /**
     * Gets the stack field. Text describing the stack. Either stack or parsedStack should have a value.
     */
    public function getStack(): ?array
    {
        if ($this->_data->hasKey('stack')) {
            return $this->_data->get('stack');
        }
        return null;
    }

    /**
     * Sets the stack field. Text describing the stack. Either stack or parsedStack should have a value.
     */
    public function setStack(?array $stack): void
    {
        $this->_data->put('stack', $stack);
    }

    /**
     * Gets the parsedStack field. List of stack frames. Either stack or parsedStack should have a value.
     */
    public function getParsedStack(): ?array
    {
        if ($this->_data->hasKey('parsedStack')) {
            return $this->_data->get('parsedStack');
        }
        return null;
    }

    /**
     * Sets the parsedStack field. List of stack frames. Either stack or parsedStack should have a value.
     */
    public function setParsedStack(?array $parsedStack): void
    {
        $this->_data->put('parsedStack', $parsedStack);
    }
}
